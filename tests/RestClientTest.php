<?php

use donatj\MockWebServer\DelayedResponse;
// use donatj\MockWebServer\Exceptions\RuntimeException;
// use donatj\MockWebServer\Exceptions\ServerException;
use donatj\MockWebServer\MockWebServer;
use donatj\MockWebServer\Response;
use donatj\MockWebServer\Responses\NotFoundResponse;
// use Drewlabs\Curl\Mock\PostRequestResponse;
use Drewlabs\Curl\REST\Client;
use PHPUnit\Framework\TestCase;

if (version_compare(PHP_VERSION, '7.1.0') >= 0) {
    class RestClientTest extends TestCase
    {
        /** @var MockWebServer */
        protected static $server;

        /**
         * @notest
         */
        #[\ReturnTypeWillChange]
        public static function setUpBeforeClass(): void
        {
            self::$server = new MockWebServer;
            // The default response is donatj\MockWebServer\Responses\DefaultResponse
            // which returns an HTTP 200 and a descriptive JSON payload.
            //
            // Change the default response to donatj\MockWebServer\Responses\NotFoundResponse
            // to get a standard 404.
            //
            // Any other response may be specified as default as well.
            self::$server->setDefaultResponse(new NotFoundResponse);
            self::$server->start();

            return;
        }

        public function test_rest_client_create_new_instance()
        {
            $client = Client::new();
            $this->assertInstanceOf(Client::class, $client);
        }

        public function test_rest_client_get_request()
        {
            $expects = [
                'id' => 2,
                'reference' => 'TR-98249LBN8724',
                'status' => 0,
                'processors' => [],
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $url = self::$server->setResponseOfPath(
                '/api/transactions',
                new DelayedResponse(
                    new Response(json_encode($expects)),
                    1000
                )
            );
            $response = Client::new()->get($url);
            $this->assertEquals($expects, $response->getBody());
        }

        /**
         * @notest
         */
        static function tearDownAfterClass(): void
        {
            // stopping the web server during tear down allows us to reuse the port for later tests
            self::$server->stop();

            return;
        }
    }
}
