<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \Menu::make('admin_sidebar', function ($menu) {
            // Dashboard
            $menu->add('<i class="fas fa-tachometer-alt"></i><p> Dashboard</p>', [
                'route' => 'backend.dashboard',
                'class' => 'nav-item',
            ])
            ->data([
                'order' => 1,
                'activematches' => config('portal.core.core.admin-prefix', 'admin') . '/dashboard*',
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);

            // Notifications
            $menu->add('<i class="nav-icon fas fa-bell"></i><p> Notifications</p>', [
                'route' => 'backend.notifications.index',
                'class' => 'nav-item',
            ])
            ->data([
                'order' => 99,
                'activematches' => config('portal.core.core.admin-prefix', 'admin') . '/notifications*',
                'permission' => [],
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);

            // Separator: Access Management
            $menu->add('Management', [
                'class' => 'nav-header',
            ])
            ->data([
                'order' => 101,
                'permission' => ['edit_settings', 'view_backups', 'view_users', 'view_roles', 'view_logs'],
            ]);

            // Settings
            $menu->add('<i class="nav-icon fas fa-cogs"></i><p> Settings</p>', [
                'route' => 'backend.settings',
                'class' => 'nav-item',
            ])
            ->data([
                'order' => 102,
                'activematches' => config('portal.core.core.admin-prefix', 'admin') . '/settings*',
                'permission' => ['edit_settings'],
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);

            // Backup
            $menu->add('<i class="nav-icon fas fa-archive"></i><p> Backups</p>', [
                'route' => 'backend.backups.index',
                'class' => 'nav-item',
            ])
            ->data([
                'order' => 103,
                'activematches' => config('portal.core.core.admin-prefix', 'admin') . '/backups*',
                'permission' => ['view_backups'],
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);

            // Access Control Dropdown
            $accessControl = $menu->add('<i class="nav-icon fas fa-user-shield"></i><p> Access Control<i class="fas fa-angle-left right"></i></p>', [
                'class' => 'nav-item',
            ])
            ->data([
                'order' => 104,
                'activematches' => [
                    config('portal.core.core.admin-prefix', 'admin') . '/users*',
                    config('portal.core.core.admin-prefix', 'admin') . '/roles*',
                ],
                'permission' => ['view_users', 'view_roles'],
            ]);
            $accessControl->link->attr([
                'class' => 'nav-link',
                'href' => '#',
            ]);

            // Submenu: Users
            $accessControl->add('<i class="nav-icon fas fa-users"></i><p> Users</p>', [
                'route' => 'backend.users.index',
                'class' => 'nav-item',
            ])
            ->data([
                'order' => 105,
                'activematches' => config('portal.core.core.admin-prefix', 'admin') . '/users*',
                'permission' => ['view_users'],
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);

            // Submenu: Roles
            $accessControl->add('<i class="nav-icon fas fa-user-cog"></i><p> Roles</p>', [
                'route' => 'backend.roles.index',
                'class' => 'nav-item',
            ])
            ->data([
                'order' => 106,
                'activematches' => config('portal.core.core.admin-prefix', 'admin') . '/roles*',
                'permission' => ['view_roles'],
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);

            // Log Viewer
            // Log Viewer Dropdown
            $accessControl = $menu->add('<i class="nav-icon fas fas fa-stream"></i><p> Log Viewer<i class="fas fa-angle-left right"></i></p>', [
                'class' => 'nav-item',
            ])
            ->data([
                'order' => 107,
                'activematches' => [
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
                'activematches' => config('portal.core.core.admin-prefix', 'admin') . '/log-viewer',
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
                'activematches' => config('portal.core.core.admin-prefix', 'admin') . '/log-viewer/logs*',
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);

            // Access Permission Check
            $menu->filter(function ($item) {
                if ($item->data('permission')) {
                    if (auth()->check()) {
                        if (auth()->user()->hasRole('super admin')) {
                            return true;
                        } elseif (auth()->user()->hasAnyPermission($item->data('permission'))) {
                            return true;
                        }
                    }

                    return false;
                } else {
                    return true;
                }
            });

            // Set Active Menu
            $menu->filter(function ($item) {
                if ($item->activematches) {
                    $matches = is_array($item->activematches) ? $item->activematches : [$item->activematches];

                    foreach ($matches as $pattern) {
                        if (Str::is($pattern, \Request::path())) {
                            $item->activate();
                            $item->active();
                            if ($item->hasParent()) {
                                $item->parent()->activate();
                                $item->parent()->active();
                            }
                            // dd($pattern);
                        }
                    }
                }

                return true;
            });
        })->sortBy('order');

        return $next($request);
    }
}
