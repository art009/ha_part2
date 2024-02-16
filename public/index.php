<?php

use app\common\Request;

require __DIR__ . '/../vendor/autoload.php';

$config = require __DIR__ . '/../src/configs/app.php';
$routing = require __DIR__ . '/../src/configs/routing.php';

$request = new Request(
    path_request: $_SERVER['REQUEST_URI'],
    get: $_GET,
    post: $_POST,
    files: $_FILES
);

$router = \app\routing\Routing::getInstance(
    route: $routing,
    request: $request
);

\app\common\App::getInstance($router)->run();