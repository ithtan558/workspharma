<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class M_products_cat_manufacture extends CI_Model{
    function __construct(){
        parent::__construct();
		$this->load->database();
			$this->load->helper("url");
    }
	/*list products_cat_manufacture */
		public function listProductsCatManufacture(){
			$queryproducts_cat_manufacture=$this->db->query('select * from '.PREFIX.'products_cat_manufacture  order by idProductsCatManufacture DESC');
			$listProductsCatManufacture=$queryproducts_cat_manufacture->result();
			return $listProductsCatManufacture;
		}
	/*edit list products_cat_manufacture */
	
	/*get products_cat_manufacture*/
		public function getProductsCatManufacture($idProductsCatManufacture){
			$queryproducts_cat_manufacture=$this->db->query(
			'select *
			from '.PREFIX.'products_cat_manufacture
			where idProductsCatManufacture='.$idProductsCatManufacture.'');
			$getProductsCatManufacture=$queryproducts_cat_manufacture->result();
			
			return $getProductsCatManufacture;
		}
	/*edit products_cat_manufacture*/
	
	/*add products_cat_manufacture*/
		public function addProductsCatManufacture($data){
			$this->db->insert(''.PREFIX.'products_cat_manufacture', $data);
		}
	/*edit add products_cat_manufacture*/
	/*sửa products_cat_manufacture*/
		public function editProductsCatManufacture($idProductsCatManufacture,$data){
			$this->db->where("idProductsCatManufacture",$idProductsCatManufacture);
			$this->db->update(''.PREFIX.'products_cat_manufacture', $data);
		}
	/*edit sửa products_cat_manufacture*/
	
	/*remove products_cat_manufacture*/
	public function removeProductsCatManufacture($idProductsCatManufacture)

	{
		$this->db->where("idProductsCatManufacture",$idProductsCatManufacture);
		$this->db->delete("".PREFIX."products_cat_manufacture");
	}
	/*edit remove products_cat_manufacture*/

	/*enable products_cat_manufacture*/
		public function enable($status,$id){
			if($status==0)
			$status=1;
			else
			$status=0;
			$qr = $this->db->query("UPDATE ".PREFIX."products_cat_manufacture SET enable_products_cat_manufacture=".$status." WHERE idProductsCatManufacture=".$id."" );
		}
	/*edit enable products_cat_manufacture*/
	
}
?>
