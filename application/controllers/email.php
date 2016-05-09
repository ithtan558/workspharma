<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION))@session_start();
require_once(APPPATH . 'controllers/application.php');
class Email extends Application{
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
		/*session*/
			$this->load->library('session');
		/*Load model*/
			$this->load->Model("m_email");
		
		
	}
	public function index()
	{
		$this->_data['home']=1;
		$this->_data['nothome']=1;
		$name_email=$this->input->post("name_email");
		$data=array(
		'idEmail'   => 'NULL',
		'name_email' => $name_email,
		'enable_email' => 1,
		);
		$this->m_email->addEmail($data);
	}
}
