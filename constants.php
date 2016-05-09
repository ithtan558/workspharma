<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/


define('EMAIL_SEND_MAIL', 'donoreply@gmail.com');
define('SENDGRIP', '0');
define('MKDIR_HOST', '0');
define('PREFIX', 'pt_');
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);
//define('languages','en');
//define('URL','http://'.$_SERVER['HTTP_HOST'].'/nspv3/');
define('URL','http://'.$_SERVER['HTTP_HOST'].'/');
define('IMAGES',URL.'public/images/');
define('CSS',URL.'public/css/');
define('JS',URL.'public/js/');
/* admin */
define('PUBLIC_ADMIN',URL.'public/');
define('CSS_ADMIN',URL.'public/css/admin/');
define('JS_ADMIN',URL.'public/js/admin/');
define('IMAGES_ADMIN',URL.'public/images/admin/');
define('DATETIME_FORMAT_DB','Y-m-d H:i:s');
/* end admin */
/*

|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');
/* End of file constants.php */
/* Location: ./application/config/constants.php */