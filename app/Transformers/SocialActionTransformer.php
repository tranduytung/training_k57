<?php

namespace App\Transformers;

use App\Models\SocialAction;
use League\Fractal\TransformerAbstract;

class SocialActionTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(SocialAction $action)
    {
        return [
            //
        ];
    }
}
