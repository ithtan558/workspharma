<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Jorge Torres

 * Description: Login model class

 */

class M_article extends CI_Model{

    function __construct(){

        parent::__construct();

		$this->load->database();
		
		$this->_gallery_path = realpath(APPPATH. "../public/images/articles/".date("m_Y"));

    }

	//upload images

		public function do_upload(){
			
			$path = "./public/images/articles/".date("m_Y");
			
			$in = array("jpg", "png", "gif", "bmp");

			$name=$_FILES['thumb_articles']['name'];

			$out = array("php", "php4", "php5", "exe","psd");

			if(in_array(end(explode('.',$name)),$in) && !in_array(end(explode('.',$name)),$out))

			{
				$name=getAlias($name);
				$filename=encrypt_name($name);
				$config = array('upload_path'   => $this->_gallery_path,

							'allowed_types' => 'gif|jpg|png',

							'max_size'      => '200000',

							'file_name'      => $filename);

				$this->load->library("upload");
				$this->upload->initialize($config);

				if(!$this->upload->do_upload("thumb_articles")){

					$error = array($this->upload->display_errors());

				}else{

					$image_data = $this->upload->data();    
					$_POST['file_name'] = $image_data['file_name'];

				}



				//kết thúc công đoạn upload hình ảnh

				$config = array("source_image" => $image_data['full_path'],

							"new_image" => $this->_gallery_path . "",

							"maintain_ration" => true);

				$this->load->library("image_lib",$config);

				$this->image_lib->resize();

			}

			else

			{

				return false;

			}

		}

	/*get list articles categories*/

		public function listArticleCategories(){

			$queryarticles_categories=$this->db->query('select * from '.PREFIX.'articles_categories order by name_articles_categories');

			$listArticlesCategories=$queryarticles_categories->result();

			return $listArticlesCategories;

		}

	/*end get list articles categories*/

	

    /*get list articles*/

