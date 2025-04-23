<?php

use Programster\LeadDyno\LeadDyno;
use Programster\LeadDyno\LineItem;
use Programster\LeadDyno\LineItemCollection;
use Slim\Psr7\Factory\RequestFactory;

require_once(__DIR__ . "/settings.php");
require_once(__DIR__ . "/../vendor/autoload.php");

$useGuzzleForRequests = false;

if ($useGuzzleForRequests)
{
    $leadDyno = new LeadDyno(
        LEADDYNO_API_KEY,
        new RequestFactory(),
        new \Http\Client\Curl\Client()
    );
}
else
{
    $leadDyno = new LeadDyno(
        LEADDYNO_API_KEY,
        new \GuzzleHttp\Psr7\HttpFactory(),
        new \GuzzleHttp\Client()
    );
}

$lineItems = new LineItemCollection(
    new LineItem(
        sku: "Botswana1",
        description: "A trip to Botswana",
        quantity: "1",
        amount: "123.45",
    ),
);

$affiliateCode = "testing123";
$faker = Faker\Factory::create();

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

if ($response->getStatusCode() === 201)
{
    print "Successfully created the purchase!" . PHP_EOL;
}
else
{
    print "Failed to create the purchase." . PHP_EOL;
    print "status code: " . $response->getStatusCode() . PHP_EOL;
    print "response body: " . print_r($response->getBody()->getContents(), true) . PHP_EOL;
}


