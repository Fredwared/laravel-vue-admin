<?php
namespace App\Api\Transformers;

use App\User;

class UserTransformer extends Transformer
{
    public function transform(User $user)
    {
        $container['user'] =  [
            'name' => $this->get($user, 'username'),
        ];

        if (isset($user->token)) {
            $container['token'] = [
                'token' => $this->get($user, 'token'),
                'ttl' => $this->get($user, 'token_ttl')
            ];
        }

        return $container;
    }
}