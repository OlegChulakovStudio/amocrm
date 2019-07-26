<?php
/**
 * Файл класса AbstractEntityRequestParams.php
 *
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace Chulakov\AmoCRM\Entity;

use Chulakov\AmoCRM\AbstractRequestParams;
use Chulakov\AmoCRM\Exception\RequestParams\NotAllowedParamException;

/**
 * Добавляет часть логику обработки with-параметров запроса к API
 * @package Chulakov\AmoCRM\Entity
 * @todo написать обработку filter-параметров
 */
abstract class AbstractQueryRequestParams extends AbstractRequestParams
{

    /**
     * @var array дополнительные заголовки, которые будут переданы вместе с параметрами
     */
    protected $requestHeaders = [];

    /**
     * @var array
     */
    protected $with = [];

    /**
     * Метод возвращает перечень допустимых специальных параметров для запроса дополнительной информации
     * @return array
     */
    abstract public function allowedWithParams(): array;

    /**
     * @param string $name
     * @return AbstractRequestParams
     * @throws NotAllowedParamException
     */
    public function with(string $name): AbstractRequestParams
    {
        $this->withParamExists($name);

        $this->with[$name] = $name;

        return $this;
    }

    /**
     * Исключает with-параметр из коллекции
     * @param string $name
     * @return AbstractRequestParams
     * @throws NotAllowedParamException
     */
    public function without(string $name): AbstractRequestParams
    {
        $this->withParamExists($name);

        unset($this->with[$name]);

        return $this;
    }

    /**
     * Проверяет заявлен ли with-параметр в методо @see allowedWithParams()
     * @param string $name
     * @throws NotAllowedParamException
     */
    protected function withParamExists(string $name): void
    {
        if (!in_array($name, $this->allowedWithParams())) {
            throw new NotAllowedParamException($name, "With-parameter '{$name}' is not allowed for this request");
        }
    }

    /**
     * @inheritdoc
     */
    public function getRequestParams(): array
    {
        $parent = parent::getRequestParams();

        if (!empty($this->with)) {
            return array_merge([
                'with' => implode($this->with, ',')
            ], $parent);
        }

        return $parent;
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