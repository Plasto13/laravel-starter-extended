<?php
namespace Modules\Comment\Menu;

use Modules\Core\Menu\Builder;

class CommentMenu
{
    /**
     * @param Builder $builder
     *
     */
    public function make(Builder $menu)
    {
        $menu->add(__('Comment'), [
            'icon' => 'fa-file-alt',
            'permission' => 'edit_posts',
            'route' => 'backend.comments.index',
        ])
        ->id('comment_menu')
        ->activeIfRoute(
            'backend.comments.*'
        )
        ->order(81);

        //append

        // -append
    }
}
