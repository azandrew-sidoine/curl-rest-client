<?php

declare(strict_types=1);
/*
 * (c) Sidoine Azandrew <contact@liksoft.tg>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/

namespace Drewlabs\Curl\REST\Contracts;

use Drewlabs\Curl\REST\Exceptions\ClientException;
use Drewlabs\Curl\REST\Exceptions\BadRequestException;
use Drewlabs\Curl\REST\Exceptions\RequestException;
use InvalidArgumentException;
use RuntimeException;
use Drewlabs\Curl\REST\Response;

interface ClientInterface
{
    /**
     * Send HTTP request with `POST` verb
     * 
     * ```php
     * <?php
     * 
     * // .../MyBodyBuilder.php
     * class MyBodyBuilder implements JSONBodyBuilder {
     * 		// ...
     * 		public function json()
     * 		{
     * 			return [
     * 				'title' => $this->title,
     * 				'comments' => $this->comments
     * 			];
     * 		}
     * }
     * 
     * $builder = MyBodyBuilder::new()->setTitle(...)
     * 							->setComments(...);
     * 
     * $client = \Drewlabs\Curl\REST\Client::new();
     * 
     * // Sending the actual request
     * $client->post('http://localhost/api/posts', $builder, [
     * 		'verifypeer' => false, // Disable peer verification when sending request to https secure servers
     * ]);
     * 
     * ```
     * 
     * @param string $url 
     * @param JSONBodyBuilder|array  $body 
     * @param array $options 
     * @return Response 
     * @throws InvalidArgumentException 
     * @throws RuntimeException 
     * @throws ClientException 
     * @throws BadRequestException 
     * @throws RequestException 
     */
    public function post(string $url, $body, array $options = []);

    /**
     * Send HTTP request with `PUT` verb
     * 
     * ```php
     * <?php
     * 
     * // .../MyBodyBuilder.php
     * class MyBodyBuilder implements JSONBodyBuilder {
     * 		// ...
     * 		public function json()
     * 		{
     * 			return [
     * 				'title' => $this->title,
     * 				'comments' => $this->comments
     * 			];
     * 		}
     * }
     * 
     * $builder = MyBodyBuilder::new()->setTitle(...)
     * 							->setComments(...);
     * 
     * $client = \Drewlabs\Curl\REST\Client::new();
     * 
     * // Sending the actual request
     * $client->put('http://localhost/api/posts/2', $builder, [
     * 		'verifypeer' => false, // Disable peer verification when sending request to https secure servers
     * ]);
     * 
     * ```
     * 
     * @param string $url 
     * @param JSONBodyBuilder|array $body 
     * @param array $options 
     * @return Response 
     * @throws InvalidArgumentException 
     * @throws RuntimeException 
     * @throws ClientException 
     * @throws BadRequestException 
     * @throws RequestException 
     */
    public function put(string $url, $body, array $options = []);

    /**
     * Send HTTP request with `GET` verb
     * **Note** Any value `n` other o or -1 passed as redirect option with follow the max `n` redirect
     * 
     * ```php
     * <?php
     * 
     * $client = \Drewlabs\Curl\REST\Client::new();
     * 
     * // Sending the actual request
     * $client->get('http://localhost/api/posts', [
     * 		'headers' => ['Accept' => 'application/json'],
     * 		'params' => ['title' => ...] // Query parameters,
     * 		'timeout' => 3, // Set the timeout to 3seconds,
     * 		'redirect' => -1, // Instruct curl to follow any redirect. 0 -> Does not follows redirect
     * 		'verifypeer' => false, // Disable peer verification when sending request to https secure servers 
     * ]);
     * 
     * ```
     * **Note** In case of GET & DELETE requests, body can be passed as option to the request
     * 
     * ```
     * <?php
     * 
     * $client = \Drewlabs\Curl\REST\Client::new();
     * 
     * // Sending the actual request
     * $client->get('http://localhost/api/posts', [
     * 		// ...
     * 		'body' => [...]
     * ]);
     * ```
     * 
     * @param string $url 
     * @param array $options 
     * @return Response 
     * @throws InvalidArgumentException 
     * @throws RuntimeException 
     * @throws ClientException 
     * @throws BadRequestException 
     * @throws RequestException 
     */
    public function get(string $url, array $options = []);

    /**
     * Send an HTTP request with the `DELETE` verb
     * 
     * ```php
     * <?php
     * 
     * $client = \Drewlabs\Curl\REST\Client::new();
     * 
     * // Sending the actual request
     * $client->delete('http://localhost/api/posts', [
     * 		'headers' => ['Accept' => 'application/json'],
     * 		'params' => ['title' => ...] // Query parameters,
     * 		'timeout' => 3, // Set the timeout to 3seconds
     * ]);
     * ```
     * 
     * **Note** In case of GET & DELETE requests, body can be passed as option to the request
     * 
     * ```
     * <?php
     * 
     * $client = \Drewlabs\Curl\REST\Client::new();
     * 
     * // Sending the actual request
     * $client->delete('http://localhost/api/posts', [
     * 		// ...
     * 		'body' => [...]
     * ]);
     * ```
     * 
     * @param string $url 
     * @param array $options
     * 
     * @return Response 
     */
    public function delete(string $url, array $options = []);

    /**
     * Send HTTP request with `PATCH` verb
     * 
     * ```php
     * <?php
     * 
     * $client = \Drewlabs\Curl\REST\Client::new();
     * 
     * // Sending the actual request
     * $client->patch('http://localhost/api/posts', [/.../], [...]);
     * ```
     * 
     * @param string $url 
     * @param JSONBodyBuilder|array $body 
     * @param array $options 
     * @return Response 
     * @throws InvalidArgumentException 
     * @throws RuntimeException 
     * @throws ClientException 
     * @throws BadRequestException 
     * @throws RequestException 
     */
    public function patch(string $url, $body, array $options = []);

    /**
     * Send the request to backend server
	 * 
	 * @param array|JSONBodyBuilder|\Closure(Response $response):mixed $body
     * 
	 * @param \Closure(Response $response):mixed $callback
	 *
	 * @return Response|mixed
	 */
	public function sendRequest($body = null, ?\Closure $callback = null);
}
