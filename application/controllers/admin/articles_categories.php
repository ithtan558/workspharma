<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION))@session_start();
require_once(APPPATH . 'controllers/admin/admin_application.php');
class Articles_categories extends Admin_application{
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
			$this->load->Model("admin/menu/m_menu");
			$this->load->Model("admin/articles_categories/m_articles_categories");
			$this->_gallery_url = base_url()."public/images";
	}
	/*load function index default*/
	public function index($idArticlesCategories=false)
	{
		//sent data
			$this->_data['articles_categories']=1;	
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/articles_categories/main';
		//list articles categories
			$listArticlesCategories=$this->m_articles_categories->listArticlesCategories($idArticlesCategories);
			$this->_data['listArticlesCategories']=$listArticlesCategories;
			foreach($listArticlesCategories as $row)
			{
				$data=array(
				'alias_articles_categories' => getAlias($row->name_articles_categories),
				'alias_en_articles_categories' => getAlias($row->name_en_articles_categories),	
				);
				$this->m_articles_categories->eidtArticlesCategories($row->idArticlesCategories,$data);
			}
			/*foreach($listProducts as $row)
			{
				
				//$thumb_products='08_2014/'.$row->thumb_products;
				$fullimage_products=str_replace('08_2014/thumbs/','08_2014/',$row->thumb_products);
				$data=array(
				'fullimage_products' => ($fullimage_products)
				
				);
				$this->m_products->editProducts($row->idProducts,$data);
			}*/
		//load view
			$this->load->view('admin/main',$this->_data);
		
	}
	/*end load function index default*/
	
	/*load function add articles categories*/
	public function add_articles_categories()
	{
		//sent data
			$this->_data['add_articles_categories']=1;
			$_SESSION['__idArticlesCategories__']="";
			$this->_data['title']=$this->config->item("title_index");
			$listArticlesCategoriesCombobox=$this->m_articles_categories->listArticlesCategoriesCombobox();
			$this->_data['listArticlesCategoriesCombobox']=$listArticlesCategoriesCombobox;
			$this->_data['template']='admin/bodyright/articles_categories/addArticles_Categories';
		//load view
			$this->load->view('admin/main',$this->_data);
		
	}
	/*end load function add articles categories*/
	
	/*load function check add articles categories*/
	public function check_add_articles_categories()
	{					
		//sent data
			$action=$this->input->post('t');
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/articles_categories/main';
		//get data
			$parentid=$this->input->post('parentid');
			$name_articles_categories=$this->input->post('name_articles_categories');
			$name_en_articles_categories=$this->input->post('name_en_articles_categories');
			$description_articles_categories=$this->input->post('description_articles_categories');
			$description_en_articles_categories=$this->input->post('description_en_articles_categories');
			$meta_desc_articles_categories=$this->input->post('meta_desc_articles_categories');
			$ordering_articles_categories=$this->input->post('ordering_articles_categories');
			$enable_articles_categories=$this->input->post('enable_articles_categories');
			$meta_title_articles_categories=$this->input->post('meta_title_articles_categories');
			$meta_key_articles_categories=$this->input->post('meta_key_articles_categories');
			$data=array(
			'idArticlesCategories'   => 'NULL',
			'parentid' => $parentid,
			'name_articles_categories' => $name_articles_categories,
			'name_en_articles_categories' => $name_en_articles_categories,
			'alias_articles_categories' => getAlias($name_articles_categories),
			'alias_en_articles_categories' => getAlias($name_en_articles_categories),
			'description_articles_categories' => $description_articles_categories,
			'description_en_articles_categories' => $description_en_articles_categories,
			'meta_desc_articles_categories' => $meta_desc_articles_categories,
			'ordering_articles_categories' => $ordering_articles_categories,
			'meta_title_articles_categories' => $meta_title_articles_categories,
			'meta_key_articles_categories' => $meta_key_articles_categories,		
			'enable_articles_categories' =>$enable_articles_categories
			);
			$this->m_articles_categories->addArticlesCategories($data);
			//if action == save then action is save else action is save and close
			if($action=='save')
			{
				//lists custom sent data
				//$this->_data['listArticlesCategories']=$this->m_articles_categories->listArticlesCategories();
					//$this->_data['template']='admin/bodyright/articles_categories/addArticles_Categories';
					//$this->_data['messages']='Thêm danh mục bài viết thành công.';
					redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				//$this->_data['listArticle']=$this->m_article->listArticle();
				//$this->_data['template']='admin/bodyright/article/main';
				redirect(URL."admin/articles_categories");
			}
			$this->_data['messages']='Thêm danh mục bài viết thành công.';
			//call function addArticle in model
			//load view
			$this->load->view('admin/main',$this->_data);
		
	}
	/*end load function check add articles categories*/
	
	/*load function edit articles categories*/
	public function edit_articles_categories($idArticlesCategories)
	{
			
		//sent data
			$this->_data['add_articles_categories']=1;
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/articles_categories/editArticles_Categories';
			$this->_data['getArticlesCategories']=$this->m_articles_categories->getArticlesCategories($idArticlesCategories);
			$listArticlesCategoriesCombobox=$this->m_articles_categories->listArticlesCategoriesCombobox();
			$this->_data['listArticlesCategoriesCombobox']=$listArticlesCategoriesCombobox;
		//load view
			$this->load->view('admin/main',$this->_data);
		
	}
	/*end load function check edit articles categories*/
	public function check_edit_articles_categories($idArticlesCategories)
	{
			$action=$this->input->post('t');
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/articles_categories/main';
			$parentid=$this->input->post('parentid');
			$name_articles_categories=$this->input->post('name_articles_categories');
			$name_en_articles_categories=$this->input->post('name_en_articles_categories');
			$description_articles_categories=$this->input->post('description_articles_categories');
			$description_en_articles_categories=$this->input->post('description_en_articles_categories');
			$meta_desc_articles_categories=$this->input->post('meta_desc_articles_categories');
			$ordering_articles_categories=$this->input->post('ordering_articles_categories');
			$enable_articles_categories=$this->input->post('enable_articles_categories');
			$meta_title_articles_categories=$this->input->post('meta_title_articles_categories');
			$meta_key_articles_categories=$this->input->post('meta_key_articles_categories');
			$data=array(
			'parentid' => $parentid,
			'name_articles_categories' => $name_articles_categories,
			'name_en_articles_categories' => $name_en_articles_categories,
			'alias_articles_categories' => getAlias($name_articles_categories),
			'alias_en_articles_categories' => getAlias($name_en_articles_categories),
			'description_articles_categories' => $description_articles_categories,
			'description_en_articles_categories' => $description_en_articles_categories,
			'meta_desc_articles_categories' => $meta_desc_articles_categories,
			'ordering_articles_categories' => $ordering_articles_categories,
			'meta_title_articles_categories' => $meta_title_articles_categories,
			'meta_key_articles_categories' => $meta_key_articles_categories,		
			'enable_articles_categories' =>$enable_articles_categories
			);
			$this->m_articles_categories->eidtArticlesCategories($idArticlesCategories,$data);
			if($action=='save')
			{
				//lists custom sent data
				//$this->_data['listArticlesCategories']=$this->m_articles_categories->listArticlesCategories();
					$this->_data['getArticlesCategories']=$this->m_articles_categories->getArticlesCategories($idArticlesCategories);
					$this->_data['template']='admin/bodyright/articles_categories/editArticles_Categories';
					$this->_data['messages']='Sữa danh mục bài viết thành công.';
			}
			else
			{
				//$this->_data['listArticle']=$this->m_article->listArticle();
				//$this->_data['template']='admin/bodyright/article/main';
				redirect(URL."admin/articles_categories");
			}
			$this->_data['listArticlesCategories']=$this->m_articles_categories->listArticlesCategories();
			
			$this->_data['getArticlesCategories']=$this->m_articles_categories->getArticlesCategories($idArticlesCategories);
			$this->load->view('admin/main',$this->_data);
		
	}
	/*end load function check edit articles categories*/
	
	//enable articles categories
	public function enable($enable,$id)
	{
		//sent data
			$this->_data['title']=$this->config->item("title_index");
			$this->_data['template']='admin/bodyright/articles_categories/main';
		//load function enable model
			$this->m_articles_categories->enable($enable,$id);
			$this->_data['listArticlesCategories']=$this->m_articles_categories->listArticlesCategories();
			$this->load->view('admin/main',$this->_data);
	}
	//end enable articles categories
	/*Delete articles categories*/
		public function remove_articles_categories()
		{
			if(isset($_POST["btnDeleteall"]))
			{
				if(empty($_POST['delete']))
				redirect(URL.'admin/articles_categories');
				foreach($_POST['delete'] as $id)
				{
					//remove don hang
					$this->m_articles_categories->removeArticlesCategories($id);
				}
				redirect(URL."admin/articles_categories");
			}
		}
	/*end delete articles categories*/
}