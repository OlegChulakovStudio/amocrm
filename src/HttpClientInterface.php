<?php
/**
 * Файл класса HttpClientInterface.php
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
interface HttpClientInterface
{
    /**
     * Производит GET-запрос в RESTful API
     * @param string $action имя действия
     * @param AbstractQueryRequestParams $params параметры запроса
     * @return array
     */
    public function get(string $action, AbstractQueryRequestParams $params): array;

    /**
     * Производит POST-запрос к RESTful API
     * @param string $action
     * @param RequestParamsPool $data пул параметров запроса, которые необходимы для добавления или изменения данных
     * @return array
     */
    public function post(string $action, RequestParamsPool $data): array;
}