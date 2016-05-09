<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!isset($_SESSION))@session_start();

require_once(APPPATH . 'controllers/admin/admin_application.php');

class Block extends Admin_application{

	/**

	 * Index Page for this controller.

	 *

	 * Maps to the following URL

	 * 		http://example.com/index.php/welcome

	 *	- or -  

	 * 		http://example.com/index.php/welcome/index

	 *	- or -

	 * Since this controller is set as the default controller in 

	 * config/routes.php, it's displayed at http://example.com/

	 *

	 * So any other public methods not prefixed with an underscore will

	 * map to /index.php/welcome/<method_name>

	 * @see http://codeigniter.com/user_guide/general/urls.html

	 */

	 public function __construct(){

		parent::__construct();

		$this->_data['blocks_config']=1;	

		$this->_data['blocks_default']=1;	

		/*hepler*/

			$this->load->helper("url");

			$this->load->helper("getalias");		

		/*Load model*/

			$this->load->Model("admin/block/m_blocks");

			$this->_gallery_url = base_url()."public/images";

	}

	/*load function index default*/

	public function index()

	{

		//sent data

			$this->_data['title']=$this->config->item("title_index");

			$this->_data['template']='admin/bodyright/block/main';

		//load list blocks

			$this->_data['listBlocks']=$this->m_blocks->listBlocks();

			$this->load->view('admin/main',$this->_data);

		

	}

	/*end load function index default*/

	/*load function check_edit_block_config*/

	public function check_edit_block_config()

	{

			$this->_data['title']=$this->config->item("title_index");

			$action=$this->input->post('t');

			$listBlocks=$this->m_blocks->listBlocks();

			foreach($listBlocks as $blockConfig)

			{

				$value_modules_config=$this->input->post(''.$blockConfig->name_modules_config.'');

				$data=array(

					'value_modules_config' => $value_modules_config,

				);

				$this->m_blocks->editBlocks($blockConfig->name_modules_config,$data);

			}

			$this->_data['template']='admin/bodyright/block/block_config/editBlocks';

			$this->_data['messages']='Sữa block thành công.';

			$this->_data['listBlocks']=$this->m_blocks->listBlocks();

			$this->load->view('admin/main',$this->_data);

		

	}

	/*end load function check_edit_block_config*/

	/*load function add_blocks*/

	public function add_blocks()

	{

		//sent data

			$this->_data['title']=$this->config->item("title_index");

			$this->_data['template']='admin/bodyright/block/addBlocks';

			$this->load->view('admin/main',$this->_data);

	}

	/*end load function add_blocks*/

	/*load function check_add_blocks*/

	public function check_add_blocks()

	{

		//sent data

			$this->_data['title']=$this->config->item("title_index");

		//get data

			$action=$this->input->post('t');

			$name_blocks=$this->input->post('name_blocks');

			//$position_blocks=$this->input->post('position_blocks');

			$title_blocks=$this->input->post('title_blocks');

			

			$showtitle_blocks=$this->input->post('showtitle_blocks');

			$html_content_blocks=$this->input->post('html_content_blocks');

			

			$enable_blocks=$this->input->post('enable_blocks');

			//$menuid_blocks=$this->input->post('menuid_blocks');

			//$ordering_blocks=$this->input->post('ordering_blocks');

			$data=array(

			'idBlocks' => 'NULL',

			'name_blocks' =>$name_blocks,

			//'position_blocks' =>$position_blocks,

			//'ordering_blocks' =>$ordering_blocks,

			'title_blocks' =>$title_blocks,

			

			'showtitle_blocks' =>$showtitle_blocks,

			'html_content_blocks' =>$html_content_blocks,

			

			'enable_blocks' =>$enable_blocks,

			//'menuid_blocks' =>$menuid_blocks

			);

			$this->_data['title']=$this->config->item("title_index");

			if($action=='save')

			{

				$this->_data['template']='admin/bodyright/block/addBlocks';

			}

			else

			{

				$this->_data['listBlocks']=$this->m_blocks->listBlocks();

				$this->_data['template']='admin/bodyright/block/main';

			}

			$this->_data['messages']='Sữa block thành công.';

			$this->m_blocks->addBlocks($data);

			$this->_data['listBlocks']=$this->m_blocks->listBlocks();

			$this->load->view('admin/main',$this->_data);

		

	}

	/*end load function check_add_blocks*/

	/*load function edit_blocks*/

	public function edit_blocks($idBlocks)

	{

		//sent data

			$this->_data['title']=$this->config->item("title_index");

			$this->_data['template']='admin/bodyright/block/editBlocks';

		//get data

			$this->_data['getBlocks']=$this->m_blocks->getBlocks($idBlocks);

			$this->load->view('admin/main',$this->_data);

		

	}

	/*end load function edit_blocks*/

	/*load function check_edit_blocks*/

	public function check_edit_blocks($idBlocks)

	{

		//sent data

			$this->_data['title']=$this->config->item("title_index");

		//get data

			$action=$this->input->post('t');

			$name_blocks=$this->input->post('name_blocks');

			//$position_blocks=$this->input->post('position_blocks');

			$title_blocks=$this->input->post('title_blocks');

			

			$showtitle_blocks=$this->input->post('showtitle_blocks');

			$html_content_blocks=$this->input->post('html_content_blocks');

			

			$enable_blocks=$this->input->post('enable_blocks');

			//$menuid_blocks=$this->input->post('menuid_blocks');

			$limit_show=$this->input->post('limit_show');

			$data=array(

			'name_blocks' =>$name_blocks,

			//'position_blocks' =>$position_blocks,

			'limit_show' =>$limit_show,

			'title_blocks' =>$title_blocks,

			

			'showtitle_blocks' =>$showtitle_blocks,

			'html_content_blocks' =>$html_content_blocks,

			

			'enable_blocks' =>$enable_blocks,

			//'menuid_blocks' =>$menuid_blocks

			);

			$this->m_blocks->editBlocks($idBlocks,$data);	

			$this->_data['title']=$this->config->item("title_index");

			if($action=='save')

			{

				$this->_data['getBlocks']=$this->m_blocks->getBlocks($idBlocks);

				$this->_data['template']='admin/bodyright/block/editBlocks';

			}

			else

			{

				$this->_data['listBlocks']=$this->m_blocks->listBlocks();

				$this->_data['template']='admin/bodyright/block/main';

			}

			$this->_data['messages']='Sữa block thành công.';	

			$this->load->view('admin/main',$this->_data);

		

	}

	/*end load function check_edit_blocks*/

	/*load function enable*/

	public function enable($status,$id)

	{

		//sent data

			$this->_data['title']=$this->config->item("title_index");

			$this->_data['template']='admin/bodyright/block/main';

		//get data

			$this->m_blocks->enable($status,$id);

			$this->_data['listBlocks']=$this->m_blocks->listBlocks();

			$this->load->view('admin/main',$this->_data);

		

	}

	/*end load function enable*/

	/*Delete block*/

	public function removeBlocks()

	{

		if(isset($_POST["btnDeleteall"]))

		{

			if(empty($_POST['delete']))

			redirect(URL.'admin/block');

			foreach($_POST['delete'] as $id)

			{

				//remove don hang

				$this->m_blocks->removeBlocks($id);

			}

			redirect(URL."admin/block");

		}

	}

	/*end delete block*/

	

}