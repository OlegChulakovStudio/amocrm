<?php
/**
 * Файл класса NotAllowedParamException.php
 *
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace Chulakov\AmoCRM\Exception\RequestParams;

use Throwable;

/**
 * Исключение, связанное с неверно заданными параметрами запроса
 * @package Chulakov\AmoCRM\Exception\RequestParams
 */
class NotAllowedParamException extends \Exception
{
    /**
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     * @param string $parameter наменование невалидного параметра
     */
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null, string $parameter)
    {
        parent::__construct($message, $code, $previous);
    }
}