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

    protected $currentAction;

    protected $currentQueryParams;

    protected $currentForm;

    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    protected $currentRequestResult;


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
        $this->currentAction = $action;
        $this->currentQueryParams = $queryParams;

        $this->currentRequestResult = $this->getGuzzle()->post($this->getApiUrl(), [
            'json' => $data
        ]);

        return $this->result();
    }

    /**
     * Производит GET-запрос к сервису
     * @param $action
     * @param array $queryParams
     * @return mixed
     */
    public function get($action, $queryParams = [])
    {
        $this->currentAction = $action;
        $this->currentQueryParams = $queryParams;

        $this->currentRequestResult = $this->getGuzzle()->get($this->getApiUrl());

        return $this->result();
    }

    /**
     *
     * @return GuzzleClient
     */
    protected function getGuzzle()
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
    protected function getApiUrl()
    {
        $baseUrl = strtr($this->urlTemplate, [
            '{subdomain}' => $this->subdomain
        ]) . $this->currentAction;

        if (!empty($this->currentQueryParams)) {
            return  $baseUrl . '?' . http_build_query($this->currentQueryParams);
        } else {
            return $baseUrl;
        }
    }

    /**
     * Возвращает результирующий массив
     * @return array
     */
    protected function result()
    {
        return \GuzzleHttp\json_decode($this->currentRequestResult->getBody(), true);
    }
}