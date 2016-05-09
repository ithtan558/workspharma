<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class M_order_config extends CI_Model{
    function __construct(){
        parent::__construct();
		$this->load->database();
			$this->load->helper("url");
    }
	/*get config order*/
		public function getOrderConfig(){
			$queryorder_config=$this->db->query(
			'select *
			from '.PREFIX.'order_config');
			$getOrderConfig=$queryorder_config->result();
			
			return $getOrderConfig;
		}
	/*end config order*/
	/*edit config order*/
		public function editOrderConfig($name_order_config,$data){
			$this->db->where("name_order_config",$name_order_config);
			$this->db->update(''.PREFIX.'order_config', $data);
		}
	/*end edit config order*/
}
?>
