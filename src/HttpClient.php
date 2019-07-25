<?php
/**
 * Файл класса HttpClient.php
 *
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace Chulakov\AmoCRM;

use Chulakov\AmoCRM\Entity\AbstractQueryRequestParams;
use Chulakov\AmoCRM\Exception\Http\ResponseExceptionFactory;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Response;

/**
 * Реализация Http-клиента на основе библиотеки Guzzle для взаимодействия с RESTful API AmoCRM
 * @package Chulakov\AmoCRM
 */
class HttpClient implements HttpClientInterface
{
    /**
     * @var string
     */
    protected $subdomain;

    /**
     * @var string шаблон ссылки
     */
    protected $urlTemplate = 'https://{subdomain}.amocrm.ru/api/v2/';

    /**
     * @var GuzzleClient инстанс текущего Guzzle-клиента
     */
    protected $guzzle;

    /**
     * @var AbstractRequestParams параметры авторизации по HTTP
     */
    protected $authParams;

    /**
     * @var array заголовки, которые всегда передаются серверу API
     */
    protected $defaultHeaders = [
        'Content-Type' => 'application/json',
        'Accept' => 'application/json'
    ];

    /**
     * @param string $subdomain
     * @param AbstractRequestParams $authParams
     */
    public function __construct(string $subdomain, AbstractRequestParams $authParams)
    {
        $this->subdomain = $subdomain;
        $this->authParams = $authParams;
    }

    /**
     * @param string $action
     * @param AbstractQueryRequestParams $params
     * @return array
     * @throws Exception\Http\ResponseException
     */
    public function get(string $action, AbstractQueryRequestParams $params): array
    {
        try {

            $response = $this->getGuzzleClient()
                ->get(
                    $this->getApiUrl($action, $params),
                    [
                        'headers' => $this->prepareRequestHeaders($params->getRequestHeaders())
                    ]
                );

        } catch (\GuzzleHttp\Exception\ClientException $exception) {
            $factory = new ResponseExceptionFactory($exception);
            $factory->throwException();
        }

        return $this->decodeResponse($response);
    }

    /**
     * @param string $action
     * @param AbstractQueryRequestParams $params
     * @param AbstractRequestParams|AbstractRequestParams[] $data
     * @return array
     * @throws Exception\Http\ResponseException
     */
    public function post(string $action, AbstractQueryRequestParams $params, $data): array
    {
        try {
            $response = $this->getGuzzleClient()
                ->post(
                    $this->getApiUrl($action, $params), [
                        'json' => $data,
                        'headers' => $this->prepareRequestHeaders($params->getRequestHeaders())
                    ]
                );
        } catch (\GuzzleHttp\Exception\ClientException $exception) {
            $factory = new ResponseExceptionFactory($exception);
            $factory->throwException();
        }

        return $this->decodeResponse($response);
    }

    /**
     * Возвращает подготовленный Guzzle-клиент для отправки HTTP-запроса
     * @return GuzzleClient
     */
    protected function getGuzzleClient()
    {
        if (is_null($this->guzzle)) {
            $this->guzzle = new GuzzleClient([
                'verify' => false
            ]);
        }

        return $this->guzzle;
    }

    /**
     * Собирает полынй URL-адрес REST-запроса
     *
     * @return string
     */
    protected function getApiUrl($action, AbstractQueryRequestParams $queryParams)
    {
        $baseUrl = strtr($this->urlTemplate, [
            '{subdomain}' => $this->subdomain
        ]) . $action;


        $params = array_merge($this->authParams->getRequestParams(), $queryParams->getRequestParams());

        if (!empty($params)) {
            return  $baseUrl . '?' . http_build_query($params);
        }

        return $baseUrl;
    }

    /**
     * Сливает умолчательные заголовки запроса с пользовательскими и возвращает результат
     * @param array $customHeaders
     * @return array
     */
    protected function prepareRequestHeaders(array $customHeaders = [])
    {
        return array_merge($this->defaultHeaders, $customHeaders);
    }

    /**
     * Декодирует тело ответа из json-строки в ассоциативный массив
     * @param Response $response
     * @return mixed
     */
    protected function decodeResponse(Response $response)
    {
        return \GuzzleHttp\json_decode($response->getBody(), true);
    }
}