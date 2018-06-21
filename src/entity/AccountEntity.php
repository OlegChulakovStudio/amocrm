<?php
/**
 * Файл класса AccountEntity.php
 *
 * @author Samsonov Vladimir <vs@chulakov.ru>
 * @copyright Copyright (c) 2018, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace Chulakov\AmoCRM\Entity;

/**
 * Сущность "Аккаунт"
 * @see https://www.amocrm.ru/developers/content/api/account
 */
class AccountEntity extends BaseEntity
{
    const ACTION_NAME = 'account';

    /**
     * Возвращает информацию об аккаунте
     * @see https://www.amocrm.ru/developers/content/api/account
     * @return mixed
     */
    public function info()
    {
        return $this->client->get(self::ACTION_NAME, $this->auth->getCredentials());
    }
}