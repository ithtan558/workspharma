<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class M_config extends CI_Model{
    function __construct(){
        parent::__construct();
		$this->load->database();
    }
    /*get list Config*/
		public function listConfig(){
			$queryconfig=$this->db->query('select * from '.PREFIX.'config order by idConfig');
			$listConfig=$queryconfig->result();
			return $listConfig;
		}
	/*end list Config*/
	
	/*get  Config*/
		public function getConfig($idConfig){
			$queryconfig=$this->db->query(
			'select *
			from '.PREFIX.'config
			where idConfig='.$idConfig.'');
			$getconfig=$queryconfig->result();
			
			return $getconfig;
		}
	/*end  Config*/
	
	/*add Config*/
		public function addConfig($data){
			$this->db->insert(''.PREFIX.'config', $data);
		}
	/*end add Config*/
	/*edit Config*/
		public function editConfig($idConfig,$data){
			$this->db->where("idConfig",$idConfig);
			$this->db->update(''.PREFIX.'config', $data);
		}
	/*end edit Config*/
	
	/*remove Config*/
	public function remove_config($idConfig)
	{
		$this->db->where("idConfig",$idConfig);
		$this->db->delete(''.PREFIX.'config');
	}
	/*end remove Config*/
	
}
?>