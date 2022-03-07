<?php
namespace Modules\Article\Menu;

use Modules\Core\Menu\Builder;

class ArticleMenu
{
    /**
     * @param Builder $builder
     *
     */
    public function make(Builder $menu)
    {
        $menu->add(__('Article'), [
            'icon' => 'fa-file-alt',
            'permission' => 'edit_posts',
            'url' => '#',
        ])
        ->id('article_menu')
        ->activeIfRoute(
            'backend.posts.*',
            'backend.categories.*'
        )
        ->order(81);

        $menu->addTo('article_menu', __('Posts'), [
            'route' => 'backend.posts.index',
            'permission' => 'edit_posts',
        ])
        ->activeIfRoute('backend.posts.*')
        ->order(82);

        $menu->addTo('article_menu', __('Categories'), [
            'route' => 'backend.categories.index',
            'permission' => 'edit_categories',
        ])
        ->activeIfRoute('backend.categories.*')
        ->order(83);

        //append

        // -append
    }
}
