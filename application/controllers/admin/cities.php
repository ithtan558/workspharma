<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION))@session_start();
require_once(APPPATH . 'controllers/admin/admin_application.php');
class Cities extends Admin_application{
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
		$this->_data['cities_default']=1;
		/*hepler*/
			$this->load->helper("url");
		/*Load model*/
			$this->load->Model("admin/menu/m_menu");
			$this->load->Model("admin/cities/m_cities");
			$this->_gallery_url = base_url()."public/images";
	}
	/*load function index default*/
	public function index($id=false)
	{
		//sent data
			$this->_data['cities']=1;	
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/cities/main';
		//list articles categories
			$listCities=$this->m_cities->listCities();
			$this->_data['listCities']=$listCities;
		//load view
			$this->load->view('admin/main',$this->_data);
	}
	/*end load function index default*/
	/*load function add articles categories*/
	public function add_cities()
	{
		//sent data
			$this->_data['add_cities']=1;
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/cities/addCities';
		//load view
			$this->load->view('admin/main',$this->_data);
	}
	/*end load function add articles categories*/
	/*load function check add articles categories*/
	public function check_add_cities()
	{					
		//sent data
			$action=$this->input->post('t');
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/cities/main';
		//get data
			$city_name=$this->input->post('city_name');
			$data=array(
				'id'   => 'NULL',
				'city_name' => $city_name
			);
			$this->m_cities->addCities($data);
			//if action == save then action is save else action is save and close
			if($action=='save')
			{
				//lists custom sent data
				//$this->_data['listcities']=$this->m_cities->listcities();
					//$this->_data['template']='admin/bodyright/cities/addcities';
					//$this->_data['messages']='Thêm danh mục bài viết thành công.';
					redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				//$this->_data['listArticle']=$this->m_article->listArticle();
				//$this->_data['template']='admin/bodyright/article/main';
				redirect(URL."admin/cities");
			}
			$this->_data['messages']='Thêm cities thành công.';
			//call function addArticle in model
			//load view
			$this->load->view('admin/main',$this->_data);
	}
	/*end load function check add articles categories*/
	/*load function edit articles categories*/
	public function edit_cities($id)
	{
		//sent data
			$this->_data['add_cities']=1;
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/cities/editCities';
			$this->_data['getCities']=$this->m_cities->getCities($id);
		//load view
			$this->load->view('admin/main',$this->_data);
	}
	/*end load function check edit articles categories*/
	public function check_edit_cities($id)
	{
			$action=$this->input->post('t');
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/cities/main';
			$city_name=$this->input->post('city_name');
			$data=array(
			'city_name' => $city_name
			);
			$this->m_cities->eidtcities($id,$data);
			if($action=='save')
			{
				//lists custom sent data
				//$this->_data['listcities']=$this->m_cities->listcities();
					$this->_data['getCities']=$this->m_cities->getCities($id);
					$this->_data['template']='admin/bodyright/cities/editCities';
					$this->_data['messages']='Sữa danh mục bài viết thành công.';
			}
			else
			{
				//$this->_data['listArticle']=$this->m_article->listArticle();
				//$this->_data['template']='admin/bodyright/article/main';
				redirect(URL."admin/cities");
			}
			$this->_data['listcities']=$this->m_cities->listcities();
			$this->_data['getCities']=$this->m_cities->getCities($id);
			$this->load->view('admin/main',$this->_data);
	}
	/*end load function check edit articles categories*/
	//enable articles categories
	public function enable($enable,$id)
	{
		//sent data
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/cities/main';
		//load function enable model
			$this->m_cities->enable($enable,$id);
			$this->_data['listcities']=$this->m_cities->listcities();
			$this->load->view('admin/main',$this->_data);
	}
	//end enable articles categories
	/*Delete articles categories*/
		public function remove_cities()
		{
			if(isset($_POST["btnDeleteall"]))
			{
				if(empty($_POST['delete']))
				redirect(URL.'admin/cities');
				foreach($_POST['delete'] as $id)
				{
					//remove don hang
					$this->m_cities->removecities($id);
				}
				redirect(URL."admin/cities");
			}
		}
	/*end delete articles categories*/
}