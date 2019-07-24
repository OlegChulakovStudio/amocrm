<?php
/**
 * Файл класса UpdateRequestParams.php
 *
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace Chulakov\AmoCRM\Entity\Lead;


use Chulakov\AmoCRM\Entity\AbstractOperationRequestParams;

/**
 * Параметры, необходимые для добавления новой сделки
 * @package Chulakov\AmoCRM\Entity\Lead
 */
class UpdateRequestParams extends AbstractOperationRequestParams
{

    /**
     * @inheritdoc
     */
    public function allowedParams(): array
    {
        return [
            'id',
            'updated_at',
            'unlink',
            'sale',
            'custom_fields'
        ];
    }
}