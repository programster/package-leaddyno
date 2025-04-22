<?php

use Programster\LeadDyno\LeadDyno;
use Programster\LeadDyno\LineItem;
use Programster\LeadDyno\LineItemCollection;

require_once(__DIR__ . "/settings.php");
require_once(__DIR__ . "/../vendor/autoload.php");

$leadDyno = new LeadDyno(
    LEADDYNO_API_KEY,
    new \GuzzleHttp\Psr7\HttpFactory(),
    new \GuzzleHttp\Client(),
);

$lineItems = new LineItemCollection(
    new LineItem(
        sku: "Botswana1",
        description: "A trip to Botswana",
        quantity: "1",
        amount: "123.45",
    ),
);

$affiliateCode = "testing123";

$response = $leadDyno->createPurchase(
    customerEmail: "test-customer@gmail.com",
    purchaseAmount: 123.45,
    purchaseId: "9eb2d2b1-f4fb-4b2c-84e3-688f950db50d",
    planCode: "Default",
    affiliateCode: $affiliateCode,
    description: "Description of purchase goes here.",
    lineItems: $lineItems,
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


