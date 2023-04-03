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
		return $this->setMethod('POST')
			->setRequestURI($url)
			->prepareRequest($options)
			->sendRequest($body);
	}

	public function put(string $url, $body, array $options = [])
	{
		# code...
		return $this->setMethod('PUT')
			->setRequestURI($url)
			->prepareRequest($options ?? [])
			->sendRequest($body);
	}


	public function get(string $url, array $options = [])
	{
		# code...
		return $this->setMethod('GET')
			->setRequestURI($url)
			->prepareRequest($options)
			->sendRequest($options['body'] ?? []);
	}

	public function delete(string $url, array $options = [])
	{
		# code...
		return $this->setMethod('DELETE')
			->setRequestURI($url)
			->prepareRequest($options)
			->sendRequest($options['body'] ?? []);
	}

	public function patch(string $url, $body, array $options = [])
	{
		# code...
		return $this->setMethod('PATCH')
			->setRequestURI($url)
			->prepareRequest($options)
			->sendRequest($body);
	}
}
