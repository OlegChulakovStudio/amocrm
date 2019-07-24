<?php
/**
 * Файл класса LeadEntity.php
 *
 * @author Samsonov Vladimir <vs@chulakov.ru>
 * @copyright Copyright (c) 2018, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace Chulakov\AmoCRM\Entity;

/**
 * Сущность "Сделки"
 * @see https://www.amocrm.ru/developers/content/api/leads
 */
class LeadEntity extends BaseEntity
{
    const ACTION_NAME = 'leads';

    /**
     * Возвращает список сделок
     *
     * @param array $params дополнительные параметры запроса
     * @return mixed
     */
    public function items($params = [], \DateTime $updatedAfter = null)
    {
        $params = array_merge($this->auth->getCredentials(), $params);

        if ($updatedAfter !== null) {
            $this->client->addRequestHeaders([
                'If-Modified-Since' => $updatedAfter->format('D, d M Y H:i:s')
            ]);
        }

        return $this->client->get(self::ACTION_NAME, $params);
    }
}
