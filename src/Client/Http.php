<?php
/**
 * Файл класса Http.php
 *
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace Chulakov\AmoCRM;

use Chulakov\AmoCRM\Entity\AbstractQueryRequestParams;
use GuzzleHttp\Client as GuzzleClient;

/**
 * Реализация Http-клиента на основе библиотеки Guzzle для взаимодействия с RESTful API AmoCRM
 * @package Chulakov\AmoCRM
 */
class Http implements ClientInterface
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
     * @var AbstractRequestParams параметры авторизации по HTTP
     */
    protected $authParams;

    /**
     * @param \Chulakov\AmoCRM\AbstractRequestParams $authParams
     */
    public function __construct(string $subdomain, AbstractRequestParams $authParams)
    {
        $this->subdomain = $subdomain;
        $this->authParams = $authParams;
    }

    /**
     * @param string $action имя действия
     * @param AbstractRequestParams $params параметры запроса
     * @return mixed
     */
    public function get(string $action, AbstractQueryRequestParams $params)
    {
        return \GuzzleHttp\json_decode($this->getGuzzleClient()->get($this->getApiUrl($action, $params))->getBody(), true);
    }

    /**
     * @param string $action имя действия
     * @param \Chulakov\AmoCRM\AbstractRequestParams $params параметры запроса
     * @param array|\Chulakov\AmoCRM\AbstractRequestParams|AbstractRequestParams[] $data данные сущности для сохранения
     * @return mixed
     */
    public function post(string $action, AbstractQueryRequestParams $params, $data)
    {
        return \GuzzleHttp\json_decode($this->getGuzzleClient()->post($this->getApiUrl($action, $params), [
            'json' => $data
        ])->getBody(), true);
    }

    /**
     * Возвращает подготовленный Guzzle-клиент для отправки HTTP-запроса
     * @return GuzzleClient
     */
    protected function getGuzzleClient()
    {
        return new GuzzleClient([
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ],
            'verify' => false
        ]);
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
}