<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 _ 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
// ________________________________________________________________________
/**
 * CodeIgniter URL Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/url_helper.html
 */
// ________________________________________________________________________
/**
 * Site URL
 *
 * Create a local URL based on your basepath. Segments can be passed via the
 * first parameter either as a string or an array.
 *
 * @access	public
 * @param	string
 * @return	string
 */
	function delVietnamesesImg($value)
	{	
		$marTViet=array(
		" ","  "
		);
		
		$marKoDau=array(
		"_","_");
		return str_replace($marTViet,$marKoDau,$value);
	}
	
	function getAliasImg($value)
	{
		$value = delVietnamesesImg($value);
		$value = str_replace(array("  ","__"," ",),"_",$value);
		return $value;
	}
	
	function delVietnameses($value)
	{	
		$marTViet=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",
		"ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề"
		,"ế","ệ","ể","ễ",
		"ì","í","ị","ỉ","ĩ",
		"ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ"
		,"ờ","ớ","ợ","ở","ỡ",
		"ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
		"ỳ","ý","ỵ","ỷ","ỹ",
		"đ",
		"À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă"
		,"Ằ","Ắ","Ặ","Ẳ","Ẵ",
		"È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
		"Ì","Í","Ị","Ỉ","Ĩ",
		"Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ"
		,"Ờ","Ớ","Ợ","Ở","Ỡ",
		"Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
		"Ỳ","Ý","Ỵ","Ỷ","Ỹ",
		"Đ",
		"A","B","C","D","E","F","G","H","I","J","K","L"
		,"M","N","O","P","Q",
		"R","S","T","U","V","W","X","Y","Z",
		"'",",","~","@","#","$","%","^","&","*",";","/","\\","|","`","!","(",")",">","<","=",
		"+","{","}","[","]","?",
		"--",
		"---",
		"----",
		'"'
		);
		
		$marKoDau=array("a","a","a","a","a","a","a","a","a","a","a"
		,"a","a","a","a","a","a",
		"e","e","e","e","e","e","e","e","e","e","e",
		"i","i","i","i","i",
		"o","o","o","o","o","o","o","o","o","o","o","o"
		,"o","o","o","o","o",
		"u","u","u","u","u","u","u","u","u","u","u",
		"y","y","y","y","y",
		"d",
		"A","A","A","A","A","A","A","A","A","A","A","A"
		,"A","A","A","A","A",
		"E","E","E","E","E","E","E","E","E","E","E",
		"I","I","I","I","I",
		"O","O","O","O","O","O","O","O","O","O","O","O"
		,"O","O","O","O","O",
		"U","U","U","U","U","U","U","U","U","U","U",
		"Y","Y","Y","Y","Y",
		"D",
		"a","b","c","d","e","f","g","h","i","j","k","l"
		,"m","n","o","p","q",
		"r","s","t","u","v","w","x","y","z",
		"-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-",
		"-","-","-","-","-","-",
		"-","-","-","-");
		return str_replace($marTViet,$marKoDau,$value);
	}
	
	function getAlias($value)
	{
		for($i=1; $i<=5;$i++)
		{
			$value = delVietnameses($value);
			$value = str_replace(array("–","  ","--","---","----"," ","__","_",'"','“','”','`','``','‘','’'),"-",$value);
		}
		return $value;
	}