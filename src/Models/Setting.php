<?php namespace Edutalk\Base\Settings\Models;

use Edutalk\Base\Models\EloquentBase as BaseModel;
use Edutalk\Base\Settings\Models\Contracts\SettingModelContract;

class Setting extends BaseModel implements SettingModelContract
{
    protected $table = 'settings';

    protected $primaryKey = 'id';

    protected $fillable = [
        'option_key',
        'option_value',
    ];
}
