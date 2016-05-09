<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!isset($_SESSION))@session_start();

require_once(APPPATH . 'controllers/application.php');

class Search extends Application{

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

			//tin hot

			$this->load->Model("body/search/m_search");

		

		

	}

	public function index()

	{
		$this->_data['search']='search';
		$this->_data['name']=true;
		//$this->_data['name_parent']='Tìm kiếm';
		$searchstring=$this->input->post('searchstring');
		$this->_data['listProducts']=$this->m_search->listSearch($searchstring);
		//get data
		$this->load->view('body/search/main',$this->_data);

	}

}

