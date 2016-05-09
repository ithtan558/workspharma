<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION))@session_start();
require_once(APPPATH . 'controllers/application.php');
class Contact extends Application{
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
			$this->load->helper("getalias");
			$this->load->library('session');		
		/*Load model*/
			$this->load->Model("m_contact");
			$this->_data['home']=$this->uri->segment(1);
			$this->_data['nothome']=0;
	}
	public function addContact()
	{
		$content_contact = $this->input->post('content_contact',true);
		$subject_contact = $this->input->post('subject_contact',true);
		$email_contact = $this->input->post('email_contact',true);
		$phone_contact = $this->input->post('phone_contact',true);
		$person_contact = $this->input->post('person_contact',true);
		$message = $this->lang->line('Contact success');
        $this->session->set_flashdata('flash_message', setMessage('success', $message));
        $paramBody = array(
        	'!person' => $person_contact,
        	'!phone' => $phone_contact,
        	'!body' => $content_contact
        );
        $this->email->mailFrom = $email_contact;
        $this->email->mailTo = $this->config->item('email_send_contact');
        $this->email->templateType = 'contact';
        $this->email->paramBody = $paramBody;
        $this->email->sendMail();
        redirect($this->lang->line('l_contact'));
		
	}
	
}