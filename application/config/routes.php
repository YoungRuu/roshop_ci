<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller']                   = "home/home_index/index";
$route['404_override']                         = 'Admin_404';
$route['translate_uri_dashes']                 = FALSE;

$route['admin/Admin_products']                 = 'admin/Admin_products/index';
$route['admin/Admin_products/index']           = 'admin/Admin_products/index';
$route['admin/Admin_products/add']             = 'admin/Admin_products/add';
$route['admin/Admin_products/update/(:num)']   = 'admin/Admin_products/update/$1';

$route['admin/Admin_users']                    = 'admin/Admin_users/index';
$route['admin/Admin_users/index']              = 'admin/Admin_users/index';
$route['admin/Admin_users/add']                = 'admin/Admin_users/add';
$route['admin/Admin_users/update/(:num)']      = 'admin/Admin_users/update/$1';

$route['admin/Admin_orders']                   = 'admin/Admin_orders/index';
$route['admin/Admin_orders/index']             = 'admin/Admin_orders/index';
$route['admin/Admin_orders/add']        	   = 'admin/Admin_orders/add';
$route['admin/Admin_orders/add_orders']        = 'admin/Admin_orders/add_orders';

$route['admin/Admin_categories']               = 'admin/Admin_categories/index';
$route['admin/Admin_categories/index']         = 'admin/Admin_categories/index';
$route['admin/Admin_categories/add']           = 'admin/Admin_categories/add';
$route['admin/Admin_categories/update/(:num)'] = 'admin/Admin_categories/update/$1';

$route['(:any)/(:any)-(:any)']                 = 'home/Home_index/productdetail/$1/$2/$3';
$route['(:any)']                               = 'home/Home_index/categories/$1';
$route['dat-hang-thanh-cong']                  = 'home/Home_index/checkout_complete';
$route['thong-tin-gio-hang']                   = 'home/Home_index/info_cart_multi';
$route['gio-hang-trong']                       = 'home/Home_index/cart_clear';
$route['dang-nhap']                            = 'home/Home_index/login';
$route['dang-xuat']                            = 'home/Home_index/logout';
$route['tim-kiem-san-pham']              	   = 'home/Home_index/search';
$route['khach-hang/dang-nhap']                 = 'home/Home_index/customer_login';
$route['khach-hang/dang-ky']                   = 'home/Home_index/customer_register';
$route['khach-hang/tai-khoan']                 = 'home/Home_index/customer_account';
$route['khach-hang/don-dat-hang']              = 'home/Home_index/customer_order';
$route['khach-hang/cap-nhat-thong-tin-tai-khoan']= 'home/Home_index/customer_update_info';
$route['khach-hang/cap-nhat-mat-khau']          = 'home/Home_index/customer_update_pass';
$route['thong-tin/(:any)']          		   = 'home/Home_index/customer_staticpage/$1';

$route['admin/dang-xuat']                      = 'admin/Admin_login/logout';
