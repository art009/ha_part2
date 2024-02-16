<?php

namespace app\common;

use app\routing\Routing;
use Exception;
use PDO;

class App
{
    private static ?self $instance = null;
    private function __construct(
        private Routing $route
    ) {}

    public static function getInstance( Routing $route ): self
    {
        if (self::$instance === null) {
            self::$instance = new self( $route );
        }
        return self::$instance;
    }

    private function __clone() {}


    private function getController( PDO $db ): object
    {
        return $this->route->getController( $db );
    }

    private function getAction(): string
    {
        return $this->route->getAction();
    }

    private function getRequest(): Request
    {
        return $this->route->getRequest();
    }

    /**
     * @throws Exception
     */
    public function run(): void
    {
        $my_pdo = new MyPDO(
            host: DB_HOSTNAME,
            database: DB_DATABASE,
            user_name: DB_USERNAME,
            password: DB_PASSWORD
        );
        $db = $my_pdo->getPdo();

        $controller = $this->getController($db);
        $action = $this->getAction();

        if ( !method_exists($controller,$action) ) {
            throw new Exception('Страница не найдена', 404);
        }
        echo (new $controller($db))->$action();
    }
}