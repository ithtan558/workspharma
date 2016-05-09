<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!isset($_SESSION))@session_start();

require_once(APPPATH . 'controllers/admin/admin_application.php');

class Blocks_adv_right extends Admin_application{

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

		$this->_data['blocks_adv_right']=1;

		$this->_data['blocks_default']=1;	

		/*hepler*/

			$this->load->helper("url");	

			$this->load->helper("getalias");		

		/*Load model*/

			$this->load->Model("admin/block/m_blocks_adv_right");

	}

	/*load function index default*/

	public function index()

	{

		//sent data

			$this->_data['title']=$this->config->item("title_index");

			$this->_data['template']='admin/bodyright/block/blocks_adv_right/main';

		//list customer model

			$this->_data['listBlocksAdvRight']=$this->m_blocks_adv_right->listBlocksAdvRight();

			$this->load->view('admin/main',$this->_data);

		

	}

	/*end load function index default*/

	/*load function add_blocks_adv_right*/

	public function add_blocks_adv_right()

	{

		//sent data

			

			$this->_data['title']=$this->config->item("title_index");

			$this->_data['template']='admin/bodyright/block/blocks_adv_right/addBlocksAdvRight';

			//list customer model

			$this->load->view('admin/main',$this->_data);

		

	}

	/*end load function add_blocks_adv_right*/

	/*load function add_blocks_adv_right*/

	public function check_add_blocks_adv_right()

	{

		//sent data

			

			$this->_data['title']=$this->config->item("title_index");

			//list customer model

			$this->m_blocks_adv_right->do_upload();

			//list customer model

			$action=$this->input->post('t');
			
			$text_adv_right=$this->input->post('text_adv_right');
			
			$paramid=$this->input->post('paramid');

			$url_adv_right=$this->input->post('url_adv_right');

			$ordering_adv_right=$this->input->post('ordering_adv_right');

			$image_adv_right=getAlias($_FILES['image_adv_right']['name']);

			$enable_adv_right=$this->input->post('enable_adv_right');

			$data=array(

			'idAdvRight' =>'NULL',
			
			'paramid' =>$paramid,

			'text_adv_right' =>$text_adv_right,
			
			'url_adv_right' =>$url_adv_right,

			'image_adv_right' =>encrypt_name($image_adv_right),

			'ordering_adv_right' =>$ordering_adv_right,

			'enable_adv_right' =>$enable_adv_right,

			);

			$this->m_blocks_adv_right->addBlocksAdvRight($data);

			$this->_data['title']=$this->config->item("title_index");

			if($action=='save')

			{

				$this->_data['listBlocksAdvRight']=$this->m_blocks_adv_right->listBlocksAdvRight();

				$this->_data['template']='admin/bodyright/block/blocks_adv_right/addBlocksAdvRight';

			}

			else

			{

				$this->_data['listBlocksAdvRight']=$this->m_blocks_adv_right->listBlocksAdvRight();

				$this->_data['template']='admin/bodyright/block/blocks_adv_right/main';

			}

			$this->_data['messages']='Thêm block quảng cáo thành công.';

			

			

			$this->load->view('admin/main',$this->_data);

		

	}

	/*load function add_blocks_adv_right*/

	/*end load function edit_blocks_adv_right*/

	

	public function edit_blocks_adv_right($idAdvRight)

	{

		//sent data

			

			$this->_data['title']=$this->config->item("title_index");

			$this->_data['template']='admin/bodyright/block/blocks_adv_right/editBlocksAdvRight';

			//list customer model

			$this->_data['getBlocksAdvRight']=$this->m_blocks_adv_right->getBlocksAdvRight($idAdvRight);

			$this->load->view('admin/main',$this->_data);

		

	}

	/*end load function edit_blocks_adv_right*/

	/*load function check_edit_blocks_adv_right*/

	public function check_edit_blocks_adv_right($idAdvRight)

	{

		//sent data

			

			$this->_data['title']=$this->config->item("title_index");

			//list customer model

			$this->m_blocks_adv_right->do_upload();

			//list customer model

			$action=$this->input->post('t');
			
			$paramid=$this->input->post('paramid');

			$text_adv_right=$this->input->post('text_adv_right');
			
			$url_adv_right=$this->input->post('url_adv_right');

			$ordering_adv_right=$this->input->post('ordering_adv_right');

			$image_adv_right=getAlias($_FILES['image_adv_right']['name']);

			$enable_adv_right=$this->input->post('enable_adv_right');

			$data=array(
			
			'paramid' =>$paramid,
			
			'text_adv_right' =>$text_adv_right,
			
			'url_adv_right' =>$url_adv_right,

			'image_adv_right' =>encrypt_name($image_adv_right),

			'ordering_adv_right' =>$ordering_adv_right,

			'enable_adv_right' =>$enable_adv_right,

			);

			if($image_adv_right=="")

			{

				$data=array(
				
				'paramid' =>$paramid,
				
				'text_adv_right' =>$text_adv_right,
				
				'url_adv_right' =>$url_adv_right,

				'ordering_adv_right' =>$ordering_adv_right,

				'enable_adv_right' =>$enable_adv_right,

				);

			}

			$this->m_blocks_adv_right->editBlocksAdvRight($idAdvRight,$data);

			$this->_data['title']=$this->config->item("title_index");

			if($action=='save')

			{

				redirect($_SERVER['HTTP_REFERER']);

			}

			else

			{

				redirect(URL."admin/blocks_adv_right");

			}

			$this->_data['messages']='Sữa block quảng cáo thành công.';

			$this->load->view('admin/main',$this->_data);

	}

	

	/*end load function check_edit_blocks_adv_right*/

	/*load function enable*/

	public function enable($status,$id)

	{

		//sent data

			

			$this->_data['title']=$this->config->item("title_index");

			$this->_data['template']='admin/bodyright/block/blocks_adv_right/main';

			//list customer model

			$this->m_blocks_adv_right->enable($status,$id);

			$this->_data['listBlocksAdvRight']=$this->m_blocks_adv_right->listBlocksAdvRight();

			$this->load->view('admin/main',$this->_data);

	}

	/*end load function enable*/

	/*Delete removeBlocksAdvRight*/

		public function removeBlocksAdvRight()

		{

			if(isset($_POST["btnDeleteall"]))

			{

				if(empty($_POST['delete']))

				redirect(URL.'admin/blocks_adv_right');

				foreach($_POST['delete'] as $id)

				{

					//remove don hang

					$this->m_blocks_adv_right->removeBlocksAdvRight($id);

				}

				redirect(URL."admin/blocks_adv_right");

			}

		}

	/*end delete removeBlocksAdvRight*/

	/*check ordering*/

	public function check_ordering()

	{

			$ordering_adv_right=$this->input->post('ordering_adv_right');

			/*list id adv_right*/

				$listAdvRight=$this->input->post('idAdvRight');

			/* get idadv_right*/

				$idAdvRight=$this->input->post('t');

			/*get stt input ordering*/

				$stt=$this->input->post('stt');

			

			/* update record with ordering*/

			$data=array(

			'ordering_adv_right' =>$ordering_adv_right[$stt]

			);

			$this->m_blocks_adv_right->check_ordering($idAdvRight,$data);

			/* update all record with ordering*/

			$listAdvRight=$this->m_blocks_adv_right->listBlocksAdvRight();

			$stt=0;

			foreach($listAdvRight as $adv_right){

				if($adv_right->ordering_adv_right!=$stt+1)

				{

					$data=array(

					'ordering_adv_right' =>$stt+1

					);

					$this->m_blocks_adv_right->check_ordering($adv_right->idAdvRight,$data);

				}

				$stt++;

				

			}

			redirect($_SERVER['HTTP_REFERER']);

		

	}

	/*end check ordering*/

	/*check ordering previous*/

	public function check_ordering_previous($idAdvRight,$ordering_adv_right)

	{

			/* update next record with ordering*/

			$getOrderingPrevious=$this->m_blocks_adv_right->getOrderingPrevious($ordering_adv_right);

			$data=array(

			'ordering_adv_right' =>$ordering_adv_right

			);

			$this->m_blocks_adv_right->check_ordering($getOrderingPrevious[0]->idAdvRight,$data);

			/* update record with ordering*/

			$data=array(

			'ordering_adv_right' =>$ordering_adv_right+1

			);

			$this->m_blocks_adv_right->check_ordering($idAdvRight,$data);

			redirect($_SERVER['HTTP_REFERER']);

	}

	/*end check ordering previous*/

	/*check ordering next */

	public function check_ordering_next($idAdvRight,$ordering_adv_right)

	{

			/* update next record with ordering*/

			$getOrderingNext=$this->m_blocks_adv_right->getOrderingNext($ordering_adv_right);

			$data=array(

			'ordering_adv_right' =>$ordering_adv_right

			);

			$this->m_blocks_adv_right->check_ordering($getOrderingNext[0]->idAdvRight,$data);

			/* update record with ordering*/

			$data=array(

			'ordering_adv_right' =>$ordering_adv_right-1

			);

			$this->m_blocks_adv_right->check_ordering($idAdvRight,$data);

			redirect($_SERVER['HTTP_REFERER']);

	}

	/*end check ordering next*/

	

}