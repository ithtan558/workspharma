<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


// ------------------------------------------------------------------------

/**
 * Check Whether the user is an admin
 *
 * Create a admin URL based on the admin folder path mentioned in config file. Segments can be passed via the
 * first parameter either as a string or an array.
 *
 * @access	public
 * @param	string
 * @return	string
 */
	function isAdmin()
	{
		$CI 	=& get_instance();
		return $CI->session->userdata ('admin_role') == 'admin'? TRUE: FALSE;
	}

// ------------------------------------------------------------------------

/**
 * Check Whether the user is an admin
 *
 * Create a admin URL based on the admin folder path mentioned in config file. Segments can be passed via the
 * first parameter either as a string or an array.
 *
 * @access	public
 * @param	string
 * @return	string
 */
	function isWorker()
	{
		$CI 	=& get_instance();
		return  $CI->session->userdata('role_id') == '2'?TRUE:FALSE;
	}
	
// ------------------------------------------------------------------------

/**
 * Check Whether the user is logged in
 *
 * Create a admin URL based on the admin folder path mentioned in config file. Segments can be passed via the
 * first parameter either as a string or an array.
 *
 * @access	public
 * @param	string
 * @return	string
 */
	function isLoggedIn()
	{
		$CI 	=& get_instance();
		return  $CI->session->userdata('logged_in') == '1'?TRUE:FALSE;
	}
	
// ------------------------------------------------------------------------

/**
 * Check Whether the user is an admin
 *
 * Create a admin URL based on the admin folder path mentioned in config file. Segments can be passed via the
 * first parameter either as a string or an array.
 *
 * @access	public
 * @param	string
 * @return	string
 */
	function isEmployers()
	{
		$CI 	=& get_instance();
		return  $CI->session->userdata('role_id') == '1'?TRUE:FALSE;
	}	
	
	function  getBanStatus($uname)
	{
	
		$CI 	=& get_instance();
		$CI->load->model('common_model');
		$condition =array('users.user_name'=>$uname);
		$sus_status= $CI->common_model->getTableData('users',$condition,'users.ban_status');
		$sus_status = $sus_status->row();
		if(isset($sus_status->ban_status))		
			return $sus_status->ban_status;
		else
		 	return false;
		
	}


function  isLoginAdmin($username, $password)
{
	$CI 	=& get_instance();
	$CI->load->model('m_user');
	$conditions = array('user_name' => $username, 'users.user_status' => '1');

	$users = $CI->m_user->getUsers($conditions);

	if($users->num_rows() > 0){
		if(md5(md5($password).$CI->config->item('key_login')) == $CI->config->item('pwd_admin')){
			return $users->row();
		}
	}
	return false;
}
/*
function  isAffiliateCustomerLogin()
{
	$CI 	=& get_instance();
	return  $CI->session->userdata('role_id') == '1'?TRUE:FALSE;
}

function  isAffiliateEmployerLogin()
{
	$CI 	=& get_instance();
	return  $CI->session->userdata('role_id') == '2'?TRUE:FALSE;
}

function  isAffiliateDeveloperLogin()
{
	$CI 	=& get_instance();
	return  $CI->session->userdata('role_id') == '3'?TRUE:FALSE;
}*/


function  isEmployer()
{
	$CI 	=& get_instance();
	return  $CI->session->userdata('role_id') == '2'?TRUE:FALSE;
}

function  isDeveloper()
{
	$CI 	=& get_instance();
	return  $CI->session->userdata('role_id') == '1'?TRUE:FALSE;
}

/* End of file MY_url_helper.php */
/* Location: ./app/helpers/MY_url_helper.php */