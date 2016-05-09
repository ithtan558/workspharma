<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION))@session_start();
require_once(APPPATH . 'controllers/admin/admin_application.php');
class Employer extends Admin_application{
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

		$this->load->Model("admin/m_employer");
		$this->load->Model("admin/m_jobs");
		// get params
		$this->_params = ($this->uri->uri_to_assoc())?$this->uri->uri_to_assoc():'';
		$this->_data['params'] = $this->_params;
		$this->_data['users_default'] = true;
		$this->_data['employer'] = true;
	} //Controller End
	function viewEmployer()
	{
		$this->load->helper("users");
		redirect_page($_POST);
		$this->_params = ($this->uri->uri_to_assoc(2))?$this->uri->uri_to_assoc(2):'';
		$this->_data['params'] = $this->_params;
		$condition = array('users.is_deleted'=>0,'users.role_id'=>2);
		if(isset($this->_params['is_phone']) && $this->_params['is_phone'] == 1){
			$condition['users.phone != '] = '';
		}
		$order=array('users.id','DESC');
		$userDetail	=	$this->m_employer->getEmployer($condition, null,null,null,$order, $this->_params);
		$start =  isset($this->_params['page'])?$this->_params['page']:0;
		 //$start = $this->uri->segment(4,0);
		//Get the inbox mail list
     	 $page_rows         					 =  $this->config->item('listing_limit');
		$limit[0]			 = $page_rows;
		if($start > 0)
		   $limit[1]			 = ($start-1) * $page_rows;
		else
		    $limit[1]			 = $start * $page_rows;
		//echo 'hihihohoho'.$limit;
		//$order[0]            ='created';
		//$order[1]            ='DESC';
		//Get Groups
	    $getEmployer=	$this->m_employer->getEmployer($condition,NULL,NULL,$limit,$order, $this->_params);
		$this->_data['userDetails'] = $getEmployer;
		//Pagination
		$this->load->library('pagination');
		$config['base_url'] 	 = admin_url('users/viewUsers');
		$config['total_rows'] 	 = $userDetail->num_rows();
		$config['per_page']     = $page_rows;
		$config['cur_page']     = $start;
		$this->pagination->initialize($config);
		$this->_data['pagination']   = $this->pagination->create_links3();
		$this->_data['template'] = 'admin/bodyright/employers/viewEmployers';
		$this->load->view('admin/main',$this->_data);
	}//End of addBans Function
	function deleteEmployer(){
		if(isset($_POST["btnDeleteall"]))
		{
			if(empty($_POST['delete']))
			redirect(URL.'admin/employer/viewEmployers');
			foreach($_POST['delete'] as $id)
			{
				$this->m_employer->deleteEmployer($id);
			}
			redirect(URL."admin/employer/viewEmployers");
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