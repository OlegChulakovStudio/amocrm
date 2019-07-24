<?php
/**
 * Файл класса AbstractRequestParams.php
 *
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace Chulakov\AmoCRM;

/**
 * Абстрактный класс, описывающий магию доступа к параметрам запроса как к свойствам объекта-коллекции параметров
 * @package Chulakov\AmoCRM
 */
abstract class AbstractRequestParams implements RequestParamsInterface
{

    /**
     * @var array
     */
    protected $params = [];

    /**
     * Магический метод позволяет работать с параметрами, как со свойствами объекта
     * @param string $name
     * @param mixed $value
     * @return AbstractRequestParams
     * @throws \Exception
     */
    public function __set($name, $value): AbstractRequestParams
    {
        if (!in_array($name, $this->allowedParams())) {
            throw new \Exception("Parameter '{$name}' does not exist");
        }

        if (!is_null($value)) {
            $this->params[$name] = $value;
        } elseif (isset($this->params[$name])) {
            unset($this->params[$name]);
        }

        return $this;
    }

    /**
     * Возвращает массив верных параметров запроса с их заданными значениями
     * @return array
     */
    public function getRequestParams(): array
    {
        return $this->params;
    }

}