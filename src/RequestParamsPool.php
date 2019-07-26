<?php
/**
 * Файл класса RequestParamsPool.php
 *
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace Chulakov\AmoCRM;

/**
 * Реализует логику пула параметров запроса
 * @package Chulakov\AmoCRM
 */
class RequestParamsPool
{

    /**
     * @var AbstractRequestParams[] массив объектов-апарметров запроса
     */
    protected $paramsPool = [];

    /**
     * @var array массив извлеченных параметров
     */
    protected $extractedParams = [];

    /**
     * Добавляет объект параметров в пул
     * @param AbstractRequestParams $params
     */
    public function add(AbstractRequestParams $params): void
    {
        $this->paramsPool[$this->getHash($params)] = $params;
        $this->extractedParams = [];
    }

    /**
     * Удаляет объект араметров из пула
     * @param AbstractRequestParams $params
     */
    public function remove(AbstractRequestParams $params): void
    {
        unset($this->paramsPool[$this->getHash($params)]);
        $this->extractedParams = [];
    }

    /**
     * Вычисляет значение хеша для указанного объекта
     * @param AbstractRequestParams $params
     * @return string
     */
    protected function getHash(AbstractRequestParams $params): string
    {
       return md5(serialize($params));
    }

    /**
     * Возвращает массив верных параметров запроса с их заданными значениями
     * @return array
     */
    public function getRequestParams(): array
    {
        if (empty($this->extractedParams)) {

            foreach ($this->paramsPool as $pool) {
                $this->extractedParams[] = $pool->getRequestParams();
            }

        }

        return $this->extractedParams;
    }
}