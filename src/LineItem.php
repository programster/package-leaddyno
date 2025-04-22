<?php

/*
 * A class to represent a line-item that would form part of a purchase that a customer makes.
 */

namespace Programster\LeadDyno;

class LineItem implements \JsonSerializable
{
    /**
     * Create a LineItem for a purchase
     * @param string $sku - the SKU of the product being purchased.
     * @param string $description - a description of the product.
     * @param string $quantity - the number of items or quantity of the product being purchased. This is a string
     * because that is what the LeadDyno docs states it wants.
     * @param string $amount - the price for each of the line items.
     */
    public function __construct(
        public readonly string $sku,
        public readonly string $description,
        public readonly string $quantity,
        public readonly string $amount
    )
    {

    }


    public function jsonSerialize(): mixed
    {
        return [
            'sku' => $this->sku,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'amount' => $this->amount,
        ];
    }
}
