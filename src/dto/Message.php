<?php

namespace app\dto;

class Message {

    public function __construct(
        private int $theme_id,
        private string $message_text,
        private int $user_id,
    ) {}

    public function getThemeId(): int
    {
        return $this->theme_id;
    }

    public function setThemeId(int $theme_id): void
    {
        $this->theme_id = $theme_id;
    }

    public function getText(): string
    {
        return $this->message_text;
    }

    public function setText(string $message_text): void
    {
        $this->message_text = $message_text;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }
}
