<?php
/**
 * Файл класса ApiInterface.php
 *
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace Chulakov\AmoCRM;

/**
 * Интерфейс взаимодействия с RESTful API AmoCRM по средствам клиента @see HttpClientInterface
 * @package Chulakov\AmoCRM
 */
interface ApiInterface
{
    /**
     * Устанавливает объект http-клиента
     *
     * @param HttpClientInterface $client
     */
    public function setClient(HttpClientInterface $client): void;
}