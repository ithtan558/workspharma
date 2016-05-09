<?php
/**
 * Reverse bidding system skills Class
 *
 * Permits admin to handle the skills for this site
 *
 * @package		Reverse bidding system
 * @subpackage	Controllers
 * @category	Skills
 * @author		Cogzidel Dev Team
 * @version		Version 1.0
 * @created		December 22 2008
 * @link		http://www.cogzidel.com
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
require_once(APPPATH . 'controllers/admin/admin_application.php');
class Category extends Admin_application{
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
		//Load Models Common to all the functions in this controller
		$this->load->model('admin/m_category');
        $this->_data['categories'] = $this->m_category->getCategory();
		// get params
		$this->_params = ($this->uri->uri_to_assoc())?$this->uri->uri_to_assoc():'';
		$this->_data['params'] = $this->_params;
		$this->_data['jobs_default'] = true;
		$this->_data['category'] = true;
	}//Controller End
	// --------------------------------------------------------------------
	/**
	 * View Categories
	 *
	 * @access	private
	 * @param	nil
	 * @return	void
	 */
	function viewCategorys()
	{
		redirect_page($_POST);
		$this->_params = ($this->uri->uri_to_assoc(2))?$this->uri->uri_to_assoc(2):'';
		$this->_data['params'] = $this->_params;
		//Load model
		$this->load->model('m_category');
		//Get Categories
		$condition_parent = array(
			"categories.is_deleted" => 0,
			"categories.parent_id" => 0,
		);
		$condition_child = array(
			"categories.is_deleted" => 0,
			"categories.parent_id !=" => 0,
		);
		$order = array('categories.id', 'DESC');
		$order[0]            ='id';
		$order[1]            ='ASC';
		//Get categoryies
	    $categories_parent=	$this->m_category->getCategory($condition_parent,NULL,NULL,null,$order, $this->_params);
	    $categories_child=	$this->m_category->getCategory($condition_child,NULL,NULL,null,$order, $this->_params);
		$this->_data['categories_parent'] = $categories_parent;
		$this->_data['categories_child'] = $categories_child;
		//Load View
		$this->_data['template'] = 'admin/bodyright/category/viewCategorys';
		$this->load->view('admin/main',$this->_data);
	}//End of index function
	// --------------------------------------------------------------------
	/**
	 * trash Categories
	 *
	 * @access	private
	 * @param	nil
	 * @return	void
	 */
	function trashCategories()
	{
		isAllowed();
		redirect_page($_POST);
		//Load model
		$this->load->model('m_category');
		$groupId = isset($this->_params['group_id'])?$this->_params['group_id']:0;
		//Get Categories
		$condition = array(
				"categories.is_deleted" => 1,
				//"categories.group_id" => $groupId
		);
		$category =	$this->m_category->getCategory($condition, NULL, $this->_params);
		$start =  isset($this->_params['page'])?$this->_params['page']:0;
		//$start = $this->uri->segment(4,0);
		//Get the inbox mail list
		$page_rows         					 =  $this->config->item('listing_limit');
		$limit[0]			 = $page_rows;
		if($start > 0)
			$limit[1]			 = ($start-1) * $page_rows;
		else
			$limit[1]			 = $start * $page_rows;
		$order[0]            ='id';
		$order[1]            ='asc';
		//Get Groups
		$categoryies=	$this->m_category->getCategory($condition,NULL,NULL,$limit,$order, $this->_params);
		$this->_data['categories'] = $categoryies;
		//Pagination
		$this->load->library('pagination');
		$config['base_url'] 	 = admin_url('skills/trashCategories');
		$config['total_rows'] 	 = $category->num_rows();
		$config['per_page']     = $page_rows;
		$config['cur_page']     = $start;
		$this->pagination->initialize($config);
		$this->_data['pagination']   = $this->pagination->create_links3();
		//Load View
		$this->load->view('skills/trashCategories', $this->_data);
	}//End of index function
	// --------------------------------------------------------------------
	/**
	 * Loads skills settings page.
	 *
	 * @access	private
	 * @param	nil
	 * @return	void
	 */
	function deleteCategory(){
		if(isset($_POST["btnDeleteall"]))
		{
			if(empty($_POST['delete']))
			redirect(URL.'admin/category/viewCategorys');
			foreach($_POST['delete'] as $id)
			{
				$this->m_category->deleteCategory($id);
			}
			redirect(URL."admin/category/viewCategorys");
		}
	}
	// --------------------------------------------------------------------
	function restoreCategory()
	{
		isAllowed();
		//Load model
		//Load Form Helper
		$this->load->helper('form');
		$categoryid = $this->uri->segment(3,'0');
		if($categoryid==0)
		{
			//$groupId = $this->input->post('group_id');
			//$getgroups	=	$this->m_category->getCategory();
			$categoryList  =   $this->input->post('categoryList');
			if(!empty($categoryList))
			{
				foreach($categoryList as $res)
				{
					$condition = array('categories.id'=>$res);
					$this->m_category->restoreCategory(NULL,$condition);
				}
			}
			else
			{
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error',$this->lang->line('Please select category')));
				redirect_admin('skills/trashCategories');
			}
		}
		else
		{
			$condition = array('categories.id'=>$categoryid);
			$this->m_category->restoreCategory(NULL,$condition);
		}
		$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success',$this->lang->line('restore_success')));
		redirect_admin('skills/trashCategories');
	}
	/**
	 * Add Category.
	 *
	 * @access	private
	 * @param	nil
	 * @return	void
	 */
	function addCategory()
	{
		//Load model
		$this->load->model('m_category');
		//load validation library
		$this->load->library('form_validation');
		//Load Form Helper
		$this->load->helper('form');
		$condition_parent = array(
			"categories.is_deleted" => 0,
			"categories.parent_id" => 0,
		);
		$order = array('categories.id', 'DESC');
		$order[0]            ='id';
		$order[1]            ='ASC';
		//Get categoryies
	    $categories_parent=	$this->m_category->getCategory($condition_parent,NULL,NULL,null,$order);
	    $this->_data['categories_parent'] = $categories_parent;
		//Intialize values for library and helpers
		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
		if($this->input->post('addCategory'))
		{
			//prepare insert data
			$insertData                  	  	= array();
			$insertData['category_name']  	= $this->input->post('category_name');
			$insertData['category_en_name']  	= $this->input->post('category_en_name');
			$insertData['parent_id']  	= $this->input->post('parent_id');
			//$insertData['group_id']  			= $this->input->post('group_id');
			$insertData['is_active']  		= 1;
			$insertData['page_title']  		= $this->input->post('page_title');
			$insertData['meta_keywords']  	= $this->input->post('meta_keywords');
			$insertData['meta_description']  	= $this->input->post('meta_description');
			$insertData['created']			= get_est_time();
			$insertData['modified']			= get_est_time();
			//Add Category
			$this->m_category->addCategory($insertData);
			//Notification message
			$this->session->set_flashdata('flash_message', 'Added category success');
			$action=$this->input->post('t');
			if($action=='save')
			{
				redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				redirect(URL."admin/category/viewCategorys");
			}
		} //If - Form Submission End
		$this->_data['template'] = 'admin/bodyright/category/addCategory';
		$this->load->view('admin/main',$this->_data);
	}//End of addCategory function
		// --------------------------------------------------------------------
	/**
	 * Edit Category.
	 *
	 * @access	private
	 * @param	nil
	 * @return	void
	 */
	function editCategory()
	{
		
		//Get id of the category
		$id = is_numeric($this->uri->segment(4))?$this->uri->segment(4):0;
		$this->_data['category'] = $this->m_category->getCategory(array('categories.id'=>$id))->row();
		//Load model
		$this->load->model('m_category');
		//load validation library
		$this->load->library('form_validation');
		//Load Form Helper
		$this->load->helper('form');
		//Intialize values for library and helpers
		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
		if($this->input->post('addCategory'))
		{
			//prepare insert data
			$updateData                  	  	= array();
			$updateData['category_name']  	= $this->input->post('category_name');
			$updateData['category_en_name']  	= $this->input->post('category_en_name');
			$updateData['parent_id']  	= $this->input->post('parent_id');
			//$insertData['group_id']  			= $this->input->post('group_id');
			$updateData['is_active']  		= 1;
			$updateData['page_title']  		= $this->input->post('page_title');
			$updateData['meta_keywords']  	= $this->input->post('meta_keywords');
			$updateData['meta_description']  	= $this->input->post('meta_description');
			$updateData['modified']			= get_est_time();
			//Add Category
			$this->m_category->updateCategory($id,$updateData);
			//Notification message
			$this->session->set_flashdata('flash_message', 'Edited category success');
			$action=$this->input->post('t');
			if($action=='save')
			{
				redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				redirect(URL."admin/category/viewCategorys");
			}
		} //If - Form Submission End//Get categoryies
	    $condition_parent = array(
			"categories.is_deleted" => 0,
			"categories.parent_id" => 0,
		);
		$order = array('categories.id', 'DESC');
		$order[0]            ='id';
		$order[1]            ='ASC';
		//Get categoryies
	    $categories_parent=	$this->m_category->getCategory($condition_parent,NULL,NULL,null,$order);
	    $this->_data['categories_parent'] = $categories_parent;
		$this->_data['template'] = 'admin/bodyright/category/editCategory';
		$this->load->view('admin/main',$this->_data);
	}//End of editCategory function
}
//End  skillSettings Class
/* End of file skillSettings.php */
/* Location: ./app/controllers/skillSettings.php */
?>