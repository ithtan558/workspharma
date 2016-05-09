<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Jorge Torres

 * Description: Login model class

 */

class M_download_categories extends CI_Model{

    function __construct(){

        parent::__construct();

		$this->load->database();

			$this->load->helper("url");

    }

    /*list download_categories*/

		public function listDownloadCategories(){

		$download_categories_list=$this->db->get('nsp_download_categories');

		$download_categories = array();

		foreach ($download_categories_list->result() as $DownloadCategories){

			$option_list = $this->db->get_where('nsp_download', array('catid'=>$DownloadCategories->idDownloadCategories));

			$DownloadCategories->idDownloadCategorie = $option_list->result();

			$download_categories[] = $DownloadCategories;

  		}

		return $download_categories;

    }

	/*end list download_categories*/

	/*list download_categories sub*/

		public function listDownload(){

			$queryDownload=$this->db->query('select a.*,b.title_download from nsp_download_categories a,nsp_download b where a.catid=b.idDownloadCategories order by idDownloadCategories DESC');

			$listDownload=$queryDownload->result();

			return $listDownload;

		}

	/*end list download_categories sub*/

	

	/*get download categories*/

		public function getDownloadCategories($idDownloadCategories){

			$queryDownloadCategories=$this->db->query(

			'select *

			from nsp_download_categories

			where idDownloadCategories='.$idDownloadCategories.'');

			$getDownloadCategories=$queryDownloadCategories->result();

			

			return $getDownloadCategories;

		}

	/*end download categories*/

	

	/*add download categories */

		public function addDownloadCategories($data){

			$this->db->insert('nsp_download_categories', $data);

		}

	/*end add download categories */

	/*edit download categories */

		public function editDownloadCategories($idDownloadCategories,$data){

			$this->db->where("idDownloadCategories",$idDownloadCategories);

			$this->db->update('nsp_download_categories', $data);

		}

	/*end edit download categories */

	

	/*remove download categories*/

	public function removeDownloadCategories($idDownloadCategories)



	{

		$this->db->where("idDownloadCategories",$idDownloadCategories);

		$this->db->delete("nsp_download_categories");

	}

	/*end remove download categories*/



	/*enable download categories */

		public function enable($status,$id){

			if($status==0)

			$status=1;

			else

			$status=0;

			$qr = $this->db->query("UPDATE nsp_download_categories SET enable_download_categories=".$status." WHERE idDownloadCategories=".$id."" );

		}

	/*end enable download categories */

	

	/*enable download categories */

		public function enable_sub($status,$id){

			if($status==0)

			$status=1;

			else

			$status=0;

			$qr = $this->db->query("UPDATE nsp_download SET enable_download=".$status." WHERE idDownload=".$id."" );

		}

	/*end enable download categories */



	

}

?>

