<?php
 /* ****************************************************************** */
if (!defined('BASEPATH')) exit('No direct script access allowed'); //No Direct Access

/*
|--------------------------------------------------------------------------
| Variables needed for pagination -- affects the whole site
|--------------------------------------------------------------------------
|
*/
$config['per_page'] 		= 10;
$config['uri_segment'] 		= 3;
$config['num_links'] 		= 5;
$config['full_tag_open'] 	= ' <ul class="pagination">';
$config['full_tag_close'] 	= '</ul>';

$config['cur_tag_open'] 	= "<li class='disabled'><li class='active'><a href='#'>";
$config['cur_tag_close'] 	= '</a></li>';

$config['num_tag_open']		= '<li>';
$config['num_tag_close'] 	= '</li>';

$config['first_tag_open'] 	= '<li>';
$config['first_tag_close'] 	= '</li>';
$config['first_link'] 	  	= '&lt;&lt;';
$config['prev_link']	 	= '&lt;';
$config['last_tag_open'] 	= '<li>';
$config['last_tag_close'] 	= '</li>';
$config['last_link'] 		= '&gt;&gt;';
$config['next_link'] 		= '&gt;';
$config['next_tag_open'] 	= '<li>';
$config['next_tag_close'] 	= '</li>';
$config['prev_tag_open'] 	= '<li>';
$config['prev_tag_close'] 	= '</li>';
?>