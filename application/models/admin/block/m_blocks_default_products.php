<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Jorge Torres

 * Description: Login model class

 */

class M_blocks_default_products extends CI_Model{

    function __construct(){

        parent::__construct();

		$this->load->database();

			$this->load->helper("url");

    }

	

	/*list Blocks Default Products*/

		public function listBlocksDefaultProducts(){
			
			
			$queryproducts_categoriesSub=$this->db->query('select a.*,b.name_products_categories from '.PREFIX.'products a,'.PREFIX.'products_categories b where a.catid=b.idProductsCategories and a.is_default_products=1 and a.parentid=0  and a.enable_products=1 order by idProductsCategories DESC');

			$listBlocksDefaultProducts=$queryproducts_categoriesSub->result();

			return $listBlocksDefaultProducts;

		}

	/*end list Blocks Default Products sub*/	

	

	/*list Blocks Not Default Products*/

		public function listProductsNotDefault(){
			$where="";
			if(isset($_SESSION['__enable_products__']) )
			{
				if($_SESSION['__enable_products__']!=-1)
				{
					$this->db->where('enable_products',$_SESSION['__enable_products__']);
				}
			}
			if(isset($_SESSION['__idProductsCategories__']) )
			{
				if($_SESSION['__idProductsCategories__']!=0 )
				{
					$this->db->where_in('catid',$_SESSION['__idProductsCategories__']);
				}
			}
				$this->db->where('parentid',0);
				$queryProductsNotDefault = $this->db->get(''.PREFIX.'products');

			$listProductsNotDefault=$queryProductsNotDefault->result();

			return $listProductsNotDefault;

		}

	/*end list Blocks Not Default Products*/	

	

	

	/*add Blocks Default Products*/

		public function addProducts($data){

			$this->db->insert(''.PREFIX.'products', $data);

		}

	/*end add Blocks Default Products*/

	/*remove Blocks Default Products*/

		public function addBlocksDefaultProducts($idProducts,$data){

			$this->db->where("idProducts",$idProducts);

			$this->db->update(''.PREFIX.'products', $data);

		}

	/*end remove Blocks Default Products*/	

	

	/*remove Blocks Default Products*/

		public function removeBlocksDefaultProducts($idProducts,$data){

			$this->db->where("idProducts",$idProducts);

			$this->db->update(''.PREFIX.'products', $data);

		}

	/*end remove Blocks Default Products*/	

}

?>