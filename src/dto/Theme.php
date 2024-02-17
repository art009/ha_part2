<?php

namespace app\dto;

class Theme {

    public function __construct(
        private string $theme_name
    ) {}

    public function getName(): string
    {
        return $this->theme_name;
    }

    public function setName(string $theme_name): void
    {
        $this->theme_name = $theme_name;
    }
}
