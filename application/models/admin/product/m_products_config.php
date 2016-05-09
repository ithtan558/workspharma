<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class M_products_config extends CI_Model{
    function __construct(){
        parent::__construct();
		$this->load->database();
			$this->load->helper("url");
    }
	/*get config products*/
		public function getProductsConfig(){
			$queryproducts_config=$this->db->query(
			'select *
			from '.PREFIX.'modules_config
			where mid_modules_config =3');
			$getProductsConfig=$queryproducts_config->result();
			
			return $getProductsConfig;
		}
	/*end config products*/
	/*edit config products*/
		public function editProductsConfig($name_modules_config,$data){
			$this->db->where("name_modules_config",$name_modules_config);
			$this->db->update(''.PREFIX.'modules_config', $data);
		}
	/*end edit config products*/
}
?>
