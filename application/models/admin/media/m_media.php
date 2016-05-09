<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Jorge Torres

 * Description: Login model class

 */

class M_media extends CI_Model{

    function __construct(){

        parent::__construct();

		$this->load->database();

			$this->load->helper("url");

			$this->load->library('session');

			$url="";

			for($i=4;$i<=10;$i++)

			{

				if($this->uri->segment($i))

				{

					$url.=$this->uri->segment($i).'/';

				}

			}

			$this->_gallery_path = realpath(APPPATH. "../public/images/".$this->session->userdata("__url__")."");

    }

	

	public function do_upload($filename){

		$path = "./public/uploads/download/".date("m_Y");

		if(!is_dir($path)) //create the folder if it's not already exists

		{

			mkdir($path,0777,TRUE);

		}


		$in = array("jpg", "png", "gif", "bmp","pdf","doc","docx","xls","xlsx");

		$name=$_FILES[$filename]['name'];

		$out = array("php", "php4", "php5", "exe","psd");

		if(in_array(end(explode('.',$name)),$in) && !in_array(end(explode('.',$name)),$out))

		{

			$config = array('upload_path'   => $this->_gallery_path,

							'allowed_types' => 'gif|jpg|png|pdf|doc|docx|xls|xlsx',

							'max_size'      => '200000',);

			$this->load->library("upload",$config);

			if(!$this->upload->do_upload($filename)){

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

	

	public function do_create_folder($filename){

		
		
		$fname_folder=$this->input->post('fname_folder');

		$path = "./public/images/".$this->session->userdata("__url__").$fname_folder."/";

		if(!is_dir($path)) //create the folder if it's not already exists

		{
			$this->load->library("ftp");
			$config['hostname'] = 'localhost';
			$config['username'] = 'user@fredton.vn';
			$config['password'] = '5~6!USfe&G+i';
			$config['port']     = 21;
			$config['passive']  = FALSE;
			$config['debug']    = TRUE;
			$this->ftp->connect($config);
			if($this->ftp->mkdir($path, 0777));
			$this->ftp->chmod($path, 0777);
			$this->ftp->close();

		}

		else

		{

			return false;

		}

    }

	public function removeMedia($dir){

		foreach ($files as $file) { 

		  (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 

		} 

	    rmdir($dir); 

    }



	

}

?>