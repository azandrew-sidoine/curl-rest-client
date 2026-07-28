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

final class Client implements ClientInterface
{
	use ClientBase;

	/** @var Client  */
	private $curl;

	/**
	 * creates the curl REST client instance
	 * 
	 * @return void 
	 */
	public function __construct(array $options = [])
	{
		$this->curl = new CurlClient(null, $options);
	}


	/**
	 * creates class instance
	 * 
	 * @param array $options 
	 * 
	 * @return static 
	 */
	public static function new(array $options = [])
	{
		return new static($options);
	}


	/**
	 * creates a client with the base url set
	 * 
	 * @param string $url 
	 * @return static 
	 */
	public static function baseUrl(string $url)
	{
		return new static(['base_url' => $url]);
	}

	public function post(string $url, $body, array $options = [])
	{
		return $this->prepareRequest($options)
			->setMethod('POST')
			->setRequestURI($url)
			->sendRequest($body);
	}

	public function put(string $url, $body, array $options = [])
	{
		return $this->prepareRequest($options ?? [])
			->setMethod('PUT')
			->setRequestURI($url)
			->sendRequest($body);
	}


	public function get(string $url, array $options = [])
	{
		return $this->prepareRequest($options)
			->setMethod('GET')
			->setRequestURI($url)
			->sendRequest($options['body'] ?? []);
	}

	public function delete(string $url, array $options = [])
	{
		return $this->prepareRequest($options)
			->setMethod('DELETE')
			->setRequestURI($url)
			->sendRequest($options['body'] ?? []);
	}

	public function patch(string $url, $body, array $options = [])
	{
		return $this->prepareRequest($options)
			->setMethod('PATCH')
			->setRequestURI($url)
			->sendRequest($body);
	}

	/**
	 * prepare request with user custom request options
	 * 
	 * @param array $options
	 * 
	 * @return static 
	 */
	public function prepareRequest(array $options = [])
	{
		$this->setQuery($options['params'] ?? $options['query'] ?? []);

		foreach ($options['headers'] ?? [] as $key => $value) {
			$this->setHeader($key, $value);
		}

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

		return $this;
	}
}
