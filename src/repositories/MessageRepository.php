<?php

namespace app\repositories;

use app\entities\Message;
use app\mappers\MessageHydrator;
use PDO;

class MessageRepository
{
    private MessageHydrator $hydrator;
    public function __construct(
        private readonly PDO $db
    ) {
        $this->hydrator = new MessageHydrator();
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
        $stmt = $this->db->query($sql);
        $stmt->execute(['message_id' => $id]);
        $messageData = $stmt->fetch();

        if ($messageData) {
            return $this->hydrator->hydrate($messageData);
        }

        return null;
    }

    public function save(Message $message): void
    {
        $messageData = $this->hydrator->extract($message);
        $sql = <<<SQL
INSERT INTO message (message_id, theme_id, message_text, message_time, user_id) 
VALUES (:message_id, :theme_id, :message_text, :message_time, :user_id)
SQL;
        $this->db->query($sql)->execute($messageData);
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


}