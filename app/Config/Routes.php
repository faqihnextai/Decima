<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'LandingPage::index');

// Switcher Bahasa via Controller (Aman untuk semua halaman)
$routes->get('lang/(:segment)', 'LanguageController::switchLocale/$1');

// Prefix landing page (fallback)
$routes->get('(id|en)', 'LandingPage::index/$1');

// Route Halaman Detail Statis Portofolio (SEO URL)
$routes->get('portofolio/(:segment)', 'PortfolioController::detail/$1');

//Route post email
$routes->post('contact/send', 'ContactController::send');

// Auth Admin
$routes->get('login', 'AuthController::login');
$routes->post('login/auth', 'AuthController::auth');
$routes->get('logout', 'AuthController::logout');


//detailsproduct
// Route Halaman Detail Statis Produk (SEO URL)
$routes->get('product/(:segment)', 'ProductController::detail/$1');

// Admin CRUD Portfolio
$routes->group('admin', function($routes) {
    $routes->get('portfolio', 'AdminPortfolioController::index');
    $routes->post('portfolio/save', 'AdminPortfolioController::save');
    $routes->post('portfolio/delete/(:num)', 'AdminPortfolioController::delete/$1');
});