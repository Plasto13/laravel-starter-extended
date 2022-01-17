<?php
namespace Modules\Core\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Modules\Core\View\Component\Card;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Composers\MenuComposer;
use Modules\Core\Composers\ThemeComposer;
use Modules\Core\View\Component\Nestable;
use Modules\Core\Composers\LocaleComposer;
use Modules\Core\Menu\MenuItemsRepository;
use Modules\Core\View\Component\Datatable;
use Modules\Core\Composers\LocalesComposer;
use Modules\Core\Foundation\Theme\ThemeManager;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Composers\SettingLocalesComposer;

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

    public function __construct($app)
    {
        $this->loader = AliasLoader::getInstance();

        parent::__construct($app);
    }

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        // adding global middleware
        $this->registerTranslations();
        $this->registerComposers();
        $this->publishConfig('core', 'settings');
        $this->publishConfig('core', 'config');
        $this->publishConfig('core', 'available-locales');
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->registerMenu();
        View::composer('backend.includes.sidebar', MenuComposer::class);
        // View::composer('partials.navbar', TopMenuComposer::class);
        $this->app->singleton('portal.onBackend', function () {
            return $this->onBackend();
        });
        $this->registerServices();
        $this->registerComponents();
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

    private function registerComponents()
    {
        Blade::component('nestable', Nestable::class);
        Blade::component('datatables', Datatable::class);
        Blade::component('card', Card::class);
    }

    /**
    * Register package lavary/laravel-menu.
    */
    private function registerMenu()
    {
        $this->app->register(\Lavary\Menu\ServiceProvider::class);
        $this->loader->alias('Menu', \Lavary\Menu\Facade::class);

        // Menu items repository singleton
        $this->app->singleton('core.menu.items', function () {
            return new MenuItemsRepository();
        });
        // Menu items repository singleton
        // $this->app->singleton('core.top.menu.items', function () {
        //     return new TopMenuItemsRepository();
        // });
    }

    private function onBackend()
    {
        $url = app(Request::class)->url();
        if (str_contains($url, config('core.core.admin-prefix'))) {
            return true;
        }

        return false;
    }
}
