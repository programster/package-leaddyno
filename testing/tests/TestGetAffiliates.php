<?php

namespace Programster\LeadDyno\Testing\Tests;

use Programster\LeadDyno\Exceptions\ExceptionUnexpectedResponse;
use Programster\LeadDyno\LeadDyno;
use Programster\LeadDyno\Testing\AbstractTest;

class TestGetAffiliates extends AbstractTest
{
    public function getDescription(): string
    {
        return "Test that we can get the affiliates from LeadDyno.";
    }


    public function run()
    {
        $useGuzzleForRequests = false;

        $leadDyno = new LeadDyno(
            LEADDYNO_API_KEY,
            new \GuzzleHttp\Psr7\HttpFactory(),
            new \GuzzleHttp\Client()
        );

        try
        {
            $affiliates = $leadDyno->getAffiliates();
            $this->m_passed = true;
        }
        catch (ExceptionUnexpectedResponse $exception)
        {
            $response = $exception->getResponse();

            $this->m_passed = false;
            $this->m_errorMessage =
                "Response status code: " . $response->getStatusCode() . PHP_EOL .
                "Response body: " . print_r($response->getBody()->getContents(), true) . PHP_EOL;
        }
    }
}



