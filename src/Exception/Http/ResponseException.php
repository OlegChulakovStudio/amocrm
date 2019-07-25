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
     * @var string IP-адрес сервера API, который вернул HTTP-ответ
     */
    protected $ip;

    /**
     * @var string
     */
    protected $domain;

    /**
     * @var \DateTime время формирования результата
     */
    protected $serverTime;

    /**
     * @param string $httpCode код HTTP-ответа
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $httpCode, string $message, int $code, Throwable $previous = null)
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

    /**
     * @param string $ip
     */
    public function setIp(string $ip): void
    {
        $this->ip = $ip;
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * @param string $domain
     */
    public function setDomain(string $domain): void
    {
        $this->domain = $domain;
    }

    /**
     * @return \DateTime
     */
    public function getServerTime(): \DateTime
    {
        return $this->serverTime;
    }

    /**
     * @param string $timestamp
     */
    public function setServerTime(string $timestamp): void
    {
        $this->serverTime = new \DateTime($timestamp);
    }
}