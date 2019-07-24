<?php
/**
 * Файл класса AuthInterface.php
 *
 * @author Samsonov Vladimir <vs@chulakov.ru>
 * @copyright Copyright (c) 2018, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace Chulakov\AmoCRM;

/**
 * Интерфейс регламентирует обязательный метод для классов авторизации
 */
interface AuthInterface
{

    /**
     * Возвращает параметры авторизации, необходимые для обращений к API
     * @return array
     */
    public function getCredentials();
}