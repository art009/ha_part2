<?php

namespace app\services;

use app\dto\Message as MessageDTO;
use app\entities\User;
use app\repositories\MessageRepository;
use PDO;

class MessageService
{
    public function __construct(
        private readonly PDO $db
    ) {}

    public function getMessages(
        int $theme_id,
        User $user
    ) {
        return (new MessageRepository($this->db))
            ->getMyInTheme(
                $theme_id,
                $user->getId()
            );
    }

    public function save( MessageDTO $message )
    {
        return (new MessageRepository($this->db))->save($message);
    }
}