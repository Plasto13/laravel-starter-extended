<?php
namespace Modules\Core\Menu;

use Auth;
use Illuminate\Support\Collection;
use Lavary\Menu\Builder as LavaryMenuBuilder;

/**
 * Class Builder.
 *
 * @property Collection $items;
 */
class Builder extends LavaryMenuBuilder
{
    private $root = [];

    /**
     * Adds an item to the menu.
     *
     * @param string $title
     * @param array $options
     *
     * @return Item
     */
    public function add($title, $options = [])
    {
        if (isset($options['class']) && $options['class'] == 'nav-header') {
            $title = __($title);
        } else {
            $title = sprintf('<p>%s</p>', /** @scrutinizer ignore-type */ __($title));
        }
        // $title = sprintf('<p>%s</p>', /** @scrutinizer ignore-type */ __($title));
        $id = isset($options['id']) ? $options['id'] : $this->id();

        $item = new Item($this, $id, $title, $options);
        if (!empty($options['class'])) {
            $item->addLinkClass($options['class']);
        } else {
            $item->addLinkClass('nav-link');
        }
        // $item->addLinkClass('nav-link');

        if (!empty($options['active'])) {
            $item->activeIfRoute($options['active']);
        } elseif (!empty($options['route'])) {
            $item->activeIfRoute($options['route']);
        }

        if ($item->hasParent()) {
            $item->icon($item->isActive ? 'dot-circle ' : 'circle', 'far');
        } elseif (!empty($options['icon'])) {
            $item->icon($options['icon']);
        } else {
            // $item->icon('cube');
        }

        if (!empty($options['order'])) {
            $item->order($options['order']);
        }

        if (isset($options['role']) || isset($options['permission'])) {
            $ability = ['super admin'];
            if (isset($options['role'])) {
                $ability = $ability + explode(',', $options['role']);
            }

            $permission = [];
            if (isset($options['permission'])) {
                $permission = explode(',', $options['permission']);
            }

            if (Auth::user()->hasRole($ability) or Auth::user()->hasAnyPermission($permission)) {
                $this->items->push($item);
            }
        } else {
            $this->items->push($item);
        }

        return $item;
    }

    /**
     * Add an item to a existing menu item as a submenu item.
     *
     * @param string $id Id of the menu item to attach to
     * @param string $title Title of the sub item
     * @param array $options
     *
     * @return Item
     */
    public function addTo($id, $title, $options = [])
    {
        $parent = $this->whereId($id)->first();

        if (isset($parent)) {
            if (!isset($this->root[$parent->id])) {
                $parent->attr(['url' => '#', 'class' => 'nav-item has-treeview']);
                $parent->append('<i class="fa fa-angle-left right"></i>');
                $this->root[$parent->id] = true;
            }

            $item = $parent->add($title, $options);
        } else {
            $item = $this->add($title, $options);
        }

        return $item;
    }
}
