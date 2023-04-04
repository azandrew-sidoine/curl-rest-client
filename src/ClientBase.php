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
use Drewlabs\Curl\Converters\JSONDecoder;
use Closure;
use Drewlabs\Curl\REST\Exceptions\BadRequestException;
use Drewlabs\Curl\REST\Exceptions\ClientException;
use Drewlabs\Curl\REST\Exceptions\RequestException;
use Drewlabs\Curl\REST\Contracts\JSONBodyBuilder;
use Drewlabs\Curl\REST\Contracts\ClientInterface;

trait ClientBase
{
	/**
	 * @var string
	 */
	private $path = null;


	/**
	 * @var string
	 */
	private $method = 'GET';

	/**
	 * 
	 * @var CurlClient
	 */
	private $curl;

	/**
	 * @var array
	 */
	private $__HEADERS__ = [];

	/**
	 * @var array
	 */
	private $__COOKIES__ = [];

	/**
	 * @var array
	 */
	private $__QUERIES__ = [];

	/**
	 * Set the request HTTP verb to use when sending requests
	 * 
	 * @param string $method
	 * 
	 * ```php
	 * <?php
	 * 
	 * $client = Client::new(); // Creates a REST client
	 * 
	 * $client = $client->setMethod("DELETE"); // Set the request HTTP verb
	 * ```
	 *
	 * @return static|ClientInterface
	 */
	public function setMethod(string $method)
	{
		$self = clone $this;
		$self->method = $method;
		return $self;
	}

	/**
	 * Set the request URI for the current client
	 * 
	 * **Note** When using the rest interfaces (get, post, put, delete), the url passed as parameter
	 * will override this property.
	 * 
	 * 
	 * ```php
	 * <?php
	 * 
	 * $client = Client::new(); // Creates a REST client
	 * 
	 * $client = $client->setRequestURI("http://localhost:8000/api/posts"); // Set the request URI parameter
	 * ```
	 * 
	 * @param string $path
	 *
	 * @return self|ClientInterface
	 */
	public function setRequestURI(string $path)
	{
		$self = clone $this;
		$self->path = $path;
		return $self;
	}

	/**
	 * Set request header value
	 * 
	 * **Note** When using the REST client get, post(), put(), patch(), delete() interfaces, `headers` option might
	 * override the values set using this method
	 * 
	 * ```php
	 * <?php
	 * 
	 * $client = Client::new(); // Creates a REST client
	 * 
	 * $client = $client->setHeader('Authorization', 'Basic ' . base64_encode(sprintf("%s:%s", "user", "password")));
	 * ```
	 * 
	 * @param string $name
	 * @param string $value
	 *
	 * @return static|ClientInterface
	 */
	public function setHeader(string $name, string $value)
	{
		# code...
		$this->__HEADERS__[$name] = $value;
		return $this;
	}

	/**
	 * Set request cookie value
	 * 
	 * @param string $name
	 * @param string $value
	 *
	 * @return static|ClientInterface
	 */
	public function setCookie(string $name, string $value)
	{
		# code...
		$this->__COOKIES__[$name] = $value;
		return $this;
	}

	/**
	 * Add bearer token authorization header to request
	 * 
	 * **Note** Creates a copy of the request client adding `Authorization: Bearer <TOKEN>` header
	 * 
	 * ```php
	 * <?php
	 * 
	 * $client = Client::new(); // Creates a REST client
	 * 
	 * $client = $client->withBearerToken('...');
	 * ```
	 * 
	 * @param string $token
	 *
	 * @return static|ClientInterface
	 */
	public function withBearerToken(string $token)
	{
		# code...
		$self = clone $this;
		return $self->setHeader("Authorization", "Bearer $token");
	}

	/**
	 * Add Basic authorization header to request
	 * 
	 * **Note** Creates a copy of the request client adding `Authorization: Basic <TOKEN>` header
	 * 
	 * ```php
	 * <?php
	 * 
	 * $client = Client::new(); // Creates a REST client
	 * 
	 * $client = $client->withBasicAuth('user', 'password');
	 * ```
	 * 
	 * @param string $user
	 * @param string $password
	 *
	 * @return static|ClientInterface
	 */
	public function withBasicAuth(string $user, string $password)
	{
		# code...
		$self = clone $this;
		return $self->setHeader("Authorization", "Basic " . base64_encode(sprintf("%s:%s", $user, $password)));
	}

	/**
	 * Add request query
	 * 
	 * ```php
	 * <?php
	 * 
	 * $client = Client::new(); // Creates a REST client
	 * 
	 * $client = $client->setQuery([
	 * 		'title' => '...',
	 * 		'post_type' => '...'
	 * ]); // Set a list of query parameters that might be applied to the request client
	 * ```
	 * 
	 * @param array $query
	 *
	 * @return static|ClientInterface
	 */
	public function setQuery(array $query)
	{
		# code...
		$this->__QUERIES__ = $query;
		return $this;
	}

	/**
	 * Returns request headers
	 * 
	 *
	 * @return array
	 */
	public function getHeaders()
	{
		# code...
		return $this->__HEADERS__ ?? [];
	}

	/**
	 * Returns request cookies
	 * 
	 *
	 * @return array
	 */
	public function getCookies()
	{
		# code...
		return $this->__COOKIES__ ?? [];
	}

	/**
	 * Returns request query
	 * 
	 *
	 * @return array
	 */
	public function getQuery()
	{
		# code...
		return $this->__QUERIES__ ?? [];
	}

