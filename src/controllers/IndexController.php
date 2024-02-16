<?php

namespace app\controllers;

use app\common\Controller;
use Throwable;

class IndexController extends Controller
{
    /**
     * Вернем ошибку
     * @return string
     * @throws Throwable
     */
    public function error(): string
    {
        return $this->render('index/error.php',[
            'code'=>404,
            'message'=>'Страница не найдена!'
        ]);
    }

    /**
     * Список сообщений
     * @throws Throwable
     */
    public function messages(): string
    {
        return $this->render('index/messages.php',[
            'code'=>404,
            'message'=>'Страница не найдена!'
        ]);
    }

    /**
     * Написать сообщение
     * @param $request
     * @return void
     */
    public function updateOrCreate( $request )
    {

    }

    /**
     * Удаление сообщение
     * @param $request
     * @return void
     */
    public function delete( $request )
    {

        header('');
    }
}