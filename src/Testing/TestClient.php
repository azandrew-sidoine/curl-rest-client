<?php

declare(strict_types=1);
/*
 * (c) Sidoine Azandrew <contact@liksoft.tg>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/

namespace Drewlabs\Curl\REST\Testing;

use Drewlabs\Curl\REST\BaseResponse;
use Drewlabs\Curl\REST\Contracts\ResponseInterface;
use Drewlabs\Curl\REST\Exceptions\BadRequestException;
use Drewlabs\Curl\REST\Exceptions\NetworkException;

class TestClient
{
    /**
     * 
     * @var array
     */
    private static $__MAP__ = [];

    /**
     * Set route maps for test client
     * 
     * @param array<string,string|ResponseInterface|array<string|ResponseInterface>> $map 
     * @return void 
     */
    public static function setRouteResponses(array $map)
    {
        foreach ($map as $key => $value) {
            $key = substr(strval($key), 0, 1) === '/' ? strval($key) : "/$key";
            self::$__MAP__[$key][] = is_string($value) ? [$value, new BaseResponse('', 200, [])] : ($value instanceof ResponseInterface ? ['GET', $value] : $value);
        }
    }

    /**
     * Bind a response for a given route definition
     * 
     * @param string $name 
     * @param ResponseInterface $response 
     * @param string $method 
     * @return void 
     */
    public static function for(string $name, ResponseInterface $response, string $method = 'GET')
    {
        $name = substr(strval($name), 0, 1) === '/' ? strval($name) : "/$name";
        self::$__MAP__[$name][] = [$method ?? 'GET', $response];
    }

    /**
     * Creates a new class instance
     * 
     * @return TestClient 
     */
    public static function new()
    {
        return new self();
    }

    public function post(string $url, $body, array $options = [])
    {
        # code...
        return $this->findMatch($url, 'POST');
    }

    public function put(string $url, $body, array $options = [])
    {
        # code...
        return $this->findMatch($url, 'PUT');
    }


    public function get(string $url, array $options = [])
    {
        # code...
        return $this->findMatch($url, 'GET');
    }

    public function delete(string $url, array $options = [])
    {
        # code...
        return $this->findMatch($url, 'DELETE');
    }

    public function patch(string $url, $body, array $options = [])
    {
        # code...
        return $this->findMatch($url, 'PATCH');
    }

    /**
     * Find the response matching the request url
     * 
     * @param mixed $url 
     * @return mixed 
     * @throws BadRequestException 
     */
    private function findMatch($url, string $method)
    {
        $host = parse_url($url, PHP_URL_HOST);
        if (null === $host) {
            throw new NetworkException("Unable to resolve host URL");
        }
        $rest = substr($url, strpos($url, $host) + strlen($host));
        // TODO: Search for path matching the url
        if (!array_key_exists($rest, self::$__MAP__)) {
            throw new BadRequestException(new BaseResponse([], 404, []));
        }
        $definitions = self::$__MAP__[$rest];
        if (!is_array($definitions)) {
            throw new \RuntimeException("Invalid response definition for $url");
        }
        $response = array_values(array_filter($definitions, function ($value) use ($method) {
            return is_array($value) && strtoupper($value[0]) === strtoupper($method);
        }))[0] ?? null;
        if (!is_array($response) || !isset($response[1])) {
            throw new BadRequestException(new BaseResponse([], 403));
        }
        return $response[1];
    }
}
