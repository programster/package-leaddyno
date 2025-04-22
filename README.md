LeadDyno PHP Package
====================

An SDK for interfacing with the LeadDyno RESTful API in PHP. 


## Usage

### Installation
Install this in your codebase with composer like so:

```bash
composer require programster/leaddyno
```

### Example Code
The following example creates a LeadDyno client, and uses it to tell LeadDyno that there was a sale
that was the result of a specific affiliate code.

```php
<?php

use Programster\LeadDyno\LeadDyno;
use Programster\LeadDyno\LineItem;
use Programster\LeadDyno\LineItemCollection;

require_once(__DIR__ . "/../vendor/autoload.php");

$myLeadDynoApiKey = "xxxxxxxxxxxxxxxxxxxxxxxxxx";

$leadDyno = new LeadDyno(
    $myLeadDynoApiKey,
    new \GuzzleHttp\Psr7\HttpFactory(),
    new \GuzzleHttp\Client(),
);

$lineItems = new LineItemCollection(
    new LineItem(
        sku: "Botswana1",
        description: "A ticket to Botswana",
        quantity: "1",
        amount: "123.45",
    ),
);

$response = $leadDyno->createPurchase(
    customerEmail: "test-customer@somedomain.com",
    purchaseAmount: 123.45,
    purchaseId: "9eb2d2b1-f4fb-4b2c-84e3-688f950db50d",
    planCode: "Default",
    affiliateCode: "someAffiliateCode",
    description: "Description of purchase goes here.",
    lineItems: $lineItems,
);

if ($response->getStatusCode() === 201)
{
    // Purchase succssfully registered...
}
else
{
    // Handle error response here...
}
```
