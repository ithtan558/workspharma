<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------
/**
 * Admin URL
 *
 * Create a admin URL based on the admin folder path mentioned in config file. Segments can be passed via the
 * first parameter either as a string or an array.
 *
 * @access	public
 * @param	string
 * @return	string
 <Reverse bidding system> 
    Copyright (C) <2009>  <Cogzidel Technologies>
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>
    If you want more information, please email me at bala.k@cogzidel.com or 
    contact us from http://www.cogzidel.com/contact 
 */
if ( ! function_exists('admin_url'))
{
	function admin_url($uri = '')
	{
		$CI =& get_instance();
		return $CI->config->site_url($uri.'ak-administrator');
	}
}
// ------------------------------------------------------------------------
/**
 * Images URL
 *
 * Create a admin URL based on the admin folder path mentioned in config file. Segments can be passed via the
 * first parameter either as a string or an array.
 *
 * @access	public
 * @param	string
 * @return	string
 */
if ( ! function_exists('image_url'))
{
	function image_url($image_name = '')
	{
		$CI =& get_instance();
		$uri = str_replace($CI->config->item('index_page'),"",$CI->config->site_url()).'public/images/'.$image_name;
		//echo $uri;exit;
		return $uri;
	}
}
if ( ! function_exists('file_url'))
{
    function file_url($path)
    {
        $CI =& get_instance();
        $uri = str_replace($CI->config->item('index_page'),"",$CI->config->site_url()).$path;
        //echo $uri;exit;
        return $uri;
    }
}
// ------------------------------------------------------------------------
/**
* Images URL
*
* Create a admin URL based on the admin folder path mentioned in config file. Segments can be passed via the
* first parameter either as a string or an array.
*
* @access	public
* @param	string
* @return	string
*/
if ( ! function_exists('portfolio_image_url'))
{
	function portfolio_image_url($image_name = '')
	{
		$CI =& get_instance();
		$uri = str_replace($CI->config->item('index_page'),"",$CI->config->site_url()).'files/portfolios/'.$image_name;
		//echo $uri;exit;
		return $uri;
	}
}
if ( ! function_exists('partner_portfolio_image_url'))
{
	function partner_image_url($image_name = '')
	{
		$CI =& get_instance();
		$uri = str_replace($CI->config->item('index_page'),"",$CI->config->site_url()).'files/partners/'.$image_name;
		//echo $uri;exit;
		return $uri;
	}
}
// ------------------------------------------------------------------------
/**
 * Portfolio Images URL
 *
 * Create a admin URL based on the admin folder path mentioned in config file. Segments can be passed via the
 * first parameter either as a string or an array.
 *
 * @access	public
 * @param	string
 * @return	string
 */
if ( ! function_exists('pimage_url'))
{
	function pimage_url($image_name = '')
	{
		$CI =& get_instance();
		$uri = str_replace($CI->config->item('index_page'),"",$CI->config->site_url()).'files/portfolios/'.$image_name;
		return $uri;
	}
}
// ------------------------------------------------------------------------
/**
 * User Images URL
 *
 * Create a admin URL based on the admin folder path mentioned in config file. Segments can be passed via the
 * first parameter either as a string or an array.
 *
 * @access	public
 * @param	string
 * @return	string
 */
