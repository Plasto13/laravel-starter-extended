<?php

namespace Modules\Tag\Http\Middleware;

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

            // Tags
            $menu->add('<i class="fas fa-tags nav-icon"></i><p> Tags</p>', [
                'route' => 'backend.tags.index',
                'class' => 'nav-item',
            ])
            ->data([
                'order'         => 84,
                'activematches' => config('modules.core.core.admin-prefix').'/tags*',
                'permission'    => ['view_tags'],
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);
        })->sortBy('order');

        return $next($request);
    }
}
