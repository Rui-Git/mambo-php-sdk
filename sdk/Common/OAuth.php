<?php
// vim: foldmethod=marker

/**
 * The MIT License
 *
 * Copyright (c) 2007 Andy Smith
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
* THE SOFTWARE.
*/

namespace Mambo\Common;

use Mambo\Common\MamboOAuthUtil;
use Mambo\Common\MamboOAuthRequest;

/* Generic exception class
 */
class MamboOAuthException extends \Exception {
	// pass
}

class MamboOAuthConsumer {
	public $key;
	public $secret;

	function __construct($key, $secret, $callback_url=NULL) {
		$this->key = $key;
		$this->secret = $secret;
		$this->callback_url = $callback_url;
	}

	function __toString() {
		return "MamboOAuthConsumer[key=$this->key,secret=$this->secret]";
	}
}

class MamboOAuthToken {
	// access tokens and request tokens
	public $key;
	public $secret;

	/**
	 * key = the token
	 * secret = the token secret
	 */
	function __construct($key, $secret) {
		$this->key = $key;
		$this->secret = $secret;
	}

	/**
	 * generates the basic string serialization of a token that a server
	 * would respond to request_token and access_token calls with
	 */
	function to_string() {
		return "oauth_token=" .
				MamboOAuthUtil::urlencode_rfc3986($this->key) .
				"&oauth_token_secret=" .
				MamboOAuthUtil::urlencode_rfc3986($this->secret);
	}

	function __toString() {
		return $this->to_string();
	}
}

/**
 * A class for implementing a Signature Method
 * See section 9 ("Signing Requests") in the spec
 */
abstract class MamboOAuthSignatureMethod {
	/**
	 * Needs to return the name of the Signature Method (ie HMAC-SHA1)
	 * @return string
	 */
	abstract public function get_name();

	/**
	 * Build up the signature
	 * NOTE: The output of this function MUST NOT be urlencoded.
	 * the encoding is handled in MamboOAuthRequest when the final
	 * request is serialized
	 * @param MamboOAuthRequest $request
	 * @param MamboOAuthConsumer $consumer
	 * @param MamboOAuthToken $token
	 * @return string
	 */
	abstract public function build_signature($request, $consumer, $token);

	/**
	 * Verifies that a given signature is correct
	 * @param MamboOAuthRequest $request
	 * @param MamboOAuthConsumer $consumer
	 * @param MamboOAuthToken $token
	 * @param string $signature
	 * @return bool
	 */
	public function check_signature($request, $consumer, $token, $signature) {
		$built = $this->build_signature($request, $consumer, $token);

		// Check for zero length, although unlikely here
		if (strlen($built) == 0 || strlen($signature) == 0) {
			return false;
		}

		if (strlen($built) != strlen($signature)) {
			return false;
		}

		// Avoid a timing leak with a (hopefully) time insensitive compare
		$result = 0;
		for ($i = 0; $i < strlen($signature); $i++) {
			$result |= ord($built{$i}) ^ ord($signature{$i});
		}

		return $result == 0;
	}
}

/**
 * The HMAC-SHA1 signature method uses the HMAC-SHA1 signature algorithm as defined in [RFC2104]
 * where the Signature Base String is the text and the key is the concatenated values (each first
 * encoded per Parameter Encoding) of the Consumer Secret and Token Secret, separated by an '&'
 * character (ASCII code 38) even if empty.
 *   - Chapter 9.2 ("HMAC-SHA1")
 */
class MamboOAuthSignatureMethod_HMAC_SHA1 extends MamboOAuthSignatureMethod {
	function get_name() {
		return "HMAC-SHA1";
	}

	public function build_signature($request, $consumer, $token) {
		$base_string = $request->get_signature_base_string();
		$request->base_string = $base_string;

		$key_parts = array(
				$consumer->secret,
				($token) ? $token->secret : ""
		);

		$key_parts = MamboOAuthUtil::urlencode_rfc3986($key_parts);
		$key = implode('&', $key_parts);

		return base64_encode(hash_hmac('sha1', $base_string, $key, true));
	}
}

/**
 * The PLAINTEXT method does not provide any security protection and SHOULD only be used
 * over a secure channel such as HTTPS. It does not use the Signature Base String.
 *   - Chapter 9.4 ("PLAINTEXT")
 */
class MamboOAuthSignatureMethod_PLAINTEXT extends MamboOAuthSignatureMethod {
	public function get_name() {
		return "PLAINTEXT";
	}

