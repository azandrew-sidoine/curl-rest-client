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
	 * Get status property value
	 * 
	 *
	 * @return int
	 */
	public function getStatus();

	/**
	 * Returns the response status text
	 * 
	 * @return string 
	 */
	public function getStatusText();

	/**
	 * Get headers property value
	 * 
	 *
	 * @return array
	 */
	public function getHeaders();

	/**
	 * Get reasonPhrase property value
	 * 
	 *
	 * @return string
	 */
	public function getReasonPhrase();

	/**
	 * Returns the actual response body
	 * 
	 * @return mixed
	 */
	public function getBody();
}
