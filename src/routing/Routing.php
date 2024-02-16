<?php

namespace app\routing;

use app\controllers\IndexController;
use Exception;

class Routing
{
    private array $get = [];
    private array $post = [];

    private static ?Routing $instance = null;
    private function __construct(
        private readonly array $route
    ) {}

    public static function getInstance(array $route): Routing
    {
        if (self::$instance === null) {
            self::$instance = new self( $route );
        }
        return self::$instance;
    }

    private function __clone() {}

    /**
     * @throws Exception
     */
    public function __wakeup()
    {
        throw new Exception("Cannot serialize singleton");
    }

    public function setGetParams( array $get ): void
    {
        $this->get = $get;
    }

    public function setPostParams( array $post ): void
    {
        $this->post = $post;
    }

    public function getController()
    {
        $default_controller = IndexController::class;

    }

    public function getAction()
    {
        $default_controller = 'error';
    }
}