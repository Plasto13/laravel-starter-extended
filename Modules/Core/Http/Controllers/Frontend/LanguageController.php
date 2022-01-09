<?php
namespace Modules\Core\Http\Controllers\Frontend;

use Alert;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class LanguageController extends Controller
{
    public function switch($language)
    {
        app()->setLocale($language);

        session()->put('locale', $language);

        setlocale(LC_TIME, $language);

        Carbon::setLocale($language);

        Alert::add('success', __('Language changed to') . ' ' . strtoupper($language))->flash();

        return redirect()->back();
    }
}
