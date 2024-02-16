<?php
return [
    'index' => [
        'controller' => \app\controllers\IndexController::class,
        'action' => 'messages',
    ],
    'themes' => [
        'controller' => \app\controllers\ThemeController::class,
        'action' => 'list',
    ],

    'update-themes' => [
        'controller' => \app\controllers\ThemeController::class,
        'action' => 'update',
    ],

    'delete-themes' => [
        'controller' => \app\controllers\ThemeController::class,
        'action' => 'delete',
    ],
];