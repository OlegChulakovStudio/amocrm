<?php
/**
 * Файл класса ResponseExceptionFactory.php
 *
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace Chulakov\AmoCRM\Exception\Http;

use GuzzleHttp\Exception\ClientException;

class ResponseExceptionFactory
{

    protected $httpCode;

    protected $code;

    protected $message;

    protected $domain;

    protected $serverTime;

    /**
     * @var ResponseException
     */
    protected $exception;

    /**
     * @var array
     */
    protected $classes = [
        '401-110' => AuthResponseException::class,
        '401-111' => AuthResponseException::class,
        '401-112' => AuthResponseException::class,
        '403-113' => AuthResponseException::class,
        '401-101' => AuthResponseException::class,
        '401-401' => AuthResponseException::class,
    ];

    /**
     * Собирает необходимую информацию для сборки исключения
     * @param ClientException $exception
     */
    public function __construct(ClientException $exception)
    {
        $response = \GuzzleHttp\json_decode($exception->getResponse()->getBody()->getContents(), true);

        $this->httpCode = $exception->getCode();
        $this->code = $response['error_code'];
        $this->message = $response['error'];
        $this->ip = $response['ip'];
        $this->domain = $response['domain'];
        $this->serverTime = $response['server_time'];
    }

    /**
     * Производит сборку исключения
     */
    protected function buildException(): void
    {
        $exceptionClass =
            key_exists($this->httpCode . '-' . $this->code, $this->classes)
                ? $this->classes["{$this->httpCode}-{$this->code}"] : ResponseException::class;


        $this->exception = new $exceptionClass($this->httpCode, $this->message, $this->code);

        $this->exception->setDomain($this->domain);
        $this->exception->setIp($this->ip);
        $this->exception->setIp($this->ip);
    }

    /**
     * Побуждает исключение
     * @throws ResponseException
     */
    public function throwException()
    {
        $this->buildException();

        throw $this->exception;
    }
}