if ( ! function_exists('uimage_url'))
{
	function uimage_url($image_name = '')
	{
		$CI =& get_instance();
		$uri = str_replace($CI->config->item('index_page'),"",$CI->config->site_url()).'public/images/logo/'.$image_name;
		return $uri;
	}
}
if ( ! function_exists('file_url'))
{
	function file_url($file_url = '')
	{
		$CI =& get_instance();
		$uri = str_replace($CI->config->item('index_page'),"",$CI->config->site_url()).'/'.$image_name;
		return $uri;
	}
}
if ( ! function_exists('thumb_uimage_url'))
{
    function thumb_uimage_url($image_name = '')
    {
        $CI =& get_instance();
        $uri = str_replace($CI->config->item('index_page'),"",$CI->config->site_url()).'public/images/logo/'.$image_name;
        return $uri;
    }
}
if ( ! function_exists('prfile_url'))
{
	function prfile_url($image_name = '')
	{
		$CI =& get_instance();
		$uri = str_replace($CI->config->item('index_page'),"",$CI->config->site_url()).'files/project_attachment/'.$image_name;
		return $uri;
	}
}
if ( ! function_exists('build_url')) {
	function build_url($params = array()){
		$link = '';
		foreach ($params as $key => $val) {
			if($val != ''){
				if ($link == '') {
					$link .= $key . '/' . $val;
				} else {
					$link .= '/' . $key . '/' . $val;
				}
			}
		}
		return $link;
	}
}
if ( ! function_exists('my_uri_to_assoc')) {
	function my_uri_to_assoc($n=1){
		$CI =& get_instance();
		$strUri = $CI->uri->uri_string();
		$uri_arr = explode('/', $strUri);
		$segments = array_slice($uri_arr, $n + 1);
		$i = 0;
		$lastval = '';
		$retval  = array();
		foreach ($segments as $seg)
		{
			if ($i % 2)
			{
				$retval[$lastval] = $seg;
			}
			else
			{
				$retval[$seg] = FALSE;
				$lastval = $seg;
			}
			$i++;
		}
		return $retval;
	}
}
if ( ! function_exists('site_url_none_suffix')) {
    function site_url_none_suffix($uri = ''){
		$CI =& get_instance();
		$url = base_url().$uri;
		return $url;
    }
}
if ( ! function_exists('current_url_none_suffix')) {
	function current_url_none_suffix(){
		$CI =& get_instance();
		return $CI->uri->uri_string();
	}
}
if ( ! function_exists('get_params')) {
	function get_params(){
		$CI =& get_instance();
		$currentUrl = $_SERVER['REQUEST_URI'];
		//echo $currentUrl;
		$strParams = explode('/?',$currentUrl);
		$parsedParams = array();
		if(isset($strParams[1])){
			$arrParams = explode("&", $strParams[1]);
			$parsedParams = array();
			foreach ($arrParams as $i => $value) {
				$tmpAr = explode("=", $value);
				if(sizeof($tmpAr) > 1) {
					$parsedParams[$tmpAr[0]] = $tmpAr[1];
				}
			}
		}
		if(isset($strParams[2])){
			$arrParams = explode("&", $strParams[2]);
			foreach ($arrParams as $i => $value) {
				$tmpAr = explode("=", $value);
				if(sizeof($tmpAr) > 1) {
					$parsedParams[$tmpAr[0]] = $tmpAr[1];
				}
			}
		}
		return $parsedParams;
	}
}
// ------------------------------------------------------------------------
/**
 * Header Redirect Admin
 *
 * Header redirect in two flavors
 * For very fine grained control over headers, you could use the Output
 * Library's set_header() function.
 *
 * @access	public
 * @param	string	the URL
 * @param	string	the method: location or redirect
 * @return	string
 */
if ( ! function_exists('redirect_admin'))
{
	function redirect_admin($uri = '', $method = 'location', $http_response_code = 302)
	{
		switch($method)
		{
			case 'refresh'	: header("Refresh:0;url=".admin_url($uri));
				break;
			default			: header("Location: ".admin_url($uri), TRUE, $http_response_code);
				break;
		}
		exit;
	}
}
// ------------------------------------------------------------------------
/**
 * Header Redirect Admin
 *
 * Header redirect in two flavors
 * For very fine grained control over headers, you could use the Output
 * Library's set_header() function.
 *
 * @access	public
 * @param	string	the URL
 * @param	string	the method: location or redirect
 * @return	string
 */
if ( ! function_exists('replaceSpaceWithUnderscore'))
{
	function replaceSpaceWithUnderscore($text='')
	{
		$text = str_replace(' ','_',$text);
		return $text;
	} //Function replaceSpaceWithUnderscore End
}
// ------------------------------------------------------------------------
/**
 * Header Redirect Admin
 *
 * Header redirect in two flavors
 * For very fine grained control over headers, you could use the Output
 * Library's set_header() function.
 *
 * @access	public
 * @param	string	the URL
 * @param	string	the method: location or redirect
 * @return	string
 */
if ( ! function_exists('replaceUnderscoreWithSpace'))
{
	function replaceUnderscoreWithSpace($text = '')
	{
		$text = str_replace('_',' ',$text);
		return $text;
	}//Function replaceUnderscoreWithSpace End
}
// ------------------------------------------------------------------------
/**
 * Header Redirect Admin
 *
 * Header redirect in two flavors
 * For very fine grained control over headers, you could use the Output
 * Library's set_header() function.
 *
 * @access	public
 * @param	string	the URL
 * @param	string	the method: location or redirect
 * @return	string
 */
