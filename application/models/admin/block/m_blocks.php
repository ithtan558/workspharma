<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Jorge Torres

 * Description: Login model class

 */

class M_blocks extends CI_Model{

    function __construct(){

        parent::__construct();

		$this->load->database();

			$this->load->helper("url");

    }

	/*get list blocks*/

		public function listBlocks(){

			$queryBlocks=$this->db->query(

			'select *

			from '.PREFIX.'blocks');

			$listBlocks=$queryBlocks->result();

			return $listBlocks;

		}

	/*end get list blocks*/

	/*get blocks*/

		public function getBlocks($idBlocks){

			$queryBlocks=$this->db->query(

			'select *

			from '.PREFIX.'blocks

			where idBlocks='.$idBlocks.'');

			$getBlocks=$queryBlocks->result();

			

			return $getBlocks;

		}

	/*end get blocks*/

	/*add blocks*/

		public function addBlocks($data){

			$this->db->insert(''.PREFIX.'blocks', $data);

		}

	/*end add blocks*/

	/*edit blocks*/

		public function editBlocks($idBlocks,$data){

			$this->db->where("idBlocks",$idBlocks);

			$this->db->update(''.PREFIX.'blocks', $data);

		}

	/*end edit blocks*/

	/*edit blocks */

		public function editDownloadConfig($name_blocks,$data){

			$this->db->where("name_blocks",$name_blocks);

			$this->db->update(''.PREFIX.'blocks', $data);

		}

	/*end edit blocks */

	

	/*enable blocks */

		public function enable($status,$id){

			if($status==0)

			$status=1;

			else

			$status=0;

			$qr = $this->db->query("UPDATE ".PREFIX."blocks SET enable_blocks=".$status." WHERE idBlocks=".$id."" );

		}

	/*end enable blocks */

	

	/*remove blocks*/

	public function removeBlocks($idBlocks)

	{

		$this->db->where("idBlocks",$idBlocks);

		$this->db->delete("".PREFIX."blocks");

	}

	/*end remove blocks*/

	

}

?>