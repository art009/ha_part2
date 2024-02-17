<?php

namespace app\mappers;

use app\entities\User;

class UserHydrator
{
    public function hydrate(array $data): User
    {
        return new User(
            (int) $data['user_id'],
            (string) $data['user_hash']
        );
    }

    public function extract(User $user): array
    {
        return [
            'user_id' => $user->getId(),
            'user_hash' => $user->getHash()
        ];
    }
}