<?php

namespace app\controllers;

use app\common\Controller;

class IndexController extends Controller
{
    /**
     * Вернем ошибку
     * @return void
     */
    public function error()
    {
        $this->render('error',['code'=>404,'message'=>'Страница не найдена!']);
    }

    public function index()
    {

    }

    public function updateOrCreate( $request )
    {

    }

    public function delete( $request )
    {

    }
}