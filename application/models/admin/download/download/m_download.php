<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Jorge Torres

 * Description: Login model class

 */

class M_download extends CI_Model{

    function __construct(){

        parent::__construct();

		$this->load->database();

			$this->load->helper("url");
			$this->load->helper("getalias");

			$this->_gallery_path = realpath(APPPATH. "../public/images/download/".date("m_Y"));

    }

	

	public function do_upload1(){

		$path = "./public/images/download/".date("m_Y");

		if(!is_dir($path)) //create the folder if it's not already exists

		{

			mkdir($path,0777,TRUE);

		}

		$in = array("jpg", "png", "gif", "bmp");

		$name=$_FILES['preview_download']['name'];

		$out = array("php", "php4", "php5", "exe","psd");

		if(in_array(end(explode('.',$name)),$in) && !in_array(end(explode('.',$name)),$out))

		{

			$config = array('upload_path'   => $this->_gallery_path,

							'allowed_types' => 'gif|jpg|png',

							'max_size'      => '200000',

							"width" => '200',

							"height" => "200");

			$this->load->library("upload",$config);

			if(!$this->upload->do_upload('preview_download')){

				$error = array($this->upload->display_errors());

				echo $this->upload->display_errors();

			}else{

				$image_data = $this->upload->data();    

			}

			//kết thúc công đoạn upload hình ảnh

			$config = array("source_image" => $image_data['full_path'],

                        "new_image" => $this->_gallery_path . "",

                        "maintain_ration" => true,

                        "width" => '200',

                        "height" => "200");

			$this->load->library("image_lib",$config);

			$this->image_lib->resize();

		}

		else

		{

			return false;

		}

    }

	

	public function do_upload($filename){
		

		$path = "./public/images/download/".date("m_Y");

		if(!is_dir($path)) //create the folder if it's not already exists

		{

			mkdir($path,0777,TRUE);

		}

		$in = array("jpg", "png", "gif", "bmp","pdf","doc","docx","xls","xlsx","csv");

		$name=$_FILES[$filename]['name'];
		
		$out = array("php", "php4", "php5", "exe","psd");
		if(in_array(end(explode('.',$name)),$in) && !in_array(end(explode('.',$name)),$out))

		{

			$config = array('upload_path'   => $this->_gallery_path,

							'allowed_types' => 'gif|jpg|png|pdf|doc|docx|xls|xlsx|csv',

							'max_size'      => '200000',
							'file_name'  => getAlias($name)
							);

			$this->load->library("upload",$config);

			if(!$this->upload->do_upload($filename)){

				$error = array($this->upload->display_errors());

				echo $this->upload->display_errors();

			}else{

				$image_data = $this->upload->data();    
			}

			//kết thúc công đoạn upload hình ảnh
		}

		else

		{

			return false;

		}

    }

	

    /*list download_categories*/

		public function listDownloadProducts(){

			$option_list = $this->db->query('select 

			*

			from nsp_download a, nsp_products b

			where a.productid=b.idProducts');

			$listDownloadProducts = $option_list->result();

		return $listDownloadProducts;

    }

	/*end list download_categories*/

	/*list download_categories sub*/

		public function listProducts(){

			$queryProducts=$this->db->query('select * from nsp_products where parentid=0 order by name_products');

			$listProducts=$queryProducts->result();

			return $listProducts;

		}

	/*end list download_categories sub*/

	

	/*get đơn download */

		public function getDownload($idDownload){

			$queryDownload=$this->db->query(

			'select *

			from nsp_download

			where idDownload='.$idDownload.'');

			$getDownload=$queryDownload->result();

			

			return $getDownload;

		}

	/*end đơn download */

	

	/*add download */

		public function addDownload($data){

			$this->db->insert('nsp_download', $data);

		}

	/*end add download */

	/*edit download */

		public function editDownload($idDownload,$data){

			$this->db->where("idDownload",$idDownload);

			$this->db->update('nsp_download', $data);

		}

	/*end edit download */

	

	/*remove download*/

	public function removeDownload($idDownload)

	{
		
		$queryDownload=$this->db->query(

			'select *

			from nsp_download

			where idDownload='.$idDownload.'');

		$getDownload=$queryDownload->row();
		unlink("./public/images/download/".$getDownload->filename_download."");
		
		$this->db->where("idDownload",$idDownload);

		$this->db->delete("nsp_download");

	}

	/*end remove download*/



	/*enable download */

		public function enable($status,$id){

			if($status==0)

			$status=1;

			else

			$status=0;

			$qr = $this->db->query("UPDATE nsp_download_categories SET enable_download_categories=".$status." WHERE idProducts=".$id."" );

		}

	/*end enable download */

	

	/*enable download */

		public function enable_sub($status,$id){

			if($status==0)

			$status=1;

			else

			$status=0;

			$qr = $this->db->query("UPDATE nsp_download SET enable_download=".$status." WHERE idDownload=".$id."" );

		}

	/*end enable download */



	

}

?>