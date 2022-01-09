<?php
namespace App\Providers;

use Illuminate\Support\Arr;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerLocales();
        Paginator::useBootstrap();

        Blade::component('components.backend-breadcrumbs', 'backendBreadcrumbs');
    }

    private function registerLocales()
    {
        $allLocales = config('portal.core.available-locales');
        $locales = Arr::only($allLocales, json_decode(setting('core::locales')));
        LaravelLocalization::setSupportedLocales($locales);
        // dd(LaravelLocalization::getSupportedLocales());
        config([
            'laravellocalization.supportedLocales' => $locales,
            'laravellocalization.useAcceptLanguageHeader' => true,
            'hideDefaultLocaleInURL' => true
        ]);
        // dd(config('laravellocalization.supportedLocales'));
    }
}
