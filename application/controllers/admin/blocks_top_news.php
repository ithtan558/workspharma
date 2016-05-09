<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!isset($_SESSION))@session_start();

require_once(APPPATH . 'controllers/admin/admin_application.php');

class Blocks_top_news extends Admin_application{

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

		$this->_data['blocks_default']=1;	

		$this->_data['blocks_top_news']=1;	

		/*hepler*/

			$this->load->helper("url");

			$this->load->helper("getalias");		

		/*Load model*/

			$this->load->Model("admin/block/m_blocks_top_news");

			$this->_gallery_url = base_url()."public/images";

	}

	/*load function index default*/

	public function index()

	{

		//sent data

			

			$this->_data['title']=$this->config->item("title_index");

			$this->_data['template']='admin/bodyright/block/blocks_top_news/main';

			//list customer model

			$this->_data['listBlocksTopNews']=$this->m_blocks_top_news->listBlocksTopNews();

			$this->load->view('admin/main',$this->_data);

		

	}

	/*end load function index default*/

	/*load function add_blocks_top_news*/

	public function add_blocks_top_news()

	{

		//sent data

			

			$this->_data['title']=$this->config->item("title_index");

			$this->_data['template']='admin/bodyright/block/blocks_top_news/addBlocksTopNews';

			$this->_data['listBlocksNotTopNews']=$this->m_blocks_top_news->listBlocksNotTopNews();

			//list customer model

			$this->load->view('admin/main',$this->_data);

		

	}

	/*end load function add_blocks_top_news*/

	/*load function check_add_blocks_top_news*/

	public function check_add_blocks_top_news()

	{	

			if(isset($_POST["btnAddall"]))

			{

				if(empty($_POST['add']))

				redirect(URL.'admin/blocks_top_news');

				foreach($_POST['add'] as $id)

				{

					//remove don hang

					$data=array(

						'is_top_news' => 1

					);

					$this->m_blocks_top_news->addBlocksTopNews($id,$data);

				}

				redirect(URL."admin/blocks_top_news");

			}

			$this->_data['listBlocksNotNew']=$this->m_blocks_top_news->listBlocksNotNew();

			$this->_data['template']='admin/bodyright/block/blocks_top_news/addBlocksTopNews';

			$this->_data['messages']='Thêm block tin tức mới nhất thành công.';

			$this->_data['listBlocksTopNews']=$this->m_blocks_top_news->listBlocksTopNews();

			$this->load->view('admin/main',$this->_data);

		

	}

	/*end load function check_add_blocks_top_news*/

	/*load function removeBlocksTopNews*/

	public function removeBlocksTopNews()

	{	

			if(isset($_POST["btnDeleteall"]))

			{

				if(empty($_POST['delete']))

				redirect(URL.'admin/blocks_top_news');

				foreach($_POST['delete'] as $id)

				{

					//remove don hang

					$data=array(

						'is_top_news' => 0

					);

					$this->m_blocks_top_news->removeBlocksTopNews($id,$data);

				}

				redirect(URL."admin/blocks_top_news");

			}

			$this->_data['listBlocksNotTopNews']=$this->m_blocks_top_news->listBlocksNotTopNews();

			$this->_data['template']='admin/bodyright/block/blocks_top_news/addBlocksTopNews';

			$this->_data['messages']='Thêm block tin tức mới nhất thành công.';

			$this->_data['listBlocksTopNews']=$this->m_blocks_top_news->listBlocksTopNews();

			$this->load->view('admin/main',$this->_data);

		

	}

	/*end load function removeBlocksTopNews*/

	

}