	/**
	 * oauth_signature is set to the concatenated encoded values of the Consumer Secret and
	 * Token Secret, separated by a '&' character (ASCII code 38), even if either secret is
	 * empty. The result MUST be encoded again.
	 *   - Chapter 9.4.1 ("Generating Signatures")
	 *
	 * Please note that the second encoding MUST NOT happen in the SignatureMethod, as
	 * MamboOAuthRequest handles this!
	 */
	public function build_signature($request, $consumer, $token) {
		$key_parts = array(
				$consumer->secret,
				($token) ? $token->secret : ""
		);

		$key_parts = MamboOAuthUtil::urlencode_rfc3986($key_parts);
		$key = implode('&', $key_parts);
		$request->base_string = $key;

		return $key;
	}
}

/**
 * The RSA-SHA1 signature method uses the RSASSA-PKCS1-v1_5 signature algorithm as defined in
 * [RFC3447] section 8.2 (more simply known as PKCS#1), using SHA-1 as the hash function for
 * EMSA-PKCS1-v1_5. It is assumed that the Consumer has provided its RSA public key in a
 * verified way to the Service Provider, in a manner which is beyond the scope of this
 * specification.
 *   - Chapter 9.3 ("RSA-SHA1")
 */
abstract class MamboOAuthSignatureMethod_RSA_SHA1 extends MamboOAuthSignatureMethod {
	public function get_name() {
		return "RSA-SHA1";
	}

	// Up to the SP to implement this lookup of keys. Possible ideas are:
	// (1) do a lookup in a table of trusted certs keyed off of consumer
	// (2) fetch via http using a url provided by the requester
	// (3) some sort of specific discovery code based on request
	//
	// Either way should return a string representation of the certificate
	protected abstract function fetch_public_cert(&$request);

	// Up to the SP to implement this lookup of keys. Possible ideas are:
	// (1) do a lookup in a table of trusted certs keyed off of consumer
	//
	// Either way should return a string representation of the certificate
	protected abstract function fetch_private_cert(&$request);

	public function build_signature($request, $consumer, $token) {
		$base_string = $request->get_signature_base_string();
		$request->base_string = $base_string;

		// Fetch the private key cert based on the request
		$cert = $this->fetch_private_cert($request);

		// Pull the private key ID from the certificate
		$privatekeyid = openssl_get_privatekey($cert);

		// Sign using the key
		$ok = openssl_sign($base_string, $signature, $privatekeyid);

		// Release the key resource
		openssl_free_key($privatekeyid);

		return base64_encode($signature);
	}

	public function check_signature($request, $consumer, $token, $signature) {
		$decoded_sig = base64_decode($signature);

		$base_string = $request->get_signature_base_string();

		// Fetch the public key cert based on the request
		$cert = $this->fetch_public_cert($request);

		// Pull the public key ID from the certificate
		$publickeyid = openssl_get_publickey($cert);

		// Check the computed signature against the one passed in the query
		$ok = openssl_verify($base_string, $decoded_sig, $publickeyid);

		// Release the key resource
		openssl_free_key($publickeyid);

		return $ok == 1;
	}
}

class MamboOAuthServer {
	protected $timestamp_threshold = 300; // in seconds, five minutes
	protected $version = '1.0';             // hi blaine
	protected $signature_methods = array();

	protected $data_store;

	function __construct($data_store) {
		$this->data_store = $data_store;
	}

	public function add_signature_method($signature_method) {
		$this->signature_methods[$signature_method->get_name()] =
		$signature_method;
	}

	// high level functions

	/**
	 * process a request_token request
	 * returns the request token on success
	 */
	public function fetch_request_token(&$request) {
		$this->get_version($request);

		$consumer = $this->get_consumer($request);

		// no token required for the initial token request
		$token = NULL;

		$this->check_signature($request, $consumer, $token);

		// Rev A change
		$callback = $request->get_parameter('oauth_callback');
		$new_token = $this->data_store->new_request_token($consumer, $callback);

		return $new_token;
	}

	/**
	 * process an access_token request
	 * returns the access token on success
	 */
	public function fetch_access_token(&$request) {
		$this->get_version($request);

		$consumer = $this->get_consumer($request);

		// requires authorized request token
		$token = $this->get_token($request, $consumer, "request");

		$this->check_signature($request, $consumer, $token);

		// Rev A change
		$verifier = $request->get_parameter('oauth_verifier');
		$new_token = $this->data_store->new_access_token($token, $consumer, $verifier);

		return $new_token;
	}

	/**
	 * verify an api call, checks all the parameters
	 */
	public function verify_request(&$request) {
		$this->get_version($request);
		$consumer = $this->get_consumer($request);
		$token = $this->get_token($request, $consumer, "access");
		$this->check_signature($request, $consumer, $token);
		return array($consumer, $token);
	}

