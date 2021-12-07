<?php

use Illuminate\Routing\Router;

/** @var Router $router */

$router->group(['prefix' => '/setting'], function (Router $router) {
    $router->bind('setting', function ($id) {
        return app('Modules\Setting\Repositories\SettingRepository')->find($id);
    });

    $router->get('/', [
        'as' => 'backend.setting.index',
        'uses' => 'SettingController@index',
        // 'middleware' => 'can:setting.index'
    ]);
    $router->get('module/{module}', [
        'as' => 'backend.setting.module',
        'uses' => 'SettingController@getModuleSettings',
        // 'middleware' => 'can:setting.index'
    ]);
    $router->post('/', [
        'as' => 'backend.setting.store',
        'uses' => 'SettingController@store',
        // 'middleware' => 'can:setting.index'
    ]);
    // append
});
