<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION))@session_start();
require_once(APPPATH . 'controllers/admin/admin_application.php');
class Tool extends Admin_application{
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
			
		$this->_data['tools_default']=1;	
		/*hepler*/
			$this->load->helper("url");
			$this->load->helper("getalias");
			$this->load->library('session');		
	}
	
	public function index()
	{
		$this->_data['tool']=1;
		//data sent
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/tool/export_database';
		//get data
			$this->load->view('admin/main',$this->_data);
	}
	/*export_sql*/
		public function export_database(){
			//ENTER THE RELEVANT INFO BELOW
			$this->load->dbutil();
			$prefs = array(     
					'format'      => 'zip',             
					'filename'    => 'my_db_backup.sql'
				  );
	
	
			$backup =& $this->dbutil->backup($prefs); 
	
			$db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
			$save = 'backup/'.$db_name;
	
			$this->load->helper('file');
			write_file($save, $backup); 
	
	
			$this->load->helper('download');
			force_download($db_name, $backup); 
	
				
	
			}
	/*export_sql*/
	public function clear_cache()
	{
		//data sent
			$this->_data['clear_cache']=1;
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/tool/clear_cache';
		//get data
			$this->load->view('admin/main',$this->_data);
	}
	
	public function check_clear_cache()
	{
		$this->_data['clear_cache']=1;
		//data sent
			$this->load->driver('cache');
			//$this->cache->clean();
			
			$this->cache->remove_group(NULL);
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/tool/clear_cache';
		//get data
			$this->load->view('admin/main',$this->_data);
	}
	
		
}