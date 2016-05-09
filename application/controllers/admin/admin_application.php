<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION))@session_start();
class Admin_application extends CI_Controller{
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
			$this->load->helper("auth");	
		/*Load model*/
		/*session*/
			$this->load->library('session');
		//check permission
			//isAllowed();
		//Kiểm tra đã đăng nhập thành công hay chưa
			if(!$this->session->userdata('validatedAdmin'))
			{
				
				if($this->session->userdata('__gidAdmin__')!=1)
				{
					redirect();
				}
				
			}
			$ckFinder="
			filebrowserBrowseUrl : '".PUBLIC_ADMIN."ckfinder/ckfinder.html',
			filebrowserImageBrowseUrl : '".PUBLIC_ADMIN."ckfinder/ckfinder.html?type=Images',
			filebrowserFlashBrowseUrl : '".PUBLIC_ADMIN."ckfinder/ckfinder.html?type=Flash',
			filebrowserUploadUrl : '".PUBLIC_ADMIN."ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
			filebrowserImageUploadUrl : '".PUBLIC_ADMIN."ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
			filebrowserFlashUploadUrl : '".PUBLIC_ADMIN."ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'";
			$this->_data['ckFinder']=$ckFinder;
	}
}