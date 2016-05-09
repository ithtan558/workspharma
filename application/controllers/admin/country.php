<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION))@session_start();
require_once(APPPATH . 'controllers/admin/admin_application.php');
class Country extends Admin_application{
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
		$this->_data['country_default']=1;
		/*hepler*/
			$this->load->helper("url");
		/*Load model*/
			$this->load->Model("admin/menu/m_menu");
			$this->load->Model("admin/country/m_country");
			$this->_gallery_url = base_url()."public/images";
	}
	/*load function index default*/
	public function index($id=false)
	{
		//sent data
			$this->_data['country']=1;	
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/country/main';
		//list articles categories
			$listCountry=$this->m_country->listCountry();
			$this->_data['listCountry']=$listCountry;
		//load view
			$this->load->view('admin/main',$this->_data);
	}
	/*end load function index default*/
	/*load function add articles categories*/
	public function add_country()
	{
		//sent data
			$this->_data['add_country']=1;
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/country/addCountry';
		//load view
			$this->load->view('admin/main',$this->_data);
	}
	/*end load function add articles categories*/
	/*load function check add articles categories*/
	public function check_add_country()
	{					
		//sent data
			$action=$this->input->post('t');
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/country/main';
		//get data
			$country_name=$this->input->post('country_name');
			$data=array(
				'id'   => 'NULL',
				'country_name' => $country_name
			);
			$this->m_country->addCountry($data);
			//if action == save then action is save else action is save and close
			if($action=='save')
			{
				//lists custom sent data
				//$this->_data['listCountry']=$this->m_country->listCountry();
					//$this->_data['template']='admin/bodyright/country/addCountry';
					//$this->_data['messages']='Thêm danh mục bài viết thành công.';
					redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				//$this->_data['listArticle']=$this->m_article->listArticle();
				//$this->_data['template']='admin/bodyright/article/main';
				redirect(URL."admin/country");
			}
			$this->_data['messages']='Thêm danh mục bài viết thành công.';
			//call function addArticle in model
			//load view
			$this->load->view('admin/main',$this->_data);
	}
	/*end load function check add articles categories*/
	/*load function edit articles categories*/
	public function edit_country($id)
	{
		//sent data
			$this->_data['add_country']=1;
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/country/editCountry';
			$this->_data['getCountry']=$this->m_country->getCountry($id);
		//load view
			$this->load->view('admin/main',$this->_data);
	}
	/*end load function check edit articles categories*/
	public function check_edit_country($id)
	{
			$action=$this->input->post('t');
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/country/main';
			$country_name=$this->input->post('country_name');
			$data=array(
			'country_name' => $country_name
			);
			$this->m_country->eidtCountry($id,$data);
			if($action=='save')
			{
				//lists custom sent data
				//$this->_data['listCountry']=$this->m_country->listCountry();
					$this->_data['getCountry']=$this->m_country->getCountry($id);
					$this->_data['template']='admin/bodyright/country/editCountry';
					$this->_data['messages']='Sữa danh mục bài viết thành công.';
			}
			else
			{
				//$this->_data['listArticle']=$this->m_article->listArticle();
				//$this->_data['template']='admin/bodyright/article/main';
				redirect(URL."admin/country");
			}
			$this->_data['listCountry']=$this->m_country->listCountry();
			$this->_data['getCountry']=$this->m_country->getCountry($id);
			$this->load->view('admin/main',$this->_data);
	}
	/*end load function check edit articles categories*/
	//enable articles categories
	public function enable($enable,$id)
	{
		//sent data
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/country/main';
		//load function enable model
			$this->m_country->enable($enable,$id);
			$this->_data['listCountry']=$this->m_country->listCountry();
			$this->load->view('admin/main',$this->_data);
	}
	//end enable articles categories
	/*Delete articles categories*/
		public function remove_country()
		{
			if(isset($_POST["btnDeleteall"]))
			{
				if(empty($_POST['delete']))
				redirect(URL.'admin/country');
				foreach($_POST['delete'] as $id)
				{
					//remove don hang
					$this->m_country->removeCountry($id);
				}
				redirect(URL."admin/country");
			}
		}
	/*end delete articles categories*/
}