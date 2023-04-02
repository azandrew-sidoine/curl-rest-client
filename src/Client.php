<?php

declare(strict_types=1);
/*
 * This file is auto generated using the drewlabs code generator package (v2.4)
 *
 * (c) Sidoine Azandrew <contact@liksoft.tg>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/

namespace Drewlabs\Curl\REST;

use Drewlabs\Curl\Client as CurlClient;
use Drewlabs\Curl\REST\Contracts\ClientInterface;

class Client implements ClientInterface
{
	use ClientBase;

	/**
	 * 
	 * @var Client
	 */
	private $curl;

	/**
	 * Creates the curl REST client instance
	 * 
	 * @return void 
	 */
	public function __construct(array $options = [])
	{
		$this->curl = new CurlClient(null, $options);
	}


	/**
	 * Creates class instance
	 * 
	 * @param array $options 
	 * @return Client 
	 */
	public static function new(array $options = [])
	{
		return new self($options);
	}

	public function post(string $url, $body, array $options = [])
	{
		# code...
		$this->setMethod('POST');
		$this->setRequestURI($url);
		$this->prepareRequest($options);
		return $this->sendRequest($body);
	}

	public function put(string $url, $body, array $options = [])
	{
		# code...
		$this->setMethod('PUT');
		$this->setRequestURI($url);
		$this->prepareRequest($options ?? []);
		return $this->sendRequest($body);
	}


	public function get(string $url, array $options = [])
	{
		# code...
		$this->setMethod('GET');
		$this->setRequestURI($url);
		$this->prepareRequest($options);
		return $this->sendRequest($options['body'] ?? []);
	}

	public function delete(string $url, array $options = [])
	{
		# code...
		$this->setMethod('DELETE');
		$this->setRequestURI($url);
		$this->prepareRequest($options);
		// In case of GET & DELETE requests, body can be passed as option to the request
		return $this->sendRequest($options['body'] ?? []);
	}

	public function patch(string $url, $body, array $options = [])
	{
		# code...
		$this->setMethod('PATCH');
		$this->setRequestURI($url);
		$this->prepareRequest($options);
		return $this->sendRequest($body);
	}

	/**
	 * Perpare request with user custom request options
	 * 
	 * @param array $options
	 * @return void 
	 */
	private function prepareRequest(array $options = [])
	{
		$this->setQuery($options['params'] ?? $options['query'] ?? []);
		// Set request headers
		foreach ($options['headers'] ?? [] as $key => $value) {
			$this->setHeader($key, $value);
		}
		// Set request cookies
		foreach ($options['cookies'] ?? [] as $key => $value) {
			$this->setCookie($key, $value);
		}
		if (isset($options['verifypeer']) && (false === $options['verifypeer'])) {
			$this->curl->disableSSLVerification();
		}

		if (isset($options['timeout']) && is_numeric($options['timeout'])) {
			$this->curl->timeout(intval($options['timeout']) * 1000);
		}

		if (isset($options['redirect']) && (0 !== $options['redirect'])) {
			$this->curl->followLocation();
			$redirect = intval($options['redirect']);
			if ($redirect !== -1) {
				$this->curl->maxRedirects($redirect);
			}
		}
	}
}
