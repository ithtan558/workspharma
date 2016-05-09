<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Jorge Torres

 * Description: Login model class

 */

class M_blocks_new_articles extends CI_Model{

    function __construct(){

        parent::__construct();

		$this->load->database();

		$this->_gallery_path = realpath(APPPATH. "../public/images/articles");

    }

	

    /*get list New Articles*/

		public function listBlocksNewArticles(){

			$queryBlocksNewArticle=$this->db->query("select a.*,b.name_articles_categories from ".PREFIX."articles a,".PREFIX."articles_categories b where a.catid=b.idArticlesCategories and a.is_new_articles=1 and b.alias_articles_categories='tin-tuc' and a.enable_articles=1 order by idArticles DESC");

			$listBlocksNewArticle=$queryBlocksNewArticle->result();

			return $listBlocksNewArticle;

		}

	/*end list New Articles*/

	

	/*get list New Articles*/

		public function listBlocksNotNew(){

			$queryBlocksNotNew=$this->db->query("select a.*,b.name_articles_categories from ".PREFIX."articles a,".PREFIX."articles_categories b where a.catid=b.idArticlesCategories and a.is_new_articles=0 and b.alias_articles_categories='tin-tuc' and a.enable_articles=1 order by idArticles DESC");

			$listBlocksNotNew=$queryBlocksNotNew->result();

			return $listBlocksNotNew;

		}

	/*end list New Articles*/

	/*add New Articles*/

		public function addBlocksNewArticles($idArticles,$data){

			$this->db->where("idArticles",$idArticles);

			$this->db->update(''.PREFIX.'articles', $data);

		}

	/*end add New Articles*/

	/*remove New Articles*/

		public function removeBlocksNewArticles($idArticles,$data){

			$this->db->where("idArticles",$idArticles);

			$this->db->update(''.PREFIX.'articles', $data);

		}

	/*remove add New Articles*/

	

}

?>