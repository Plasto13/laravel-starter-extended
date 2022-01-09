<?php

use Illuminate\Routing\Router;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;

$router->group(['prefix' => ''], function (Router $router) {
    /*
    *
    *  Frontend default Routes
    *
    * ---------------------------------------------------------------------
    */
    $router->get('language/{language}', 'LanguageController@switch')->name('language.switch');
    $router->get('/', 'FrontendController@index')->name('frontend.index');
    $router->get('home', 'FrontendController@index')->name('frontend.home');
    $router->get('privacy', 'FrontendController@privacy')->name('frontend.privacy');
    $router->get('terms', 'FrontendController@terms')->name('frontend.terms');

    /*
    *
    *  Auth Routes
    *
    * ---------------------------------------------------------------------
    */
    if (user_registration()) {
        // Check if registration is enabled
        $router->get('/register', [RegisteredUserController::class, 'create'])
                    ->name('register');

        $router->post('/register', [RegisteredUserController::class, 'store']);
    }

    $router->get('/login', [AuthenticatedSessionController::class, 'create'])
                    ->middleware('guest')
                    ->name('login');

    $router->post('/login', [AuthenticatedSessionController::class, 'store'])
                    ->middleware('guest');

    $router->get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                    ->middleware('guest')
                    ->name('password.request');

    $router->post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                    ->middleware(['guest'])
                    ->name('password.email');

    $router->get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                    ->middleware(['guest'])
                    ->name('password.reset');

    $router->post('/reset-password', [NewPasswordController::class, 'store'])
                    ->middleware(['guest'])
                    ->name('password.update');

    $router->get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                    ->middleware(['auth'])
                    ->name('verification.notice');

    $router->get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                    ->middleware(['auth', 'signed', 'throttle:6,1'])
                    ->name('verification.verify');

    $router->post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                    ->middleware(['auth', 'throttle:6,1'])
                    ->name('verification.send');

    $router->get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                    ->middleware(['auth'])
                    ->name('password.confirm');

    $router->post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                    ->middleware(['auth']);

    $router->post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                    ->name('logout')
                    ->middleware('auth');

    /*
    *
    *  Users Routes
    *
    * ---------------------------------------------------------------------
    */
    $router->group(['middleware' => ['auth']], function (Router $router) {
        $router->get('profile/{id}', [
            'as' => 'frontend.users.profile',
            'uses' => 'UserController@profile'
        ]);

        $router->get('profile/{id}/edit', [
            'as' => 'frontend.users.profileEdit',
            'uses' => 'UserController@profileEdit'
        ]);

        $router->patch('profile/{id}/edit', [
            'as' => 'frontend.users.profileUpdate',
            'uses' => 'UserController@profileUpdate'
        ]);

        $router->get('users/emailConfirmationResend/{id}', [
            'as' => 'frontend.users.emailConfirmationResend',
            'uses' => 'UserController@emailConfirmationResend'
        ]);

        $router->get('profile/changePassword/{username}', [
            'as' => 'frontend.users.changePassword',
            'uses' => 'UserController@changePassword'
        ]);

        $router->patch('profile/changePassword/{username}', [
            'as' => 'frontend.users.changePasswordUpdate',
            'uses' => 'UserController@changePasswordUpdate'
        ]);

        $router->delete('users/userProviderDestroy', [
            'as' => 'frontend.users.userProviderDestroy',
            'uses' => 'UserController@userProviderDestroy'
        ]);
    });
});

// Social Login Routes
$router->group(['namespace' => 'Auth', 'middleware' => 'guest'], function (Router $router) {
    $router->get('login/{provider}', [
        'as' => 'social.login',
        'uses' => 'SocialLoginController@redirectToProvider'
    ]);

    $router->get('login/{provider}/callback', 'SocialLoginController@handleProviderCallback');
});