if ( ! function_exists('linksToCategories'))
{
	function linksToCategories($string='')
	{
		if($string!='')
		{
			$categories = explode(',',$string);
			if(count($categories)>0)
			{
			}
		} 
		return false;
	}
}
    function url_list_project(){
        $link = site_url("browse-projects");
        return $link;
    }
    function url_list_freelancer(){
        $link = site_url("find-freelancer");
        return $link;
    }
    function url_create_project(){
        $link = site_url("post-project");
        return $link;
    }
    function url_signup(){
        $link = base_url()."buyer/signup";
        return $link;
    }
    function url_indexManage(){
        $link = base_url()."jobseeker";
        return $link;
    }
    function url_accountManage(){
        $link = base_url()."jobseeker/accountManage";
        return $link;
    }
    function url_accountSettings(){
        $link = base_url()."jobseeker/accountSettings";
        return $link;
    }
    function url_changeSecurityQuestion(){
        $link = base_url()."users/changeSecurityQuestion";
        return $link;
    }
    function url_contactInfo(){
        $link = base_url()."users/contactInfo";
        return $link;
    }
    function image_default(){
        $link = image_url('default-logo.jpg');
        return $link;
    }
    function url_dashboard(){
        $CI = & get_instance();
        if($CI->session->userdata('user_id')){
            if($CI->session->userdata('role_id') == '2'){
                return $url_dashboard = base_url();
            }else{
                return $url_dashboard = base_url();
            }
        }else{
            return $url_dashboard = base_url();
        }
    }
    function url_notification(){
        $link = base_url()."notification/showAllNotification";
        return $link;
    }
    function url_settingNotifications(){
        $link = base_url()."notification/settingNotifications";
        return $link;
    }
    function url_Message(){
        $CI = & get_instance();
        if($CI->session->userdata('user_id')){
            if($CI->session->userdata('role') == 'buyer'){
                return $url_dashboard = site_url('buyer/messages');
            }else{
                return $url_dashboard = site_url('programmer/messages');
            }
        }else{
            return $url_dashboard = base_url();
        }
    }
    function url_Manage(){
        $link = base_url()."finances/paymentMethod";
        return $link;
    }
    function url_viewProfile($id = 0){
        $link = base_url()."programmer/viewProfile/".$id;
        return $link;
    }
	function url_UxHome(){
		$link = base_url()."ux";
		return $link;
	}
    function url_uxTool(){
        $link = base_url()."ux/loadux/#new";
        return $link;
    }
    function url_listProjectUx(){
        $link = base_url()."tools/listProjectUx";
        return $link;
    }
    function url_UX($code = null){
        $link = base_url()."ux/loadux/?code=".$code;
        return $link;
    }
	function url_Library(){
		$link = base_url()."library";
		return $link;
	}
	function url_Ideas(){
		$link = base_url()."patterns";
		return $link;
	}
	function url_Publisher(){
		$link = base_url()."employers/publisher";
		return $link;
	}
	function url_FindCV(){
		$link = base_url()."employers/search";
		return $link;
	}
	function url_PostJob(){
		$link = base_url()."employers";
		return $link;
	}
	function url_CreateResume(){
		$link = base_url()."jobseeker/resume";
		return $link;
	}
	function url_Contest(){
		$link = base_url()."contest";
		return $link;
	}
	function url_HireMe($id = 0){
		if($id != 0){
			$link = base_url()."users/hireme/".$id;
			return $link;
		}
		return false;
	}
	function url_HowItWorks(){
		$link = base_url()."how-it-works";
		return $link;
	}
    function url_search(){
        $link = base_url()."search";
        return $link;
    }
    function url_create_resume(){
        $link = base_url()."jobseeker/resume";
        return $link;
    }
	function url_ProjectView($id = 0){
		if($id != 0){
			$link = base_url()."project/view/".$id;
			return $link;
		}
		return false;
	}
	function url_Policy(){
		$link = base_url()."policy";
		return $link;
	}
	function url_Aboutus(){
		$link = base_url()."about-us";
		return $link;
	}
	function url_TOS(){
		$link = base_url()."tos";
		return $link;
	}
	function url_Privacy_Policy(){
		$link = base_url()."privacy-policy";
		return $link;
	}
