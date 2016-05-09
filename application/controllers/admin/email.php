<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!isset($_SESSION))@session_start();

require_once(APPPATH . 'controllers/admin/admin_application.php');

class Email extends Admin_application{

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

		$this->_data['email']=1;	

		$this->_data['email_default']=1;	

		/*hepler*/

			$this->load->helper("url");

			$this->load->helper("getalias");		

		/*Load model*/

			$this->load->Model("admin/email/m_email");

	}

	

	public function index()

	{

		//sent data

			$this->_data['title']=$this->config->item("title_index");

			$this->_data['template']='admin/bodyright/email/main';

		//get data

			$this->_data['listEmail']=$this->m_email->listEmail();

			$this->load->view('admin/main',$this->_data);

		

	}

	

	public function enable($enable,$id)

	{

		//sent data

			$this->_data['title']=$this->config->item("title_index");

			$this->_data['template']='admin/bodyright/email/main';

		//get data

			$this->m_email->enable($enable,$id);

			

			$this->_data['listEmail']=$this->m_email->listEmail();

			$this->load->view('admin/main',$this->_data);

		

	}

	public function removeEmail()

	{

		if(isset($_POST["btnDeleteall"]))

		{

			if(empty($_POST['delete']))

			redirect(URL.'admin/email');

			foreach($_POST['delete'] as $id)

			{

				//remove don hang

				$this->m_email->removeEmail($id);

			}

			redirect(URL."admin/email");

		}

	}	

}