	// Internals from here
	/**
	 * version 1
	 */
	private function get_version(&$request) {
		$version = $request->get_parameter("oauth_version");
		if (!$version) {
			// Service Providers MUST assume the protocol version to be 1.0 if this parameter is not present.
			// Chapter 7.0 ("Accessing Protected Ressources")
			$version = '1.0';
		}
		if ($version !== $this->version) {
			throw new MamboOAuthException("OAuth version '$version' not supported");
		}
		return $version;
	}

	/**
	 * figure out the signature with some defaults
	 */
	private function get_signature_method($request) {
		$signature_method = $request instanceof MamboOAuthRequest
		? $request->get_parameter("oauth_signature_method")
		: NULL;

		if (!$signature_method) {
			// According to chapter 7 ("Accessing Protected Ressources") the signature-method
			// parameter is required, and we can't just fallback to PLAINTEXT
			throw new MamboOAuthException('No signature method parameter. This parameter is required');
		}

		if (!in_array($signature_method,
				array_keys($this->signature_methods))) {
			throw new MamboOAuthException(
					"Signature method '$signature_method' not supported " .
					"try one of the following: " .
					implode(", ", array_keys($this->signature_methods))
			);
		}
		return $this->signature_methods[$signature_method];
	}

	/**
	 * try to find the consumer for the provided request's consumer key
	 */
	private function get_consumer($request) {
		$consumer_key = $request instanceof MamboOAuthRequest
		? $request->get_parameter("oauth_consumer_key")
		: NULL;

		if (!$consumer_key) {
			throw new MamboOAuthException("Invalid consumer key");
		}

		$consumer = $this->data_store->lookup_consumer($consumer_key);
		if (!$consumer) {
			throw new MamboOAuthException("Invalid consumer");
		}

		return $consumer;
	}

	/**
	 * try to find the token for the provided request's token key
	 */
	private function get_token($request, $consumer, $token_type="access") {
		$token_field = $request instanceof MamboOAuthRequest
		? $request->get_parameter('oauth_token')
		: NULL;

		$token = $this->data_store->lookup_token(
				$consumer, $token_type, $token_field
		);
		if (!$token) {
			throw new MamboOAuthException("Invalid $token_type token: $token_field");
		}
		return $token;
	}

	/**
	 * all-in-one function to check the signature on a request
	 * should guess the signature method appropriately
	 */
	private function check_signature($request, $consumer, $token) {
		// this should probably be in a different method
		$timestamp = $request instanceof MamboOAuthRequest
		? $request->get_parameter('oauth_timestamp')
		: NULL;
		$nonce = $request instanceof MamboOAuthRequest
		? $request->get_parameter('oauth_nonce')
		: NULL;

		$this->check_timestamp($timestamp);
		$this->check_nonce($consumer, $token, $nonce, $timestamp);

		$signature_method = $this->get_signature_method($request);

		$signature = $request->get_parameter('oauth_signature');
		$valid_sig = $signature_method->check_signature(
				$request,
				$consumer,
				$token,
				$signature
		);

		if (!$valid_sig) {
			throw new MamboOAuthException("Invalid signature");
		}
	}

	/**
	 * check that the timestamp is new enough
	 */
	private function check_timestamp($timestamp) {
		if( ! $timestamp )
			throw new MamboOAuthException(
					'Missing timestamp parameter. The parameter is required'
			);

		// verify that timestamp is recentish
		$now = time();
		if (abs($now - $timestamp) > $this->timestamp_threshold) {
			throw new MamboOAuthException(
					"Expired timestamp, yours $timestamp, ours $now"
			);
		}
	}

	/**
	 * check that the nonce is not repeated
	 */
	private function check_nonce($consumer, $token, $nonce, $timestamp) {
		if( ! $nonce )
			throw new MamboOAuthException(
					'Missing nonce parameter. The parameter is required'
			);

		// verify that the nonce is uniqueish
		$found = $this->data_store->lookup_nonce(
				$consumer,
				$token,
				$nonce,
				$timestamp
		);
		if ($found) {
			throw new MamboOAuthException("Nonce already used: $nonce");
		}
	}

}

class MamboOAuthDataStore {
	function lookup_consumer($consumer_key) {
		// implement me
	}

	function lookup_token($consumer, $token_type, $token) {
		// implement me
	}

	function lookup_nonce($consumer, $token, $nonce, $timestamp) {
		// implement me
	}

	function new_request_token($consumer, $callback = null) {
		// return a new token attached to this consumer
	}

	function new_access_token($token, $consumer, $verifier = null) {
		// return a new access token attached to this consumer
		// for the user associated with this token if the request token
		// is authorized
		// should also invalidate the request token
	}

}



?>
