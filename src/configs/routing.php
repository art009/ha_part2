<?php
return [
    '' => [
        'controller' => \app\controllers\IndexController::class,
        'action' => 'messages',
    ],
    'index' => [
        'controller' => \app\controllers\IndexController::class,
        'action' => 'messages',
    ],
    'messages/themes' => [
        'controller' => \app\controllers\MessageController::class,
        'action' => 'themes',
    ],
    'messages/save' => [
        'controller' => \app\controllers\MessageController::class,
        'action' => 'saveMessage',
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