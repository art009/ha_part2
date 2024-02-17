<?php

namespace app\mappers;

use app\entities\User;
use app\dto\User as UserDTO;

class UserHydrator
{
    public function hydrate(array $data): User
    {
        return new User(
            (int) $data['user_id'],
            (string) $data['user_hash']
        );
    }

    public function extract(UserDTO $user): array
    {
        return [
            'user_hash' => $user->getHash()
        ];
    }
}