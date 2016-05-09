<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Jorge Torres

 * Description: Login model class

 */

class M_products extends CI_Model{

    function __construct(){

        parent::__construct();

		$this->load->database();

			$this->load->helper("url");

			$this->_gallery_path = realpath(APPPATH. "../public/images/products/".date("m_Y"));

			$this->_gallery_path1 = realpath(APPPATH. "../public/images/products");

    }

	//upload images

    public function do_upload($fullimage_products){

		$path = "./public/images/products/".date("m_Y");

		$path1 = "./public/images/products/thumbs/".date("m_Y");

		if(!is_dir($path)) //create the folder if it's not already exists

		{

			mkdir($path,0777,TRUE);

			

		}

		$in = array("jpg", "png", "gif", "bmp");

		$name=$_FILES[$fullimage_products]['name'];

		$out = array("php", "php4", "php5", "exe","psd");

		if(in_array(end(explode('.',$name)),$in) && !in_array(end(explode('.',$name)),$out))

		{

			$config = array('upload_path'   => $this->_gallery_path,

							'allowed_types' => 'gif|jpg|png');

			$this->load->library("upload",$config);

			if(!$this->upload->do_upload($fullimage_products)){

				$error = array($this->upload->display_errors());

				echo $this->upload->display_errors();

			}else{

				$image_data = $this->upload->data();    

			}

		}

		else

		{

			return false;

		}

    }

	

	 public function do_upload1(){

		$path = "./public/images/products/".date("m_Y");

		if(!is_dir($path)) //create the folder if it's not already exists

		{

			mkdir($path,0777,TRUE);

		}

		$in = array("jpg", "png", "gif", "bmp");

		$name=$_FILES['thumb_products']['name'];

		$out = array("php", "php4", "php5", "exe","psd");

		if(in_array(end(explode('.',$name)),$in) && !in_array(end(explode('.',$name)),$out))

		{

			$config = array('upload_path'   => $this->_gallery_path,

							'allowed_types' => 'gif|jpg|png',

							'max_size'      => '200000',

							"width" => '200',

							"height" => "200");

			$this->load->library("upload",$config);

			if(!$this->upload->do_upload('thumb_products')){

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

	

    /*list products_categories*/

		public function listProductsCategories(){

		$products_categories_list=$this->db->get('nsp_products_categories');

		$productsCategorie = array();

		foreach ($products_categories_list->result() as $productsCategories){

			$option_list = $this->db->get_where('nsp_products', array('catid'=>$productsCategories->idProductsCategories));

			$productsCategories->idProductsCategorie = $option_list->result();

			$productsCategorie[] = $productsCategories;

  		}

		return $productsCategorie;

    }

	/*end list products_categories*/

	

	/*list products_categories sub*/

		public function listProductsManufacture(){

			$querylistProductsManufacture=$this->db->query('select * from nsp_products_manufacture order by idProductsManufacture DESC');

			$listProductsManufacture=$querylistProductsManufacture->result();

			return $listProductsManufacture;

		}

	/*end list products_categories sub*/

	

	/*list products_categories sub*/

		public function listProducts(){

			$queryproducts_categoriesSub=$this->db->query('select a.*,b.title_products_categories from nsp_products_categories a,nsp_products_categories b where a.idProductsCategories=b.idProductsCategories order by idProductsCategories DESC');

			$listProducts=$queryproducts_categoriesSub->result();

			return $listProducts;

		}

	/*end list products_categories sub*/

	

	/*get products*/

		public function getProducts($idProducts){

			$queryproducts=$this->db->query(

			'select *

			from nsp_products

			where idProducts='.$idProducts.'');

			$getProducts=$queryproducts->result();

			

			return $getProducts;

		}

	/*end products*/

	

	/*add products*/

		public function addProducts($data){

			$this->db->insert('nsp_products', $data);

		}

	/*end add products*/

	/*edit products*/

		public function editProducts($idProducts,$data){

			$this->db->where("idProducts",$idProducts);

			$this->db->update('nsp_products', $data);

		}

	/*end edit products*/

	

	/*remove loại*/

	public function removeProducts($idProducts)



	{

		$this->db->where("idProducts",$idProducts);

		$this->db->delete("nsp_products");

	}

	/*end remove loại*/



	/*enable products*/

		public function enable($status,$id){

			if($status==0)

			$status=1;

			else

			$status=0;

			$qr = $this->db->query("UPDATE nsp_products_categories SET enable_products_categories=".$status." WHERE idProductsCategories=".$id."" );

		}

	/*end enable products*/

	

	/*enable products*/

		public function enable_products($status,$id){

			if($status==0)

			$status=1;

			else

			$status=0;

			$qr = $this->db->query("UPDATE nsp_products SET enable_products=".$status." WHERE idProducts=".$id."" );

		}

	/*end enable products*/

}

?>

