<?php
/**
 * Файл класса CreateRequestParams.php
 *
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace Chulakov\AmoCRM\Entity\Lead;

use Chulakov\AmoCRM\Entity\AbstractOperationRequestParams;

/**
 * Параметры, необходимые для добавления новой сделки
 * @package Chulakov\AmoCRM\Entity\Lead
 * @see https://www.amocrm.ru/developers/content/api/leads
 */
class CreateRequestParams extends AbstractOperationRequestParams
{

    /**
     * @inheritdoc
     */
    public function allowedParams(): array
    {
        return [
            'name',
            'created_at',
            'updated_at',
            'status_id',
            'pipeline_id',
            'responsible_user_id',
            'sale',
            'tags',
            'contacts_id',
            'company_id',
            'catalog_elements_id',
            'custom_fields'
        ];
    }
}