<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION))@session_start();
require_once(APPPATH . 'controllers/admin/admin_application.php');
class Main extends Admin_application{
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
			$this->load->Model("admin/login/m_login");
			$this->_data['config']=1;
	}
	public function index()
	{
		//sent data
			
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/main';
			$this->_data['numberlogin']=$this->m_login->check_number_login();
		/*end dử liệu gửi*/
		//kiểm tra thời gian để mơ khóa cho người dùng
			$listLimitLogin=$this->m_login->getIp();
			if($listLimitLogin)
			{
				
				$date=strtotime($listLimitLogin[0]->time_last);
				$time_conlai=10-date('i:s',(time()-$date));
				if($time_conlai<0)
				{
					if($this->m_login->deleteIp());
				}
			}
		//end kiểm tra thời gian để mơ khóa cho người dùng
		
		//Kiểm tra đã đăng nhập thành công hay chưa
			if($this->session->userdata('validated'))
			{
				
				if($this->session->userdata('__ma_quyen__')==1)
				{
					$this->load->view('admin/main',$this->_data);
				}
				
			}
			else
			{
				$this->load->view('admin/login',$this->_data);
			}
			
		//end Kiểm tra đã đăng nhập thành công hay chưa
	}
	public function limitlogin()
	{
		
		$this->_data['title']=$this->config->item("title_index");
		$this->_data['listLimitLogin']=$this->m_login->getIp();
		$this->load->view('admin/limitlogin',$this->_data);
	}
	//xử lý đăng nhập
    public function check_admin_login(){
        // Load the model
		$email=$this->input->post('email');
		$matkhau=$this->input->post('pass');
        // Validate the user can login
        $result = $this->m_login->check_admin_login($email,$matkhau);
        // Now we verify the result
        if($result)
		{
		 	echo "true";
		}
		else{
			echo "false";
		}
    }
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */