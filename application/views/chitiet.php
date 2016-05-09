<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!isset($_SESSION))@session_start();

require_once(APPPATH . 'controllers/application.php');

class Chitiet extends Appilcation{



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

			//chi tiet

			$this->load->Model("body/chitiet/m_chitiet");
			//tin hot

			$this->load->Model("body/tinvip/m_tinvip");

		

		

	}

	public function index($idTinDang)

	{

		// load thư viện cần thiết 

			
			// load thư viện cần thiết 

			$this->load->library("pagination");

			$config['per_page']  = 4;

			$page =4;

		//phân trang tin hot

			if($this->uri->segment(3)==0)

			{

				$start=0;

			}

			else

			{

				$start=($this->uri->segment(3));

			}

			

			$config['total_rows'] = count($this->m_tinvip->list_all());

			$config['base_url']   = URL."main/index";

			$this->pagination->initialize($config);

			$this->_data['pagination_tinvip'] = $this->pagination->create_links();

			$this->_data['listTinVip']=$this->m_tinvip->listTinVip($start,$page);

			//end ajax phan trang tin hot
			$this->_data['template']='body/chitiet/main';

			$this->_data['getTinDang']=$this->m_chitiet->getTinDang($idTinDang);

			$getTinDang=$this->m_chitiet->getTinDang($idTinDang);

			$this->m_chitiet->setView($idTinDang,$getTinDang[0]->view_tindang+1);

			$this->_data['title']=$getTinDang[0]->ten_tindang;

			$this->_data['listTinLienQuan']=$this->m_chitiet->listTinLienQuan();

			$this->_data['listTinTinhThanh']=$this->m_chitiet->listTinTinhThanh($idTinDang);

			$this->load->view('index',$this->_data);

	}

}

