<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION))@session_start();
require_once(APPPATH . 'controllers/admin/admin_application.php');
class Contact_config extends Admin_application{
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
		$this->_data['contact_default']=1;
		$this->_data['contact_config']=1;	
		/*hepler*/
			$this->load->helper("url");	
			$this->load->helper("getalias");		
		/*Load model*/
			$this->load->Model("admin/contact_config/m_contact_config");
	}
	public function index()
	{
		//sent data
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/contact_config/editContact_Config';
		//get data
			$this->_data['getContactConfig']=$this->m_contact_config->getContactConfig();
			$this->load->view('admin/main',$this->_data);
		
	}
	public function check_edit_contact_config()
	{
		//sent data
			$this->_data['title']=$this->config->item("title_index");
			$action=$this->input->post('t');
			//$this->m_contact_config->do_upload();
			$infotext_contact_config=$this->input->post('infotext_contact_config');
			$gmapcode_contact_config=$this->input->post('gmapcode_contact_config');
			$gmapcode1_contact_config=$this->input->post('gmapcode1_contact_config');
			$sendto_contact_config=$this->input->post('sendto_contact_config');
			$replycontent_contact_config=$this->input->post('replycontent_contact_config');
			$data=array(
			'infotext_contact_config' =>$infotext_contact_config,
			'gmapcode_contact_config' =>$gmapcode_contact_config,
			'gmapcode1_contact_config' =>$gmapcode1_contact_config,
			'sendto_contact_config' =>$sendto_contact_config,
			'replycontent_contact_config' =>$replycontent_contact_config,
			);
			$this->_data['title']=$this->config->item("title_index");
			$this->m_contact_config->editContactConfig($data);
			$this->_data['template']='admin/bodyright/contact_config/editContact_Config';
			$this->_data['getContactConfig']=$this->m_contact_config->getContactConfig();
			$this->_data['messages']='Sữa liên hệ thành công.';
			$this->load->view('admin/main',$this->_data);
		
	}
}