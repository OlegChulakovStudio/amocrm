<?php
/**
 * Файл класса AbstractRequestParams.php
 *
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace Chulakov\AmoCRM;

use Chulakov\AmoCRM\Exception\RequestParams\NotAllowedParamException;

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
     * @var array дополнительные заголовки, которые будут переданы вместе с параметрами
     */
    protected $requestHeaders = [];

    /**
     * Магический метод позволяет работать с параметрами, как со свойствами объекта
     * @param string $name
     * @param mixed $value
     * @return AbstractRequestParams
     * @throws NotAllowedParamException
     */
    public function __set($name, $value): AbstractRequestParams
    {
        if (!in_array($name, $this->allowedParams())) {
            throw new NotAllowedParamException($name,"Parameter '{$name}' is not allowed for this request");
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

    /**
     * Возвращает массив дополнительных заголовком, которые будут переданы вместе с параметрами запроса
     * @return array
     */
    public function getRequestHeaders(): array
    {
        return $this->requestHeaders;
    }

}