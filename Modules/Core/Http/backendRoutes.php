<?php

use Illuminate\Routing\Router;

/** @var Router $router */

$router->group(['prefix' => ''], function (Router $router) {
    //Dashboard
    $router->get('/', [
        'uses' => 'BackendController@index',
        'as' => 'backend.home',
        'middleware' => 'can:view_backend'
    ]);

    $router->get('dashboard', [
        'uses' => 'BackendController@index',
        'as' => 'backend.dashboard',
        'middleware' => 'can:view_backend'
    ]);
    //Notification
    $router->get('/notifications', [
        'as' => 'backend.notifications.index',
        'uses' => 'NotificationsController@index'
    ]);

    $router->get('/notifications/markAllAsRead', [
        'as' => 'backend.notifications.markAllAsRead',
        'uses' => 'NotificationsController@markAllAsRead'
    ]);

    $router->delete('/notifications/deleteAll', [
        'as' => 'backend.notifications.deleteAll',
        'uses' => 'NotificationsController@deleteAll'
    ]);

    $router->get('/notifications/{id}', [
        'as' => 'backend.notifications.show',
        'uses' => 'NotificationsController@show'
    ]);
    //Backup
    $router->get('/backups', [
        'as' => 'backend.backups.index',
        'uses' => 'BackupController@index'
    ]);
    $router->get('/backups/create', [
        'as' => 'backend.backups.create',
        'uses' => 'BackupController@create'
    ]);
    $router->get('/backups/download/{file_name}', [
        'as' => 'backend.backups.download',
        'uses' => 'BackupController@download'
    ]);
    $router->get('/backups/delete/{file_name}', [
        'as' => 'backend.backups.delete',
        'uses' => 'BackupController@delete'
    ]);
    /*
    *
    *  Roles Routes
    *
    * ---------------------------------------------------------------------
    */
    $router->get('/roles', [
        'as' => 'backend.roles.index',
        'uses' => 'RolesController@index'
    ]);

    $router->get('/roles/create', [
        'as' => 'backend.roles.create',
        'uses' => 'RolesController@create'
    ]);

    $router->post('/roles', [
        'as' => 'backend.roles.store',
        'uses' => 'RolesController@store'
    ]);

    $router->get('/roles/{id}', [
        'as' => 'backend.roles.show',
        'uses' => 'RolesController@show'
    ]);

    $router->get('/roles/edit/{id}', [
        'as' => 'backend.roles.edit',
        'uses' => 'RolesController@edit'
    ]);

    $router->patch('/roles/{id}', [
        'as' => 'backend.roles.update',
        'uses' => 'RolesController@update'
    ]);

    $router->post('/roles/destroy/{id}', [
        'as' => 'backend.roles.destroy',
        'uses' => 'RolesController@destroy'
    ]);

    /*
    *
    *  Users Routes
    *
    * ---------------------------------------------------------------------
    */
    $router->get(
        'users/profile/{id}',
        ['as' => 'backend.users.profile',
            'uses' => 'UserController@profile'
        ]
    );

    $router->get(
        'users/profile/{id}/edit',
        ['as' => 'backend.users.profileEdit',
            'uses' => 'UserController@profileEdit'
        ]
    );

    $router->patch(
        'users/profile/{id}/edit',
        ['as' => 'backend.users.profileUpdate',
            'uses' => 'UserController@profileUpdate'
        ]
    );

    $router->get(
        'users/emailConfirmationResend/{id}',
        ['as' => 'backend.users.emailConfirmationResend',
            'uses' => 'UserController@emailConfirmationResend'
        ]
    );

    $router->delete(
        'users/userProviderDestroy',
        ['as' => 'backend.users.userProviderDestroy',
            'uses' => 'UserController@userProviderDestroy'
        ]
    );

    $router->get(
        'users/profile/changeProfilePassword/{id}',
        ['as' => 'backend.users.changeProfilePassword',
            'uses' => 'UserController@changeProfilePassword'
        ]
    );

    $router->patch(
        'users/profile/changeProfilePassword/{id}',
        ['as' => 'backend.users.changeProfilePasswordUpdate',
            'uses' => 'UserController@changeProfilePasswordUpdate'
        ]
    );

    $router->get(
        'users/changePassword/{id}',
        ['as' => 'backend.users.changePassword',
            'uses' => 'UserController@changePassword'
        ]
    );

    $router->patch(
        'users/changePassword/{id}',
        ['as' => 'backend.users.changePasswordUpdate',
            'uses' => 'UserController@changePasswordUpdate'
        ]
    );

    $router->get(
        'users/trashed',
        ['as' => 'backend.users.trashed',
            'uses' => 'UserController@trashed'
        ]
    );

    $router->patch(
        'users/trashed/{id}',
        ['as' => 'backend.users.restore',
            'uses' => 'UserController@restore'
        ]
    );

    $router->get(
        'users/index_data',
        ['as' => 'backend.users.index_data',
            'uses' => 'UserController@index_data'
        ]
    );

    $router->get(
        'users/index_list',
        ['as' => 'backend.users.index_list',
            'uses' => 'UserController@index_list'
        ]
    );

    $router->get('/users', [
        'as' => 'backend.users.index',
        'uses' => 'UserController@index'
    ]);

    $router->get('/users/create', [
        'as' => 'backend.users.create',
        'uses' => 'UserController@create'
    ]);

    $router->post('/users', [
        'as' => 'backend.users.store',
        'uses' => 'UserController@store'
    ]);

    $router->get('/users/{id}', [
        'as' => 'backend.users.show',
        'uses' => 'UserController@show'
    ]);

    $router->get('/users/{id}/edit', [
        'as' => 'backend.users.edit',
        'uses' => 'UserController@edit'
    ]);

    $router->patch('/users/{id}', [
        'as' => 'backend.users.update',
        'uses' => 'UserController@update'
    ]);

    $router->post('/users/destroy/{id}', [
        'as' => 'backend.users.destroy',
        'uses' => 'UserController@destroy'
    ]);

    $router->patch(
        'users/{id}/block',
        ['as' => 'backend.users.block',
            'uses' => 'UserController@block',
            'middleware' => ['permission:block_users']
        ]
    );

    $router->patch(
        'users/{id}/unblock',
        ['as' => 'backend.users.unblock',
            'uses' => 'UserController@unblock',
            'middleware' => ['permission:block_users']
        ]
    );

    // append
});
