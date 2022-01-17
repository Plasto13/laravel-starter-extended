<?php

namespace Modules\Core\Menu;

use Lavary\Menu\Menu as LavaryMenu;
use View;

class TopMenu extends LavaryMenu
{
    public function make($name, $callback, array $options = [])
    {
        if (is_callable($callback)) {
            if (! array_key_exists($name, $this->menu)) {
                $this->menu[$name] = new TopBuilder($name, $this->loadConf($name), $options);
            }

            // Registering the items
            call_user_func($callback, $this->menu[$name]);

            // Storing each menu instance in the collection
            $this->collection->put($name, $this->menu[$name]);

            // Make the instance available in all views
            View::share($name, $this->menu[$name]);

            return $this->menu[$name];
        }
    }
}
