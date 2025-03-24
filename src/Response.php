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

class Response implements ResponseInterface
{
    use ConcernsResponse;

    /** @var array Response actual value */
    private $json = null;

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
		$this->headers = $this->normalizeHeaders($headers ?? []);
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
        return $this->arrayGet($this->json ?? [], $name);
    }

    public function getBody()
    {
        return $this->json;
    }

    /**
     * Get json property value
     * 
     *
     * @return array
     */
    public function getJson()
    {
        return $this->json;
    }
}
