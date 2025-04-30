<?php

/*
 * A LeadDyno API client.
 */

namespace Programster\LeadDyno\Exceptions;


use Psr\Http\Message\ResponseInterface;

class ExceptionUnexpectedResponse extends \Exception
{
    private ResponseInterface $response;

    public function __construct(ResponseInterface $response)
    {
        parent::__construct("Unexpected error response from Lead Dyno API.");
    }


    public function getResponse() : ResponseInterface { return $this->response;}
}