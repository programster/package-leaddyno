<?php

/*
 * A LeadDyno API client.
 */

namespace Programster\LeadDyno;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;

class LeadDyno
{
    private readonly string $baseUrl;


    /**
     * Create the LeadDyno client.
     *
     * @param string $apiKey - the API key from LeadDyno that we use for authentication.
     *
     * @param RequestFactoryInterface $requestFactory - the factory that should be used for creating requests.
     * \GuzzleHttp\Psr7\HttpFactory is recommended.
     *
     * @param ClientInterface $httpClient - the client that should be used for sending API requests.
     * \GuzzleHttp\Client is recommended
     */
    public function __construct(
        private readonly string $apiKey,
        private readonly RequestFactoryInterface $requestFactory,
        private readonly ClientInterface $httpClient
    )
    {
        $this->baseUrl = "https://api.leaddyno.com/v1";
    }


    /**
     * Register a purchase in LeadDyno. https://app.theneo.io/leaddyno/leaddyno-rest-api/purchases/post-purchases
     * @param string $customerEmail - the email address of the customer making the purchase.
     * @param float $purchaseAmount - the amount of the purchase.
     * @param ?string $purchaseId - a unique id for this purchase/transaction. If set to null, then one will be
     * automatically provided for you.
     * @param string $planCode - The code of the reward structure used for calculating affiliate commissions. E.g. "Default"
     * @param ?string $affiliateCode - The affiliate code to which the purchase should be assigned. This parameter is
     * optional and its usage depends on the 'first source wins' or 'first affiliate wins' settings.
     * @param string $description - Text description of the purchase.
     * @param bool $reassignAffiliate - optionally set to false to have the original affiliate of the lead (if there is one)
     * be retained.
     * @param LineItemCollection|null $lineItems - optionally provide the line items that were purchased.
     * @param float|null $commissionAmountOverride - optionally override the fixed amount of commission.
     * @return void
     */
    function createPurchase(
        string $customerEmail,
        float $purchaseAmount,
        ?string $purchaseId,
        string $planCode,
        ?string $affiliateCode,
        string $description,
        bool $reassignAffiliate = true,
        ?LineItemCollection $lineItems = null,
        ?float $commissionAmountOverride = null,
    ) : ResponseInterface
    {
        $body = [
            "email" => $customerEmail,
            "purchase_amount" => $purchaseAmount,
            "plan_code" => $planCode,
            "code" => $affiliateCode,
            "description" => $description,
        ];

        if ($purchaseId !== null)
        {
            $body["purchase_code"] = $purchaseId;
        }

        if ($lineItems !== null && count($lineItems) > 0)
        {
            /* @var $lineItems LineItemCollection */
            $body["line_items"] = $lineItems->getArrayCopy();
        }

        return $this->sendRequest(method: "POST", path: "/purchases", requestParams: $body);
    }


    private function sendRequest(string $method, string $path, ?array $requestParams = null): ResponseInterface
    {
        $queryParams = ['key' => $this->apiKey];

        if (strtoupper($method) === "GET" && $requestParams !== null && count($requestParams) > 0)
        {
            $queryParams = array_merge($queryParams, $requestParams);
        }

        $fullUrl = $this->baseUrl . $path . "?" . http_build_query($queryParams);
        $request = $this->requestFactory->createRequest($method, $fullUrl);

        if ($method !== "GET" && $requestParams !== null && count($requestParams) > 0)
        {
            $request = $request->withHeader("Content-Type", "application/json");
            $body = $request->getBody();
            $body->write(json_encode($requestParams));
            $request = $request->withBody($body);
        }

        $response = $this->httpClient->sendRequest($request);
        return $response;
    }
}