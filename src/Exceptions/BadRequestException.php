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

use Drewlabs\Curl\REST\Contracts\ResponseInterface;

class BadRequestException extends ClientException
{
    /**
     * 
     * @var ResponseInterface
     */
    private $response;

    /**
     * Creates exception class instance
     * 
     * @param ResponseInterface $response 
     */
    public function __construct(ResponseInterface $response)
    {
        parent::__construct('Bad Request', $response->getStatus());
        $this->response = $response;
    }

    /**
     * Returns the request response
     * 
     * @return ResponseInterface 
     */
    public function getResponse()
    {
        return $this->response;
    }
}