function url_Contact(){
	$link = base_url()."contact";
	return $link;
}
function url_now_hiring(){
	$link = base_url()."about-us";
	return $link;
}
	function url_exams(){
		$link = site_url("exams");
		return $link;
	}
	function url_DetailContest($id = 0,$url = null){
		if($url != null){
			if($id != 0){
				$link = site_url('contest/'.$url."-".$id.".html");
				return $link;
			}else{
				return false;
			}
		}else{
			if($id != 0){
				$link = site_url('contest/detailContest/'.$id.".html");
				return $link;
			}else{
				return false;
			}
		}
	}
	function url_BrowseContest(){
		$link = site_url("browse-contest.html");
		return $link;
	}
	function url_ShowAllContest(){
		$link = site_url('contest/showAllContest');
		return $link;
	}
	function url_postContest(){
		$link = site_url('post-contest.html');
		return $link;
	}
	function url_ajaxViewDetailJoinContest(){
		$link = site_url('contest/ajaxViewDetailJoinContest');
		return $link;
	}
	function url_ajaxCommentContestJoin(){
		$link = site_url('contest/ajaxCommentContestJoin');
		return $link;
	}
	function url_ajaxLikeContestJoin(){
		$link = site_url('contest/ajaxLikeContestJoin');
		return $link;
	}
	function url_ajaxViewNextContestJoin(){
		$link = site_url('contest/ajaxViewNextContestJoin');
		return $link;
	}
	function standardURL1($value) {
		$result = str_replace(' ', '_', $value);
		for($i=0;$i<=10;$i++){
			$result = str_replace('__', '_', $result);
		}
		return $result;
	}
	function standardURL($value, $options = null) {
		$result = removeVietnam($value);
		$result = preg_replace('/[^a-zA-Z0-9- ]/', '', $result);
		$result = str_replace(' ', '-', $result);
		$pattern = "/-[0-9]*$/";
		preg_match($pattern, $result, $matches);
		if(isset($matches[0]) && ($matches[0] != null)){
			$pos = strrpos($result, "-",0);
			$len = strlen($result);
			$strsub = substr($result, $pos+1, $len);
			$str = substr($result, 0, $pos);
			$result = $str.$strsub;
		}
		return $result;
	}
    function removeVietnam($string) {
		$stringOld = array("à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă",
			"ằ", "ắ", "ặ", "ẳ", "ẵ",
			"è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề", "ế", "ệ", "ể", "ễ",
			"ì", "í", "ị", "ỉ", "ĩ",
			"ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ"
		, "ờ", "ớ", "ợ", "ở", "ỡ",
			"ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ",
			"ỳ", "ý", "ỵ", "ỷ", "ỹ",
			"đ",
			"À", "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă"
		, "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ",
			"È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ",
			"Ì", "Í", "Ị", "Ỉ", "Ĩ",
			"Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ", "Ỗ", "Ơ"
		, "Ờ", "Ớ", "Ợ", "Ở", "Ỡ",
			"Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ",
			"Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ",
			"Đ", "ê", "ù", "à");
		$stringNew = array("a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a"
		, "a", "a", "a", "a", "a", "a",
			"e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e",
			"i", "i", "i", "i", "i",
			"o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o"
		, "o", "o", "o", "o", "o",
			"u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u",
			"y", "y", "y", "y", "y",
			"d",
			"A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A"
		, "A", "A", "A", "A", "A",
			"E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E",
			"I", "I", "I", "I", "I",
			"O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O"
		, "O", "O", "O", "O", "O",
			"U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U",
			"Y", "Y", "Y", "Y", "Y",
			"D", "e", "u", "a");
		return str_replace($stringOld, $stringNew, $string);
	}
