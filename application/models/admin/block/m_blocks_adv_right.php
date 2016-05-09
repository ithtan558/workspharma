<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Jorge Torres

 * Description: Login model class

 */

class M_blocks_adv_right extends CI_Model{

    function __construct(){

        parent::__construct();

		$this->load->database();

			$this->load->helper("url");

			$this->_gallery_path = realpath(APPPATH. "../public/images/banner");

    }

	//upload images	

	 public function do_upload(){

		$in = array("jpg", "png", "gif", "bmp");

		$name=$_FILES['image_adv_right']['name'];

		
		$out = array("php", "php4", "php5", "exe","psd");

		if(in_array(end(explode('.',$name)),$in) && !in_array(end(explode('.',$name)),$out))

		{
			$name=getAlias($name);
			$filename=encrypt_name($name);
			$config = array('upload_path'   => $this->_gallery_path,

							'allowed_types' => 'gif|jpg|png',

							'max_size'      => '200000',

							'file_name'      => $filename);

			$this->load->library("upload");
			$this->upload->initialize($config);

			if(!$this->upload->do_upload('image_adv_right')){

				$error = array($this->upload->display_errors());

				echo $this->upload->display_errors();

			}else{

				$image_data = $this->upload->data();    

			}

			//kết thúc công đoạn upload hình ảnh

			// $config = array("source_image" => $image_data['full_path'],

   //                      "new_image" => $this->_gallery_path . "",

   //                      "maintain_ration" => true);

			// $this->load->library("image_lib",$config);

			// $this->image_lib->resize();

		}

		else

		{

			return false;

		}

    }

	/*list adv_right sub*/

		public function listBlocksAdvRight(){

			$queryBlocksAdvRight=$this->db->query('select * from '.PREFIX.'adv_right order by paramid,ordering_adv_right');

			$listBlocksAdvRight=$queryBlocksAdvRight->result();

			return $listBlocksAdvRight;

		}

	/*end list adv_right sub*/

	

	/*get adv_right*/

		public function getBlocksAdvRight($idAdvRight){

			$queryadv_right=$this->db->query(

			'select *

			from '.PREFIX.'adv_right

			where idAdvRight='.$idAdvRight.'');

			$getBlocksAdvRight=$queryadv_right->result();

			

			return $getBlocksAdvRight;

		}

	/*end get adv_right*/

	

	/*add adv_right*/

		public function addBlocksAdvRight($data){

			$this->db->insert(''.PREFIX.'adv_right', $data);

		}

	/*end add adv_right*/

	/*edit adv_right*/

		public function editBlocksAdvRight($idAdvRight,$data){

			$this->db->where("idAdvRight",$idAdvRight);

			$this->db->update(''.PREFIX.'adv_right', $data);

		}

	/*end edit adv_right*/

	

	/*remove loại*/

	public function removeBlocksAdvRight($idAdvRight)



	{

		$this->db->where("idAdvRight",$idAdvRight);

		$this->db->delete("".PREFIX."adv_right");

	}

	/*end remove loại*/



	/*enable adv_right*/

		public function enable($status,$id){

			if($status==0)

			$status=1;

			else

			$status=0;

			$qr = $this->db->query("UPDATE ".PREFIX."adv_right SET enable_adv_right=".$status." WHERE idAdvRight=".$id."" );

		}

	/*end enable adv_right*/

	

	/*enable adv_right*/

		public function enable_adv_right($status,$id){

			if($status==0)

			$status=1;

			else

			$status=0;

			$qr = $this->db->query("UPDATE ".PREFIX."adv_right SET enable_adv_right=".$status." WHERE idAdvRight=".$id."" );

		}

	/*end enable adv_right*/



	/*check_ordering*/

		public function check_ordering($idAdvRight,$data){

			$this->db->where("idAdvRight",$idAdvRight);

			$this->db->update(''.PREFIX.'adv_right', $data);

		}

	/*end check_ordering*/

	/*get record next ordering*/

		public function getOrderingPrevious($ordering_adv_right){

			$queryOrderingPrevious=$this->db->query(

			'select *

			from '.PREFIX.'adv_right

			where ordering_adv_right='.($ordering_adv_right+1).'');

			$getOrderingPrevious=$queryOrderingPrevious->result();

			return $getOrderingPrevious;

		}

	/*end get record next ordering*/

	

	/*get record next ordering*/

		public function getOrderingNext($ordering_adv_right){

			$queryOrderingNext=$this->db->query(

			'select *

			from '.PREFIX.'adv_right

			where ordering_adv_right='.($ordering_adv_right-1).'');

			$getOrderingNext=$queryOrderingNext->result();

			return $getOrderingNext;

		}

	/*end get record next ordering*/



	

}

?>