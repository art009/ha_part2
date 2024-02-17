<?php

namespace app\repositories;

use app\entities\Message;
use app\dto\Message as MessageDTO;
use app\mappers\MessageHydrator;
use PDO;

class MessageRepository
{
    private MessageHydrator $hydrator;

    private ?int $user_id = null;
    public function __construct(
        private readonly PDO $db
    ) {
        $this->hydrator = new MessageHydrator();
    }

    public function onlyUser( int $user_id ): self
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * Вернем список сообщение с ограничением по кол-ву и отступу
     * @param int $limit
     * @param int $offset
     * @return array|null
     */
    public function getAll( int $limit = 10, int $offset = 0): ?array
    {
        $sql = 'SELECT * FROM messages LIMIT :limit, :offset';
        $stmt = $this->db->query($sql);
        $stmt->execute(['limit' => $limit, 'offset' => $offset]);
        $messagesData = $stmt->fetchAll();

        if ($messagesData) {
            $hydrator = $this->hydrator;
            return array_map(function($message) use ($hydrator) {
                return $hydrator->hydrate($message);
            },$messagesData);
        }
        return null;
    }

    public function getById( int $id ): ?Message
    {
        $sql = 'SELECT * FROM messages WHERE message_id = :message_id';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['message_id' => $id]);
        $messageData = $stmt->fetch();

        if ($messageData) {
            return $this->hydrator->hydrate($messageData);
        }

        return null;
    }

    public function save(MessageDTO $message): ?Message
    {
        $messageData = $this->hydrator->extract($message);
        $sql = <<<SQL
INSERT INTO messages ( theme_id, message_text, message_time, user_id) 
VALUES ( :theme_id, :message_text, :message_time, :user_id)
SQL;
//        var_dump($sql); var_dump($messageData); exit;
        $this->db
            ->prepare($sql)
            ->execute($messageData);
        $lastInsertId = $this->db->lastInsertId();
        return $this->getById($lastInsertId);
    }

    public function update(Message $message): void
    {
        $messageData = $this->hydrator->extract($message);
        $sql = <<<SQL
UPDATE messages SET theme_id = :theme_id, message_text = :message_text, 
    message_time = :message_time, user_id = :user_id 
    WHERE message_id = :message_id
SQL;

        $this->db->query($sql)->execute($messageData);
    }

    /**
     * Список сообщений пользователя
     * @param int $theme_id
     * @param int $user_id
     * @return void
     */
    public function getMyInTheme( int $theme_id, int $user_id): ?array
    {
        $sql = "SELECT * FROM messages WHERE theme_id = :theme_id AND user_id=:user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['theme_id' => $theme_id, 'user_id' => $user_id]);
        $messagesData = $stmt->fetchAll();

        if ($messagesData) {
            $hydrator = $this->hydrator;
            return array_map(function($message) use ($hydrator) {
                return $hydrator->hydrate($message);
            },$messagesData);
        }
        return null;
    }


}