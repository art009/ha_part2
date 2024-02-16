<?php

namespace app\entities;

class Message {
    private int $message_id;
    private int $theme_id;
    private string $message_text;
    private int $message_time;
    private int $user_id;

    public function __construct(int $message_id, int $theme_id, string $message_text, int $message_time, int $user_id)
    {
        $this->message_id = $message_id;
        $this->theme_id = $theme_id;
        $this->message_text = $message_text;
        $this->message_time = $message_time;
        $this->user_id = $user_id;
    }

    public function getId(): int
    {
        return $this->message_id;
    }

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

    public function getTime(): int
    {
        return $this->message_time;
    }

    public function setTime(int $message_time): void
    {
        $this->message_time = $message_time;
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
