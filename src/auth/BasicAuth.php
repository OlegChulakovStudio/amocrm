<?php
/**
 * Файл класса CookieAuth.php
 *
 * @author Samsonov Vladimir <vs@chulakov.ru>
 * @copyright Copyright (c) 2018, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace Chulakov\AmoCRM\Auth;

use Chulakov\AmoCRM\AuthInterface;

/**
 * Реализует формирование параметров, необходимых для авторизации через API.
 * Здесь н происходит магии с куками, которая описана здесь @see https://www.amocrm.ru/developers/content/api/auth
 * Как выяснилось, можно просто пробрасывать параметры авторизации в каждый запрос
 */
class BasicAuth implements AuthInterface
{

    /**
     * @var string
     */
    protected $subdomain;

    /**
     * @var string
     */
    protected $login;

    /**
     * @var string
     */
    protected $hash;

    /**
     * Инициализация необходимых параметров для авторизации
     * @param $login
     * @param $hash
     */
    public function __construct($login, $hash)
    {
        $this->login = $login;
        $this->hash = $hash;
    }

    /**
     * {@inheritdoc}
     * @return array
     */
    public function getCredentials()
    {
        return [
            'USER_LOGIN' => $this->login,
            'USER_HASH' => $this->hash
        ];
    }
}