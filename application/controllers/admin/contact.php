<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION))@session_start();
require_once(APPPATH . 'controllers/admin/admin_application.php');
class Contact extends Admin_application{
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
		/*hepler*/
			$this->load->helper("url");	
			$this->load->helper("getalias");		
		/*Load model*/
			$this->load->Model("admin/contact/m_contact");
	}
	public function index()
	{
		//sent data
			$this->_data['contact']=1;	
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/contact/main';
		//get data
			$this->_data['listContact']=$this->m_contact->listContact();
			$this->load->view('admin/main',$this->_data);
		
	}
	
	public function add_contact()
	{
		//sent data
			$this->_data['add_contact']=1;
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/contact/addContact';
		//get data
			$this->load->view('admin/main',$this->_data);
		
	}
	
	public function check_add_contact()
	{
		//get data
			$action=$this->input->post('t');
			$name_contact=$this->input->post('name_contact');
			$address_contact=$this->input->post('address_contact');
			
			
			$website_contact=$this->input->post('website_contact');
			$email_contact=$this->input->post('email_contact');
			$telephone_contact=$this->input->post('telephone_contact');
			$mobilephone_contact=$this->input->post('mobilephone_contact');
			$fax_contact=$this->input->post('fax_contact');
			$yahoo_contact=$this->input->post('yahoo_contact');
			$skype_contact=$this->input->post('skype_contact');
			$enable_contact=$this->input->post('enable_contact');
			$data=array(
			'idContact'   => 'NULL',
			'name_contact' =>$name_contact,
			
			'address_contact' =>$address_contact,
			
			'website_contact' =>$website_contact,
			'email_contact' =>$email_contact,
			'telephone_contact' =>$telephone_contact,
			'mobilephone_contact' =>$mobilephone_contact,
			'fax_contact' =>$fax_contact,
			'yahoo_contact' =>$yahoo_contact,
			'skype_contact' =>$skype_contact,
			'enable_contact' =>$enable_contact,
			);
			$this->_data['title']=$this->config->item("title_index");
			if($action=='save')
			{
				$this->_data['template']='admin/bodyright/contact/addContact';
			}
			else
			{
				$this->_data['template']='admin/bodyright/contact/main';
			}
			$this->_data['messages']='Thêm liên hệ thành công.';
			$this->m_contact->addContact($data);
			$this->_data['listContact']=$this->m_contact->listContact();
			$this->load->view('admin/main',$this->_data);
		
	}
	public function edit_contact($idLoai)
	{
		//sent data
			$this->_data['add_contact']=1;
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/contact/editContact';
		//get data
			$this->_data['getContact']=$this->m_contact->getContact($idLoai);
			$this->load->view('admin/main',$this->_data);
		
	}
	
	public function check_edit_contact($idLoai)
	{
		//sent data
			$this->_data['title']=$this->config->item("title_index");
			$action=$this->input->post('t');
			$name_contact=$this->input->post('name_contact');
			$address_contact=$this->input->post('address_contact');
			
			
			$website_contact=$this->input->post('website_contact');
			$email_contact=$this->input->post('email_contact');
			$telephone_contact=$this->input->post('telephone_contact');
			$mobilephone_contact=$this->input->post('mobilephone_contact');
			$fax_contact=$this->input->post('fax_contact');
			$yahoo_contact=$this->input->post('yahoo_contact');
			$skype_contact=$this->input->post('skype_contact');
			$enable_contact=$this->input->post('enable_contact');
			$data=array(
			'name_contact' =>$name_contact,
			
			'address_contact' =>$address_contact,
			
			'website_contact' =>$website_contact,
			'email_contact' =>$email_contact,
			'telephone_contact' =>$telephone_contact,
			'mobilephone_contact' =>$mobilephone_contact,
			'fax_contact' =>$fax_contact,
			'yahoo_contact' =>$yahoo_contact,
			'skype_contact' =>$skype_contact,
			'enable_contact' =>$enable_contact,
			);
			$this->_data['title']=$this->config->item("title_index");
			$this->m_contact->editcontact($idLoai,$data);
			if($action=='save')
			{
				$this->_data['template']='admin/bodyright/contact/editContact';
				$this->_data['getContact']=$this->m_contact->getContact($idLoai);
			}
			else
			{
				$this->_data['template']='admin/bodyright/contact/main';
				$this->_data['listContact']=$this->m_contact->listContact();
			}
			$this->_data['messages']='Sữa liên hệ thành công.';
			
			
			$this->load->view('admin/main',$this->_data);
		
	}
	
	public function enable($status,$id)
	{
		//sent data
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/contact/main';
		//get data
			$this->m_contact->enable($status,$id);
			$this->_data['listContact']=$this->m_contact->listContact();
			$this->load->view('admin/main',$this->_data);
		
	}
	
		public function removecontact()
		{
			if(isset($_POST["btnDeleteall"]))
			{
				if(empty($_POST['delete']))
				redirect(URL.'admin/contact');
				foreach($_POST['delete'] as $id)
				{
					//remove don hang
					$this->m_contact->removecontact($id);
				}
				redirect(URL."admin/contact");
			}
		}
		
		public function check_ordering()
		{
				$ordering_contact=$this->input->post('ordering_contact');
				/*list id contact*/
					$listcontact=$this->input->post('idContact');
				/* get idContact*/
					$idContact=$this->input->post('t');
				/*get stt input ordering*/
					$stt=$this->input->post('stt');
				/* update record with ordering*/
				$data=array(
	
				'ordering_contact' =>$ordering_contact[$stt]
	
				);
	
				$this->m_contact->check_ordering($idContact,$data);
	
				/* update all record with ordering*/
	
				$listContact=$this->m_contact->listContact();
	
				$stt=0;
	
				foreach($listContact as $Contact){
	
					if($Contact->ordering_contact!=$stt+1)
	
					{
	
						$data=array(
	
						'ordering_contact' =>$stt+1
	
						);
	
						$this->m_contact->check_ordering($Contact->idContact,$data);
	
					}
	
					$stt++;
	
					
	
				}
	
				redirect($_SERVER['HTTP_REFERER']);
	
			
	
		}
	
		/*end check ordering*/
	
		/*check ordering previous*/
	
		public function check_ordering_previous($idContact,$ordering_contact)
	
		{
	
				/* update next record with ordering*/
	
				$getOrderingPrevious=$this->m_contact->getOrderingPrevious($ordering_contact);
	
				$data=array(
	
				'ordering_contact' =>$ordering_contact
	
				);
	
				$this->m_contact->check_ordering($getOrderingPrevious[0]->idContact,$data);
	
				/* update record with ordering*/
	
				$data=array(
	
				'ordering_contact' =>$ordering_contact+1
	
				);
	
				$this->m_contact->check_ordering($idContact,$data);
	
				redirect($_SERVER['HTTP_REFERER']);
	
		}
	
		/*end check ordering previous*/
	
		/*check ordering next */
	
		public function check_ordering_next($idContact,$ordering_contact)
	
		{
	
				/* update next record with ordering*/
	
				$getOrderingNext=$this->m_contact->getOrderingNext($ordering_contact);
	
				$data=array(
	
				'ordering_contact' =>$ordering_contact
	
				);
	
				$this->m_contact->check_ordering($getOrderingNext[0]->idContact,$data);
	
				/* update record with ordering*/
	
				$data=array(
	
				'ordering_contact' =>$ordering_contact-1
	
				);
	
				$this->m_contact->check_ordering($idContact,$data);
	
				redirect($_SERVER['HTTP_REFERER']);
	
		}
	
		/*end check ordering next*/
	
}