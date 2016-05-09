<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Jorge Torres

 * Description: Login model class

 */

class M_contact_config extends CI_Model{

    function __construct(){

        parent::__construct();

		$this->load->database();

		$this->_gallery_path = realpath(APPPATH. "../public/images/contact_config");

    }

	//upload images

    public function do_upload(){

		$in = array("jpg", "png", "gif", "bmp");

		$name=$_FILES['image_contact_config']['name'];

		$out = array("php", "php4", "php5", "exe","psd");

		if(in_array(end(explode('.',$name)),$in) && !in_array(end(explode('.',$name)),$out))

		{

			$config = array('upload_path'   => $this->_gallery_path,

							'allowed_types' => 'gif|jpg|png',

							'max_size'      => '200000',

							"width" => '30',

							"height" => "30");

			$this->load->library("upload",$config);

			if(!$this->upload->do_upload("image_contact_config")){

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

	/*get config contact*/

		public function getContactConfig(){

			$queryContactConfig=$this->db->query(

			'select *

			from '.PREFIX.'contact_config');

			$getContactConfig=$queryContactConfig->result();

			return $getContactConfig;

		}

	/*end get config contact*/

	/*edit config contact*/

		public function editContactConfig($data){

			$this->db->update(''.PREFIX.'contact_config', $data);

		}

	/*end edit config contact*/

	

}

?>