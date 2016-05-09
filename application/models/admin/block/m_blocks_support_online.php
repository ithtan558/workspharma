<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Jorge Torres

 * Description: Login model class

 */

class M_blocks_support_online extends CI_Model{

    function __construct(){

        parent::__construct();

		$this->load->database();

			$this->load->helper("url");

    }

	

	/*list support_online sub*/

		public function listBlocksSupportOnline(){

			$queryBlocksSupportOnline=$this->db->query('select * from '.PREFIX.'support_online order by ordering_support_online');

			$listBlocksSupportOnline=$queryBlocksSupportOnline->result();

			return $listBlocksSupportOnline;

		}

	/*end list support_online sub*/

	

	/*get  Blocks Support Online*/

		public function getBlocksSupportOnline($idSupportOnline){

			$querysupport_online=$this->db->query(

			'select *

			from '.PREFIX.'support_online

			where idSupportOnline='.$idSupportOnline.'');

			$getBlocksSupportOnline=$querysupport_online->result();

			

			return $getBlocksSupportOnline;

		}

	/*end  Blocks Support Online*/

	

	/*add Blocks Support Online*/

		public function addBlocksSupportOnline($data){

			$this->db->insert(''.PREFIX.'support_online', $data);

		}

	/*end add Blocks Support Online*/

	/*edit Blocks Support Online*/

		public function editBlocksSupportOnline($idSupportOnline,$data){

			$this->db->where("idSupportOnline",$idSupportOnline);

			$this->db->update(''.PREFIX.'support_online', $data);

		}

	/*end edit Blocks Support Online*/

	

	/*remove Blocks Support Online*/

	public function removeBlocksSupportOnline($idSupportOnline)



	{

		$this->db->where("idSupportOnline",$idSupportOnline);

		$this->db->delete(''.PREFIX.'support_online');

	}

	/*end remove Blocks Support Online*/



	/*enable Blocks Support Online*/

		public function enable($status,$id){

			if($status==0)

			$status=1;

			else

			$status=0;

			$qr = $this->db->query('UPDATE '.PREFIX.'support_online SET enable_support_online=".$status." WHERE idSupportOnline=".$id."' );

		}

	/*end enable Blocks Support Online*/

	

	/*enable Blocks Support Online*/

		public function enable_support_online($status,$id){

			if($status==0)

			$status=1;

			else

			$status=0;

			$qr = $this->db->query('UPDATE '.PREFIX.'support_online SET enable_support_online=".$status." WHERE idSupportOnline=".$id."' );

		}

	/*end enable Blocks Support Online*/

	/*check_ordering*/

		public function check_ordering($idSupportOnline,$data){

			$this->db->where("idSupportOnline",$idSupportOnline);

			$this->db->update(''.PREFIX.'support_online', $data);

		}

	/*end check_ordering*/

	/*get record next ordering*/

		public function getOrderingPrevious($ordering_support_online){

			$queryOrderingPrevious=$this->db->query(

			'select *

			from '.PREFIX.'support_online

			where ordering_support_online='.($ordering_support_online+1).'');

			$getOrderingPrevious=$queryOrderingPrevious->result();

			return $getOrderingPrevious;

		}

	/*end get record next ordering*/

	

	/*get record next ordering*/

		public function getOrderingNext($ordering_support_online){

			$queryOrderingNext=$this->db->query(

			'select *

			from '.PREFIX.'support_online

			where ordering_support_online='.($ordering_support_online-1).'');

			$getOrderingNext=$queryOrderingNext->result();

			return $getOrderingNext;

		}

	/*end get record next ordering*/

	

}

?>