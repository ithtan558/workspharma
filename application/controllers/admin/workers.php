<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION))@session_start();
require_once(APPPATH . 'controllers/admin/admin_application.php');
class Workers extends Admin_application{
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

		$this->load->Model("admin/m_worker");
		$this->_params = ($this->uri->uri_to_assoc())?$this->uri->uri_to_assoc():'';
		$this->_data['params'] = $this->_params;

		$this->_data['users_default'] = true;
		$this->_data['workers'] = true;
        $this->load->library('encrypt');

	} //Controller End
	// --------------------------------------------------------------------
	/**
	 * View users
	 *
	 * @access	private
	 * @param	nil
	 * @return	void
	 */
	function viewWorkers()
	{
		$this->load->helper("users");
		redirect_page($_POST);
		$this->_params = ($this->uri->uri_to_assoc(2))?$this->uri->uri_to_assoc(2):'';
		$this->_data['params'] = $this->_params;
		$order=array('users.id','DESC');
		$condition = array('users.is_deleted'=>0,'users.role_id'=>1);
		if(isset($this->_params['is_phone']) && $this->_params['is_phone'] == 1){
			$condition['users.phone != '] = '';
		}
		$userDetail	=	$this->m_worker->getWorkers($condition, null, null,null,$order,$this->_params);
		$start =  isset($this->_params['page'])?$this->_params['page']:0;
     	$page_rows         					 =  $this->config->item('listing_limit');
		$limit[0]			 = $page_rows;
		if($start > 0)
		   $limit[1]			 = ($start-1) * $page_rows;
		else
		    $limit[1]			 = $start * $page_rows;
		//Get Groups
	    $userbalance=	$this->m_worker->getWorkers($condition,NULL,NULL,$limit,$order, $this->_params);
		$this->_data['userDetails'] = $userbalance;
		//Pagination
		$this->load->library('pagination');
		$config['base_url'] 	 = admin_url('users/viewUsers');
		$config['total_rows'] 	 = $userDetail->num_rows();
		$config['per_page']     = $page_rows;
		$config['cur_page']     = $start;
		$this->pagination->initialize($config);
		$this->_data['pagination']   = $this->pagination->create_links3();
		$this->_data['template'] = 'admin/bodyright/workers/viewWorkers';
		$this->load->view('admin/main',$this->_data);
	}//End of addBans Function
	function deleteWorker(){
		if(isset($_POST["btnDeleteall"]))
		{
			if(empty($_POST['delete']))
			redirect(URL.'admin/workers/viewWorkers');
			foreach($_POST['delete'] as $id)
			{
				$this->m_worker->deleteWorker($id);
			}
			redirect(URL."admin/workers/viewWorkers");
		}
	}
	// --------------------------------------------------------------------
	/**
	 * View users
	 *
	 * @access	private
	 * @param	nil
	 * @return	void
	 */
	function viewResume()
	{
		
		$userid = $this->uri->segment(3,'0');
		$this->load->helper("users");
		redirect_page($_POST);
		$condition = array('resume.id !='=>0,'resume.user_id'=>$userid);
		$getResume	=	$this->m_worker->getResume($condition, null, $this->_params);
		$start =  isset($this->_params['page'])?$this->_params['page']:0;
		 //$start = $this->uri->segment(4,0);
		//Get the inbox mail list
     	 $page_rows         					 =  $this->config->item('listing_limit');
		$limit[0]			 = $page_rows;
		if($start > 0)
		   $limit[1]			 = ($start-1) * $page_rows;
		else
	    $limit[1]			 = $start * $page_rows;
		//Get Groups
	    $userbalangetResumece=	$this->m_worker->getResume($condition,NULL,NULL,$limit,null, $this->_params);
		$this->_data['getResume'] = $getResume;
        //Pagination
		$this->load->library('pagination');
		$config['base_url'] 	 = admin_url('workers/viewWorkers');
		$config['total_rows'] 	 = $getResume->num_rows();
		$config['per_page']     = $page_rows;
		$config['cur_page']     = $start;
		$this->pagination->initialize($config);
		$this->_data['pagination']   = $this->pagination->create_links3();
		$this->_data['template'] = 'workers/viewResume';
		$this->load->view('admin/main',$this->_data);
	}//End of addBans Function
	
	/**
	 * edit user
	 *
	 * @access	private
	 * @param	nil
	 * @return	void
	 */
	function editWorkers()
	{
		//load validation library
		$this->load->library('form_validation');
		//Load Form Helper
		$this->load->helper('form');
		//Intialize values for library and helpers
		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
		$userid = $this->uri->segment(4,'0');
		$condition = array('users.id' => $userid);
		$this->_data['userDetails'] = $this->m_worker->getWorkers($condition)->row();
		if($this->input->post('editUser')){
			  $updateData                   = array();
			  $updateData['user_name']     	= $this->input->post('username');
			  if($this->input->post('password')!='')
			  {
			  	$updateData['password']    	= md5($this->input->post('password'));
			  	$updateKey = array('users.id' => $this->input->post('userid',true));
				  //Edit user
				  $this->m_worker->updateUser($updateKey,$updateData);
			  }
			  $this->session->set_flashdata('flash_message', 'Updated worker success!');
			  redirect($_SERVER['HTTP_REFERER']);
		}
		$this->_data['template'] = 'admin/bodyright/workers/editWorkers';
		$this->load->view('admin/main',$this->_data);
	}//End of addBans Function
}
//End  SiteSettings Class
/* End of file siteSettings.php */
/* Location: ./app/controllers/siteSettings.php */
?>