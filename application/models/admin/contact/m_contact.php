<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Jorge Torres

 * Description: Login model class

 */

class M_contact extends CI_Model{

    function __construct(){

        parent::__construct();

		$this->load->database();

		$this->_gallery_path = realpath(APPPATH. "../public/images/contact");

    }

	//upload images

    public function do_upload(){

		$in = array("jpg", "png", "gif", "bmp");

		$name=$_FILES['thumb_contact']['name'];

		$out = array("php", "php4", "php5", "exe","psd");

		if(in_array(end(explode('.',$name)),$in) && !in_array(end(explode('.',$name)),$out))

		{

			$config = array('upload_path'   => $this->_gallery_path,

							'allowed_types' => 'gif|jpg|png',

							'max_size'      => '200000',

							"width" => '30',

							"height" => "30");

			$this->load->library("upload",$config);

			if(!$this->upload->do_upload("thumb_contact")){

				$error = array($this->upload->display_errors());

			}else{

				$image_data = $this->upload->data();    

			}

			//kết thúc công đoạn upload hình ảnh

			$config = array("source_image" => $image_data['full_path'],

                        "new_image" => $this->_gallery_path . "",

                        "maintain_ration" => true,

                        "width" => '50',

                        "height" => "50");

			$this->load->library("image_lib",$config);

			$this->image_lib->resize();

		}

		else

		{

			return false;

		}

    }

	

    /*get list contact*/

		public function listContact(){

			$querycontact=$this->db->query('select * from '.PREFIX.'contact order by ordering_contact ASC');

			$listContact=$querycontact->result();

			return $listContact;

		}

	/*end list contact*/

	

	/*get  contact*/

		public function getContact($idContact){

			$querycontact=$this->db->query(

			'select *

			from '.PREFIX.'contact

			where idContact='.$idContact.'');

			$getContact=$querycontact->result();

			

			return $getContact;

		}

	/*end  contact*/

	

	/*add contact*/

		public function addContact($data){

			$this->db->insert(''.PREFIX.'contact', $data);

		}

	/*end add contact*/

	/*edit contact*/

		public function editContact($idContact,$data){

			$this->db->where("idContact",$idContact);

			$this->db->update(''.PREFIX.'contact', $data);

		}

	/*end edit contact*/

	

	/*remove contact*/

	public function removeContact($idContact)

	{

		$this->db->where("idContact",$idContact);

		$this->db->delete("".PREFIX."contact");

	}

	/*end remove contact*/

	/*enable contact*/

		public function enable($enable,$id){

			if($enable==0)

			$enable=1;

			else

			$enable=0;

			$qr = $this->db->query("UPDATE ".PREFIX."contact SET enable_contact=".$enable." WHERE idContact=".$id."" );

		}

	/*end enable contact*/
	
	/*check_ordering*/

		public function check_ordering($idcontact,$data){

			$this->db->where("idcontact",$idcontact);

			$this->db->update(''.PREFIX.'contact', $data);

		}

	/*end check_ordering*/

	/*get record next ordering*/

		public function getOrderingPrevious($ordering_contact){

			$queryOrderingPrevious=$this->db->query(

			'select *

			from '.PREFIX.'contact

			where ordering_contact='.($ordering_contact+1).'');

			$getOrderingPrevious=$queryOrderingPrevious->result();

			return $getOrderingPrevious;

		}

	/*end get record next ordering*/

	

	/*get record next ordering*/

		public function getOrderingNext($ordering_contact){

			$queryOrderingNext=$this->db->query(

			'select *

			from '.PREFIX.'contact

			where ordering_contact='.($ordering_contact-1).'');

			$getOrderingNext=$queryOrderingNext->result();

			return $getOrderingNext;

		}

	/*end get record next ordering*/


	

}

?>