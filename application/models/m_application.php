<?php
if(!isset($_SESSION))@session_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class M_application extends CI_Model{
	public $listMenuBottom=array();
	public $listMenu=array();
	public $where="";
	public $languages="";
	public $listBlocks="";
    function __construct(){
        parent::__construct();
		$this->load->database();
		$this->load->helper("getalias");
		$this->load->library('session');
		if($this->session->userdata("languages"))
		{
			if($this->session->userdata("languages")=='vietnamese')
			{
				$this->languages=$languages='';
			}
			else
			{
				$this->languages=$languages='_en';
			}
		}
		else
		{
			$queryLanguages=$this->db->query('select
			code_languages
			from pt_languages
			where default_languages=1 and enable_languages=1');
			$getLanguages=$queryLanguages->result();
			$this->languages=	$getLanguages[0]->code_languages;
		}
		$listBlocks=$this->db->query('select
			enable_blocks,
			html_content_blocks,
			name_blocks
			from '.PREFIX.'blocks
			where enable_blocks=1');
			$listBlocks=$listBlocks->result();
			$this->listBlocks=$listBlocks;
    }
	/*check languages*/
	/*end check languages*/
	/*List article about us*/
		public function listBlocks(){
			$this->db->cache_on();
			$listBlocks=$this->db->query('select
			enable_blocks,
			html_content_blocks,
			name_blocks,
			title_blocks,
			limit_show
			from '.PREFIX.'blocks
			where enable_blocks=1');
			$listBlocks=$listBlocks->result();
			$this->listBlocks=$listBlocks;
			return $listBlocks;
		}
	/*end List article about us*/
	
	/*List blocks support online*/
		public function listSupportOnline(){
			$queryBlocksSupportOnline=$this->db->query('select
			name_support_online, phone_support_online, skype_support_online, email_support_online, yahoo_support_online
			from '.PREFIX.'support_online where enable_support_online=1 order by ordering_support_online');
			$listBlocksSupportOnline=$queryBlocksSupportOnline->result();
			return $listBlocksSupportOnline;
		}
	/*end blocks support online*/
    /*List article about us*/
		public function listArticles(){
			$languages=$this->languages;
			$queryarticles=$this->db->query("select
			idArticles,catid,
			thumb_articles,
			title_articles, title".$languages."_articles as title_articles,
			introtext_articles,introtext".$languages."_articles as introtext_articles,
			fulltext_articles,fulltext".$languages."_articles as fulltext_articles,
			name_articles_categories,name".$languages."_articles_categories as name_articles_categories,
			alias_articles_categories,alias".$languages."_articles_categories as alias_articles_categories,
			alias_articles,alias".$languages."_articles as alias_articles
			from ".PREFIX."articles a, ".PREFIX."articles_categories b
			where b.idArticlesCategories=a.catid and a.enable_articles=1 order by ordering_articles");
			$listArticles=$queryarticles->result();
			return $listArticles;
		}
	/*end List article about us*/
	/*List article about us*/
		public function listArticlesCategories(){
			$languages=$this->languages;
			$listArticlesCategories=$this->db->query("select
			idArticlesCategories,parentid,
			name_articles_categories,name".$languages."_articles_categories as name_articles_categories,
			alias_articles_categories,alias".$languages."_articles_categories as alias_articles_categories
			from  ".PREFIX."articles_categories
			where enable_articles_categories=1 order by ordering_articles_categories");
			$listArticlesCategories=$listArticlesCategories->result();
			return $listArticlesCategories;
		}
	/*end List article about us*/
	/*List article about us*/
		public function getCopyright(){
			$this->db->cache_on();
			$queryCopyright=$this->db->query('select html_content_blocks
			from '.PREFIX.'blocks
			where idBlocks=5');
			$getCopyright=$queryCopyright->result();
			return $getCopyright;
		}
	/*end List article about us*/
	/*get config*/
		public function getConfig(){
			$queryconfig=$this->db->query('select value, name
			from '.PREFIX.'config');
			$listConfig=$queryconfig->result();
			return $listConfig;
		}
	/*end get config*/
	/*list banner*/
		public function listBanner(){
			$listBanner=$this->db->query('select paramid, image_adv_right, url_adv_right, text_adv_right
			from '.PREFIX.'adv_right
			where enable_adv_right=1 order by ordering_adv_right');
			$listBanner=$listBanner->result();
			return $listBanner;
		}
	/*end list banner*/
	/*get list New Articles*/
		public function listBlocksNewArticles(){
			$languages=$this->languages;
			$listBlocks=$this->listBlocks;
			foreach($listBlocks as $blocks)
			{
				if($blocks->name_blocks=='block_new_articles')
				{
					$block_new_articles=$blocks->limit_show;
				}
			}
			$queryBlocksNewArticle=$this->db->query("select a.*,
			name_articles_categories,name".$languages."_articles_categories as name_articles_categories,
			alias_articles_categories,alias".$languages."_articles_categories as alias_articles_categories
			from ".PREFIX."articles a,".PREFIX."articles_categories b
			where a.catid=b.idArticlesCategories and b.alias_articles_categories='tin-tuc' and a.is_new_articles=1 and a.enable_articles=1 order by ordering_articles asc  limit 0,".$block_new_articles."");
			$listBlocksNewArticle=$queryBlocksNewArticle->result();
			return $listBlocksNewArticle;
		}
	/*end list New Articles*/
	/*get list New Articles*/
		public function listBlocksTopNews(){
			$languages=$this->languages;
			$listBlocks=$this->listBlocks;
			foreach($listBlocks as $blocks)
			{
				if($blocks->name_blocks=='block_top_news')
				{
					$block_top_news=$blocks->limit_show;
				}
			}
			$queryBlocksTopNews=$this->db->query("select a.*,
			name_articles_categories,name".$languages."_articles_categories as name_articles_categories,
			alias_articles_categories,alias".$languages."_articles_categories as alias_articles_categories
			from ".PREFIX."articles a,".PREFIX."articles_categories b
			where a.catid=b.idArticlesCategories and b.alias_articles_categories='tin-tuc' and a.is_top_news=1 and a.enable_articles=1 order by ordering_articles asc  limit 0,".$block_top_news."");
			$listBlocksTopNews=$queryBlocksTopNews->result();
			return $listBlocksTopNews;
		}
	/*end list New Articles*/
	/*get list New Articles*/
		public function listBlocksFinishProjects(){
			$languages=$this->languages;
			$listBlocks=$this->listBlocks;
			foreach($listBlocks as $blocks)
			{
				if($blocks->name_blocks=='block_finish_projects')
				{
					$blocks_new_articles=$blocks->limit_show;
				}
			}
			$listBlocksFinishProjects=$this->db->query("select a.*,
			name_articles_categories,name".$languages."_articles_categories as name_articles_categories,
			alias_articles_categories,alias".$languages."_articles_categories as alias_articles_categories
			from ".PREFIX."articles a,".PREFIX."articles_categories b
			where a.catid=b.idArticlesCategories and a.is_new_articles=1 and b.alias_articles_categories='du-an-da-thuc-hien' and a.enable_articles=1 order by ordering_articles asc  limit 0,".$blocks_new_articles."");
			$listBlocksFinishProjects=$listBlocksFinishProjects->result();
			return $listBlocksFinishProjects;
		}
	/*end list New Articles*/
	/* Get Categories
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getCategories($conditions=array(),$fields='', $where_in = '',$limit=array(),$orderby=array())
	 {
		$languages=$this->languages;
	 	//Check For Conditions
	 	if(count($conditions)>0)
	 		$this->db->where($conditions);
	 	if($where_in != ''){
	 		$this->db->where_in('categories.id', $where_in);
	 	}
         //Check For Limit
         if(is_array($limit))
         {
             if(count($limit)==1)
                 $this->db->limit($limit[0]);
             else if(count($limit)==2)
                 $this->db->limit($limit[0],$limit[1]);
         }
         //Check for Order by
         if(is_array($orderby) and count($orderby)>0)
             $this->db->order_by($orderby[0], $orderby[1]);
		$this->db->from('categories');
		//Check For Fields
		if($fields!='')
				$this->db->select($fields);
		else
	 		$this->db->select('categories.view_search,categories.id,categories.parent_id,
	 			categories.category_name, categories.category'.$languages.'_name as category_name,
	 			categories.description, categories.page_title, categories.meta_keywords,
	 			categories.meta_description, categories.is_active, categories.created, categories.modified');
		$result = $this->db->get();
		return $result;
	 }//End of getCategories Function
	 /**
	 * Get admin roles
	 *
	 * @access	private
	 * @param	nil
	 * @return	object	object with result set
	 */
	 function getDistrict($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby=array())
	 {
	 	//Check For Conditions
	 	if(is_array($conditions) and count($conditions)>0)
	 		$this->db->where($conditions);
		//Check For like statement
	 	if(is_array($like) and count($like)>0)
	 		$this->db->like($like);
		//Check For Limit
		if(is_array($limit))
		{
			if(count($limit)==1)
	 			$this->db->limit($limit[0]);
			else if(count($limit)==2)
				$this->db->limit($limit[0],$limit[1]);
		}
		//Check for Order by
		if(is_array($orderby) and count($orderby)>0)
			$this->db->order_by($orderby[0], $orderby[1]);
		$this->db->from('district');
		$result = $this->db->get();
		return $result;
	 }//End of getUsers Function
	 /**
	 * Get admin roles
	 *
	 * @access	private
	 * @param	nil
	 * @return	object	object with result set
	 */
	 function getCities($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby=array())
	 {
	 	//Check For Conditions
	 	if(is_array($conditions) and count($conditions)>0)
	 		$this->db->where($conditions);
		//Check For like statement
	 	if(is_array($like) and count($like)>0)
	 		$this->db->like($like);
		//Check For Limit
		if(is_array($limit))
		{
			if(count($limit)==1)
	 			$this->db->limit($limit[0]);
			else if(count($limit)==2)
				$this->db->limit($limit[0],$limit[1]);
		}
		//Check for Order by
		if(is_array($orderby) and count($orderby)>0)
			$this->db->order_by($orderby[0], $orderby[1]);
		$this->db->from('cities');
		$result = $this->db->get();
		return $result;
	 }//End of getUsers Function
}
?>