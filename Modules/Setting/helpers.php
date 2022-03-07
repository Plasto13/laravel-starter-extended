<?php

if (!function_exists('setting')) {
    function setting($name, $locale = null, $default = null)
    {
        if (env('APP_INSTALED')) {
            return app('setting.settings')->get($name, $locale, $default);
        }
    }
}
