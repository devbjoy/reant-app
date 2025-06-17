<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    protected $guarded = [];
    protected $table = 'company_settings';

    public static function get($key, $default = null)
    {
        $companySetting = self::where('key', $key)->first();
        return $companySetting ? $companySetting->value : $default;
    }

}
