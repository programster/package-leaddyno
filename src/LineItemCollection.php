<?php

/*
 * A collection for LineItems, purely for type-safety.
 */

namespace Programster\LeadDyno;

use Programster\Collections\AbstractCollection;

class LineItemCollection extends AbstractCollection
{
    public function __construct(LineItem ...$lineItems)
    {
        parent::__construct(LineItem::class, ...$lineItems);
    }
}