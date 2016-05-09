<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION))@session_start();
require_once(APPPATH . 'controllers/application.php');
class Danhmuc extends Appilcation{

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
		
	}
	
	
	/*Lấy danh sách loại sub_category*/
	public function index($alias,$idCategory){

		$this->_data['template']='body/danhmuc/main';
		$this->_data['getSubCategory']=$this->m_danhmuc->getSubCategory($idCategory);
		$category=$this->m_danhmuc->getTenDanhMuc($idCategory);
		$this->_data['title']=$category[0]->ten_danhmuc;
		$this->load->view("index",$this->_data);
	}
	/*end Lấy danh sách loại sub_category*/
	
	/*Lấy danh sách loại sub_category*/
	public function getdanhmuc($a,$b,$idSubCategory){
		// load thư viện cần thiết 
			$this->m_danhmuc->creat_session($idSubCategory);
			$this->load->library("pagination");
			$config['per_page']  = 40;
			$page =40;
		//phân trang tin hot
			if($this->uri->segment(3)==0)
			{
				$start=0;
			}
			else
			{
				$start=($this->uri->segment(3));
			}
			$config['total_rows'] = count($this->m_danhmuc->list_all($idSubCategory));
			$config['base_url']   = URL."danhmuc/phantrang/";
			$this->pagination->initialize($config);
			$this->_data['pagination_tinDang'] = $this->pagination->create_links();
			$this->_data['listTinDang']=$this->m_danhmuc->listTinDang($idSubCategory,$start,$page);
			$subCategory=$this->m_danhmuc->listTinDang($idSubCategory,$start,$page);
		//end ajax phan trang tin hot
			
			if(count($subCategory)>0)
			{
				$this->_data['title']=$subCategory[0]->ten_danhmuc;
			}
			else
			{
				$this->_data['title']=$this->config->item("title_index");
			}
			$this->_data['template']='body/tindang/main';
			$getSubCategory=$this->m_danhmuc->list_all($idSubCategory);
			if(count($getSubCategory)>0)
			{
				$this->_data['ten_tinhthanh']=$getSubCategory[0]->ten_danhmuc;
			}
			else
			{
				$this->_data['ten_tinhthanh']='Không có';
			}
		//Ajax phan trang
			if($this->input->post('flag'))
			{
				if($this->input->post('flag')=='tindang')
				{
					$html=$this->load->view('body/tindang/body_tindang',$this->_data);
				}
				return $html;
				exit;
			}
		//end ajax phân trang
		//$this->_data['getSubCategory']=$this->m_danhmuc->getSubCategory();
		$this->load->view("index",$this->_data);
	}
	/*end Lấy danh sách loại sub_category*/
	
	/*Lấy danh sách loại sub_category*/
	public function phantrang(){
			$idSubCategory=$this->session->userdata("__iddanhmuc__");
		// load thư viện cần thiết 
			$this->load->library("pagination");
			$config['per_page']  = 40;
			$page =40;
		//phân trang tin hot
			if($this->uri->segment(3)==0)
			{
				$start=0;
			}
			else
			{
				$start=($this->uri->segment(3));
			}
			$config['total_rows'] = count($this->m_danhmuc->list_all($idSubCategory));
			$config['base_url']   = URL."danhmuc/phantrang";
			$this->pagination->initialize($config);
			$this->_data['pagination_tinDang'] = $this->pagination->create_links();
			$this->_data['listTinDang']=$this->m_danhmuc->listTinDang($idSubCategory,$start,$page);
			$subCategory=$this->m_danhmuc->listTinDang($idSubCategory,$start,$page);
		//end ajax phan trang tin hot
			
			if(count($subCategory)>0)
			{
				$this->_data['title']=$subCategory[0]->ten_danhmuc;
			}
			else
			{
				$this->_data['title']=$this->config->item("title_index");
			}
			$this->_data['template']='body/tindang/main';
		//Ajax phan trang
			if($this->input->post('flag'))
			{
				if($this->input->post('flag')=='tindang')
				{
					$html=$this->load->view('body/tindang/body_tindang',$this->_data);
				}
				return $html;
				exit;
			}
		//end ajax phân trang
		//$this->_data['getSubCategory']=$this->m_danhmuc->getSubCategory();
		$this->load->view("index",$this->_data);
	}
	/*end Lấy danh sách loại sub_category*/
	
	
	
	/*Lấy danh sách loại sub_category*/
	public function getTinDangTinhThanh($idTinhThanh){
			$this->m_danhmuc->creat_session_tinhthanh($idTinhThanh);
		// load thư viện cần thiết 
			$this->load->library("pagination");
			$config['per_page']  = 40;
			$page =40;
		//phân trang tin hot
			$start=0;		
			$config['total_rows'] = count($this->m_danhmuc->list_all_tinhthanh());
			$config['base_url']   = URL."danhmuc/phantrang_tinhthanh/";
			$this->pagination->initialize($config);
			$this->_data['pagination_tinDang'] = $this->pagination->create_links();
			$this->_data['listTinDang']=$this->m_danhmuc->listTinDangTinhThanh($start,$page);
			
			$subTinhThanh=$this->m_danhmuc->listTinDangTinhThanh($start,$page);
		//end ajax phan trang tin hot
			
			if(count($subTinhThanh)>0)
			{
				$this->_data['title']=$subTinhThanh[0]->ten_danhmuc;
			}
			else
			{
				$this->_data['title']=$this->config->item("title_index");
			}
			$this->_data['template']='body/tindang/main';
			$getTenTinhThanh=$this->m_danhmuc->getTenTinhThanh();
			
			$this->_data['ten_tinhthanh']=$getTenTinhThanh[0]->ten_tinhthanh;
		
		//$this->_data['getSubCategory']=$this->m_danhmuc->getSubCategory();
		$this->load->view("index",$this->_data);
	}
	/*end Lấy danh sách loại sub_category*/
	
	/*Lấy danh sách loại sub_category*/
	public function phantrang_tinhthanh(){
		
			
		// load thư viện cần thiết 
			$this->load->library("pagination");
			$config['per_page']  = 40;
			$page =40;
		//phân trang tin hot
			if($this->uri->segment(3)==0)
			{
				$start=0;
			}
			else
			{
				$start=($this->uri->segment(3));
			}
			$config['total_rows'] = count($this->m_danhmuc->list_all_tinhthanh());
			$config['base_url']   = URL."danhmuc/phantrang_tinhthanh/";
			$this->pagination->initialize($config);
			$this->_data['pagination_tinDang'] = $this->pagination->create_links();
			$this->_data['listTinDang']=$this->m_danhmuc->listTinDangTinhThanh($start,$page);
			
			$subTinhThanh=$this->m_danhmuc->listTinDangTinhThanh($start,$page);
		//end ajax phan trang tin hot
			
			if(count($subTinhThanh)>0)
			{
				$this->_data['title']=$subTinhThanh[0]->ten_danhmuc;
			}
			else
			{
				$this->_data['title']=$this->config->item("title_index");
			}
			$this->_data['template']='body/tindang/main';
			$getTenTinhThanh=$this->m_danhmuc->getTenTinhThanh();
			
			$this->_data['ten_tinhthanh']=$getTenTinhThanh[0]->ten_tinhthanh;
		//Ajax phan trang
			if($this->input->post('flag'))
			{
				if($this->input->post('flag')=='tindang')
				{
					$html=$this->load->view('body/tindang/body_tindang',$this->_data);
				}
				return $html;
				exit;
			}
		//end ajax phân trang
		//$this->_data['getSubCategory']=$this->m_danhmuc->getSubCategory();
		$this->load->view("index",$this->_data);
	}
	/*end Lấy danh sách loại sub_category*/
	
	
}
?>
