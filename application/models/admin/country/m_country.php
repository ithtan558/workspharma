<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class M_country extends CI_Model{
    function __construct(){
        parent::__construct();
		$this->load->database();
			$this->load->helper("url");
    }
		public function listCountry(){
			$queryCountry=$this->db->query("select * 
			from country order by id");
			$listCountry=$queryCountry->result();
			return $listCountry;
		}
	/*end Get list categories*/
	/*Get categories*/
		public function getCountry($id){
			$queryCountry=$this->db->query(
			'select *
			from country
			where id='.$id.'');
			$getCountry=$queryCountry->result();
			return $getCountry;
		}
	/*end Get categories*/
	/*add categories*/
		public function addCountry($data){
			$this->db->insert('country', $data);
		}
	/*end add categories*/
	/*edit categories*/
		public function eidtCountry($id,$data){
			$this->db->where("id",$id);
			$this->db->update('country', $data);
		}
	/*end edit categories*/
	/*remove categories*/
	public function removeCountry($id)
	{
		$this->db->where("id",$id);
		$this->db->delete("country");
	}
	/*end remove categories*/
}
?>