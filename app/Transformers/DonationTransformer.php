<?php

namespace App\Transformers;

use App\Models\Donation;
use League\Fractal\TransformerAbstract;

class DonationTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @@param Donation $donation
     * @return array
     */
    public function transform(Donation $donation)
    {
        return [];
    }
}
