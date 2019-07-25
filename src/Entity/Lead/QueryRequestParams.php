<?php
/**
 * Файл класса QueryRequestParams
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace Chulakov\AmoCRM\Entity\Lead;

use Chulakov\AmoCRM\Entity\AbstractQueryRequestParams;
/**
 * Описывает допустимые параметры запроса для сущности "Сделка"
 * @package Chulakov\AmoCRM\Entity\Lead
 * @see https://www.amocrm.ru/developers/content/api/leads
 */
class QueryRequestParams extends AbstractQueryRequestParams
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

    /**
     * Задает дополнительное условие отбора,
     * при котором выбираются только те сделки, которые были изменены после указанной даты
     * @param \DateTime|null $updatedAfter
     */
    public function modifiedAfter(\DateTime $updatedAfter = null)
    {
        if ($updatedAfter !== null) {
            $this->requestHeaders['If-Modified-Since'] = $updatedAfter->format('D, d M Y H:i:s');
        } else {
            unset($this->requestHeaders['If-Modified-Since']);
        }
    }
}