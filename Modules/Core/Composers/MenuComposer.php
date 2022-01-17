<?php
namespace Modules\Core\Composers;

use Illuminate\View\View;
use Modules\Core\Menu\Builder;
use Modules\Core\Menu\Menu;

class MenuComposer
{
    /**
     * Called when view layout/mainsidebar.blade.php is called.
     * This is defined in BoilerPlateServiceProvider.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $menu = new Menu();
        $menu = $menu->make('SidebarMenu', function (Builder $menu) {
            $menu->add('Home', ['route' => 'backend.dashboard', 'icon' => 'home'])
                ->activeIfRoute('home')
                ->id('home')
                ->order(0);

            // Separator: Access Management
            $menu->add('Management', [
                'permission' => 'edit_settings', 'view_backups', 'view_users', 'view_roles', 'view_logs',
                'class' => 'nav-header'
            ])->order(100);

            // Backup
            $menu->add('Backups', [
                'route' => 'backend.backups.index',
                'icon' => 'fas fa-archive',
                'permission' => 'view_backups',
            ])->activeIfRoute(config('portal.core.core.admin-prefix', 'admin') . '/backups*')
                ->id('backups')
                ->order(103);

            // Access Control Dropdown
            $accessControl = $menu->add('Access Control', [
                'icon' => 'fas fa-users',
            ])
            ->activeIfRoute([
                config('portal.core.core.admin-prefix', 'admin') . '/users*',
                config('portal.core.core.admin-prefix', 'admin') . '/roles*',
            ])
            ->id('acl')
            ->order(104);

            // Submenu: Users
            $accessControl->add('Users', [
                'route' => 'backend.users.index',
                'icon' => 'fas fa-users',
                'permission' => 'view_users',
            ])
            ->activeIfRoute(config('portal.core.core.admin-prefix', 'admin') . '/users*')
            ->id('acl-users')
            ->order(105);

            // Submenu: Roles
            $accessControl->add('Roles', [
                'route' => 'backend.roles.index',
                'icon' => 'fas fa-user-cog',
                'permission' => 'view_roles',
            ])
            ->activeIfRoute(config('portal.core.core.admin-prefix', 'admin') . '/roles*')
            ->order(106)
            ->id('act-roles');

            // Log Viewer
            // Log Viewer Dropdown
            $accessControl = $menu->add('<i class="nav-icon fas fas fa-stream"></i><p> Log Viewer<i class="fas fa-angle-left right"></i></p>', [
                'class' => 'nav-item',
            ])
            ->data([
                'order' => 107,
                'active' => [
                    'log-viewer*',
                ],
                'permission' => ['view_logs'],
            ]);
            $accessControl->link->attr([
                'class' => 'nav-link',
                'href' => '#',
            ]);

            // Submenu: Log Viewer Dashboard
            $accessControl->add('<i class="nav-icon fas fa-list-alt"></i> Dashboard', [
                'route' => 'log-viewer::dashboard',
                'class' => 'nav-item',
            ])
            ->data([
                'order' => 108,
                'active' => config('portal.core.core.admin-prefix', 'admin') . '/log-viewer',
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);

            // Submenu: Log Viewer Logs by Days
            $accessControl->add('<i class="nav-icon fas fa-list"></i><p> Logs by Days</p>', [
                'route' => 'log-viewer::logs.list',
                'class' => 'nav-item',
            ])
            ->data([
                'order' => 109,
                'active' => config('portal.core.core.admin-prefix', 'admin') . '/log-viewer/logs*',
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);

            $providers = $this->getProviders();

            foreach ($providers as $provider) {
                $class = new $provider();
                $class->make($menu);
            }
        });

        $compact = config('core.theme.sidebar.compact') === true ? ' nav-compact' : '';

        $view->with('menu', $menu->sortBy('order')->asUl([
            'class' => 'nav nav-pills nav-sidebar flex-column nav-child-indent' . $compact,
            'data-widget' => 'treeview',
            'data-accordion' => 'false',
            'role' => 'menu',
        ], ['class' => 'nav nav-treeview']));
    }

    /**
     * Get menu items providers.
     *
     * @return array
     */
    private function getProviders()
    {
        $providers = app('core.menu.items')->getMenuItems();

        if (is_dir(app_path('Menu'))) {
            $classes = glob(app_path('Menu') . '/*.php');

            if (!empty($classes)) {
                foreach ($classes as $class) {
                    $providers[] = '\\App\\Menu\\' . preg_replace('#\.php$#i', '', basename($class));
                }
            }
        }

        return $providers;
    }
}
