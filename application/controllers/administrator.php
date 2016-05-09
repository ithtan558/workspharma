<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION))@session_start();
class Administrator extends CI_Controller{
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
		$this->_data['config']=1;
		/*hepler*/
			$this->load->helper("url");
		/*session*/
			$this->load->library('session');
			$this->load->library('email');
		/*Load model*/
			$this->load->Model("admin/login/m_login");
			$this->load->Model("admin/config/m_config");
	}
	public function index()
	{
		//sent data
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/config/main';
			$this->_data['numberlogin']=$this->m_login->check_number_login();
			//default load module config
			$this->_data['listConfig']=$this->m_config->listConfig();
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
		//send captcha
			$this->load->model('admin/login/captcha_model');
			if(empty($_POST))
			{
				$captcha = $this->captcha_model->generateCaptcha();
				$_SESSION['captchaWord'] = $captcha['word'];
				$this->_data['captcha'] = $captcha;
			}
		//end send captcha
		//create folder auto
			$pathArticles = "./public/images/articles/".date("m_Y");
			$pathVideo = "./public/images/video/".date("m_Y");
			$pathProducts = "./public/images/products/".date("m_Y");
			$pathProductsCategories = "./public/images/products/products_categories/".date("m_Y");
			if(!is_dir($pathArticles)) //create the folder if it's not already exists
			{
				if(MKDIR_HOST!=1){
					mkdir($pathArticles,0777,TRUE);
				}
				else
				{
					parent::connect();
					if($this->ftp->mkdir($pathArticles, 0777));
					$this->ftp->chmod($pathArticles, 0777);
					$this->ftp->close();
				}
			}
			if(!is_dir($pathVideo)) //create the folder if it's not already exists
			{
				if(MKDIR_HOST!=1){
					mkdir($pathVideo,0777,TRUE);
				}
				else
				{
					parent::connect();
					if($this->ftp->mkdir($pathVideo, 0777));
					$this->ftp->chmod($pathVideo, 0777);
					$this->ftp->close();
				}
			}
			if(!is_dir($pathProducts)) //create the folder if it's not already exists
			{
				if(MKDIR_HOST!=1){
					mkdir($pathProducts,0777,TRUE);
				}
				else
				{
					parent::connect();
					if($this->ftp->mkdir($pathProducts, 0777));
					$this->ftp->chmod($pathProducts, 0777);
					$this->ftp->close();
				}
			}
			if(!is_dir($pathProductsCategories)) //create the folder if it's not already exists
			{
				if(MKDIR_HOST!=1){
					mkdir($pathProductsCategories,0777,TRUE);
				}
				else
				{
					parent::connect();
					if($this->ftp->mkdir($pathProductsCategories, 0777));
					$this->ftp->chmod($pathProductsCategories, 0777);
					$this->ftp->close();
				}
			}
		//Kiểm tra đã đăng nhập thành công hay chưa
			if($this->session->userdata('validatedAdmin'))
			{
				if($this->session->userdata('__gidAdmin__')==1 || $this->session->userdata('__gidAdmin__')==2)
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
	//end index
	//quên mật khẩu
	public function remember()
	{
		//sent data
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/config/main';
			$this->_data['numberlogin']=$this->m_login->check_number_login();
			//default load module config
			$this->_data['listConfig']=$this->m_config->listConfig();
			$this->load->model('admin/login/captcha_model');
			if(empty($_POST))
			{
				$captcha = $this->captcha_model->generateCaptcha();
				$_SESSION['captchaWord'] = $captcha['word'];
				$this->_data['captcha'] = $captcha;
				$this->load->view('admin/remember',$this->_data);
			}
			else
			{
				//check captcha matches
				if(strcasecmp($_SESSION['captchaWord'], $_POST['confirmCaptcha']) == 0)
				{
					$this->load->view('success_view');
				}
				else
				{
					$this->load->view('failure_view');
				}
			}
		/*end dử liệu gửi*/
		//end Kiểm tra đã đăng nhập thành công hay chưa
	}
	//end quên mật khẩu
	//check quên mật khẩu
	public function check_admin_remember()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email_users', 'email users',
            'trim|required|xss_clean');
		if ($this->form_validation->run() == FALSE)
		{
				echo json_encode(array('active'=>0,'msg'=>'captcha'));
				exit;
		}
		$email_users=$this->input->post('email_users',TRUE);
		$captcha=$this->input->post('captcha',TRUE);
		$captcha_session=$this->input->post('captcha_session');
        // Validate the user can login
        $check_captcha = $this->m_login->check_admin_captcha($captcha,$captcha_session);
		if(!$check_captcha)
		{
			echo json_encode(array('active'=>0,'msg'=>'captcha'));
			exit;
		}
        $result = $this->m_login->check_admin_remember($email_users,$captcha,$captcha_session);
        // Now we verify the result
        if($result)
		{
			//send mail
            // tạo biến random và update vào csdl
            $passNew=rand();
            $rand_temp = md5($passNew);
            //update is_login
		 	$conditions=array('email'=>$email_users);
            $data=array(
				'password' =>$rand_temp
			);
			$this->m_login->updateAdminIsLogin(NULL,$data,$conditions);
            $paramBody = array(
                "!pass_new" => $passNew
            );
            $this->email->mailFrom = EMAIL_SEND_MAIL;
            $this->email->mailTo = $email_users;
            $this->email->templateType = 'forgot_password';
            $this->email->paramBody = $paramBody;
            $mailID = $this->email->addMailQueue();
            $result_send = $this->email->sendMail();
            if($result_send){
            	echo json_encode(array('active'=>1,'msg'=>'username'));
				exit;
            }else{
               	echo json_encode(array('active'=>0,'msg'=>'username'));
				exit;
            }
		}
		else{
			echo json_encode(array('active'=>0,'msg'=>'username'));
			exit;
		}
	}
	//end quên mật khẩu
	public function limitlogin()
	{
		$this->_data['title']=$this->config->item("title_index");
		$this->_data['listLimitLogin']=$this->m_login->getIp();
		$this->load->view('admin/limitlogin',$this->_data);
	}
	//xử lý đăng nhập
    public function check_admin_login(){
        // Load the model
		//form_validation
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username',
            'trim|required|xss_clean');
        $this->form_validation->set_rules('pass', 'Password',
            'trim|required|xss_clean');
		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_userdata("error_login","Tên đăng nhập hay mật khẩu không tồn tại!");
				exit;
		}
		$username=$this->input->post('username');
		$username=$this->db->escape_str($username);
		$matkhau=$this->input->post('pass');
		//check captcha
		$captcha=$this->input->post('captcha');
		$captcha_session=$this->input->post('captcha_session');
		//echo $captcha.'<br>'.$captcha_session;
        // Validate the user can login
  //       $check_captcha = $this->m_login->check_admin_captcha($captcha,$captcha_session);
		// if(!$check_captcha)
		// {
		// 	$this->session->set_userdata("error_login","Captcha không khớp");
		// 	exit;
		// }
		//end check captcha
        // Validate the user can login
        $result = $this->m_login->check_admin_login($username,$matkhau);
        // Now we verify the result
		//echo $result;
        if($result)
		{
		 	echo "true";
		 	/*insert into table log*/
			$getUsers=$this->m_login->selectIdUsers($username,$matkhau);
			$data=array(
			'idLog' => 'NULL',
			'name_log' =>$getUsers[0]->admin_name,
			'created_log' => date('Y-m-d H:i:s'),
			'ip_log' => getenv("REMOTE_ADDR")
			);
			$this->m_login->addLog($data);
			exit;
		}
		else{
			$this->session->set_userdata("error_login","Tên đăng nhập hay mật khẩu không tồn tại!");
			exit;
		}
    }
    function insertDataTemp(){
    	$array=array(
    		array('products categories','products_categories','index','products categories'),
    		array('add products categories','products_categories','add_products_categories','products categories')
    	);
    	foreach($array as $item){
    		//$this->m_login->insertDataTemp()
    	}
    }
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */