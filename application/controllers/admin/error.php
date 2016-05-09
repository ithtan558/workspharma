<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION))@session_start();
require_once(APPPATH . 'controllers/admin/admin_application.php');
class Error extends CI_Controller{
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
		$this->_data['config_default']=1;	
		/*hepler*/
			$this->load->helper("url");
			$this->load->helper("getalias");		
		/*Load model*/
			$this->load->Model("admin/config/m_config");
	}
	public function viewAccessdenied()
	{
		//sent data
			$this->_data['config']=1;
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/errorPermission';
		//get data
			$this->load->view('admin/main',$this->_data);
		
	}
	
}