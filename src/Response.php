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

    /**
     * Response actual value
     * 
     * @var array|object
     */
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
}
