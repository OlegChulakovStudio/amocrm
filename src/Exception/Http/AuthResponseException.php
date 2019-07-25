<?php
/**
 * Файл класса AuthResponseException.php
 *
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace Chulakov\AmoCRM\Exception\Http;


class AuthResponseException extends ResponseException
{

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