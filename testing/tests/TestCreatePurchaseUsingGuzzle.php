<?php

namespace Programster\LeadDyno\Testing\Tests;


use Programster\LeadDyno\Testing\AbstractTest;
use Programster\LeadDyno\LeadDyno;
use Programster\LeadDyno\LineItem;
use Programster\LeadDyno\LineItemCollection;


class TestCreatePurchaseUsingGuzzle extends AbstractTest
{
    public function getDescription(): string
    {
        return "Test that we can create a purchase in LeadDyno.";
    }

    public function run()
    {
        $faker = \Faker\Factory::create();

        $leadDyno = new LeadDyno(
            LEADDYNO_API_KEY,
            new \GuzzleHttp\Psr7\HttpFactory(),
            new \GuzzleHttp\Client()
        );

        $lineItems = new LineItemCollection(
            new LineItem(
                $sku = "Botswana4",
                $description = "A trip to Botswana",
                $quantity = "1",
                $amount = "123.45",
            ),
        );

        $affiliateCode = "testing123";

        $response = $leadDyno->createPurchase(
            "test-customer@gmail.com",
            123.45,
            $faker->uuid(),
            "Default",
            $affiliateCode,
            "Description of purchase goes here.",
            "USD",
            true,
            $lineItems,
        );

        if ($response->getStatusCode() === 201) {
            $this->m_passed = true;
        } else {
            $this->m_passed = false;
            $this->m_errorMessage =
                "Response status code: " . $response->getStatusCode() . PHP_EOL .
                "Response body: " . print_r($response->getBody()->getContents(), true) . PHP_EOL;
        }
    }
}



