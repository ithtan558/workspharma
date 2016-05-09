<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Jorge Torres

 * Description: Login model class

 */

class M_blocks_slideshow extends CI_Model{

    function __construct(){

        parent::__construct();

		$this->load->database();

			$this->load->helper("url");

			$this->_gallery_path = realpath(APPPATH. "../public/images/slideshow");

    }

	//upload images	

	 public function do_upload(){

		$in = array("jpg", "png", "gif", "bmp");

		$name=$_FILES['image_slide_show']['name'];

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

			if(!$this->upload->do_upload('image_slide_show')){

				$error = array($this->upload->display_errors());

				echo $this->upload->display_errors();

			}else{

				$image_data = $this->upload->data();    

			}

			//kết thúc công đoạn upload hình ảnh

			$config = array("source_image" => $image_data['full_path'],

                        "new_image" => $this->_gallery_path . "",

                        "maintain_ration" => true,);

			$this->load->library("image_lib",$config);

			$this->image_lib->resize();

		}

		else

		{

			return false;

		}

    }

	/*list slideshow_categories sub*/

		public function listBlocksSlideshow(){

			$queryBlocksSlideshow=$this->db->query('select * from '.PREFIX.'slideshow order by ordering_slide_show');

			$listBlocksSlideshow=$queryBlocksSlideshow->result();

			return $listBlocksSlideshow;

		}

	/*end list slideshow_categories sub*/

	

	/*get slideshow*/

		public function getBlocksSlideshow($idSlideshow){

			$queryslideshow=$this->db->query(

			'select *

			from '.PREFIX.'slideshow

			where idSlideshow='.$idSlideshow.'');

			$getBlocksSlideshow=$queryslideshow->result();

			

			return $getBlocksSlideshow;

		}

	/*end slideshow*/

	

	/*add slideshow*/

		public function addBlocksSlideshow($data){

			$this->db->insert(''.PREFIX.'slideshow', $data);

		}

	/*end add slideshow*/

	/*edit slideshow*/

		public function editBlocksSlideshow($idSlideshow,$data){

			$this->db->where("idSlideshow",$idSlideshow);

			$this->db->update(''.PREFIX.'slideshow', $data);

		}

	/*end edit slideshow*/

	

	/*remove slideshow*/

	public function removeBlocksSlideshow($idSlideshow)



	{

		$this->db->where("idSlideshow",$idSlideshow);

		$this->db->delete(''.PREFIX.'slideshow');

	}

	/*end remove slideshow*/

	/*enable slideshow*/

		public function enable($status,$id){

			if($status==0)

			$status=1;

			else

			$status=0;

			$qr = $this->db->query('UPDATE '.PREFIX.'slideshow SET enable_slide_show='.$status.' WHERE idSlideshow='.$id.'');

		}

	/*end enable slideshow*/

	

	/*check_ordering*/

		public function check_ordering($idSlideshow,$data){

			$this->db->where("idSlideshow",$idSlideshow);

			$this->db->update(''.PREFIX.'slideshow', $data);

		}

	/*end check_ordering*/

	/*get record next ordering*/

		public function getOrderingPrevious($ordering_slide_show){

			$queryOrderingPrevious=$this->db->query(

			'select *

			from '.PREFIX.'slideshow

			where ordering_slide_show='.($ordering_slide_show+1).'');

			$getOrderingPrevious=$queryOrderingPrevious->result();

			return $getOrderingPrevious;

		}

	/*end get record next ordering*/

	

	/*get record next ordering*/

		public function getOrderingNext($ordering_slide_show){

			$queryOrderingNext=$this->db->query(

			'select *

			from '.PREFIX.'slideshow

			where ordering_slide_show='.($ordering_slide_show-1).'');

			$getOrderingNext=$queryOrderingNext->result();

			return $getOrderingNext;

		}

	/*end get record next ordering*/



	

}

?>