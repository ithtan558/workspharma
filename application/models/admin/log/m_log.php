<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class M_log extends CI_Model{
    function __construct(){
        parent::__construct();
		$this->load->database();
			$this->load->helper("url");
    }
    /*list log*/
		public function listLog(){
		$log_list=$this->db->get(''.PREFIX.'logs');
		$listLog = $log_list->result();
		return $listLog;
    }
	/*end list log*/
	/*list listUnlogined*/
		public function listUnlogined(){
		$listUnlogined=$this->db->get(''.PREFIX.'limitlogin');
		$listUnlogined = $listUnlogined->result();
		return $listUnlogined;
    }
	/*end list listUnlogined*/
	
	/*remove limit_use*/
	public function removeLog($idLog)
	{
		$this->db->where("idLog",$idLog);
		$this->db->delete("".PREFIX."logs");
	}
	/*end remove limit_use*/
	
	/*remove limit_use*/
	public function removeUnlogined($idUnlogined)
	{
		$this->db->where("idLimitLogin",$idUnlogined);
		$this->db->delete("".PREFIX."limitlogin");
	}
	/*end remove limit_use*/
}
?>