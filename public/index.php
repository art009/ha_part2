<?php
require __DIR__ . '/../vendor/autoload.php';

$config = require __DIR__ . '/../src/configs/app.php';
$routing = require __DIR__ . '/../src/configs/routing.php';

$router = \app\routing\Routing::getInstance($routing);
$router->setGetParams( $_GET );
$router->setPostParams( $_POST );

\app\common\App::getInstance($router)->run();