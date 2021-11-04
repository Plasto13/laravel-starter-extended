<?php

if (! function_exists('on_route')) {
    function on_route($route)
    {
        return Route::current() ? Route::is($route) : false;
    }
}

if (! function_exists('locale')) {
    function locale($locale = null)
    {
        if (is_null($locale)) {
            return app()->getLocale();
        }

        app()->setLocale($locale);

        return app()->getLocale();
    }
}

if (! function_exists('is_module_enabled')) {
    function is_module_enabled($module)
    {
        return array_key_exists($module, app('modules')->enabled());
    }
}


if (! function_exists('get_list_of_frontend_themes')) {
    function get_list_of_frontend_themes()
    {
        $themeManager = app(Modules\Core\Foundation\Theme\ThemeManager::class);
        $forntend = $themeManager->allPublicThemes();
        $list = [];
        foreach ($forntend as $key => $value) {
            $list[$key] = ucfirst($key);
        }
        return $list;
    }
}

if (! function_exists('get_list_of_backend_themes')) {
    function get_list_of_backend_themes()
    {
        $themeManager = app(Modules\Core\Foundation\Theme\ThemeManager::class);
        $forntend = $themeManager->allBackendThemes();
        $list = [];
        foreach ($forntend as $key => $value) {
            $list[$key] = ucfirst($key);
        }
        return $list;
    }
}