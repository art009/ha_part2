<?php

namespace app\helpers;
/**
 * Генерация различных рандомных значений
 */
class Gererator
{
    /**
     * Генерируем строку из указанного числа символов
     * @param int $length
     * @return string
     */
    public static function string_v1( int $length = 10 ): string
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        return substr(str_shuffle($characters), 0, 10);
    }

    /**
     * Генерируем строку из указанного числа символов
     * @param int $length
     * @return string
     */
    public static function string_v2( int $length = 10 ): string
    {
        $randomString = uniqid('', true);
        return substr($randomString, 0, 10);
    }
}