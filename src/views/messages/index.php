<?php
/**
 * @var Theme[] $themes
 * @var User $user
 * @var Message[] $messages
 * @var MessageDTO $message
 */

use app\entities\Message;
use app\entities\Theme;
use app\entities\User;
use app\dto\Message as MessageDTO;
?>
<div class="container mt-4">
    <div class="row">
        <div class="col-3">
            <div class="d-grid gap-2">
                <?php foreach ($themes as $theme):?>
                    <a class="btn btn-primary" href="/messages/themes?theme_id=<?=$theme->getId()?>"><?=$theme->getName()?></a>
                <?php endforeach;?>
            </div>
        </div>
        <div class="col-9">
            <h1><?=$user->getId()?>/<?=$user->getHash()?></h1>
            <div>
                <h2>Сообщения:</h2>
                <?php if($messages):?>
                    <div class="row">
                        <div class="col-12">
                            <?php foreach($messages as $message):?>
                            <div class="card">
                                <div class="card-body row">
                                    <div class="col-4">
                                        Сообщение #<?=$message->getId()?>
                                    </div>
                                    <div class="col-4">
                                        Пользователь #<?=$message->getUserId()?>
                                    </div>
                                    <div class="col-4">
                                        Дата: <?= (new DateTimeImmutable())->setTimestamp($message->getTime())->format('d.m.Y H:i')?>
                                    </div>
                                    <hr>
                                    <div class="col-12 mt-3">
                                        Текст: <?=$message->getText()?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                <?php endif;?>
            </div>
            <div>
                <form method="post" action="/messages/save">
                    <input type="hidden" name="message[theme_id]" value="<?=$message->getThemeId()??""?>">
                    <input type="hidden" name="message[user_id]" value="<?=$message->getUserId()??""?>">
                    <div class="mb-3">
                        <label for="message-message_text" class="form-label">Сообщение:</label>
                        <textarea class="form-control" id="message-message_text" name="message[message_text]" rows="3"><?=$message->getText()??""?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </form>
            </div>
        </div>

    </div>
</div>

