<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION))@session_start();
require_once(APPPATH . 'controllers/admin/admin_application.php');
class Language extends Admin_application{
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
		$this->_data['languages_defautl']=1;
		$this->_data['language']=1;	
		/*hepler*/
			$this->load->helper("url");	
			$this->load->helper("getalias");		
		/*Load model*/
			$this->load->Model("admin/languages/m_languages");
	}
	public function index()
	{
		//sent data
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/language/main';
		//get data
			$this->_data['listLanguages']=$this->m_languages->listLanguages();
			$this->load->view('admin/main',$this->_data);
		
	}
	
	public function add_languages()
	{
		//sent data
			
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/language/addLanguages';
			//get data
			$this->load->view('admin/main',$this->_data);
		
	}
	
	public function check_add_languages()
	{
		//sent data
			//get data
			$action=$this->input->post('t');
			$code_languages=$this->input->post('code_languages');
			$name_languages=$this->input->post('name_languages');
			$enable_languages=$this->input->post('enable_languages');
			$data=array(
			'idLanguages'   => 'NULL',
			'code_languages' =>$code_languages,
			'name_languages' =>$name_languages,
			'enable_languages' =>$enable_languages
			);
			$this->_data['title']=$this->config->item("title_index");
			if($action=='save')
			{
				$this->_data['template']='admin/bodyright/language/addLanguages';
			}
			else
			{
				$this->_data['template']='admin/bodyright/language/main';
			}
			$this->_data['messages']='Thêm loại thành công.';
			$this->m_languages->addLanguages($data);
			$this->_data['listLanguages']=$this->m_languages->listLanguages();
			$this->load->view('admin/main',$this->_data);
		
	}
	
	public function edit_languages($idLanguagess)
	{
		//sent data
			
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/language/editLanguages';
			//get data
			$this->_data['getLanguages']=$this->m_languages->getLanguages($idLanguagess);
			$this->load->view('admin/main',$this->_data);
		
	}
	
	public function check_edit_languages($idLanguagess)
	{
		//sent data
			$this->_data['title']=$this->config->item("title_index");
			$action=$this->input->post('t');
			$code_languages=$this->input->post('code_languages');
			$name_languages=$this->input->post('name_languages');
			$enable_languages=$this->input->post('enable_languages');
			$data=array(
			'code_languages' =>$code_languages,
			'name_languages' =>$name_languages,
			'enable_languages' =>$enable_languages
			);
			$this->_data['title']=$this->config->item("title_index");
			$this->m_languages->editLanguages($idLanguagess,$data);
			if($action=='save')
			{
				$this->_data['template']='admin/bodyright/language/editLanguagess';
				$this->_data['getLanguages']=$this->m_languages->getLanguages($idLanguagess);
			}
			else
			{
				$this->_data['template']='admin/bodyright/language/main';
				$this->_data['listLanguages']=$this->m_languages->listLanguages();
			}
			$this->_data['messages']='Sữa loại thành công.';
			
			
			$this->load->view('admin/main',$this->_data);
		
	}
	
	public function enable($status,$id)
	{
		//sent data
			
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/language/main';
			//get data
			$this->m_languages->enable($status,$id);
			$this->_data['listLanguages']=$this->m_languages->listLanguages();
			$this->load->view('admin/main',$this->_data);
		
	}
	public function defaults($status,$id)
	{
		//sent data
			
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/language/main';
			//get data
			$this->m_languages->defaults($status,$id);
			$this->_data['listLanguages']=$this->m_languages->listLanguages();
			$this->load->view('admin/main',$this->_data);
		
	}
	
	/*Delete loại*/
		public function removeLanguages()
		{
			if(isset($_POST["btnDeleteall"]))
			{
				if(empty($_POST['delete']))
				redirect(URL.'admin/language');
				foreach($_POST['delete'] as $id)
				{
					//remove don hang
					$this->m_languages->removeLanguages($id);
				}
				redirect(URL."admin/language");
			}
		}
	/*end delete loại*/
	
}