<?php

namespace app\mappers;

use app\dto\Message as MessageDTO;
use app\entities\Message;

class MessageHydrator
{
    public function hydrate(array $data): Message
    {
        return new Message(
            message_id: (int)$data['message_id'],
            theme_id: (int)$data['theme_id'],
            message_text: (string)$data['message_text'],
            message_time: (int)$data['message_time'],
            user_id: (int)$data['user_id']
        );
    }

    public function extract(MessageDTO $message): array
    {
        return [
            'theme_id' => $message->getThemeId(),
            'message_text' => $message->getText(),
            'message_time' => time(),
            'user_id' => $message->getUserId(),
        ];
    }

}