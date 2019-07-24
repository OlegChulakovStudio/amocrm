<?php
/**
 * Файл класса ClientInterface.php
 *
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace Chulakov\AmoCRM;

/**
 * Интерфейс клиента, который осуществялет непосредственное взаимодействие с AmoCRM RESTful API
 * @package Chulakov\AmoCRM
 */
interface ClientInterface
{
    /**
     * @param string $action имя действия
     * @param AbstractRequestParams $params параметры запроса
     */
    public function get(string $action, AbstractRequestParams $params);

    /**
     * @param string $action имя действия
     * @param AbstractRequestParams $params параметры запроса
     * @param AbstractRequestParams[] | AbstractRequestParams $data данные сущности для сохранения
     */
    public function post(string $action, AbstractRequestParams $params, $data);
}