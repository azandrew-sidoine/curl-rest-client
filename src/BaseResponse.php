<?php

declare(strict_types=1);
/*
 * (c) Sidoine Azandrew <contact@liksoft.tg>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/

namespace Drewlabs\Curl\REST;

use Drewlabs\Curl\REST\Concerns\Response as ConcernsResponse;
use Drewlabs\Curl\REST\Contracts\ResponseInterface;

final class BaseResponse implements ResponseInterface
{
	use ConcernsResponse;

	/**
	 * Response actual value
	 * 
	 * @var array|object|string
	 */
	private $body = null;

	/**
	 * Creates class instance
	 * 
	 * @param string|mixed $data 
	 * @param int $code 
	 * @param array $headers 
	 */
	public function __construct($data = '', $code = 200, array $headers = [])
	{
		$this->body = $data ?? '';
		$this->status = intval($code);
		$this->headers = $this->normalizeHeaders($headers ?? []);
		$this->reasonPhrase = ReasonPhrase::getPrase($code);
	}

	/**
	 * Returns the actual response body
	 * 
	 * @return array|object|string|null
	 */
	public function getBody()
	{
		return $this->body;
	}
}
