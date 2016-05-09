<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class M_products_manufacture extends CI_Model{
    function __construct(){
        parent::__construct();
		$this->load->database();
			$this->load->helper("url");
    }
	/*list products_manufacture */
		public function listProductsManufacture(){
			$queryproducts_manufacture=$this->db->query('select * from '.PREFIX.'products_manufacture a, '.PREFIX.'products_cat_manufacture b where a.idcatmanufacture=b.idProductsCatManufacture  order by idProductsManufacture DESC');
			$listProductsManufacture=$queryproducts_manufacture->result();
			return $listProductsManufacture;
		}
	/*edit list products_manufacture */
	
	/*get products_manufacture*/
		public function getProductsManufacture($idProductsManufacture){
			$queryproducts_manufacture=$this->db->query(
			'select *
			from '.PREFIX.'products_manufacture
			where idProductsManufacture='.$idProductsManufacture.'');
			$getProductsManufacture=$queryproducts_manufacture->result();
			
			return $getProductsManufacture;
		}
	/*edit products_manufacture*/
	
	/*add products_manufacture*/
		public function addProductsManufacture($data){
			$this->db->insert(''.PREFIX.'products_manufacture', $data);
		}
	/*edit add products_manufacture*/
	/*sửa products_manufacture*/
		public function editProductsManufacture($idProductsManufacture,$data){
			$this->db->where("idProductsManufacture",$idProductsManufacture);
			$this->db->update(''.PREFIX.'products_manufacture', $data);
		}
	/*edit sửa products_manufacture*/
	
	/*remove products_manufacture*/
	public function removeProductsManufacture($idProductsManufacture)

	{
		$this->db->where("idProductsManufacture",$idProductsManufacture);
		$this->db->delete("".PREFIX."products_manufacture");
	}
	/*edit remove products_manufacture*/

	/*enable products_manufacture*/
		public function enable($status,$id){
			if($status==0)
			$status=1;
			else
			$status=0;
			$qr = $this->db->query("UPDATE ".PREFIX."products_manufacture SET enable_products_manufacture=".$status." WHERE idProductsManufacture=".$id."" );
		}
	/*edit enable products_manufacture*/
	
}
?>
