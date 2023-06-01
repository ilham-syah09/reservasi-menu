<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern: 
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details: 
|
| https: //codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes: 
|
| $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
| $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
| $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples: my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller']   = 'frontend';
$route['404_override']         = '';
$route['translate_uri_dashes'] = FALSE;

// admin
$route['admin'] = 'admin/home';

// user
$route['user'] = 'user/home';

// frontend
$route['home'] = 'frontend';

$route['shop']                      = 'frontend/shop';
$route['shop/(:any)']               = 'frontend/shop/$1';
$route['shop/(:any)/(:any)']        = 'frontend/shop/$1/$2';
$route['shop/(:any)/(:any)/(:any)'] = 'frontend/shop/$1/$2/$3';

$route['detail/(:any)'] = 'frontend/detail/$1';
$route['contact']       = 'frontend/contact';
$route['cart']          = 'frontend/cart';
$route['checkout']      = 'frontend/checkout';
$route['profile']       = 'frontend/profile';

$route['addToCart']      = 'frontend/addToCart';
$route['deleteCart']     = 'frontend/deleteCart';
$route['updateQuantity'] = 'frontend/updateQuantity';
$route['placeOrder']     = 'frontend/placeOrder';
$route['orders']         = 'frontend/orders';
$route['getListProduct'] = 'frontend/getListProduct';

$route['print/(:any)']   = 'frontend/print/$1';
$route['uploadBerkas']   = 'frontend/uploadBerkas';
$route['getListProgres'] = 'frontend/getListProgres';
$route['message']        = 'frontend/message';
$route['review']         = 'frontend/review';
$route['changeProfile']  = 'frontend/changeProfile';
$route['changePassword']  = 'frontend/changePassword';
