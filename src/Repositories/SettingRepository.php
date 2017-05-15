<?php namespace Edutalk\Base\Settings\Repositories;

use Edutalk\Base\Caching\Services\Traits\Cacheable;
use Edutalk\Base\Repositories\Eloquent\EloquentBaseRepository;
use Edutalk\Base\Caching\Services\Contracts\CacheableContract;
use Edutalk\Base\Settings\Repositories\Contracts\SettingContract;

class SettingRepository extends EloquentBaseRepository implements SettingContract, CacheableContract
{
    use Cacheable;

    /**
     * @return array
     */
    public function getAllSettings()
    {
        $settings = $this->model->get(['option_key', 'option_value']);

        return $settings->pluck('option_value', 'option_key')->toArray();
    }

    /**
     * @param $settingKey
     * @return mixed
     */
    public function getSetting($settingKey)
    {
        $setting = $this->model
            ->where(['option_key' => $settingKey])
            ->select(['id', 'option_key', 'option_value'])
            ->first();
        if ($setting) {
            return $setting->option_value;
        }
        return null;
    }

    /**
     * @param array $settings
     * @return bool
     */
    public function updateSettings($settings = [])
    {
        foreach ($settings as $key => $row) {
            $result = $this->updateSetting($key, $row);
            if (!$result) {
                return $result;
            }
        }
        return true;
    }

    /**
     * @param $key
     * @param $value
     * @return int|null
     */
    public function updateSetting($key, $value)
    {
        /**
         * Parse everything to string
         */
        $value = (string)$value;

        $setting = $this->model
            ->where(['option_key' => $key])
            ->select(['id', 'option_key', 'option_value'])
            ->first();

        $result = $this->createOrUpdate($setting, [
            'option_key' => $key,
            'option_value' => $value
        ]);

        return $result;
    }
}
