<?php
/**
 * Файл класса AuthRequestParams.php
 *
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace Chulakov\AmoCRM\Auth;

use Chulakov\AmoCRM\AbstractRequestParams;

/**
 * Параметры, необходимые для аутентификации пользователя
 * @package Chulakov\AmoCRM\Auth
 */
class AuthRequestParams extends AbstractRequestParams
{

    /**
     * @inheritdoc
     */
    public function allowedParams(): array
    {
        return [
            'USER_LOGIN',
            'USER_HASH'
        ];
    }
}