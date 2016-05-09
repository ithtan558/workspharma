<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION))@session_start();
require_once(APPPATH . 'controllers/admin/admin_application.php');
class Users extends Admin_application{
	//Global variable
    public $_data;		//Holds the output data for each view
    public $_params = '';
	/**
	 * Constructor
	 *
	 * Loads language files and models needed for this controller
	 */
	function __construct()
	{
	   parent::__construct();

		$this->load->Model("admin/m_users");
		// get params
		$this->_params = ($this->uri->uri_to_assoc())?$this->uri->uri_to_assoc():'';
		$this->_data['params'] = $this->_params;
		$this->_data['users_default'] = true;
		$this->_data['usersTrash'] = true;
	} //Controller End
	function viewUsersTrash()
	{
		$this->load->helper("users");
		redirect_page($_POST);
		$this->_params = ($this->uri->uri_to_assoc(2))?$this->uri->uri_to_assoc(2):'';
		$this->_data['params'] = $this->_params;
		$condition = array('users.is_deleted'=>1);
		$order=array('users.id','DESC');
	    $getUsersTrash=	$this->m_users->getUsersTrash($condition,NULL,NULL,null,$order, $this->_params);
		$this->_data['userDetails'] = $getUsersTrash;
		$this->_data['template'] = 'admin/bodyright/users/viewUsersTrash';
		$this->load->view('admin/main',$this->_data);
	}//End of addBans Function
	function restoreUsers(){
		if(isset($_POST["btnResote"]))
		{
			if(empty($_POST['delete']))
			redirect(URL.'admin/users/viewUsersTrash');
			foreach($_POST['delete'] as $id)
			{
				$this->m_users->restoreUsers($id);
			}
			redirect(URL."admin/users/viewUsersTrash");
		}
	}
	// -------------------------------------------------------------------

	/**
	 * edit user
	 *
	 * @access	private
	 * @param	nil
	 * @return	void
	 */
	function editEmployers()
	{
		//load validation library
		$this->load->library('form_validation');
		//Load Form Helper
		$this->load->helper('form');
		//Intialize values for library and helpers
		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
		$userid = $this->uri->segment(4,'0');
		$condition = array('users.id' => $userid);
		$this->_data['userDetails'] = $this->m_employer->getEmployer($condition)->row();
		if($this->input->post('editUser')){
			  $updateData                   = array();
			  $updateData['user_name']     	= $this->input->post('username');
			  if($this->input->post('password')!='')
			  {
			  	$updateData['password']    	= md5($this->input->post('password'));
			  	$updateKey = array('users.id' => $this->input->post('userid',true));
				  //Edit user
				  $this->m_employer->updateUser($updateKey,$updateData);
			  }
			  $this->session->set_flashdata('flash_message', 'Updated employers success!');
			  redirect($_SERVER['HTTP_REFERER']);
		}
		$this->_data['template'] = 'admin/bodyright/employers/editEmployers';
		$this->load->view('admin/main',$this->_data);
	}//End of addBans Function
}
//End  SiteSettings Class
/* End of file siteSettings.php */
/* Location: ./app/controllers/siteSettings.php */
?>