		public function listArticle(){
			$where="";
			if(isset($_SESSION['__enable_articles__']) )
			{
				if($_SESSION['__enable_articles__']!=-1)
				{
					$where.=" and enable_articles=".$_SESSION['__enable_articles__']." ";
				}
			}
			if(isset($_SESSION['__idArticlesCategories__']) )
			{
				if($_SESSION['__idArticlesCategories__']!=0)
				{
					$where.=" and catid in (".$_SESSION['__idArticlesCategories__'].") ";
				}
			}

			$queryarticle=$this->db->query("select a.*,b.name_articles_categories 
			from ".PREFIX."articles a,".PREFIX."articles_categories b 
			where a.catid=b.idArticlesCategories ".$where." order by b.idArticlesCategories, ordering_articles");

			$listArticle=$queryarticle->result();
			
			/*$queryarticle1=$this->db->query("select * from ".PREFIX."articles where catid=12");

			$listArticle1=$queryarticle1->result();
			foreach($listArticle1 as $article)
			{
				//$fulltext=str_replace('images/stories/kien-thuc/2014/','public/images/articles/kien-thuc/2014/07/',$article->fulltext_articles);
						$fulltext=str_replace('images/stories/tin-tuc/2013/','public/images/articles/tin-tuc/2013/07/',$article->fulltext_articles);
				
					$queryarticle=$this->db->query("update ".PREFIX."articles set fulltext_articles='".$fulltext."' where idArticles=".$article->idArticles."");
					//$listArticle=$queryarticle->result();
				
			}*/

			return $listArticle;

		}

	/*end get list articles*/
	
	/*get list articles*/

		public function listArticleRelated($idArticles){
			$getArticles=$this->getArticle($idArticles);
			$queryarticle=$this->db->query('select * from '.PREFIX.'articles where idArticles in ('.$getArticles[0]->related_articles.')');

			$listArticleRelated=$queryarticle->result();

			return $listArticleRelated;

		}

	/*end get list articles*/

	

	/*get list articles temp*/

		public function listArticleTemp($idArticlesCategories){

			$queryarticle=$this->db->query('select a.*,b.name_articles_categories 
			from '.PREFIX.'articles a,'.PREFIX.'articles_categories b 
			where a.catid=b.idArticlesCategories and idArticlesCategories = '.$idArticlesCategories.' and enable_articles=1 order by ordering_articles asc');

			$listArticle=$queryarticle->result();

			return $listArticle;

		}

	/*end get list articles temp*/

	

	/*Lấy get articles*/

		public function getArticle($idArticles){

			$queryarticle=$this->db->query(

			'select *

			from '.PREFIX.'articles

			where idArticles='.$idArticles.'');

			$getArticle=$queryarticle->result();
			$_SESSION['__idArticlesCategories__']=$getArticle[0]->catid;
			

			return $getArticle;

		}

	/*end get articles*/

	

	/*add articles*/

		public function addArticle($data){

			$this->db->insert(''.PREFIX.'articles', $data);

		}

	/*end add articles*/

	/*edit articles*/

		public function editArticle($idArticles,$data){

			$this->db->where("idArticles",$idArticles);

			$this->db->update(''.PREFIX.'articles', $data);

		}

	/*end edit articles*/
	
	
	/*insert_related*/

		public function insert_related($string,$number){
			
			
			if (($key = array_search('on', $string)) !== false) {
				unset($string[$key]);
			}
			
			$string = implode(",", $string);
			
			if($number)
			{
				$number = implode(",", $number);
			}
			else
			{
				$number = 0;
			}
			$queryarticle = $this->db->query("select * from ".PREFIX."articles where idArticles not in (".$number.") and idArticles in (".$string.")");

			$insert_related=$queryarticle->result();

			

			return $insert_related;

		}

	/*end insert_related*/

	

	/*remove articles*/

		public function removeArticle($idArticles)

		{

			$this->db->where("idArticles",$idArticles);

			$this->db->delete("".PREFIX."articles");

		}

	/*end remove articles*/

	/*enable articles*/

		public function enable($enable,$id){

			if($enable==0)

			$enable=1;

			else

			$enable=0;

			$qr = $this->db->query("UPDATE ".PREFIX."articles SET enable_articles=".$enable." WHERE idArticles=".$id."" );

		}

	/*end enable articles*/

	/*check_ordering*/

		public function check_ordering($idArticles,$data){

			$this->db->where("idArticles",$idArticles);

			$this->db->update(''.PREFIX.'articles', $data);

		}

	/*end check_ordering*/

	/*get record next ordering*/

		public function getOrderingPrevious($ordering_articles){

			$queryOrderingPrevious=$this->db->query(

			'select *

			from '.PREFIX.'articles

			where ordering_articles='.($ordering_articles+1).'');

			$getOrderingPrevious=$queryOrderingPrevious->result();

			return $getOrderingPrevious;

		}

	/*end get record next ordering*/

	

	/*get record next ordering*/

		public function getOrderingNext($ordering_articles){

			$queryOrderingNext=$this->db->query(

			'select *

			from '.PREFIX.'articles

			where ordering_articles='.($ordering_articles-1).'');

			$getOrderingNext=$queryOrderingNext->result();

			return $getOrderingNext;

		}

	/*end get record next ordering*/
	
	/*list string articles categories sub*/
	function stringIdArticlesCategories($idArticlesCategories){
        $this->db->order_by('parentid','asc')->group_by('parentid,idArticlesCategories');
        $q=$this->db->where('enable_articles_categories',1);
		$this->db->select('idArticlesCategories,parentid');
        $q=$this->db->get(''.PREFIX.'articles_categories');
        foreach($q->result() as $r){
            $data[$r->parentid][] = $r;
        }
        $menu=$this->getStringIdArticlesCategories($data,$idArticlesCategories);
        return $menu;
    } 
	/*end list string articles categories sub*/
	
	/*list string articles categories nhưng không lấy sub*/
	function listArticlesCategoriesSubNotSub($idArticlesCategories){
        $this->db->order_by('ordering_articles_categories','asc');
        $q=$this->db->where('parentid',$idArticlesCategories);
        $q=$this->db->where('enable_articles_categories',1);
        $q=$this->db->get(''.PREFIX.'articles_categories');
        $menu=$q->result();
        return $menu;
    } 
	/*end list string articles categories nhưng không lấy sub*/
	
	
	function getStringIdArticlesCategories($category,$parent){
        static $i = 1;
        if (array_key_exists($parent, $category)){
            $menu = '';
            $i++;
				$menu.=$parent.',';
            foreach ($category[$parent] as $r) {
                $child = $this->getStringIdArticlesCategories($category, $r->idArticlesCategories);
				$menu.=$r->idArticlesCategories.',';
                if ($child) {
                    $i--;
                    $menu .= $child;
                }
            }		
            return $menu;
        } else {
            return false;
        }
    } 
	/*list articles_categories*/

	

}

?>