if ( ! function_exists('redirect_page')) {
    function redirect_page($post)
    {
        $CI = &get_instance();
        $_href = current_url_temp1();
        if ($post) {
            foreach ($post as $key => $val) {
            	if(is_array($val)){
            		$_href .= '/' . $key.'/';
            		$count=count($val);
            		foreach ($val as $keyChild => $valChild) {
            			if (strpos($_href, $keyChild)) {
		                    if ($valChild == '') {
		                        $_href = preg_replace("/\/{$keyChild}\/(.*)/", "", $_href);
		                    } else {
		                        $valChild = urlencode(trim($valChild));
		                        $_href = preg_replace("/{$keyChild}\/(.*)/", "{$key}/{$val}", $_href);
		                    }
		                } else {
		                    if ($valChild == '') {
		                        $_href = preg_replace("/\/{$keyChild}\/(.*)/", "", $_href);
		                    } else {
		                    	if($keyChild==$count-1){
			                    	$_href .= urlencode(trim($valChild));
			                    }
			                    else{
			                    	$_href .= urlencode(trim($valChild)).'-';
			                    }
		                        //$_href .= '/' . $keyChild . '/' . urlencode(trim($valChild));
		                    }
		                }
            		}
            	}
                elseif (strpos($_href, $key)) {

                    if ($val == '') {
                        $_href = preg_replace("/\/{$key}\/(.*)/", "", $_href);
                    } else {
                        $val = urlencode(trim($val));
                        $_href = preg_replace("/{$key}\/(.*)/", "{$key}/{$val}", $_href);
                    }
                } else {
                    if ($val == '') {
                        $_href = preg_replace("/\/{$key}\/(.*)/", "", $_href);
                    } else {
                        $_href .= '/' . $key . '/' . urlencode(trim($val));
                    }
                }
            }
            header("Location: {$_href}");
        }
    }
}

if ( ! function_exists('redirect_page_temp1')) {
    function redirect_page_temp1($post)
    {
        $CI = &get_instance();
        $_href = current_url_temp1();
        if ($post) {
            foreach ($post as $key => $val) {
            	if(is_array($val)){
            		$_href .= '/' . $key.'/';
            		$count=count($val);
            		foreach ($val as $keyChild => $valChild) {
            			if (strpos($_href, $keyChild)) {
		                    if ($valChild == '') {
		                        $_href = preg_replace("/\/{$keyChild}\/(.*)/", "", $_href);
		                    } else {
		                        $valChild = urlencode(trim($valChild));
		                        $_href = preg_replace("/{$keyChild}\/(.*)/", "{$key}/{$val}", $_href);
		                    }
		                } else {
		                    if ($valChild == '') {
		                        $_href = preg_replace("/\/{$keyChild}\/(.*)/", "", $_href);
		                    } else {
		                    	if($keyChild==$count-1){
			                    	$_href .= urlencode(trim($valChild));
			                    }
			                    else{
			                    	$_href .= urlencode(trim($valChild)).'-';
			                    }
		                        //$_href .= '/' . $keyChild . '/' . urlencode(trim($valChild));
		                    }
		                }
            		}
            	}
                elseif (strpos($_href, $key)) {

                    if ($val == '') {
                        $_href = preg_replace("/\/{$key}\/(.*)/", "", $_href);
                    } else {
                        $val = urlencode(trim($val));
                        $_href = preg_replace("/{$key}\/(.*)/", "{$key}/{$val}", $_href);
                    }
                } else {
                    if ($val == '') {
                        $_href = preg_replace("/\/{$key}\/(.*)/", "", $_href);
                    } else {
                        $_href .= '/' . $key . '/' . urlencode(trim($val));
                    }
                }
            }
            return $_href;
        }
    }
}
    if ( ! function_exists('get_params')) {
        function get_params(){
            $CI =& get_instance();
            $currentUrl = $CI->uri->uri_string();
            $strParams = explode('/?',$currentUrl);
            $parsedParams = array();
            if(isset($strParams[1])){
                $arrParams = explode("&", $strParams[1]);
                $parsedParams = array();
                foreach ($arrParams as $i => $value) {
                    $tmpAr = explode("=", $value);
                    if(sizeof($tmpAr) > 1) {
                        $parsedParams[$tmpAr[0]] = $tmpAr[1];
                    }
                }
            }
            if(isset($strParams[2])){
                $arrParams = explode("&", $strParams[2]);
                foreach ($arrParams as $i => $value) {
                    $tmpAr = explode("=", $value);
                    if(sizeof($tmpAr) > 1) {
                        $parsedParams[$tmpAr[0]] = $tmpAr[1];
                    }
                }
            }
            return $parsedParams;
        }
    }
if ( ! function_exists('current_url_temp1'))
{
	function current_url_temp1()
	{
		return 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];;
	}
}
/* End of file MY_url_helper.php */
/* Location: ./app/helpers/MY_url_helper.php */
?>