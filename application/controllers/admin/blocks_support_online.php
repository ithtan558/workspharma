<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!isset($_SESSION))@session_start();

require_once(APPPATH . 'controllers/admin/admin_application.php');

class Blocks_support_online extends Admin_application{

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

		$this->_data['blocks_support_online']=1;

		$this->_data['blocks_default']=1;	

		/*hepler*/

			$this->load->helper("url");	

			$this->load->helper("getalias");		

		/*Load model*/

			$this->load->Model("admin/block/m_blocks_support_online");

	}

	/*load function index default*/

	public function index()

	{

		//sent data

			

			$this->_data['title']=$this->config->item("title_index");

			$this->_data['template']='admin/bodyright/block/blocks_support_online/main';

			//get data

			$this->_data['listBlocksSupportOnline']=$this->m_blocks_support_online->listBlocksSupportOnline();

			$this->load->view('admin/main',$this->_data);

		

	}

	

	/*end load function index default*/

	/*load function add_blocks_support_online*/

	public function add_blocks_support_online()

	{

		//sent data

			

			$this->_data['title']=$this->config->item("title_index");

			$this->_data['template']='admin/bodyright/block/blocks_support_online/addBlocksSupportOnline';

			//get data

			$this->load->view('admin/main',$this->_data);

		

	}

	

	/*end load function add_blocks_support_online*/

	/*load function check_add_blocks_support_online*/

	public function check_add_blocks_support_online()

	{

		//sent data

			

			$this->_data['title']=$this->config->item("title_index");

			//get data

			$action=$this->input->post('t');

			$name_support_online=$this->input->post('name_support_online');

			$phone_support_online=$this->input->post('phone_support_online');

			$skype_support_online=$this->input->post('skype_support_online');

			$yahoo_support_online=$this->input->post('yahoo_support_online');

			$ordering_support_online=$this->input->post('ordering_support_online');

			$enable_support_online=$this->input->post('enable_support_online');

			$data=array(

			'idSupportOnline' =>'NULL',

			'name_support_online' =>$name_support_online,

			'phone_support_online' =>$phone_support_online,

			'skype_support_online' =>$skype_support_online,

			'yahoo_support_online' =>$yahoo_support_online,

			'ordering_support_online' =>$ordering_support_online,

			'enable_support_online' =>$enable_support_online

			);

			$this->m_blocks_support_online->addBlocksSupportOnline($data);

			$this->_data['title']=$this->config->item("title_index");

			if($action=='save')

			{

				$this->_data['listBlocksSupportOnline']=$this->m_blocks_support_online->listBlocksSupportOnline();

				$this->_data['template']='admin/bodyright/block/blocks_support_online/addBlocksSupportOnline';

			}

			else

			{

				$this->_data['listBlocksSupportOnline']=$this->m_blocks_support_online->listBlocksSupportOnline();

				$this->_data['template']='admin/bodyright/block/blocks_support_online/main';

			}

			$this->_data['messages']='Thêm support online thành công.';

			

			

			$this->load->view('admin/main',$this->_data);

		

	}

	/*end load function check_add_blocks_support_online*/

	/*load function edit_blocks_support_online*/

	public function edit_blocks_support_online($idSupportOnline)

	{

		//sent data

			

			$this->_data['title']=$this->config->item("title_index");

			$this->_data['template']='admin/bodyright/block/blocks_support_online/editBlocksSupportOnline';

			//get data

			$this->_data['getBlocksSupportOnline']=$this->m_blocks_support_online->getBlocksSupportOnline($idSupportOnline);

			$this->load->view('admin/main',$this->_data);

		

	}

	

	/*end load function edit_blocks_support_online*/

	/*load function check_edit_blocks_support_online*/

	public function check_edit_blocks_support_online($idSupportOnline)

	{

		//sent data

			$action=$this->input->post('t');

			$this->_data['title']=$this->config->item("title_index");

			//get data

			$name_support_online=$this->input->post('name_support_online');

			$phone_support_online=$this->input->post('phone_support_online');

			$skype_support_online=$this->input->post('skype_support_online');

			$yahoo_support_online=$this->input->post('yahoo_support_online');

			$ordering_support_online=$this->input->post('ordering_support_online');

			$enable_support_online=$this->input->post('enable_support_online');

			$data=array(

			'name_support_online' =>$name_support_online,

			'phone_support_online' =>$phone_support_online,

			'skype_support_online' =>$skype_support_online,

			'yahoo_support_online' =>$yahoo_support_online,

			'ordering_support_online' =>$ordering_support_online,

			'enable_support_online' =>$enable_support_online

			);

			$this->m_blocks_support_online->editBlocksSupportOnline($idSupportOnline,$data);

			$this->_data['title']=$this->config->item("title_index");

			if($action=='save')

			{

				$this->_data['getBlocksSupportOnline']=$this->m_blocks_support_online->getBlocksSupportOnline($idSupportOnline);

				$this->_data['template']='admin/bodyright/block/blocks_support_online/editBlocksSupportOnline';

			}

			else

			{

				$this->_data['listBlocksSupportOnline']=$this->m_blocks_support_online->listBlocksSupportOnline();

				$this->_data['template']='admin/bodyright/block/blocks_support_online/main';

			}

			$this->_data['messages']='Sữa support online thành công.';

			

			

			$this->load->view('admin/main',$this->_data);

		

	}

	

	/*end load function check_edit_blocks_support_online*/

	/*load function enable*/

	public function enable($status,$id)

	{

		//sent data

			

			$this->_data['title']=$this->config->item("title_index");

			$this->_data['template']='admin/bodyright/block/blocks_support_online/main';

			//get data

			$this->m_blocks_support_online->enable($status,$id);

			$this->_data['listBlocksSupportOnline']=$this->m_blocks_support_online->listBlocksSupportOnline();

			$this->load->view('admin/main',$this->_data);

		

	}

	

	/*end load function enable*/

	/*Delete removeBlocksSupportOnline*/

		public function removeBlocksSupportOnline()

		{

			if(isset($_POST["btnDeleteall"]))

			{

				if(empty($_POST['delete']))

				redirect(URL.'admin/blocks_support_online');

				foreach($_POST['delete'] as $id)

				{

					//remove don hang

					$this->m_blocks_support_online->removeBlocksSupportOnline($id);

				}

				redirect(URL."admin/blocks_support_online");

			}

		}

	/*end delete removeBlocksSupportOnline*/

	

	/*check ordering*/

	public function check_ordering()

	{

			$ordering_support_online=$this->input->post('ordering_support_online');

			/*list id support_online*/

				$listSupportOnlines=$this->input->post('idSupportOnline');

			/* get idsupport_online*/

				$idSupportOnline=$this->input->post('t');

			/*get stt input ordering*/

				$stt=$this->input->post('stt');

			

			/* update record with ordering*/

			$data=array(

			'ordering_support_online' =>$ordering_support_online[$stt]

			);

			$this->m_blocks_support_online->check_ordering($idSupportOnline,$data);

			/* update all record with ordering*/

			$listSupportOnline=$this->m_blocks_support_online->listBlocksSupportOnline();

			$stt=0;

			foreach($listSupportOnline as $menu){

				if($menu->ordering_support_online!=$stt+1)

				{

					$data=array(

					'ordering_support_online' =>$stt+1

					);

					$this->m_blocks_support_online->check_ordering($menu->idSupportOnline,$data);

				}

				$stt++;

				

			}

			redirect($_SERVER['HTTP_REFERER']);

		

	}

	/*end check ordering*/

	/*check ordering previous*/

	public function check_ordering_previous($idSupportOnline,$ordering_support_online)

	{

			/* update next record with ordering*/

			$getOrderingPrevious=$this->m_blocks_support_online->getOrderingPrevious($ordering_support_online);

			$data=array(

			'ordering_support_online' =>$ordering_support_online

			);

			$this->m_blocks_support_online->check_ordering($getOrderingPrevious[0]->idSupportOnline,$data);

			/* update record with ordering*/

			$data=array(

			'ordering_support_online' =>$ordering_support_online+1

			);

			$this->m_blocks_support_online->check_ordering($idSupportOnline,$data);

			redirect($_SERVER['HTTP_REFERER']);

	}

	/*end check ordering previous*/

	/*check ordering next */

	public function check_ordering_next($idSupportOnline,$ordering_support_online)

	{

			/* update next record with ordering*/

			$getOrderingNext=$this->m_blocks_support_online->getOrderingNext($ordering_support_online);

			$data=array(

			'ordering_support_online' =>$ordering_support_online

			);

			$this->m_blocks_support_online->check_ordering($getOrderingNext[0]->idSupportOnline,$data);

			/* update record with ordering*/

			$data=array(

			'ordering_support_online' =>$ordering_support_online-1

			);

			$this->m_blocks_support_online->check_ordering($idSupportOnline,$data);

			redirect($_SERVER['HTTP_REFERER']);

	}

	/*end check ordering next*/

	

}