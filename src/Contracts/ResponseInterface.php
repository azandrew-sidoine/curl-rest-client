<?php

declare(strict_types=1);
/*
 * (c) Sidoine Azandrew <contact@liksoft.tg>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/

namespace Drewlabs\Curl\REST\Contracts;

interface ResponseInterface
{
	/**
	 * get status property value
	 *
	 * @return int
	 */
	public function getStatus();

	/**
	 * returns the response status text
	 * 
	 * @return string 
	 */
	public function getStatusText();

	/**
	 * get headers property value
	 *
	 * @return array<string,string[]|string>
	 */
	public function getHeaders();

	/**
	 * returns the header value matching the provided $name
	 * 
	 * @param string $name 
	 * @return string|null 
	 */
	public function getHeader(string $name);

	/**
	 * get reasonPhrase property value
	 *
	 * @return string
	 */
	public function getReasonPhrase();

	/**
	 * returns the actual response body
	 * 
	 * @return mixed
	 */
	public function getBody();
}
