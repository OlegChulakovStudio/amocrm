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
     * @var string
     */
    protected $parameter;

    /**
     * @param string $parameter наменование невалидного параметра
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $parameter, string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}