<?php

namespace App\Http\Controllers;

use Auth;

class ChangeLanguageController extends Controller
{
    public function __invoke($locale)
    {
        if (!in_array($locale, config('app.available_locales'))) {
            return redirect()->back();
        }

        if (Auth::check()) {
            Auth::user()->update(['language' => $locale]);
        } else {
            session()->put('locale', $locale);
        }

        return redirect()->back();
    }
}
