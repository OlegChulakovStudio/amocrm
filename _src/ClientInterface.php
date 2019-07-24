<?php
/**
 * Файл класса ClientInterface.php
 *
 * @author Samsonov Vladimir <vs@chulakov.ru>
 * @copyright Copyright (c) 2018, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace Chulakov\AmoCRM;

/**
 * Интерфейс регламентирует базовые методы для отправки HTTP-запроса абстракции предметной области
 */
interface ClientInterface
{
    /**
     * Реализует POST-запрос с параметрами
     *
     * @param string $action
     * @param array $queryParams
     * @param array $data
     * @return mixed
     */
    public function post($action, $queryParams = [], $data = []);

    /**
     * Реализует GET-запрос
     *
     * @param string $method
     * @param array $queryParams
     * @return mixed
     */
    public function get($action, $queryParams = []);

    /**
     * Добавляет дополнительные заголовки к текущему запросу.
     * @param array $headers массив ключи которого - название заголовков, а значения - значения заголовков
     */
    public function addRequestHeaders(array $headers);
}