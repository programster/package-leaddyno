<?php

/*
 * A class to represent a line-item that would form part of a purchase that a customer makes.
 */

namespace Programster\LeadDyno;

use JsonSerializable;

class LineItem implements JsonSerializable
{
    private string $sku;
    private string $description;
    private string $quantity;
    private string $amount;


    /**
     * Create a LineItem for a purchase
     * @param string $sku - the SKU of the product being purchased.
     * @param string $description - a description of the product.
     * @param string $quantity - the number of items or quantity of the product being purchased. This is a string
     * because that is what the LeadDyno docs states it wants.
     * @param string $amount - the price for each of the line items.
     */
    public function __construct(
        string $sku,
        string $description,
        string $quantity,
        string $amount
    )
    {
        $this->sku = $sku;
        $this->amount = $amount;
        $this->description = $description;
        $this->quantity = $quantity;
    }


    public function jsonSerialize() : array
    {
        return [
            'sku' => $this->sku,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'amount' => $this->amount,
        ];
    }
}
