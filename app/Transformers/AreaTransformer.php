<?php

namespace App\Transformers;

use App\Models\Area;
use League\Fractal\TransformerAbstract;

class AreaTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param Area $area
     * @return array
     */
    public function transform(Area $area)
    {
        // TODO
        return [];
    }
}
