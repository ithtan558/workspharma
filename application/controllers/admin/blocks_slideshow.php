<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!isset($_SESSION))@session_start();

require_once(APPPATH . 'controllers/admin/admin_application.php');

class Blocks_slideshow extends Admin_application{

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

		$this->_data['block_slideshow']=1;

		$this->_data['blocks_default']=1;	

		/*hepler*/

			$this->load->helper("url");	

			$this->load->helper("getalias");		

		/*Load model*/

			$this->load->Model("admin/block/m_blocks_slideshow");

	}

	/*load function index default*/

	public function index()

	{

		//sent data

			$this->_data['title']=$this->config->item("title_index");

			$this->_data['template']='admin/bodyright/block/blocks_slideshow/main';

		//get data

			$this->_data['listBlocksSlideshow']=$this->m_blocks_slideshow->listBlocksSlideshow();

			$this->load->view('admin/main',$this->_data);

		

	}

	/*end load function index default*/

	/*load function add_blocks_slideshow*/

	public function add_blocks_slideshow()

	{

		//sent data

			

			$this->_data['title']=$this->config->item("title_index");

			$this->_data['template']='admin/bodyright/block/blocks_slideshow/addBlocksSlideshow';

			//get data

			$this->load->view('admin/main',$this->_data);

		

	}

	

	/*end load function add_blocks_slideshow*/

	/*load function check_add_blocks_slideshow*/

	public function check_add_blocks_slideshow()

	{

		//sent data

			$this->_data['title']=$this->config->item("title_index");

		//get data

			$this->m_blocks_slideshow->do_upload();

		//get data

			$action=$this->input->post('t');

			$text_slide_show=$this->input->post('text_slide_show');
			
			$url_slide_show=$this->input->post('url_slide_show');

			$ordering_slide_show=$this->input->post('ordering_slide_show');

			if($_FILES['image_slide_show']['name']!=""){
				$image_slide_show=encrypt_name(getAlias($_FILES['image_slide_show']['name']));
			}
			else{
				$image_slide_show="";
			}


			$enable_slide_show=$this->input->post('enable_slide_show');

			$data=array(

			'idSlideshow' =>'NULL',

			'text_slide_show' =>$text_slide_show,
			
			'url_slide_show' =>$url_slide_show,

			'image_slide_show' =>$image_slide_show,

			'ordering_slide_show' =>$ordering_slide_show,

			'enable_slide_show' =>$enable_slide_show,

			);

		

			$this->_data['title']=$this->config->item("title_index");
			$this->m_blocks_slideshow->addBlocksSlideshow($data);

			if($action=='save')

			{

				$this->_data['listBlocksSlideshow']=$this->m_blocks_slideshow->listBlocksSlideshow();

				$this->_data['template']='admin/bodyright/block/blocks_slideshow/addBlocksSlideshow';

			}

			else

			{

				$this->_data['listBlocksSlideshow']=$this->m_blocks_slideshow->listBlocksSlideshow();

				$this->_data['template']='admin/bodyright/block/blocks_slideshow/main';

			}

			$this->_data['messages']='Thêm block slideshow thành công.';

			

			

			$this->load->view('admin/main',$this->_data);

		

	}

	

	

	/*end load function check_add_blocks_slideshow*/

	/*load function edit_blocks_slideshow*/

	public function edit_blocks_slideshow($idSlideshow)

	{

		//sent data

			

			$this->_data['title']=$this->config->item("title_index");

			$this->_data['template']='admin/bodyright/block/blocks_slideshow/editBlocksSlideshow';

			//get data

			$this->_data['getBlocksSlideshow']=$this->m_blocks_slideshow->getBlocksSlideshow($idSlideshow);

			$this->load->view('admin/main',$this->_data);

		

	}

	

	/*end load function edit_blocks_slideshow*/

	/*load function check_edit_blocks_slideshow*/

	public function check_edit_blocks_slideshow($idSlideshow)

	{

		//sent data

			$this->_data['title']=$this->config->item("title_index");

		//get data

			$this->m_blocks_slideshow->do_upload();

		//get data

			$action=$this->input->post('t');

			$text_slide_show=$this->input->post('text_slide_show');
			
			$url_slide_show=$this->input->post('url_slide_show');

			$ordering_slide_show=$this->input->post('ordering_slide_show');
			if($_FILES['image_slide_show']['name']!=""){
				$image_slide_show=encrypt_name(getAlias($_FILES['image_slide_show']['name']));
			}

			$enable_slide_show=$this->input->post('enable_slide_show');

			

			if($_FILES['image_slide_show']['name']=="")

			{

				$data=array(

				'text_slide_show' =>$text_slide_show,
				
				'url_slide_show' =>$url_slide_show,

				'ordering_slide_show' =>$ordering_slide_show,

				'enable_slide_show' =>$enable_slide_show,

				);

			}
			else{
				$data=array(

					'text_slide_show' =>$text_slide_show,
					
					'url_slide_show' =>$url_slide_show,

					'image_slide_show' =>$image_slide_show,

					'ordering_slide_show' =>$ordering_slide_show,

					'enable_slide_show' =>$enable_slide_show,

					);
				}

			$this->m_blocks_slideshow->editBlocksSlideshow($idSlideshow,$data);

			$this->_data['title']=$this->config->item("title_index");

			if($action=='save')

			{

				$this->_data['getBlocksSlideshow']=$this->m_blocks_slideshow->getBlocksSlideshow($idSlideshow);

				$this->_data['template']='admin/bodyright/block/blocks_slideshow/editBlocksSlideshow';

			}

			else

			{

				$this->_data['listBlocksSlideshow']=$this->m_blocks_slideshow->listBlocksSlideshow();

				$this->_data['template']='admin/bodyright/block/blocks_slideshow/main';

			}

			$this->_data['messages']='Sữa block slideshow thành công.';

			$this->load->view('admin/main',$this->_data);

	}

	/*end load function check_edit_blocks_slideshow*/

	/*load function enable*/

	public function enable($status,$id)

	{

		//sent data

			

			$this->_data['title']=$this->config->item("title_index");

			$this->_data['template']='admin/bodyright/block/blocks_slideshow/main';

			//get data

			$this->m_blocks_slideshow->enable($status,$id);

			$this->_data['listBlocksSlideshow']=$this->m_blocks_slideshow->listBlocksSlideshow();

			$this->load->view('admin/main',$this->_data);

		

	}

	

	/*end load function enable*/

	/*Delete removeBlocksSlideshow*/

	public function removeBlocksSlideshow()

	{

		if(isset($_POST["btnDeleteall"]))

		{

			if(empty($_POST['delete']))

			redirect(URL.'admin/blocks_slideshow');

			foreach($_POST['delete'] as $id)

			{

				//remove don hang

				$this->m_blocks_slideshow->removeBlocksSlideshow($id);

			}

			redirect(URL."admin/blocks_slideshow");

		}

	}

	/*end delete removeBlocksSlideshow*/

	

	/*check ordering*/

	public function check_ordering()

	{

			$ordering_slide_show=$this->input->post('ordering_slide_show');

			/*list id slide_show*/

				$listSlideshows=$this->input->post('idSlideshow');

			/* get idslide_show*/

				$idSlideshow=$this->input->post('t');

			/*get stt input ordering*/

				$stt=$this->input->post('stt');

			

			/* update record with ordering*/

			$data=array(

			'ordering_slide_show' =>$ordering_slide_show[$stt]

			);

			$this->m_blocks_slideshow->check_ordering($idSlideshow,$data);

			/* update all record with ordering*/

			$listSlideshow=$this->m_blocks_slideshow->listBlocksSlideshow();

			$stt=0;

			foreach($listSlideshow as $menu){

				if($menu->ordering_slide_show!=$stt+1)

				{

					$data=array(

					'ordering_slide_show' =>$stt+1

					);

					$this->m_blocks_slideshow->check_ordering($menu->idSlideshow,$data);

				}

				$stt++;

				

			}

			redirect($_SERVER['HTTP_REFERER']);

		

	}

	/*end check ordering*/

	/*check ordering previous*/

	public function check_ordering_previous($idSlideshow,$ordering_slide_show)

	{

			/* update next record with ordering*/

			$getOrderingPrevious=$this->m_blocks_slideshow->getOrderingPrevious($ordering_slide_show);

			$data=array(

			'ordering_slide_show' =>$ordering_slide_show

			);

			$this->m_blocks_slideshow->check_ordering($getOrderingPrevious[0]->idSlideshow,$data);

			/* update record with ordering*/

			$data=array(

			'ordering_slide_show' =>$ordering_slide_show+1

			);

			$this->m_blocks_slideshow->check_ordering($idSlideshow,$data);

			redirect($_SERVER['HTTP_REFERER']);

	}

	/*end check ordering previous*/

	/*check ordering next */

	public function check_ordering_next($idSlideshow,$ordering_slide_show)

	{

			/* update next record with ordering*/

			$getOrderingNext=$this->m_blocks_slideshow->getOrderingNext($ordering_slide_show);

			$data=array(

			'ordering_slide_show' =>$ordering_slide_show

			);

			$this->m_blocks_slideshow->check_ordering($getOrderingNext[0]->idSlideshow,$data);

			/* update record with ordering*/

			$data=array(

			'ordering_slide_show' =>$ordering_slide_show-1

			);

			$this->m_blocks_slideshow->check_ordering($idSlideshow,$data);

			redirect($_SERVER['HTTP_REFERER']);

	}

	/*end check ordering next*/

	

}