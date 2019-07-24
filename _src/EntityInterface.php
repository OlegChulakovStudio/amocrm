<?php
/**
 * Файл класса EntityInterface.php
 *
 * @author Samsonov Vladimir <vs@chulakov.ru>
 * @copyright Copyright (c) 2018, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace Chulakov\AmoCRM;

/**
 * Интерфейс регламентирует необходимые методы для всех сущностей API
 */
interface EntityInterface
{
    /**
     * Устанавливает объект с реквизитами авторизации
     * @param AuthInterface $auth
     */
    public function setAuth(AuthInterface $auth);

    /**
     * Устанавливает объект http-клиента
     *
     * @param ClientInterface $client
     */
    public function setClient(ClientInterface $client);
}