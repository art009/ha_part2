<?php

namespace app\entities;

class Theme {
    private int $theme_id;
    private string $theme_name;

    public function __construct(int $theme_id, string $theme_name)
    {
        $this->theme_id = $theme_id;
        $this->theme_name = $theme_name;
    }

    public function getId(): int
    {
        return $this->theme_id;
    }

    public function getName(): string
    {
        return $this->theme_name;
    }

    public function setName(string $theme_name): void
    {
        $this->theme_name = $theme_name;
    }
}
