<?php

namespace Modules\Core\Composers;

use Illuminate\View\View;
use Modules\Core\Menu\TopBuilder;
use Modules\Core\Menu\TopMenu;

class TopMenuComposer
{
    /**
     * Called when view layout/mainsidebar.blade.php is called.
     * This is defined in BoilerPlateServiceProvider.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $topMenu = new TopMenu();
        $topMenu = $topMenu->make('TopMenu', function (TopBuilder $menu) {
            $menu->add('Home', ['route' => 'dashboard'])
                ->activeIfRoute('dashboard')
                ->id('dashboard')
                ->order(0);
            $providers = $this->getProviders();

            foreach ($providers as $provider) {
                $class = new $provider();
                $class->make($menu);
            }
        });

        $view->with('topMenu', $topMenu->sortBy('order')->asUl([
            'class'          => 'navbar-nav',
            'role'           => 'menu',
        ], ['class' => 'nav nav-treeview']));
    }

    /**
     * Get menu items providers.
     *
     * @return array
     */
    private function getProviders()
    {
        $providers = app('core.top.menu.items')->getMenuItems();

        if (is_dir(app_path('Menu'))) {
            $classes = glob(app_path('Menu').'/*.php');

            if (! empty($classes)) {
                foreach ($classes as $class) {
                    $providers[] = '\\App\\Menu\\'.preg_replace('#\.php$#i', '', basename($class));
                }
            }
        }

        return $providers;
    }
}
