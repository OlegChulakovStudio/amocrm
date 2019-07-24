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
     * @param array $headers дополнительные заголовки запроса
     * @return array
     */
    public function get(string $action, AbstractQueryRequestParams $params, array $headers = []): array;

    /**
     * Производит POST-запрос к RESTful API
     * @param string $action имя действия
     * @param AbstractQueryRequestParams $params параметры запроса
     * @param AbstractRequestParams[] | AbstractRequestParams $data данные сущности для сохранения
     * @param array $headers дополнительные заголовки запроса
     * @return array
     */
    public function post(string $action, AbstractQueryRequestParams $params, $data, array $headers = []): array;
}