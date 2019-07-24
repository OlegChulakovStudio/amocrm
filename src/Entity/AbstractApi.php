<?php
/**
 * Файл класса AbstractApi.php
 *
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace Chulakov\AmoCRM\Entity;

use Chulakov\AmoCRM\ApiInterface;
use Chulakov\AmoCRM\HttpClientInterface;

/**
 * Базовая реализация интерфейса для сущностей
 * @package Chulakov\AmoCRM\Entity
 */
abstract class AbstractApi implements ApiInterface
{
    /**
     * @var HttpClientInterface
     */
    protected $client;

    /**
     * Устанавливает клиента для работы с API
     * @param HttpClientInterface $client
     */
    public function setClient(HttpClientInterface $client): void
    {
        $this->client = $client;
    }
}