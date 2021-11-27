<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
*
* Backend Routes
*
* --------------------------------------------------------------------
*/
Route::group(['namespace' => '\Modules\Setting\Http\Controllers\Backend', 'as' => 'backend.', 'middleware' => ['web', 'auth', 'can:view_backend'], 'prefix' => config('portal.core.core.admin-prefix', 'admin')], function () {
    /*
    * These routes need view-backend permission
    * (good if you want to allow more than one group in the backend,
    * then limit the backend features by different roles or permissions)
    *
    * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
    */

    /*
     *
     *  Tags Routes
     *
     * ---------------------------------------------------------------------
     */
    $module_name = 'setting';
    $controller_name = 'SettingController';
    Route::get("$module_name/show", ['as' => "$module_name.index", 'uses' => "$controller_name@index"]);
    Route::post("$module_name/store", ['as' => "$module_name.store", 'uses' => "$controller_name@store"]);
});
