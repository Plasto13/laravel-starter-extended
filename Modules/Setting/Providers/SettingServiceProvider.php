<?php
namespace Modules\Setting\Providers;

use Modules\Setting\Entities\Setting;
use Modules\Setting\Support\Settings;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Modules\Setting\Blade\SettingDirective;
use Modules\Setting\Repositories\SettingRepository;
use Modules\Setting\Facades\Settings as SettingsFacade;
use Modules\Setting\Repositories\Cache\CacheSettingDecorator;
use Modules\Setting\Repositories\Eloquent\EloquentSettingRepository;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Setting';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'setting';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
        // adding global middleware
        $kernel = $this->app->make('Illuminate\Contracts\Http\Kernel');
        $kernel->pushMiddleware('Modules\Setting\Http\Middleware\GenerateMenus');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();

        $this->app->singleton('setting.settings', function ($app) {
            return new Settings($app[SettingRepository::class]);
        });

        $this->app->booting(function () {
            $loader = AliasLoader::getInstance();
            $loader->alias('Settings', SettingsFacade::class);
        });

        $this->app->bind('setting.setting.directive', function () {
            return new SettingDirective();
        });
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'),
            $this->moduleNameLower
        );
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

    private function registerBindings()
    {
        $this->app->bind(SettingRepository::class, function () {
            $repository = new EloquentSettingRepository(new Setting());

            if (!config('app.cache')) {
                return $repository;
            }

            return new CacheSettingDecorator($repository);
        });
        $this->app->bind(
            \Modules\Setting\Contracts\Setting::class,
            Settings::class
        );
    }

    private function registerBladeTags()
    {
        if (app()->environment() === 'testing') {
            return;
        }
        $this->app['blade.compiler']->directive('setting', function ($value) {
            return "<?php echo SettingDirective::show([$value]); ?>";
        });
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
}