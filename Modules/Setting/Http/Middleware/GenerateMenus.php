<?php
namespace Modules\Setting\Http\Middleware;

use Closure;

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
        /*
         *
         * Module Menu for Admin Backend
         *
         * *********************************************************************
         */
        \Menu::make('admin_sidebar', function ($menu) {
            // comments
            $menu->add('<i class="nav-icon fas fa-cogs"></i><p> Setting New</p>', [
                'route' => 'backend.setting.index',
                'class' => 'nav-item',
            ])
            ->data([
                'order' => 102,
                'activematches' => config('portal.core.core.admin-prefix', 'admin') . '/setting*',
                'permission' => ['view_comments'],
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);
        })->sortBy('order');

        return $next($request);
    }
}
