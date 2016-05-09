<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION))@session_start();
require_once(APPPATH . 'controllers/application.php');
class Sitemap extends Application{
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
		/*hepler*/
			$this->load->helper("url");
			$this->load->Model("body/sitemap/m_sitemap");
	}
	public function index()
	{
	
		//end ajax phân trang
			$getNameMenu=$this->m_sitemap->getNameMenu();
			$this->_data['name']=$getNameMenu[0]->title_menus;
			$this->_data['home']=$this->uri->segment(1);
			$this->_data['nothome']=0;
			$this->_data['listMenuSiteMap']=$this->m_sitemap->listMenuSiteMap();
			$this->_data['listMenuChildSiteMap']=$this->m_sitemap->listMenuChildSiteMap();
			
			$getNameMenu=$this->m_sitemap->getNameMenu();
			
			$this->_data['title']=$getNameMenu[0]->title;

			$this->_data['description']=$getNameMenu[0]->description;

			$this->_data['keywords']=$getNameMenu[0]->keywords;
			$this->_data['template']='sitemap';
			$this->load->view('index',$this->_data);
	}	
}
