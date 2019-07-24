<?php
/**
 * Файл класса QueryRequestParams
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace Chulakov\AmoCRM\Entity\Lead;

use Chulakov\AmoCRM\AbstractRequestParams;

/**
 * Описывает допустимые параметры запроса для сущности "Сделка"
 * @package Chulakov\AmoCRM\Entity\Lead
 * @see https://www.amocrm.ru/developers/content/api/leads
 */
class QueryRequestParams extends AbstractRequestParams
{

    /**
     * @inheritdoc
     */
    public function allowedParams(): array
    {
        return [
            'id',
            'query',
            'responsible_user_id',
            'status',
        ];
    }

    /**
     * @return array
     */
    public function allowedWithParams(): array
    {
        return [
            'is_price_modified_by_robot',
            'loss_reason_name'
        ];
    }
}