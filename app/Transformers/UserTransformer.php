<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param User $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'user_id' => (int)$user->id,
            'user_name' => (string)$user->username,
            'email' => (string)$user->email,
            'avatar' => (string)$user->avatar,
            'birthday' => $user->birthday ? (string)$user->birthday->format('Y-m-d') : null,
            'gender' => (int)$user->gender,
            'area_id' => (int)$user->area_id,
            'social_action_id' => (int)$user->social_action_id,
        ];
    }
}
