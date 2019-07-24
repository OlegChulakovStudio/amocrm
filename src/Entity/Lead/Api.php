<?php
/**
 * Файл класса Api.php
 *
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace Chulakov\AmoCRM\Entity\Lead;

use Chulakov\AmoCRM\HttpClientInterface;
use Chulakov\AmoCRM\Entity\AbstractApi;
use Chulakov\AmoCRM\Entity\AbstractQueryRequestParams;

/**
 * Реализация методов RESTful API для сущности Сделки
 * @package Chulakov\AmoCRM\Entity\Lead
 * @see https://www.amocrm.ru/developers/content/api/leads
 */
class Api extends AbstractApi
{

    /**
     * Код сущности
     */
    const ACTION_NAME = 'leads';

    /**
     * @param HttpClientInterface $client настроенный HTTP-клиент
     */
    public function __construct(HttpClientInterface $client)
    {
        $this->setClient($client);
    }

    /**
     * Получить список сделок
     * @param AbstractQueryRequestParams $params
     * @param \DateTime|null $updatedAfter возвращать сделки, которые были изменены только после этого времени
     *
     * @return array
     */
    public function items(AbstractQueryRequestParams $params): array
    {
        return $this->client->get(self::ACTION_NAME, $params);
    }

}