<?php

namespace app\controllers;

use app\common\Controller;
use app\common\Request;
use app\dto\Message;
use app\repositories\ThemeRepository;
use app\services\MessageService;
use Exception;

class MessageController extends Controller
{
    /**
     * @throws Exception
     */
    public function themes( Request $request ): string
    {
        $params = $request->getParams();
        $themes_id = $params['theme_id']??null;
        if (!$themes_id) {
            throw new Exception('Страница не найдена.', 404);
        }

        $messages = (new MessageService($this->getDb()))
            ->getMessages($themes_id,$this->user);

        $themes = (new ThemeRepository($this->getDb()))
            ->getAll(10,0);

        $message = new Message(
            $themes_id,
            '',
            $this->user->getId()
        );

        return $this->render('messages/index.php',[
            'themes' => $themes,
            'messages' => $messages,
            'message' => $message,
            'user' => $this->user,
        ]);
    }

    /**
     * @throws Exception
     */
    public function saveMessage(Request $request )
    {
        $params = $request->getPost();
        $message_data = $params['message']??null;
        if (!$message_data || !$message_data['message_text']) {
            throw new Exception('Страница не найдена.', 404);
        }

        $messageDTO = new Message(
            theme_id: (int)$message_data['theme_id'],
            message_text: $message_data['message_text'],
            user_id: (int)$message_data['user_id']
        );

        (new MessageService($this->getDb()))->save($messageDTO);

        $url = "/messages/themes?theme_id={$message_data['theme_id']}";
        header("Location: $url");
        exit;
    }
}