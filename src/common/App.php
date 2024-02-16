<?php

namespace app\common;

use app\routing\Routing;

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

    private function getController()
    {
        return $this->route->getController();
    }

    private function getAction()
    {
        return $this->route->getAction();
    }

    public function run()
    {

    }
}