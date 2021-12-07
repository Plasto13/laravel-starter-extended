<?php
namespace Modules\Core\Composers;

use Illuminate\Support\Arr;
use Illuminate\Contracts\View\View;

class LocalesComposer
{
    public function compose(View $view)
    {
        $allLocales = config('portal.core.available-locales');
        $locales = Arr::only($allLocales, json_decode(setting('core::locales')));
        $view->with('locales', $locales);
    }
}
