<?php

namespace Drewlabs\Curl\REST\Concerns;

use InvalidArgumentException;

trait Response
{
	/** @var int Response status code */
	private $status = null;

	/**  @var array Response headers */
	private $headers = [];

	/** @var string Response reason pharase */
	private $reasonPhrase = null;

	public function getStatus()
	{
		# code...
		return $this->status;
	}

	/**
	 * Alias for `getStatus()` method definition
	 * 
	 * @return int 
	 */
	public function getStatusCode()
	{
		return $this->status;
	}

	public function getStatusText()
	{
		return $this->reasonPhrase;
	}

	public function getHeaders()
	{
		# code...
		return $this->headers ?? [];
	}

	public function getReasonPhrase()
	{
		# code...
		return $this->reasonPhrase ?? 'Unknown';
	}

	public function getHeader(string $name)
	{
		return is_array($header = $this->arrayGet($this->headers ?? [], strtolower($name))) ? array_pop($header) : $header;
	}

	/**
	 * Normalize response headers to match http standards
	 * 
	 * @param array $headers 
	 * @return array 
	 * @throws InvalidArgumentException 
	 */
	private function normalizeHeaders(array $headers)
	{
		$ouput = [];
		foreach ($headers as $key => $value) {
			$ouput[$this->normalizeHeader($key)] = $value;
		}
		return $ouput;
	}

	/**
	 * Normalize Http header value
	 * 
	 * @param mixed $header 
	 * @return string 
	 * @throws InvalidArgumentException 
	 */
	private function normalizeHeader($header)
	{
		$this->assertHeader($header);
		$normalized = strtolower($header);
		return $normalized;
	}
	/**
	 * @see https://tools.ietf.org/html/rfc7230#section-3.2
	 *
	 * @param mixed $header
	 */
	private function assertHeader($header)
	{
		if (!is_string($header)) {
			throw new \InvalidArgumentException(sprintf(
				'Header name must be a string but %s provided.',
				is_object($header) ? get_class($header) : gettype($header)
			));
		}

		if (!preg_match('/^[a-zA-Z0-9\'`#$%&*+.^_|~!-]+$/', $header)) {
			throw new \InvalidArgumentException(
				sprintf(
					'"%s" is not valid header name',
					$header
				)
			);
		}
	}

	/**
	 * Search for a key in an array value
	 * 
	 * @param array $array 
	 * @param string $name 
	 * @return mixed 
	 */
	private function arrayGet(array $array, string $name)
	{
		if (false !== strpos($name, '.')) {
			$keys = explode('.', $name);
			$count = count($keys);
			$index = 0;
			$current = $array;
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
		return array_key_exists($name, $array ?? []) ? $array[$name] : null;
	}
}
