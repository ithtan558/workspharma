<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION))@session_start();
require_once(APPPATH . 'controllers/application.php');
class Notfound extends Application
{
    /**
     * Constructor
     *
     * Loads language files and models needed for this controller
     */
    public function __construct(){
        parent::__construct();
        //Get Config Details From Db
        $this->my_config->db_config_fetch();
        //Manage site Status
        if ($this->config->item('site_status') == 1)
            redirect(URL.'offline');
    } //Controller End
    public function index(){
        $this->_data['template']='404';
        $this->load->view('index',$this->_data);
    }
    
    

} //End  Users Class
/* End of file Users.php */
/* Location: ./app/controllers/Users.php */
