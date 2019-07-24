<?php
/**
 * Файл класса AbstractOperationRequestParams.php
 *
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace Chulakov\AmoCRM\Entity;

use Chulakov\AmoCRM\AbstractRequestParams;

/**
 * Параметры запроса на создание или изменение сущности AmoCRM
 * @package Chulakov\AmoCRM\Entity
 * @todo подумать над проверкой обязательных для заполнения параметров сущности
 * @todo написать обработку custom_fields-параметров
 */
abstract class AbstractOperationRequestParams extends AbstractRequestParams
{
}