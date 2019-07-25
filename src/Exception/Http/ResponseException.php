<?php
/**
 * Файл класса ResponseException.php
 *
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace Chulakov\AmoCRM\Exception\Http;

use Throwable;

/**
 * Класс HTTP-исключения от API
 * @package Chulakov\AmoCRM\Exception
 */
class ResponseException extends \Exception
{

    /**
     * @var string
     */
    protected $httpCode;

    /**
     * @param string $httpCode код HTTP-ответа
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $httpCode, string $message, int $code = 0, Throwable $previous = null)
    {
        $this->httpCode = $httpCode;
        parent::__construct($message, $code, $previous);
    }

    /**
     * Возвращает HTTP-код ответа
     * @return string
     */
    public function getHttpCode(): string
    {
        return $this->httpCode;
    }
}