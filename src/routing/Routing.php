<?php

namespace app\routing;

use app\common\Controller;
use app\common\MyPDO;
use app\common\Request;
use app\controllers\IndexController;
use app\interfaces\IController;
use Exception;
use PDO;

class Routing
{
    private static ?Routing $instance = null;
    private function __construct(
        private readonly array $route,
        private readonly Request $request
    ) {}

    public static function getInstance(
        array $route,
        Request $request
    ): Routing {
        if (self::$instance === null) {
            self::$instance = new self( $route, $request );
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

    /**
     * Получаем контроллер
     * @return Controller
     * @throws Exception
     */
    public function getController( PDO $db ): Controller
    {
        $default_controller = new IndexController($db);

        $path_request = $this->request->getPathRequest();
//        var_dump($path_request);exit;
        if ( isset($this->route[$path_request]) ) {
            $default_controller = new $this->route[$path_request]['controller']($db);
        }

        if( !$default_controller instanceof IController)
            throw new Exception('Необходим класс наследованный от "Controller"');

        return $default_controller;
    }

    /**
     * Исполняемый экшен по умолчанию
     * @return string
     */
    public function getAction(): string
    {
        $default_action = 'error';
        $path_request = $this->request->getPathRequest();
        $path_request = trim($path_request,'/');

        if ( isset($this->route[$path_request]) ) {
            $default_action = $this->route[$path_request]['action'];
        }

        return $default_action;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }
}