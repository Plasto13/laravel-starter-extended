<?php

namespace Modules\Core\Menu;

class MenuItemsRepository
{
    /**
     * Register menu items to display in the main menu.
     *
     * @param string|array $menuitem
     *
     * @return $this
     */
    public function registerMenuItem($menuitem)
    {
        $items = config('core.menu.providers', []);

        if (is_array($menuitem)) {
            $items = array_merge($items, $menuitem);
        } elseif (is_string($menuitem)) {
            $items[] = $menuitem;
        }

        config(['core.menu.providers' => array_unique($items)]);
        return $this;
    }

    /**
     * Unregister the given menu item.
     *
     * @param string $menuitem
     *
     * return $this;
     */
    public function unregisterMenuItem($menuitem)
    {
        $items = config('core.menu.providers', []);
        unset($items[array_search($menuitem, $items)]);
        config(['core.menu.providers' => $items]);

        return $this;
    }

    /**
     * Get menu items classes.
     *
     * @return array
     */
    public function getMenuItems()
    {
        return array_unique(config('core.menu.providers', []));
    }
}
