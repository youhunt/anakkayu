<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->setAutoRoute(false);

service('auth')->routes($routes);

$routes->get('/', 'PublicSite\HomeController::index');
$routes->get('tentang-kami', 'PublicSite\PageController::about');
$routes->get('kontak', 'PublicSite\ContactController::index');
$routes->post('kontak', 'PublicSite\ContactController::submit');
$routes->get('inquiry', 'PublicSite\ContactController::inquiry');
$routes->post('inquiry', 'PublicSite\ContactController::submit');
$routes->get('artikel', 'PublicSite\ContentController::index');
$routes->get('artikel/(:segment)', 'PublicSite\ContentController::show/$1');
$routes->get('produk', 'PublicSite\ProductController::index');
$routes->get('produk/(:segment)', 'PublicSite\ProductController::show/$1');
$routes->get('layanan', 'PublicSite\ServiceController::index');
$routes->get('layanan/(:segment)', 'PublicSite\ServiceController::show/$1');
$routes->get('portfolio', 'PublicSite\PortfolioController::index');
$routes->get('portfolio/(:segment)', 'PublicSite\PortfolioController::show/$1');
$routes->get('kategori/(:segment)', 'PublicSite\TaxonomyController::category/$1');
$routes->get('tag/(:segment)', 'PublicSite\TaxonomyController::tag/$1');
$routes->get('search', 'PublicSite\SearchController::index');
$routes->get('sitemap.xml', 'PublicSite\SeoController::sitemap');
$routes->get('robots.txt', 'PublicSite\SeoController::robots');
$routes->post('share/log', 'PublicSite\ShareController::log');

$routes->group('admin', ['filter' => 'session'], static function (RouteCollection $routes): void {
    $routes->get('/', 'Admin\DashboardController::index');
    $routes->get('dashboard', 'Admin\DashboardController::index');
    $routes->match(['get', 'post'], 'contents/new', 'Admin\CrudController::new/content');
    $routes->match(['get', 'post'], 'contents/(:num)/edit', 'Admin\CrudController::edit/content/$1');
    $routes->post('contents/(:num)/delete', 'Admin\CrudController::delete/content/$1');
    $routes->get('contents', 'Admin\CrudController::index/content');
    $routes->match(['get', 'post'], 'pages/new', 'Admin\CrudController::new/page');
    $routes->match(['get', 'post'], 'pages/(:num)/edit', 'Admin\CrudController::edit/page/$1');
    $routes->post('pages/(:num)/delete', 'Admin\CrudController::delete/page/$1');
    $routes->get('pages', 'Admin\CrudController::index/page');
    $routes->match(['get', 'post'], 'products/new', 'Admin\CrudController::new/product');
    $routes->match(['get', 'post'], 'products/(:num)/edit', 'Admin\CrudController::edit/product/$1');
    $routes->post('products/(:num)/delete', 'Admin\CrudController::delete/product/$1');
    $routes->get('products', 'Admin\CrudController::index/product');
    $routes->match(['get', 'post'], 'services/new', 'Admin\CrudController::new/service');
    $routes->match(['get', 'post'], 'services/(:num)/edit', 'Admin\CrudController::edit/service/$1');
    $routes->post('services/(:num)/delete', 'Admin\CrudController::delete/service/$1');
    $routes->get('services', 'Admin\CrudController::index/service');
    $routes->match(['get', 'post'], 'portfolio/new', 'Admin\CrudController::new/portfolio');
    $routes->match(['get', 'post'], 'portfolio/(:num)/edit', 'Admin\CrudController::edit/portfolio/$1');
    $routes->post('portfolio/(:num)/delete', 'Admin\CrudController::delete/portfolio/$1');
    $routes->get('portfolio', 'Admin\CrudController::index/portfolio');
    $routes->match(['get', 'post'], 'categories/new', 'Admin\CrudController::new/category');
    $routes->match(['get', 'post'], 'categories/(:num)/edit', 'Admin\CrudController::edit/category/$1');
    $routes->post('categories/(:num)/delete', 'Admin\CrudController::delete/category/$1');
    $routes->get('categories', 'Admin\CrudController::index/category');
    $routes->match(['get', 'post'], 'tags/new', 'Admin\CrudController::new/tag');
    $routes->match(['get', 'post'], 'tags/(:num)/edit', 'Admin\CrudController::edit/tag/$1');
    $routes->post('tags/(:num)/delete', 'Admin\CrudController::delete/tag/$1');
    $routes->get('tags', 'Admin\CrudController::index/tag');
    $routes->match(['get', 'post'], 'settings', 'Admin\SettingsController::index');
    $routes->get('inquiries', 'Admin\InquiryController::index');
    $routes->post('inquiries/(:num)', 'Admin\InquiryController::update/$1');
    $routes->get('social-content', 'Admin\SocialContentController::index');
    $routes->match(['get', 'post'], 'social-content/import', 'Admin\SocialContentController::import');
    $routes->post('social-content/(:num)/draft', 'Admin\SocialContentController::draft/$1');
});