	/**
	 * Provides a proxy interface to the internal curl client
	 * 
	 * @param string $method
	 * @param mixed $parameters
	 *
	 * @return mixed
	 */
	public function __call(string $method, $parameters)
	{
		return call_user_func([$this->curl, $method], ...$parameters);
	}

	/**
	 * {@inheritDoc}
	 * 
	 * @param array|JSONBodyBuilder|Closure(Response $response):mixed $body
	 * @param Closure(Response $response):mixed $callback
	 *
	 * @return Response|mixed
	 */
	public function sendRequest($body = null, Closure $callback = null)
	{
		list($body, $callback) = isset($body) && $body instanceof \Closure ? [null, $body] : [$body, $callback];
		# code...
		$this->curl->setOption(\CURLOPT_RETURNTRANSFER, true);
		$this->curl->setProtocolVersion('1.1');
		// #region Send the request to the external server
		$this->curl->send(
			$this->method,
			$this->appendQuery($this->path),
			array_merge([
				'headers' => $this->mergeRequestHeaders(),
				'cookies' => $this->getCookies()
			], $body ? ['body' => is_array($body) ? $body : $body->json()] : [])
		);
		// #endregion Send request to the external server

		// #region Handle request response
		$response = $this->curl->getResponse();
		if (!empty(trim($errorMessage = $this->curl->getErrorMessage()) || (0 !== $this->curl->getError()))) {
			throw new ClientException('Client request Error: ' . ($errorMessage ?? 'Unkkown error'));
		}
		// # Get the request response status code to evaluate for bad response
		$statusCode = intval($this->curl->getStatusCode());
		$responseHeaders = $this->parseResponseHeaders($this->curl->getResponseHeaders());
		if ($statusCode >= 400 && $statusCode <= 499) {
			$decoded = $this->decodeRequestResponse($response, $responseHeaders);
			throw new BadRequestException(new BaseResponse($decoded, $statusCode, $responseHeaders));
		}

		// Case the request ins not between 200 and 299, throw a request exception
		if (!(200 >= $statusCode &&  $statusCode <= 299)) {
			throw new RequestException(empty(trim($errorMessage)) ? ReasonPhrase::getPrase($statusCode) : $errorMessage, $statusCode);
		}

		// TODO : return the response to caller
		$callback = $callback ?? function ($value) {
			return $value;
		};
		// Decode response before sending it to the client
		$decoded = $this->decodeRequestResponse($response, $responseHeaders);
		// #endregion Handle request response

		// Call the provided callback at the end of the execution stack
		return $callback(new Response($decoded, $statusCode, $responseHeaders));
	}

	/**
	 * Prepare request uri appending request url encoded query parameters
	 * 
	 * @param string $path 
	 * @return string 
	 */
	private function appendQuery(string $path)
	{
		$query = $this->getQuery();
		return sprintf("%s%s", $path, implode('&', array_map(function ($key, $value) {
			return urlencode(strval($key)) . '=' . urlencode(strval($value));
		}, array_keys((array)$query), array_values((array)$query))));
	}

	/**
	 * Merge request header with default json headers
	 * 
	 * @return string[] 
	 */
	private function mergeRequestHeaders()
	{
		$defaultHeaders = ['Content-Type' => 'application/json', 'Accept' => '*/*'];
		return array_merge($defaultHeaders, $this->getHeaders());
	}

	/**
	 * Decode request response
	 * 
	 * @param string $response 
	 * @param array $headers 
	 * @return array|mixed
	 * 
	 * @throws JsonException 
	 */
	private function decodeRequestResponse(string $response, array $headers = [])
	{
		if (false !== preg_match('/^(?:application|text)\/(?:[a-z]+(?:[\.-][0-9a-z]+){0,}[\+\.]|x-)?json(?:-[a-z]+)?/i', $this->getHeader($headers, 'content-type'))) {
			return (array)((new JSONDecoder)->decode($response));
		}
		// If the Content-Type header is not present in the response headers, we apply the try catch clause
		// To insure no error is thrown when decoding.
		try {
			return (array)((new JSONDecoder)->decode($response) ?? []);
		} catch (\Throwable $e) {
			return $response;
		}
	}

	/**
	 * Parse request string headers
	 * 
	 * @param mixed $list 
	 * 
	 * @return array 
	 */
	private function parseResponseHeaders($list)
	{
		$list = preg_split('/\r\n/', (string) ($list ?? ''), -1, PREG_SPLIT_NO_EMPTY);
		$httpHeaders = [];
		$httpHeaders['Request-Line'] = reset($list) ?? '';
		for ($i = 1; $i < count($list); $i++) {
			if (strpos($list[$i], ':') !== false) {
				list($key, $value) = array_map(function ($item) {
					return $item ? trim($item) : null;
				}, explode(':', $list[$i], 2));
				$httpHeaders[$key] = $value;
			}
		}
		return $httpHeaders;
	}

	/**
	 * Get request header caseless
	 * 
	 * @param array $headers 
	 * @param string $name 
	 * @return string
	 */
	private function getHeader(array $headers, string $name)
	{
		if (empty($headers)) {
			return null;
		}
		$normalized = strtolower($name);
		foreach ($headers as $key => $header) {
			if (strtolower($key) === $normalized) {
				return implode(',', is_array($header) ? $header : [$header]);
			}
		}
		return null;
	}

	/**
	 * Perpare request with user custom request options
	 * 
	 * @param array $options
	 * @return self 
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
		return $this;
	}
}
