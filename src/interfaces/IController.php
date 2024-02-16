<?php

namespace app\interfaces;

use PDO;

interface IController
{
    public function getDb(): PDO;
    public function render( string $view, array $params = [] ): string;
}