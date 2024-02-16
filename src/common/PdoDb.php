<?php

namespace app\common;

class PdoDb
{
    public function __construct(
        private string $host = 'localhost',
        private string $user_name = '',
        private string $password = '',
        private string $charset = 'utf-8',
    ) {

    }
}