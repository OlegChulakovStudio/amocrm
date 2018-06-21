<?php
/**
 * Файл класса BaseEntity.php
 *
 * @author Samsonov Vladimir <vs@chulakov.ru>
 * @copyright Copyright (c) 2018, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace Chulakov\AmoCRM\Entity;

use Chulakov\AmoCRM\AuthInterface;
use Chulakov\AmoCRM\ClientInterface;
use Chulakov\AmoCRM\EntityInterface;

/**
 * Абстрактынй класс базовой сущности API
 */
abstract class BaseEntity implements EntityInterface
{

    /**
     * @var AuthInterface
     */
    protected $auth;

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @param AuthInterface $auth
     */
    public function setAuth(AuthInterface $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param ClientInterface $client
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
    }
}