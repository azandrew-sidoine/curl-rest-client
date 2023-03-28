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
use Drewlabs\Curl\REST\Exceptions\ClientException;
use Drewlabs\Curl\REST\Exceptions\BadRequestException;
use Drewlabs\Curl\REST\Exceptions\RequestException;
use InvalidArgumentException;
use RuntimeException;
use Drewlabs\Curl\REST\Contracts\JSONBodyBuilder;

class Client
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

	/**
	 * Send HTTP request with `POST` verb
	 * 
	 * ```php
	 * <?php
	 * 
	 * // .../MyBodyBuilder.php
	 * class MyBodyBuilder implements JSONBodyBuilder {
	 * 		// ...
	 * 		public function json()
	 * 		{
	 * 			return [
	 * 				'title' => $this->title,
	 * 				'comments' => $this->comments
	 * 			];
	 * 		}
	 * }
	 * 
	 * $builder = MyBodyBuilder::new()->setTitle(...)
	 * 							->setComments(...);
	 * 
	 * $client = \Drewlabs\Curl\REST\Client::new();
	 * 
	 * // Sending the actual request
	 * $client->post('http://localhost/api/posts', $builder, [
	 * 		'verifypeer' => false, // Disable peer verification when sending request to https secure servers
	 * ]);
	 * 
	 * ```
	 * 
	 * @param string $url 
	 * @param JSONBodyBuilder|array  $body 
	 * @param array $options 
	 * @return Response 
	 * @throws InvalidArgumentException 
	 * @throws RuntimeException 
	 * @throws ClientException 
	 * @throws BadRequestException 
	 * @throws RequestException 
	 */
	public function post(string $url, $body, array $options = [])
	{
		# code...
		$this->setMethod('POST');
		$this->setRequestURI($url);
		$this->prepareRequest($options);
		return $this->sendRequest($body);
	}

	/**
	 * Send HTTP request with `PUT` verb
	 * 
	 * ```php
	 * <?php
	 * 
	 * // .../MyBodyBuilder.php
	 * class MyBodyBuilder implements JSONBodyBuilder {
	 * 		// ...
	 * 		public function json()
	 * 		{
	 * 			return [
	 * 				'title' => $this->title,
	 * 				'comments' => $this->comments
	 * 			];
	 * 		}
	 * }
	 * 
	 * $builder = MyBodyBuilder::new()->setTitle(...)
	 * 							->setComments(...);
	 * 
	 * $client = \Drewlabs\Curl\REST\Client::new();
	 * 
	 * // Sending the actual request
	 * $client->put('http://localhost/api/posts/2', $builder, [
	 * 		'verifypeer' => false, // Disable peer verification when sending request to https secure servers
	 * ]);
	 * 
	 * ```
	 * 
	 * @param string $url 
	 * @param JSONBodyBuilder|array $body 
	 * @param array $options 
	 * @return Response 
	 * @throws InvalidArgumentException 
	 * @throws RuntimeException 
	 * @throws ClientException 
	 * @throws BadRequestException 
	 * @throws RequestException 
	 */
	public function put(string $url, $body, array $options = [])
	{
		# code...
		$this->setMethod('PUT');
		$this->setRequestURI($url);
		$this->prepareRequest($options ?? []);
		return $this->sendRequest($body);
	}

	/**
	 * Send HTTP request with `GET` verb
	 * **Note** Any value `n` other o or -1 passed as redirect option with follow the max `n` redirect
	 * 
	 * ```php
	 * <?php
	 * 
	 * $client = \Drewlabs\Curl\REST\Client::new();
	 * 
	 * // Sending the actual request
	 * $client->get('http://localhost/api/posts', [
	 * 		'headers' => ['Accept' => 'application/json'],
	 * 		'params' => ['title' => ...] // Query parameters,
	 * 		'timeout' => 3, // Set the timeout to 3seconds,
	 * 		'redirect' => -1, // Instruct curl to follow any redirect. 0 -> Does not follows redirect
	 * 		'verifypeer' => false, // Disable peer verification when sending request to https secure servers 
	 * ]);
	 * 
	 * ```
	 * **Note** In case of GET & DELETE requests, body can be passed as option to the request
	 * 
	 * ```
	 * <?php
	 * 
	 * $client = \Drewlabs\Curl\REST\Client::new();
	 * 
	 * // Sending the actual request
	 * $client->get('http://localhost/api/posts', [
	 * 		// ...
	 * 		'body' => [...]
	 * ]);
	 * ```
	 * 
	 * @param string $url 
	 * @param array $options 
	 * @return Response 
	 * @throws InvalidArgumentException 
	 * @throws RuntimeException 
	 * @throws ClientException 
	 * @throws BadRequestException 
	 * @throws RequestException 
	 */
	public function get(string $url, array $options = [])
	{
		# code...
		$this->setMethod('GET');
		$this->setRequestURI($url);
		$this->prepareRequest($options);
		return $this->sendRequest($options['body'] ?? []);
	}

	/**
	 * Send an HTTP request with the `DELETE` verb
	 * 
	 * ```php
	 * <?php
	 * 
	 * $client = \Drewlabs\Curl\REST\Client::new();
	 * 
	 * // Sending the actual request
	 * $client->delete('http://localhost/api/posts', [
	 * 		'headers' => ['Accept' => 'application/json'],
	 * 		'params' => ['title' => ...] // Query parameters,
	 * 		'timeout' => 3, // Set the timeout to 3seconds
	 * ]);
	 * ```
	 * 
	 * **Note** In case of GET & DELETE requests, body can be passed as option to the request
	 * 
	 * ```
	 * <?php
	 * 
	 * $client = \Drewlabs\Curl\REST\Client::new();
	 * 
	 * // Sending the actual request
	 * $client->delete('http://localhost/api/posts', [
	 * 		// ...
	 * 		'body' => [...]
	 * ]);
	 * ```
	 * 
	 * @param string $url 
	 * @param array $options
	 * 
	 * @return Response 
	 */
	public function delete(string $url, array $options = [])
	{
		# code...
		$this->setMethod('DELETE');
		$this->setRequestURI($url);
		$this->prepareRequest($options);
		// In case of GET & DELETE requests, body can be passed as option to the request
		return $this->sendRequest($options['body'] ?? []);
	}

	/**
	 * Send HTTP request with `PATCH` verb
	 * 
	 * ```php
	 * <?php
	 * 
	 * $client = \Drewlabs\Curl\REST\Client::new();
	 * 
	 * // Sending the actual request
	 * $client->patch('http://localhost/api/posts', [/.../], [...]);
	 * ```
	 * 
	 * @param string $url 
	 * @param JSONBodyBuilder|array $body 
	 * @param array $options 
	 * @return Response 
	 * @throws InvalidArgumentException 
	 * @throws RuntimeException 
	 * @throws ClientException 
	 * @throws BadRequestException 
	 * @throws RequestException 
	 */
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
