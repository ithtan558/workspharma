<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/


/*end transfer from link old to link new*/
#################404
$route['404.html'] = "application/error_404";
$route['get-forgot.html'] = "user/check_forgot";
$route['forgot.html'] = "user/forgot";


$route['info.html'] = "user/info";
$route['check-info'] = "user/check_info";
$route['history-order.html'] = "user/history_order";
$route['history-order/detail-order/(:num).html'] = "user/detail_order/$1";
$route['change-pass.html'] = "user/change_pass";
$route['check-pass'] = "user/check_pass";
$route['change-avatar.html'] = "user/change_avatar";
$route['check-avatar'] = "user/check_avatar";
/*recived email*/
$route['delete-item/(:num)'] = "cart/check_delete/$1";
$route['shopcart.html'] = "cart";
$route['payment.html'] = "cart/payment";
$route['check_payment.html'] = "cart/check_payment";
$route['order/(:num).html'] = "cart/order/$1";
$route['thoat.html'] = "user/check_logout";
$route['login.html'] = "user/login";
$route['check-login.html'] = "user/check_login";
$route['check-register.html'] = "user/check_register";
$route['kiem-tra-email-truoc.html'] = "user/check_email";
$route['register.html'] = "user/register";
$route['cart/check_add'] = "cart/check_add";
$route['typical-products'] = "product/typicalProducts";
$route['comment'] = "contact/testimonials";
$route['gop-y'] = "contact/testimonials";
$route['languages/index'] = "languages/index";
$route['languages/index/(:any)'] = "languages/index/$1";
$route['email'] = "email/index";
/********* end thiết lập cho nguoi dung ********************/
/********* end thiết lập cart ********************/
/*cau hinh trong admin*/
$route['ak-administrator'] = "administrator/index";
$route['ak-administrator/remember'] = "administrator/remember";
$route['ak-administrator/check_admin_remember'] = "administrator/check_admin_remember";
$route['ak-administrator/check_admin_login'] = "administrator/check_admin_login";
$route['admin/thoat'] = "admin/thoat";
$route['admin/(:any)'] = "admin/$1";
/*end cai hinh trong admin*/
/*cấu hình router để rewrite*/
$route['product/download-file/(:any)/(:any)'] = "product/download_file_home/$1/$2";
$route['search/index'] = "search/index";
/*contact*/
$route['(?i)contact'] = "contact/index";
$route['(?i)contact/check_sentmail'] = "contact/check_sentmail";
$route['(?i)lien-he'] = "contact/index";
/** product */
$route['tim-kiem?(:any)'] = "product/search";
$route['products/autocomplete'] = "product/autocomplete";
$route['(?i)main/hover_menuchild/(:num)'] = "main/hover_menuchild/$1";
$route['(?i)dich-vu'] = "product/index";
$route['(?i)products'] = "product/index";
$route['(?i)dich-vu/filter/search/(:any)'] = "product/index/$1";
$route['(?i)dich-vu/(:any)/(:num)/(:num)/(:any)'] = "product/subProducts/$1/$2/$3/$4";
$route['(?i)products/(:any)/(:num)/(:num)/(:any)'] = "product/subProducts/$1/$2/$3/$4";
$route['dich-vu/(:any)/(:any)-(:num)'] = "product/products/$1/$2/$3";
$route['(?i)products/(:any)/(:any)'] = "product/products/$1/$2";

$route['(?i)dich-vu/(:any)'] = "product/productsCategories/$1/$2";
$route['(?i)products/(:any)'] = "product/productsCategories/$1/$2";
/*$route['(?i)dich-vu/(:any)'] = "product/products/$1";
$route['(?i)products/(:any)'] = "product/products/$1";*/
$route['(:num)/(:any)'] = "product/productsCategories/$1/$2";
$route['product/export-file/(:num)'] = "product/export_file/$1";
$route['main/change_languages'] = "main/change_languages";

$route['sitemap\.xml'] = "sitemap";
$route['default_controller'] = "main";
$route['404_override'] = '';
/*footer*/
$route['so-do-web'] = "sitemap";
$route['dieu-khoan-su-dung'] = "sitemap";
/*articles*/

$route['(?i)training/check_register/(:any)'] = "training/check_register/$1";
$route['(?i)dao-tao/(:any)/register'] = "training/register/$1";
$route['(?i)dao-tao/(:any)'] = "training/getTrainingCourses/$1";
$route['(?i)dao-tao'] = "training";
$route['(?i)kien-thuc'] = "article/articlesCategoriesKienThuc";
$route['(?i)kien-thuc/(:any)/(:any)'] = "article/detailKienThuc/$1/$2";
$route['(?i)kien-thuc/(:any)'] = "article/articlesCategories/$1";
$route['(?i)articles/articlesCategories/(:num)'] = "article/articlesCategories/$1/$2";
$route['(?i)articles/articlesCategories'] = "article/articlesCategories";
$route['(?i)(:any)/(:any)'] = "article/index/$1/$2";
$route['(?i)(:any)'] = "article/articlesCategories/$1";

/* End of file routes.php */
/* Location: ./application/config/routes.php */