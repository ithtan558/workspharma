<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class M_cities extends CI_Model{
    function __construct(){
        parent::__construct();
		$this->load->database();
			$this->load->helper("url");
    }
		public function listCities(){
			$queryCities=$this->db->query("select * 
			from cities order by id");
			$listCities=$queryCities->result();
			return $listCities;
		}
	/*end Get list categories*/
	/*Get categories*/
		public function getCities($id){
			$queryCities=$this->db->query(
			'select *
			from cities
			where id='.$id.'');
			$getCities=$queryCities->result();
			return $getCities;
		}
	/*end Get categories*/
	/*add categories*/
		public function addCities($data){
			$this->db->insert('cities', $data);
		}
	/*end add categories*/
	/*edit categories*/
		public function eidtCities($id,$data){
			$this->db->where("id",$id);
			$this->db->update('cities', $data);
		}
	/*end edit categories*/
	/*remove categories*/
	public function removeCities($id)
	{
		$this->db->where("id",$id);
		$this->db->delete("cities");
	}
	/*end remove categories*/
}
?>