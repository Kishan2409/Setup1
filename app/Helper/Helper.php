<?php

namespace App\Helper;

use App\Models\Settings;

class Helper
{
    static function Settings()
    {
        $Settings = Settings::first();
        return $Settings;
    }
}
