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

final class Response
{

	/**
	 * Response actual value
	 * 
	 * @var array|object
	 */
	private $json = null;

	/**
	 * Response status code
	 * 
	 * @var int
	 */
	private $status = null;

	/**
	 * Response headers
	 * 
	 * @var array
	 */
	private $headers = [];

	/**
	 * Response reason pharase
	 * 
	 * @var string
	 */
	private $reasonPhrase = null;

	/**
	 * Creates class instance
	 * 
	 * @param array $data 
	 * @param int $statusCode 
	 * @param array $headers 
	 */
	public function __construct($data = [], $statusCode = 200, array $headers = [])
	{
		$this->json = (array)($data ?? []);
		$this->status = $statusCode;
		$this->headers = $headers ?? [];
		$this->reasonPhrase = ReasonPhrase::getPrase($statusCode);
	}

	/**
	 * Return a property key / attribute from the response body
	 * 
	 * @param string $name
	 *
	 * @return mixed
	 */
	public function get(string $name)
	{
		# code...
		if (false !== strpos($name, '.')) {
			$keys = explode('.', $name);
			$count = count($keys);
			$index = 0;
			$current = $this->json;
			while ($index < $count) {
				# code...
				if (null === $current) {
					return null;
				}
				$current = array_key_exists($keys[$index], $current) ? $current[$keys[$index]] : $current[$keys[$index]] ?? null;
				$index += 1;
			}
			return $current;
		}
		return array_key_exists($name, $this->json ?? []) ? $this->json[$name] : null;
	}

	/**
	 * Returns the actual response body
	 * 
	 *
	 * @return array|object
	 */
	public function getBody()
	{
		# code...
		return $this->json;
	}

	/**
	 * Get json property value
	 * 
	 *
	 * @return array|object
	 */
	public function getJson()
	{
		# code...
		return $this->json;
	}

	/**
	 * Get status property value
	 * 
	 *
	 * @return int
	 */
	public function getStatus()
	{
		# code...
		return $this->status;
	}

	/**
	 * Returns the response status text
	 * 
	 * @return string 
	 */
	public function getStatusText()
	{
		return $this->reasonPhrase;
	}

	/**
	 * Get headers property value
	 * 
	 *
	 * @return array
	 */
	public function getHeaders()
	{
		# code...
		return $this->headers ?? [];
	}

	/**
	 * Get reasonPhrase property value
	 * 
	 *
	 * @return string
	 */
	public function getReasonPhrase()
	{
		# code...
		return $this->reasonPhrase ?? 'Unknown';
	}
}
