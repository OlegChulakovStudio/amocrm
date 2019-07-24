<?php
/**
 * Файл класса AbstractEntityRequestParams.php
 *
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace Chulakov\AmoCRM\Entity;

use Chulakov\AmoCRM\AbstractRequestParams;

/**
 * Добавляет часть логику обработки with-параметров запроса к API
 * @package Chulakov\AmoCRM\Entity
 * @todo написать обработку filter-параметров
 */
abstract class AbstractQueryRequestParams extends AbstractRequestParams
{

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
     * @throws \Exception
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
     * @throws \Exception
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
     * @throws \Exception
     */
    protected function withParamExists(string $name): void
    {
        if (!in_array($name, $this->allowedWithParams())) {
            throw new \Exception("With-parameter '{$name}' does not exist");
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
}