<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Default Routes
$route['default_controller']     = 'frontpage';
$route['404_override']           = '';
$route['translate_uri_dashes']   = FALSE;

// Custom Routes
$route['shop']                   = 'frontpage/shop';
$route['sale']                   = 'frontpage/sale';
$route['features']               = 'frontpage/features';
$route['about']                  = 'frontpage/about';
$route['contact']                = 'frontpage/contact';
$route['profile']                = 'frontpage/profile';
$route['transactions']           = 'frontpage/transactions';
$route['cart']                   = 'frontpage/my_cart';
$route['checkout']               = 'frontpage/checkout';
$route['shipping']               = 'frontpage/shipping';
$route['payment']                = 'frontpage/payment';
$route['product_detail/(:num)']  = 'frontpage/product_detail/$1';
$route['search']                 = 'frontpage/search';
$route['view_customer/(:num)']   = 'admin/view_customer/$1';
$route['view_order/(:num)']      = 'admin/view_order/$1';
$route['logout']                 = 'auth/logout';