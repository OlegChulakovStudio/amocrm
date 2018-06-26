<?php
/**
 * Файл класса DefaultClient.php
 *
 * @author Samsonov Vladimir <vs@chulakov.ru>
 * @copyright Copyright (c) 2018, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace Chulakov\AmoCRM\Client;

use Chulakov\AmoCRM\ClientInterface;
use GuzzleHttp\Client as GuzzleClient;

/**
 * Реализация абстракции HTTP-клиента на основе Guzzle
 */
class DefaultClient implements ClientInterface
{
    /**
     * @var string
     */
    protected $subdomain;

    /**
     * @var string
     */
    protected $urlTemplate = 'https://{subdomain}.amocrm.ru/api/v2/';

    /**
     * @var array массив дополнительных заголовком для текущего выполняемого запроса.
     */
    protected $additionalHeaders = [];

    /**
     * @param $subdomain
     */
    public function __construct($subdomain)
    {
        $this->subdomain = $subdomain;
    }

    /**
     * POST-запрос
     *
     * @param string $action
     * @param array $queryParams
     * @param array $data
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function post($action, $queryParams = [], $data = [])
    {
        return \GuzzleHttp\json_decode($this->getGuzzle()->post($this->getApiUrl($action, $queryParams), [
            'json' => $data
        ])->getBody(), true);
    }

    /**
     * Производит GET-запрос к сервису
     *
     * @param string $action
     * @param array $queryParams
     * @return mixed
     */
    public function get($action, $queryParams = [])
    {
        return \GuzzleHttp\json_decode($this->getGuzzle()->get($this->getApiUrl($action, $queryParams))->getBody(), true);
    }

    /**
     * {@inheritdoc}
     */
    public function addRequestHeaders(array $headers)
    {
        $this->additionalHeaders = $headers;
    }

    /**
     * Возвращает подготовленный Guzzle-клиент для отправки HTTP-запроса
     * @return GuzzleClient
     */
    protected function getGuzzle()
    {
        $headers = array_merge([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ], $this->additionalHeaders);

        // Сбрасываем доп. заголовки для последующих запросов
        $this->additionalHeaders = [];

        return new GuzzleClient([
            'headers' => $headers,
            'verify' => false
        ]);
    }

    /**
     * Собирает полынй URL-адрес REST-запроса
     *
     * @return string
     */
    protected function getApiUrl($action, $queryParams)
    {
        $baseUrl = strtr($this->urlTemplate, [
            '{subdomain}' => $this->subdomain
        ]) . $action;

        if (!empty($queryParams)) {
            return  $baseUrl . '?' . http_build_query($queryParams);
        } else {
            return $baseUrl;
        }
    }
}