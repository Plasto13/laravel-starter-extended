<?php

namespace App\Http\Controllers;

use Alert;
use Carbon\Carbon;

class LanguageController extends Controller
{
    public function switch($language)
    {
        app()->setLocale($language);

        session()->put('locale', $language);

        setlocale(LC_TIME, $language);

        Carbon::setLocale($language);

        Alert::add('success', __('Language changed to').' '.strtoupper($language))->flash();

        return redirect()->back();
    }
}
