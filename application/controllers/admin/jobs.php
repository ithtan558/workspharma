<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION))@session_start();
require_once(APPPATH . 'controllers/admin/admin_application.php');
class Jobs extends Admin_application{
	//Global variable
    public $_params = '';
	/**
	* Constructor
	*
	* Loads language files and models needed for this controller
	*/
	function __construct()
	{
	   parent::__construct();
		$this->load->model('admin/m_jobs');
		// get params
		$this->_params = ($this->uri->uri_to_assoc())?$this->uri->uri_to_assoc():'';
		$this->_data['params'] = $this->_params;
		$this->_data['jobs_default'] = true;
        $this->load->library('encrypt');
	}//Controller End
	// --------------------------------------------------------------------
	/**
	 * viewJobs
	 *
	 * @access	private
	 * @param	nil
	 * @return	void
	 */
	function viewJobsPosted()
	{
		$this->_data['jobsPosted'] = true;
		//Load model
		$this->load->model('m_jobs');
		//Get Jobs
		$order[0]            ='jobs.id';
		$order[1]            ='DESC';
		$conditions['jobs.date_expiration >'] = date('Y-m-d H:i:s',time());
		$conditions['jobs.is_deleted'] = 0;
		//, 'bids.is_deleted' => 0
		$jobs 	         = $this->m_jobs->getJobs($conditions,NULL,NULL,null,$order);
		//echo $this->db->last_query(); die;
		$this->_data['jobs'] = $jobs;
		//Load View
		$this->_data['template'] = 'admin/bodyright/jobs/viewJobsPosted';
		$this->load->view('admin/main',$this->_data);
	}//End of viewJobs function

	// --------------------------------------------------------------------
	/**
	 * viewJobs
	 *
	 * @access	private
	 * @param	nil
	 * @return	void
	 */
	function viewJobsExpried()
	{
		$this->_data['jobsExpried'] = true;
		//Load model
		$this->load->model('m_jobs');
		//Get Jobs
		$order[0]            ='jobs.id';
		$order[1]            ='DESC';
		$conditions['jobs.date_expiration <'] = date('Y-m-d H:i:s',time());
		$conditions['jobs.is_deleted'] = 0;

		//, 'bids.is_deleted' => 0
		$jobs 	         = $this->m_jobs->getJobs($conditions,NULL,NULL,null,$order);
		//echo $this->db->last_query(); die;
		$this->_data['jobs'] = $jobs;
		//Load View
		$this->_data['template'] = 'admin/bodyright/jobs/viewJobsExpried';
		$this->load->view('admin/main',$this->_data);
	}//End of viewJobs function

