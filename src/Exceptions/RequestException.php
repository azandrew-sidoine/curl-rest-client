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

namespace Drewlabs\Curl\REST\Exceptions;


class RequestException extends ClientException
{

	/**
	 * Request status code
	 * 
	 * @var int
	 */
	private $statusCode = null;

	/**
	 * Create exception instance
	 * 
	 * @param string $reasonPhrase
	 * @param int $code
	 */
	public function __construct(string $reasonPhrase = "Unknown Error", int $code = 500)
	{
		# code...
		parent::__construct($reasonPhrase, $code);

		// Set the request status code to equals the code parameter
		$this->statusCode = $code;
	}

	/**
	 * Returns the request exception status code
	 *
	 * @return int
	 */
	public function getStatus()
	{
		# code...
		return $this->statusCode;
	}
}
