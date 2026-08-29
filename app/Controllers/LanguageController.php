<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class LanguageController extends Controller
{
    public function switchLocale($locale = 'en')
    {
        $supported = config('App')->supportedLocales;
        
        if (in_array($locale, $supported)) {
            session()->set('locale', $locale);
        }
        
        return redirect()->back();
    }
}