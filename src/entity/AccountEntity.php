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
     *
     * @param array $params дополнительные параметры запроса
     * @return mixed
     */
    public function info($params = [])
    {
        $params = array_merge($this->auth->getCredentials(), $params);

        return $this->client->get(self::ACTION_NAME, $params);
    }

    /**
     * Возвращает информацию по воронкам аккаунта
     * @return array
     */
    public function pipelines()
    {
        $params = array_merge($this->auth->getCredentials(), [
            'with' => 'pipelines'
        ]);

        $account = $this->client->get(self::ACTION_NAME, $params);

        if (!empty($account['_embedded']['pipelines'])) {
            return $account['_embedded']['pipelines'];
        }

        return [];
    }

    /**
     * Этапы цифровой воронки
     *
     * @param bool $forMainOnly возвращать этапы только главной воронки
     * @return array
     */
    public function pipelinesStatuses($forMainOnly = true)
    {
        $statuses = [];

        foreach ($this->pipelines() as $pipeline) {
            if ($forMainOnly) {
                if ($pipeline['is_main'] == 1) {
                    return $pipeline['statuses'];
                }
            } else {
                $statuses = array_merge($statuses, $pipeline['statuses']);
            }
        }

        return $statuses;
    }

    /**
     * Возвращает информацию по пользователям аккаунта
     * @return array
     */
    public function users()
    {

        $account = $this->info([
            'with' => 'users'
        ]);

        if (!empty($account['_embedded']['users'])) {
            return $account['_embedded']['users'];
        }

        return [];
    }

    /**
     * Возвращает информацию по группам пользователей аккаунта
     * @return array
     */
    public function groups()
    {
        $account = $this->info([
            'with' => 'groups'
        ]);

        if (!empty($account['_embedded']['groups'])) {
            return $account['_embedded']['groups'];
        }

        return [];
    }

    /**
     * Вернёт информацию по всем типам дополнительных полей в аккаунте
     * @return array
     */
    public function noteTypes()
    {
        $account = $this->info([
            'with' => 'note_types'
        ]);

        if (!empty($account['_embedded']['note_types'])) {
            return $account['_embedded']['note_types'];
        }

        return [];
    }

    /**
     * Вернёт информацию по всем типам задач в аккаунте
     *
     * @return array
     */
    public function taskTypes()
    {
        $account = $this->info([
            'with' => 'task_types'
        ]);

        if (!empty($account['_embedded']['task_types'])) {
            return $account['_embedded']['task_types'];
        }

        return [];
    }

    /**
     * Вернёт информацию по всем дополнительным полям в аккаунте
     * @return array
     */
    public function customFields()
    {
        $account = $this->info([
            'with' => 'custom_fields'
        ]);

        if (!empty($account['_embedded']['custom_fields'])) {
            return $account['_embedded']['custom_fields'];
        }

        return [];
    }
}