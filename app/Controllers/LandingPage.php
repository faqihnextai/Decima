<?php

namespace App\Controllers;

class LandingPage extends BaseController
{
    public function index($locale = null): string
    {
        $supported = config('App')->supportedLocales;

        if ($locale && in_array($locale, $supported)) {
            session()->set('locale', $locale);
            $this->request->setLocale($locale);
        }

        return view('landing-page');
    }
}