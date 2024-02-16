<?php

namespace app\entities;

class User {
    private int $user_id;
    private string $user_hash;

    public function __construct(int $user_id, string $user_hash) {
        $this->user_id = $user_id;
        $this->user_hash = $user_hash;
    }

    public function getId(): int {
        return $this->user_id;
    }

    public function getHash(): string {
        return $this->user_hash;
    }

    public function setHash(string $user_hash): void {
        $this->user_hash = $user_hash;
    }
}
