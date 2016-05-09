<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Jorge Torres

 * Description: Login model class

 */

class M_blocks_typcial_products extends CI_Model{

    function __construct(){

        parent::__construct();

		$this->load->database();

			$this->load->helper("url");

    }

	

	/*list Blocks Typcial Products*/

		public function listBlocksTypcialProducts(){

			$queryproducts_categoriesSub=$this->db->query('select a.*,b.name_products_categories from '.PREFIX.'products a,'.PREFIX.'products_categories b where a.catid=b.idProductsCategories and a.is_typcial_products=1 and a.parentid=0 and a.enable_products=1 order by idProductsCategories DESC');

			$listBlocksTypcialProducts=$queryproducts_categoriesSub->result();

			return $listBlocksTypcialProducts;

		}

	/*end list Blocks Typcial Products sub*/	

	

	/*list Blocks Not Typcial Products*/

		public function listProductsNotTypcial(){

			$queryProductsNotTypcial=$this->db->query('select a.*,b.name_products_categories from '.PREFIX.'products a,'.PREFIX.'products_categories b where a.catid=b.idProductsCategories and a.is_typcial_products=0 and a.parentid=0 and a.enable_products=1 order by idProductsCategories DESC');

			$listProductsNotTypcial=$queryProductsNotTypcial->result();

			return $listProductsNotTypcial;

		}

	/*end list Blocks Not Typcial Products*/	

	

	

	/*add Blocks Typcial Products*/

		public function addProducts($data){

			$this->db->insert(''.PREFIX.'products', $data);

		}

	/*end add Blocks Typcial Products*/

	/*remove Blocks Typcial Products*/

		public function addBlocksTypcialProducts($idProducts,$data){

			$this->db->where("idProducts",$idProducts);

			$this->db->update(''.PREFIX.'products', $data);

		}

	/*end remove Blocks Typcial Products*/	

	

	/*remove Blocks Typcial Products*/

		public function removeBlocksTypcialProducts($idProducts,$data){

			$this->db->where("idProducts",$idProducts);

			$this->db->update(''.PREFIX.'products', $data);

		}

	/*end remove Blocks Typcial Products*/	

}

?>