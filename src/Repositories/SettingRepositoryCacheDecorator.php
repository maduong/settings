<?php namespace Edutalk\Base\Settings\Repositories;

use Edutalk\Base\Repositories\Eloquent\EloquentBaseRepositoryCacheDecorator;
use Edutalk\Base\Settings\Repositories\Contracts\SettingContract;

class SettingRepositoryCacheDecorator extends EloquentBaseRepositoryCacheDecorator implements SettingContract
{
    /**
     * @return array
     */
    public function getAllSettings()
    {
        return $this->beforeGet(__FUNCTION__, func_get_args());
    }

    /**
     * @param $settingKey
     * @return mixed
     */
    public function getSetting($settingKey)
    {
        return $this->beforeGet(__FUNCTION__, func_get_args());
    }

    /**
     * @param array $settings
     * @return bool
     */
    public function updateSettings($settings = [])
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param $key
     * @param $value
     * @return int|null
     */
    public function updateSetting($key, $value)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }
}
