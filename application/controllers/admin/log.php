<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION))@session_start();
require_once(APPPATH . 'controllers/admin/admin_application.php');
class Log extends Admin_application{
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
		$this->_data['log_default']=1;
		/*hepler*/
			$this->load->helper("url");		
		/*Load model*/
			$this->load->Model("admin/log/m_log");
	}
	
	public function index()
	{
		//sent data
			$this->_data['log']=1;	
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/log/main';
			//get data
			$this->_data['listLog']=$this->m_log->listLog();
			$this->load->view('admin/main',$this->_data);
		
	}
	
	public function unlogined()
	{
		//sent data
			$this->_data['unlogined']=1;	
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/log/limitLogin';
			//get data
			$this->_data['listUnlogined']=$this->m_log->listUnlogined();
			$this->load->view('admin/main',$this->_data);
		
	}
	
	/*Delete hình ảnh*/
		public function removeLog()
		{
			if(isset($_POST["btnDeleteall"]))
			{
				if(empty($_POST['delete']))
				redirect(URL.'admin/log');
				foreach($_POST['delete'] as $id)
				{
					//remove don hang
					$this->m_log->removeLog($id);
				}
				redirect(URL."admin/log");
			}
		}
	/*end delete hình ảnh*/
	
	/*Delete hình ảnh*/
		public function removeUnlogined()
		{
			if(isset($_POST["btnDeleteall"]))
			{
				if(empty($_POST['delete']))
				redirect(URL.'admin/log/unlogined');
				foreach($_POST['delete'] as $id)
				{
					//remove don hang
					$this->m_log->removeUnlogined($id);
				}
				redirect(URL."admin/log/unlogined");
			}
		}
	/*end delete hình ảnh*/
}