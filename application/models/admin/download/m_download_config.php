<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Jorge Torres

 * Description: Login model class

 */

class M_download_config extends CI_Model{

    function __construct(){

        parent::__construct();

		$this->load->database();

			$this->load->helper("url");

    }

	/*get config download*/

		public function getDownloadConfig(){

			$querydownload_config=$this->db->query(

			'select *

			from nsp_modules_config

			where mid_modules_config =10');

			$getDownloadConfig=$querydownload_config->result();

			

			return $getDownloadConfig;

		}

	/*end config download*/

	/*edit config download*/

		public function editDownloadConfig($name_modules_config,$data){

			$this->db->where("name_modules_config",$name_modules_config);

			$this->db->update('nsp_modules_config', $data);

		}

	/*end edit config download*/

}

?>

