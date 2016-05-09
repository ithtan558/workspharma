<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class M_languages extends CI_Model{
    function __construct(){
        parent::__construct();
		$this->load->database();
    }
	
    /*get list languages*/
		public function listLanguages(){
			$querylanguage=$this->db->query('select * from pt_languages order by idLanguages DESC');
			$listLanguages=$querylanguage->result();
			return $listLanguages;
		}
	/*end list languages*/
	
	/*get  languages*/
		public function getLanguages($idLanguages){
			$querylanguage=$this->db->query(
			'select *
			from pt_languages
			where idLanguages='.$idLanguages.'');
			$getLanguages=$querylanguage->result();
			
			return $getLanguages;
		}
	/*end  languages*/
	
	/*add languages*/
		public function addLanguages($data){
			$this->db->insert('pt_languages', $data);
		}
	/*end add languages*/
	/*edit languages*/
		public function editLanguages($idLanguages,$data){
			$this->db->where("idLanguages",$idLanguages);
			$this->db->update('pt_languages', $data);
		}
	/*end edit languages*/
	
	/*remove languages*/
	public function removeLanguages($idLanguages)
	{
		$this->db->where("idLanguages",$idLanguages);
		$this->db->delete("pt_languages");
	}
	/*end remove languages*/
	/*enable languages*/
		public function enable($enable,$id){
			if($enable==0)
			$enable=1;
			else
			$enable=0;
			$qr = $this->db->query("UPDATE pt_languages SET enable_languages=".$enable." WHERE idLanguages=".$id."" );
		}
	/*end enable languages*/
	/*enable languages*/
		public function defaults($status,$id){
			if($status==0)
			$status=1;
			else
			$status=0;
			$qr = $this->db->query("UPDATE pt_languages SET default_languages=0" );
			$qr = $this->db->query("UPDATE pt_languages SET default_languages=".$status." WHERE idLanguages=".$id."" );
		}
	/*end enable languages*/
	
}
?>