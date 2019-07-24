<?php
/**
 * Файл класса ClientInterface.php
 *
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace Chulakov\AmoCRM;

use Chulakov\AmoCRM\Entity\AbstractQueryRequestParams;

/**
 * Интерфейс клиента, который осуществялет непосредственное взаимодействие с AmoCRM RESTful API
 * @package Chulakov\AmoCRM
 */
interface ClientInterface
{
    /**
     * @param string $action имя действия
     * @param AbstractQueryRequestParams $params параметры запроса
     */
    public function get(string $action, AbstractQueryRequestParams $params);

    /**
     * @param string $action имя действия
     * @param AbstractQueryRequestParams $params параметры запроса
     * @param AbstractRequestParams[] | AbstractRequestParams $data данные сущности для сохранения
     */
    public function post(string $action, AbstractQueryRequestParams $params, $data);
}