<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION))@session_start();
require_once(APPPATH . 'controllers/admin/admin_application.php');
class Article extends Admin_application{
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
		$this->_data['article_default']=1;
			
		/*hepler*/
			$this->load->helper("url");	
			$this->load->helper("getalias");		
		/*Load model*/
			$this->load->Model("admin/article/m_article");
			$this->load->Model("admin/articles_categories/m_articles_categories");
	}
	
	public function index($idArticlesCategories=false)
	{
		$this->_data['article']=1;
		//sent data
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/article/main';
		//lists custom sent data
			if($idArticlesCategories!=false)
			{
				unset($_SESSION['__idArticlesCategories__']);
				$_SESSION['__idArticlesCategories__']=$idArticlesCategories;
				$listArticle=$this->m_article->listArticleTemp($idArticlesCategories);
			}
			else
			{
				$listArticle=$this->m_article->listArticle();
			}
			$this->_data['listArticle']=$listArticle;
		//load view
			/*foreach($listArticle as $row)
			{
				$data=array(
				'alias_articles' => getAlias($row->title_articles),
				'alias_en_articles' => getAlias($row->title_en_articles),	
				);
				$this->m_article->editArticle($row->idArticles,$data);
			}*/
			/*foreach($listArticle as $row)
			{
				
				//$thumb_articles='08_2014/'.$row->thumb_articles;
				$fulltext_articles=str_replace('http://www.huuthinh.vn/upload/images/','public/images/articles/08_2014/',$row->fulltext_articles);
				$data=array(
				'fulltext_articles' => ($fulltext_articles)
				);
				$this->m_article->editArticle($row->idArticles,$data);
			}*/
			$listArticlesCategoriesCombobox=$this->m_articles_categories->listArticlesCategoriesCombobox();
			$this->_data['listArticlesCategoriesCombobox']=$listArticlesCategoriesCombobox;
			$this->load->view('admin/main',$this->_data);
	}
	/*Trích lọc sản phẩm theo trạng thái, theo nhóm sản phẩm*/
	public function change_enable()
	{
		//sent data
		
		$enable_articles=$this->input->post('enable_articles');
		if($enable_articles!="")
		{
			$_SESSION['__enable_articles__']=$enable_articles;
		}
		$idArticlesCategories=$this->input->post('idArticlesCategories');
		if($idArticlesCategories!="")
		{
			
			$_SESSION['__idArticlesCategoriesTemp__']=$idArticlesCategories;
			$stringidArticlesCategories=$this->m_article->stringidArticlesCategories($idArticlesCategories);
			$stringidArticlesCategories.=$idArticlesCategories;
			$_SESSION['__idArticlesCategories__']=$stringidArticlesCategories;
		}
		$keyword=$this->input->post('keyword');
		$_SESSION['__keyword__']=$keyword;
	}
	/* end Trích lọc sản phẩm theo trạng thái, theo nhóm sản phẩm*/
	/*hiện ra popup sản phẩm liên quan*/
	public function related($idArticlesCategories=false)
	{
		//sent data
			$this->_data['title']=$this->config->item("title_index");
		//lists custom sent data
			if($idArticlesCategories!=false)
			{
				$this->_data['listArticle']=$this->m_article->listArticleTemp($idArticlesCategories);
			}
			else
			{
				$this->_data['listArticle']=$this->m_article->listArticle();
			}
		//load view
			$this->load->view('admin/bodyright/article/related',$this->_data);
	}
	/*add related*/
	/*end hiện ra popup sản phẩm liên quan*/
	
	/*chọn những sản phẩm liên quan*/
	public function add_related()
	{
		//sent data
			$this->_data['add_article']=1;
			$string=$this->input->post("selectedGroups");
			$number=$this->input->post("number");
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/article/addArticle';
		//lists custom sent data
			$insert_related=$this->m_article->insert_related($string,$number);
			$array_related="";
			foreach($insert_related as $related)
			{
				$array_related.= "<option selected='selected' value=".$related->idArticles.">".$related->title_articles."</option>";
			}
		//load view
			echo json_encode(array('result'=>$array_related));
	}
	/*end related*/
	/*end chọn những sản phẩm liên quan*/
	/*add article*/
	public function add_article()
	{
		//sent data
			$this->_data['add_article']=1;
			$_SESSION['__idArticlesCategories__']="";
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/article/addArticle';
			
		//lists custom sent data
			$listArticlesCategoriesCombobox=$this->m_articles_categories->listArticlesCategoriesCombobox();
			$this->_data['listArticlesCategoriesCombobox']=$listArticlesCategoriesCombobox;
		//load view
			$this->load->view('admin/main',$this->_data);
	}
	/*end article*/
	
	/*check add article*/
	public function check_add_article()
	{
		
		//upload images
			$this->m_article->do_upload();
		//get data
			$action=$this->input->post('t');
			$title_articles=$this->input->post('title_articles');
			$title_en_articles=$this->input->post('title_en_articles');
			$introtext_en_articles=$this->input->post('introtext_en_articles');
			$fulltext_en_articles=$this->input->post('fulltext_en_articles');
			$catid=$this->input->post('catid');
			if($_FILES['thumb_articles']['name']!="")
			{
				$thumb_articles=date("m_Y").'/'.$_POST['file_name'];
			}
			else
			{
				$thumb_articles="";
			}
			$introtext_articles=$this->input->post('introtext_articles');
			$fulltext_articles=$this->input->post('fulltext_articles');
			$meta_title_articles=$this->input->post('meta_title_articles');
			$meta_key_articles=$this->input->post('meta_key_articles');
			$meta_desc_articles=$this->input->post('meta_desc_articles');
			$enable_articles=$this->input->post('enable_articles');
			$created_by_articles=$this->session->userdata('__idUsers__');
			$created_articles=date('Y-m-d H:i:s');
			$related_articles="";
			if(isset($_POST['related_pro']))
			{
				$n=count($_POST['related_pro']);
				$stt=0;
				foreach($_POST['related_pro'] as $id)
				{
					if($stt==$n-1)
					{
						$related_articles.=$id;
					}
					else
					{
						$related_articles.=$id.',';
					}
					$stt++;
				}
			}
			else
			{
				$related_articles.=0;
			}
			
			$data=array(
			'idArticles'   => 'NULL',
			'title_articles' =>$title_articles,
			'title_en_articles' =>$title_en_articles,
			'alias_articles' =>getAlias($title_articles),
			'alias_en_articles' =>getAlias($title_en_articles),
			'catid' =>$catid,
			'related_articles' =>$related_articles,
			'thumb_articles' =>getAliasImg($thumb_articles),
			'introtext_articles' =>$introtext_articles,
			'introtext_en_articles' =>$introtext_en_articles,
			'fulltext_articles' =>$fulltext_articles,
			'fulltext_en_articles' =>$fulltext_en_articles,
			'created_articles' =>$created_articles,
			'created_by_articles' =>$created_by_articles,
			'hits_articles' =>1,
			'meta_title_articles' =>$meta_title_articles,
			'meta_key_articles' =>$meta_key_articles,
			'meta_desc_articles' =>$meta_desc_articles,
			'enable_articles' =>$enable_articles,
			'ordering_articles' =>0
			);
		//call function addArticle in model
			$this->m_article->addArticle($data);
		/* update all record with ordering*/
			$listArticle=$this->m_article->listArticleTemp($catid);
			$stt=0;
			foreach($listArticle as $articles){
				//if($articles->ordering_articles!=$stt+1)
				{
					$data=array(
					'ordering_articles' =>$stt+1
					);
					$this->m_article->check_ordering($articles->idArticles,$data);
				}
				$stt++;
			}
		//if action == save then action is save else action is save and close
			if($action=='save')
			{
				redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				if(isset($_SESSION['__idArticlesCategories__']))
				{
					redirect(URL."admin/article/index/");
				}
			}
		//sent data
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['messages']='Thêm Bài viết thành công.';
		
		//lists custom sent data
			$this->_data['listArticleCategories']=$this->m_article->listArticleCategories();
			$this->_data['listArticle']=$this->m_article->listArticle();
		//load view
			$this->load->view('admin/main',$this->_data);
	}
	/*end check add article*/
	
	/*edit article*/
	public function edit_article($idArticles)
	{
		//sent data
			$this->_data['add_article']=1;
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/article/editArticle';
		//lists custom sent data
			$this->_data['getArticle']=$this->m_article->getArticle($idArticles);
			$listArticlesCategoriesCombobox=$this->m_articles_categories->listArticlesCategoriesCombobox();
			$this->_data['listArticlesCategoriesCombobox']=$listArticlesCategoriesCombobox;
			
			$this->_data['listArticleRelated']=$this->m_article->listArticleRelated($idArticles);
		//load view
			$this->load->view('admin/main',$this->_data);
	}
	/*end edit article*/
	
	/*check edit_article*/
	public function check_edit_article($idArticles)
	{
		//upload images
			$this->m_article->do_upload();
		//get data
			$action=$this->input->post('t');
			$title_articles=$this->input->post('title_articles');
			$title_en_articles=$this->input->post('title_en_articles');
			$introtext_en_articles=$this->input->post('introtext_en_articles');
			$fulltext_en_articles=$this->input->post('fulltext_en_articles');
			$catid=$this->input->post('catid');
			$thumb_articles=$_FILES['thumb_articles']['name'];
			$introtext_articles=$this->input->post('introtext_articles');
			$fulltext_articles=$this->input->post('fulltext_articles');
			$fulltext_articles=str_replace(''.URL.'public/'.'','public/',$fulltext_articles);
			$meta_title_articles=$this->input->post('meta_title_articles');
			$meta_key_articles=$this->input->post('meta_key_articles');
			$meta_desc_articles=$this->input->post('meta_desc_articles');
			$enable_articles=$this->input->post('enable_articles');
			$created_by_articles=$this->session->userdata('__idUsers__');
			$created_articles=date('Y-m-d H:i:s');
			$related_articles="";
			if(isset($_POST['related_pro']))
			{
				$n=count($_POST['related_pro']);
				$stt=0;
				foreach($_POST['related_pro'] as $id)
				{
					if($stt==$n-1)
					{
						$related_articles.=$id;
					}
					else
					{
						$related_articles.=$id.',';
					}
					$stt++;
				}
			}
			else
			{
				$related_articles.=0;
			}
			$and=array();
			//get data thumb_articles
			if($_FILES['thumb_articles']['name']!="")
			{
				$thumb_articles=date("m_Y").'/'.$_POST['file_name'];
			}
			else
			{
				$thumb_articles="";
			}
			if($_FILES['thumb_articles']['name']!=""){
				$and=array_merge($and,array('thumb_articles'=>($thumb_articles)));
			}
			$data=array(
			'title_articles' =>$title_articles,
			'title_en_articles' =>$title_en_articles,
			'alias_articles' =>getAlias($title_articles),
			'alias_en_articles' =>getAlias($title_en_articles),
			'catid' =>$catid,
			'related_articles' =>$related_articles,
			'introtext_articles' =>$introtext_articles,
			'introtext_en_articles' =>$introtext_en_articles,
			'fulltext_articles' =>$fulltext_articles,
			'fulltext_en_articles' =>$fulltext_en_articles,
			'created_articles' =>$created_articles,
			'created_by_articles' =>$created_by_articles,
			'hits_articles' =>1,
			'meta_title_articles' =>$meta_title_articles,
			'meta_key_articles' =>$meta_key_articles,
			'meta_desc_articles' =>$meta_desc_articles,
			'enable_articles' =>1
			);
			$data=array_merge($and,$data);
			//có xóa file cũ hay không
			$delete_file_thumb_old=$this->input->post('delete_file_thumb_old');
			if($delete_file_thumb_old==1){
				$getArticles=$this->m_article->getArticle($idArticles);
				if($getArticles[0]->thumb_articles!="")
				{
					if(file_exists("./public/images/articles/".$getArticles[0]->thumb_articles.""))
					{
						unlink("./public/images/articles/".$getArticles[0]->thumb_articles."");
					}
				}
			}
			//call function editArticle in model
			$this->m_article->editArticle($idArticles,$data);
		//if action == save then action is save else action is save and close
			if($action=='save')
			{
				/*$this->_data['getArticle']=$this->m_article->getArticle($idArticles);
				$this->_data['template']='admin/bodyright/article/editArticle';*/
				redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				if(isset($_SESSION['__idArticlesCategories__']))
				{
					redirect(URL."admin/article/index/");
				}
				else
				{
					$this->_data['listArticle']=$this->m_article->listArticle();
					$this->_data['template']='admin/bodyright/article/main';
				}
			}
		//sent data
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['messages']='Sữa Bài viết thành công.';
		
		//lists custom sent data
			$this->_data['listArticleCategories']=$this->m_article->listArticleCategories();
		//load view
			$this->load->view('admin/main',$this->_data);
	}
	/*end check edit_article*/
	/*enable article*/
	public function enable($status,$id)
	{
		//sent data
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/article/main';
		//call function enable in mode
			$this->m_article->enable($status,$id);
		//lists custom sent data
			$this->_data['listArticle']=$this->m_article->listArticle();
		//load view
			$this->load->view('admin/main',$this->_data);
	}
	/*end enable article*/
	
	/*Delete article*/
	public function removeArticle()
	{
		if(isset($_POST["btnDeleteall"]))
		{
			if(empty($_POST['delete']))
			redirect(URL.'admin/article');
			foreach($_POST['delete'] as $id)
			{
				//call function removeArticle in mode
				$this->m_article->removeArticle($id);
			}
			redirect(URL."admin/article");
		}
	}
	/*end delete article*/
	/*check ordering*/
	public function check_ordering()
	{
			$ordering_articles=$this->input->post('ordering_articles');
			/*list id articles*/
				$listArticles=$this->input->post('idArticles');
				$catid=$this->input->post('catid');
			/* get idarticles*/
				$idArticles=$this->input->post('t');
			/*get stt input ordering*/
				$stt=$this->input->post('stt');
			/* update record with ordering*/
			$data=array(
			'ordering_articles' =>$ordering_articles[$stt]
			);
			$this->m_article->check_ordering($idArticles,$data);
			/* update all record with ordering*/
			$listArticle=$this->m_article->listArticleTemp($catid);
			$stt=0;
			foreach($listArticle as $articles){
				if($articles->ordering_articles!=$stt+1)
				{
					$data=array(
					'ordering_articles' =>$stt+1
					);
					$this->m_article->check_ordering($articles->idArticles,$data);
				}
				$stt++;
				
			}
			redirect($_SERVER['HTTP_REFERER']);
	}
	/*end check ordering*/
	/*check ordering previous*/
	public function check_ordering_previous($idArticles,$ordering_articles)
	{
			/* update next record with ordering*/
			$getOrderingPrevious=$this->m_article->getOrderingPrevious($ordering_articles);
			$data=array(
			'ordering_articles' =>$ordering_articles
			);
			$this->m_article->check_ordering($getOrderingPrevious[0]->idArticles,$data);
			/* update record with ordering*/
			$data=array(
			'ordering_articles' =>$ordering_articles+1
			);
			$this->m_article->check_ordering($idArticles,$data);
			redirect($_SERVER['HTTP_REFERER']);
	}
	/*end check ordering previous*/
	/*check ordering next */
	public function check_ordering_next($idArticles,$ordering_articles)
	{
			/* update next record with ordering*/
			$getOrderingNext=$this->m_article->getOrderingNext($ordering_articles);
			$data=array(
			'ordering_articles' =>$ordering_articles
			);
			$this->m_article->check_ordering($getOrderingNext[0]->idArticles,$data);
			/* update record with ordering*/
			$data=array(
			'ordering_articles' =>$ordering_articles-1
			);
			$this->m_article->check_ordering($idArticles,$data);
			redirect($_SERVER['HTTP_REFERER']);
	}
	/*end check ordering next*/
	
}