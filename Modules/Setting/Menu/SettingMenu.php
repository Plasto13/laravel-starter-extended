<?php
namespace Modules\Setting\Menu;

use Illuminate\Support\Facades\DB;
use Modules\Core\Menu\Builder;

class SettingMenu
{
    /**
     * @param Builder $builder
     *
     */
    public function make(Builder $menu)
    {
        $menu->add('Settings', [
            'route' => 'backend.setting.index',
            'icon' => 'fa-cogs',
            'permission' => 'view_settings',
        ])->activeIfRoute(config('portal.core.core.admin-prefix', 'admin') . '/setting*')
                ->id('settings')
                ->order(135);
        // $permissions = DB::table('permissions')->where('category_id', '=', @DB::table('permissions_categories')->select(['id', 'name'])->where('name', 'Structure')->first()->id)->pluck('name')->toArray();
        // $permissions = implode(',', $permissions);

        //append

        // -append
    }
}
