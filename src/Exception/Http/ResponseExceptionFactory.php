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

    /**
     * @var string HTTP-код исключения
     */
    protected $httpCode;

    /**
     * @var array массив на основе JSON-строки тела HTTP-ответа Guzzle-исключения
     */
    protected $content;

    /**
     * Собирает необходимую информацию для сборки исключения
     * @param ClientException $exception
     */
    public function __construct(ClientException $exception)
    {
        $this->httpCode = $exception->getCode();
        if ($json = trim($exception->getResponse()->getBody()->getContents())) {
            $this->content = \GuzzleHttp\json_decode($json, true);
        } else {
            $this->content = [];
        }
    }

    /**
     * Производит сборку исключения и запуск исключения
     * @throws AuthResponseException
     * @throws ResponseException
     */
    public function throwException(): void
    {
        if (isset($this->content['response'])) {

            $response = $this->content['response'];
            // AuthResponseException
            if (isset($response['error_code'])) {
                $exception = new AuthResponseException($this->httpCode, $response['error'], $response['error_code']);
                $exception->setDomain($response['domain']);
                $exception->setIp($response['ip']);
                $exception->setServerTime($response['server_time']);
            } else {
                $exception = new ResponseException($this->httpCode, "Error description json: " . \GuzzleHttp\json_encode($response));
            }

        } elseif (isset($this->content['title']) && $this->content['title'] == 'Error') {

            $exception = new ResponseException($this->httpCode, $this->content['detail'], $this->content['status']);

        } else {

            $exception = new ResponseException($this->httpCode, "Unknown error with empty description");

        }

        throw $exception;
    }
}