<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class M_products_export extends CI_Model{
    function __construct(){
        parent::__construct();
		$this->load->database();
			$this->load->helper("url");
    }
	/*list products_manufacture */
		public function listProductsManufacture(){
			$queryproducts_manufacture=$this->db->query('select * from nsp_products_manufacture  order by idProductsManufacture DESC');
			$listProductsManufacture=$queryproducts_manufacture->result();
			return $listProductsManufacture;
		}
	/*edit list products_manufacture */
	/*list products_categories*/
		public function listProductsCategories(){
			$this->db->order_by("name_products_categories");
		$products_categories_list=$this->db->get('nsp_products_categories');
		$listProductsCategories= $products_categories_list->result();
		return $listProductsCategories;
    }
	/*end list products_categories*/
	
	/*list products_categories sub*/
		public function listProducts($status,$catid,$mid){
		//get products parent
			$this->db->order_by('name_products');
			if($status=="")
			{
				$products_list=$this->db->query('select * 
				from nsp_products a, nsp_products_categories b, nsp_products_manufacture c
				where catid='.$catid.' and mid='.$mid.' and a.mid=c.idProductsManufacture and a.catid=b.idProductsCategories and a.parentid =0');
			}
			else
			{
				$products_list=$this->db->query('select * 
				from nsp_products a, nsp_products_categories b, nsp_products_manufacture c
				where catid='.$catid.' and mid='.$mid.' and a.mid=c.idProductsManufacture and a.catid=b.idProductsCategories and enable_products='.$status.' and a.parentid =0');
			}
		//get products have parent
			$productsNoParent = array();
			foreach ($products_list->result() as $products){
				$productsparent_list=$this->db->query('select * 
					from nsp_products a, nsp_products_categories b, nsp_products_manufacture c
					where  parentid='.$products->idProducts.' and a.mid=c.idProductsManufacture and a.catid=b.idProductsCategories  and a.parentid!=0');
					$products->idProduct = $productsparent_list->result();
					$productsNoParent[] = $products;
			}
			return $productsNoParent;
		}
	/*end list products_categories sub*/
}
?>
