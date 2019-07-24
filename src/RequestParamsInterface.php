<?php
/**
 * Файл класса RequestParamsInterface.php
 *
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace Chulakov\AmoCRM;

/**
 * Интерфейс описывает методы задания и получения пареметров запроса к API
 * @package Chulakov\AmoCRM
 */
interface RequestParamsInterface
{
    /**
     * Метод возвращает перечень допустимых к использованию памаметрв запорса
     * @return array
     */
    public function allowedParams(): array;

    /**
     * Возвращает массив верных параметров запроса с их заданными значениями
     * @return array
     */
    public function getRequestParams(): array;
}