	// --------------------------------------------------------------------
	/**
	 * viewJobs
	 *
	 * @access	private
	 * @param	nil
	 * @return	void
	 */
	function viewJobsCheck()
	{
		$this->_data['jobsCheck'] = true;
		//Load model
		$this->load->model('m_jobs');
		//Get Jobs
		$order[0]            ='jobs.id';
		$order[1]            ='DESC';
		$conditions['jobs.is_deleted'] = 0;
		$conditions['jobs.status'] = 0;
		//, 'bids.is_deleted' => 0
		$jobs 	         = $this->m_jobs->getJobs($conditions,NULL,NULL,null,$order);
		//echo $this->db->last_query(); die;
		$this->_data['jobs'] = $jobs;
		//Load View
		$this->_data['template'] = 'admin/bodyright/jobs/viewJobsCheck';
		$this->load->view('admin/main',$this->_data);
	}//End of viewJobs function
	/**
	 * trashJobs
	 *
	 * @access	private
	 * @param	nil
	 * @return	void
	 */
	function trashJobs()
	{
		isAllowed();
		redirect_page($_POST);
		//Load model
		$this->load->model('m_jobs');
		$this->load->model('list_objects_model');
		//Get Jobs
		$jobs1	=	$this->m_jobs->getJobs(array('jobs.is_deleted' => 1),NULL,NULL,NULL,NULL, $this->_params);
		$start =  isset($this->_params['page'])?$this->_params['page']:0;
		//$this->uri->segment(4,0);
		//Get the inbox mail list
		$page_rows         					 =  $this->config->item('listing_limit');
		$limit[0]			 = $page_rows;
		if($start > 0)
			$limit[1]			 = ($start-1) * $page_rows;
		else
			$limit[1]			 = $start * $page_rows;
		$order[0]            ='id';
		$order[1]            ='asc';
		$jobs 	         = $this->m_jobs->getJobs(array('jobs.is_deleted' => 1),NULL,NULL,$limit,$order, $this->_params);
		//echo $this->db->last_query(); die;
		$this->_data['jobs'] = $jobs;
		//Pagination
		$this->load->library('pagination');
		$config['base_url'] 	 = admin_url('skills/trashJobs');
		$config['total_rows'] 	 = $jobs1->num_rows();
		$config['per_page']     = $page_rows;
		$config['cur_page']     = $start;
		$this->pagination->initialize($config);
		$this->_data['pagination']   = $this->pagination->create_links3();
		//Load View
		$this->load->view('skills/trashJobs',$this->_data);
	}//End of viewJobs function
	/**
	 * deleteBids
	 *
	 * @access	private
	 * @param	nil
	 * @return	void
	 */
	function deleteJobs(){
		if(isset($_POST["btnDeleteallPosted"]))
		{
			if(empty($_POST['delete']))
			redirect(URL.'admin/jobs/viewJobsPosted');
			foreach($_POST['delete'] as $id)
			{
				$this->m_jobs->deleteJobs($id);
			}
			$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error',$this->lang->line('Please Select Project')));
			redirect(URL.'admin/jobs/viewJobsPosted');
		}
		if(isset($_POST["btnDeleteallExpried"]))
		{
			if(empty($_POST['delete']))
			redirect(URL.'admin/jobs/viewJobsExpried');
			foreach($_POST['delete'] as $id)
			{
				$this->m_jobs->deleteJobs($id);
			}
			$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error',$this->lang->line('Please Select Project')));
			redirect(URL.'admin/jobs/viewJobsExpried');
		}
	}//End of addGroup function

	/**
	 * deleteBids
	 *
	 * @access	private
	 * @param	nil
	 * @return	void
	 */
	function updateJobsCheck(){
		if(isset($_POST["btnDeleteall"]))
		{
			if(empty($_POST['delete']))
			redirect(URL.'admin/jobs/viewJobsCheck');
			foreach($_POST['delete'] as $id)
			{
				$updateData = array();
				$updateData['status'] = 1;
				$this->m_jobs->updateJobs($id,$updateData);
			}
			redirect(URL.'admin/jobs/viewJobsCheck');
		}
	}//End of addGroup function
	function restoreJobs()
	{
		isAllowed();
		$id = $this->uri->segment(3,'0');
		//Load model
		$this->load->model('m_jobs');
		if($id == 0){
			//Get bidJobs
			$bidJobs1	=	$this->m_jobs->getBids();
			$this->_data['Jobs']	=	$this->m_jobs->getJobs();
			$jobList  =   $this->input->post('jobList');
			if(!empty($jobList))
			{
				foreach($jobList as $res)
				{
					//update the amount value
					$condition = array('jobs.id'=>$res);
					$this->m_jobs->restoreJobs(NULL,$condition);
				}
			}
			else
			{
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error',$this->lang->line('Please Select Project')));
				redirect_admin('skills/viewJobs');
			}
		}else{
			$condition = array('jobs.id'=>$id);
			$this->m_jobs->restoreJobs(NULL,$condition);
		}
		$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success',$this->lang->line('restore_success')));
		redirect_admin('skills/trashJobs');
	}

	function applies()
    {
    	$params_temp = (uri_to_assoc(3)) ? uri_to_assoc(3) : '';
		//Get Groups
		$conditions = array(
            'users.role_id' => 1
        );

        if(isset($params_temp['job_id']) && $params_temp['job_id'] > 0){
            $conditions['job_apply.job_id'] = $params_temp['job_id'];
        }

        if(isset($params_temp['status']) && $params_temp['status'] != ''){
            $conditions['job_apply.status'] = $params_temp['status'];
        }

	    $this->_data['users'] = $this->m_jobs->getUserApplies($conditions, NULL, NULL, null, null,NULL,$this->_params);
		$this->_data['template'] = 'admin/bodyright/employers/viewApply';
		$this->load->view('admin/main',$this->_data);
    }
}
//End  skillSettings Class
/* End of file skillSettings.php */
/* Location: ./app/controllers/skillSettings.php */
?>