<?php
namespace Modules\Tag\Menu;

use Modules\Core\Menu\Builder;

class TagMenu
{
    /**
     * @param Builder $builder
     *
     */
    public function make(Builder $menu)
    {
        $menu->add(__('Tag'), [
            'icon' => 'fa-tags',
            'route' => 'backend.tags.index',
            'permission' => 'view_tags',
        ])
        ->id('tag_menu')
        ->activeIfRoute(
            'backend.tags.*',
        )
        ->order(84);

        //append

        // -append
    }
}
