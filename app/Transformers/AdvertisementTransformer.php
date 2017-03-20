<?php

namespace App\Transformers;

use App\Models\Advertisement;
use League\Fractal\TransformerAbstract;

class AdvertisementTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param Advertisement $advertisement
     * @return array
     */
    public function transform(Advertisement $advertisement)
    {
        // TODO
        return [
        ];
    }
}
