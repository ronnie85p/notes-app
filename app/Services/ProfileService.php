<?php
namespace App\Services;
use App\Models\Profile\Settings;

class ProfileService 
{
    public static function getSettings() 
    {
        $settings = Settings::first();
        if (is_null($settings)) {
            $settings = new Settings(); 
        }

        return $settings;
    }

    public static function updateSettings(array $data)
    {
        $settings = self::getSettings();
        $settings->fill($data);
        $settings->save();

        return $settings;
    }
}