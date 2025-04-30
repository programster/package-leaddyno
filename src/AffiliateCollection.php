<?php

/*
 * A collection for Affiliates, purely for type-safety.
 */

namespace Programster\LeadDyno;

use Programster\Collections\AbstractCollection;

class AffiliateCollection extends AbstractCollection
{
    public function __construct(Affiliate ...$affiliates)
    {
        parent::__construct(Affiliate::class, ...$affiliates);
    }
}
