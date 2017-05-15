<?php namespace Edutalk\Base\Settings\Support\Facades;

use Illuminate\Support\Facades\Facade;
use Edutalk\Base\Settings\Support\CmsSettings;

class CmsSettingsFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return CmsSettings::class;
    }
}
