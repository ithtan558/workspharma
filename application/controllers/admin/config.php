<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION))@session_start();
require_once(APPPATH . 'controllers/admin/admin_application.php');
class Config extends Admin_application{
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
	public function index()
	{
		//sent data
			$this->_data['config']=1;
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/config/main';
		//get data
			$this->_data['listConfig']=$this->m_config->listConfig();
			$this->load->view('admin/main',$this->_data);
	}
	public function add_config()
	{
			$this->_data['add_config']=1;
		//sent data
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/config/addConfig';
		//get data
			$this->load->view('admin/main',$this->_data);
	}
	public function check_add_config()
	{
		//sent data
			$this->_data['add_config']=1;
			$action=$this->input->post("t");
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/config/addConfig';
		//get data
			$value=$this->input->post('value');
			$name=$this->input->post('name');
			$data=array(
			'idConfig'   => 'NULL',
			'value' =>$value,
			'name' =>$name
			);
			$this->_data['messages']='Thêm thành công.';
			$this->m_config->addConfig($data);
			if($action=='save')
			{
				$this->_data['template']='admin/bodyright/config/addConfig';
			}
			else
			{
				//$this->_data['template']='admin/bodyright/config/main';
				//$this->_data['listConfig']=$this->m_config->listConfig();
				redirect(URL."admin/config");
			}
			$this->_data['listConfig']=$this->m_config->listConfig();
			$this->load->view('admin/main',$this->_data);
	}
	public function sua_config($idConfig)
	{
		$this->_data['config_default']=1;
		//sent data
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/config/editConfig';
		//get data
			$this->_data['getConfig']=$this->m_config->getConfig($idConfig);
			$this->load->view('admin/main',$this->_data);
	}
	public function check_sua_config($idConfig)
	{
		//sent data
			$this->_data['add_config']=1;
			$this->_data['title']=$this->config->item("title_index");
			$action=$this->input->post('t');
		//get data;
			$value=$this->input->post('value');
			$name=$this->input->post('name');
			$data=array(
			'value' =>$value,
			// 'name' =>$name
			);
			$this->m_config->editConfig($idConfig,$data);
			if($action=='save')
			{
				$this->_data['template']='admin/bodyright/config/editConfig';
				$this->_data['getConfig']=$this->m_config->getConfig($idConfig);
			}
			else
			{
				//$this->_data['template']='admin/bodyright/config/main';
				//$this->_data['listConfig']=$this->m_config->listConfig();
				redirect(URL."admin/config");
			}
			$this->_data['messages']='Sữa cấu hình thành công.';
			$this->load->view('admin/main',$this->_data);
	}
	public function duyet($status,$id)
	{
		//sent data
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/config/main';
		//get data
			$this->m_config->duyet($status,$id);
			redirect(URL."admin/config");
			//$this->_data['listConfig']=$this->m_config->listConfig();
			//$this->load->view('admin/main',$this->_data);
	}
	public function remove_config()
	{
		if(isset($_POST["btnDeleteall"]))
		{
			if(empty($_POST['delete']))
			redirect(URL.'admin/config');
			foreach($_POST['delete'] as $id)
			{
				//remove don hang
				$this->m_config->remove_config($id);
			}
			redirect(URL."admin/config");
		}
	}
}