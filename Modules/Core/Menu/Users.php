<?php

namespace Sebastienheyd\Boilerplate\Menu;

use Sebastienheyd\Boilerplate\Menu\Builder as Builder;

class Users
{
    public function make(Builder $menu)
    {
        $item = $menu->add('core::layout.access', [
            'icon' => 'users',
            'order' => 1000,
        ]);

        $item->add('core::users.list.title', [
            'active' => 'boilerplate.users.index,boilerplate.users.edit',
            'permission' => 'users_crud',
            'route' => 'boilerplate.users.index',
        ]);

        $item->add('core::users.create.title', [
            'permission' => 'users_crud',
            'route' => 'boilerplate.users.create',
        ]);

        $item->add('core::layout.role_management', [
            'active' => 'boilerplate.roles.*',
            'permission' => 'roles_crud',
            'route' => 'boilerplate.roles.index',
        ]);

        $item->add('core::users.profile.title', [
            'route' => 'boilerplate.user.profile',
        ]);
    }
}
