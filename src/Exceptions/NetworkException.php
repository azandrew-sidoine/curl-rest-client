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

use Exception;

class NetworkException extends Exception
{

	/**
	 * Create exception instance
	 * 
	 * @param string $message
	 * @param int $errorCode
	 */
	public function __construct(string $message = "Connection Error", int $errorCode = 500)
	{
		# code...
		parent::__construct($message, $errorCode);
	}

}