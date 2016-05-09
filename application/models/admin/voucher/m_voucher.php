<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Jorge Torres

 * Description: Login model class

 */

class M_voucher extends CI_Model{

    function __construct(){

        parent::__construct();

		$this->load->database();

			$this->load->helper("url");

    }

    /*Get list categories*/

		public function listVoucher(){

			$queryVoucher=$this->db->query('select * 

			from nsp_voucher order by ordering_voucher');

			$listVoucher =$queryVoucher->result();

			return $listVoucher;

		}

	/*end Get list categories*/

	

	/*Get categories*/

		public function getVoucher($idVoucher){

			$queryVoucher=$this->db->query(

			'select *

			from nsp_voucher

			where idVoucher='.$idVoucher.'');

			$getVoucher=$queryVoucher->result();

			

			return $getVoucher;

		}

	/*end Get categories*/

	

	/*add categories*/

		public function addVoucher($data){

			$this->db->insert('nsp_voucher', $data);

		}

	/*end add categories*/

	/*edit categories*/

		public function eidtVoucher($idVoucher,$data){

			$this->db->where("idVoucher",$idVoucher);

			$this->db->update('nsp_voucher', $data);

		}

	/*end edit categories*/

	

	/*remove categories*/

	public function removeVoucher($idVoucher)



	{

		$this->db->where("idVoucher",$idVoucher);

		$this->db->delete("nsp_voucher");

	}

	/*end remove categories*/



	/*enable categories*/

		public function enable($status,$id){

			if($status==0)

			$status=1;

			else

			$status=0;

			$qr = $this->db->query("UPDATE nsp_voucher SET enable_voucher=".$status." WHERE idVoucher=".$id."" );

		}

	/*end enable categories*/



	

}

?>