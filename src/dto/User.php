<?php

namespace app\dto;

class User {
    public function __construct(
        private string $user_hash
    ) {}

    public function getHash(): string {
        return $this->user_hash;
    }

    public function setHash(string $user_hash): void {
        $this->user_hash = $user_hash;
    }
}
