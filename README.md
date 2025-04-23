LeadDyno PHP Package
====================

An SDK for interfacing with the 
[LeadDyno RESTful API](https://app.theneo.io/leaddyno/leaddyno-rest-api/leaddyno-api) in PHP. 

This package makes use of the PSR-17 and PSR-18 interfaces, so this package should be able to work
with any existing mechanism you use to send messages. If you are not sure what this means, then
we would recommend that you just install the `guzzlehttp/guzzle` package, and follow the example
in the README.


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

## Warnings

### Unique Purchase Identifiers
I noticed when performing testing, that if one creates a purchase, but does not change the purchase
ID from one that was already sent, then the response will come back as 201 for success, but a new 
purchase will not be registered. This should not be too much of an issue, as each purchase should
have a unique ID anyway but is worth noting.