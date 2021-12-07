<?php
namespace Modules\Core\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Composers\ThemeComposer;
use Modules\Core\Composers\LocaleComposer;
use Modules\Core\Composers\LocalesComposer;
use Modules\Core\Foundation\Theme\ThemeManager;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Composers\SettingLocalesComposer;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CoreServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Core';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'core';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerComposers();
        $this->publishConfig('core', 'settings');
        $this->publishConfig('core', 'config');
        $this->publishConfig('core', 'available-locales');
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
        $this->registerLocales();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->singleton('portal.onBackend', function () {
            return $this->onBackend();
        });
        $this->registerServices();
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }

    private function registerServices()
    {
        $this->app->singleton(ThemeManager::class, function ($app) {
            return new ThemeManager($app);
        });
    }

    private function registerComposers()
    {
        View::composer(['setting::admin.fields.plain.select-backend-theme', 'setting::admin.fields.plain.select-frontend-theme'], ThemeComposer::class);
        View::composer('setting::admin.fields.plain.select-locales', SettingLocalesComposer::class);
        View::composer('*', LocaleComposer::class);
        View::composer('*', LocalesComposer::class);
    }

    private function onBackend()
    {
        $url = app(Request::class)->url();
        if (str_contains($url, config('core.core.admin-prefix'))) {
            return true;
        }

        return false;
    }

    private function registerLocales()
    {
        $allLocales = config('portal.core.available-locales');
        $locales = Arr::only($allLocales, json_decode(setting('core::locales')));
        LaravelLocalization::setSupportedLocales($locales);
        // config([
        //     'laravellocalization.supportedLocales' => $locales,
        //     'laravellocalization.useAcceptLanguageHeader' => true,
        //     'hideDefaultLocaleInURL' => true
        // ]);
        // dd(config('laravellocalization.supportedLocales'));
    }
}
