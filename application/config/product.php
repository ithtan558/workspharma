<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION))@session_start();
require_once(APPPATH . 'controllers/application.php');
class Product extends Application{
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
		/*config public*/
			
		/*hepler*/
			$this->load->helper("url");
			$this->load->helper("getalias");
			$this->load->library('session');		
		/*Load model*/
			$this->load->Model("body/product/m_products");
			$this->_data['home']='san-pham';
			$this->_data['nothome']=0;
	}
	/*Mặc định khi load trang chủ*/
	public function index()
	{
		//sent data
			$this->_data['template']='body/product/productsCategories';
		//get data
			$listProductsCategories=$this->m_products->listProductsCategoriesTemp();
			$this->_data['listProductsCategories']=$listProductsCategories;
			//mãng dùng để lưu tất cả những id danh mục con của danh mục cha
			$this->_data['listProducts']=$this->m_products->listProducts();
		//get thông tin menu sản phẩm
			$getInfoMenus=$this->m_products->getInfoMenus();		
			$this->_data['name']=$getInfoMenus->title_menus;
		/*config*/
			//$listProductsCategories=$this->m_products->listProductsCategories();
			$this->_data['title']=$getInfoMenus->title;
			$this->_data['description']=$getInfoMenus->description;
			$this->_data['keywords']=$getInfoMenus->keywords;
			$this->load->view('index',$this->_data);
		
	}
	/*end Mặc định khi load trang chủ*/
	
	/*nhấn nút tìm kiếm sản phẩm ngoài trang chủ*/
	public function search()
	{
		//sent data
			$keyword=$this->input->get("keyword");
		//sent data
			$this->_data['template']='body/product/productsCategories';
		//get data
			$listProductsCategories=$this->m_products->listProductsCategories();
			$this->_data['listProducts']=$this->m_products->listProducts(false,$keyword);
			$this->load->view('index',$this->_data);
		
	}
	/*end nhấn nút tìm kiếm sản phẩm ngoài trang chủ*/
	
	/*danh sách sản phẩm khi click vào danh mục sản phẩm*/
	public function productsCategories($alias_products_categories)
	{
		//sent data
			//get info from products categories
			$getNameProductsCategories=$this->m_products->getNameProductsCategories($alias_products_categories);
			if(count($getNameProductsCategories)>0)
			{
			$listProducts=$this->m_products->listProductsCategories($getNameProductsCategories->idProductsCategories);
			
			
			$this->_data['getNameProductsCategories']=$getNameProductsCategories;
			
			$this->_data['listProducts']=$listProducts;

			$this->_data['title']=$getNameProductsCategories->meta_title_products_categories;

			$this->_data['description']=$getNameProductsCategories->meta_desc_products_categories;

			$this->_data['keywords']=$getNameProductsCategories->meta_key_products_categories;
			
			$this->_data['template']='body/product/main';
		//get data
			$this->load->view('index',$this->_data);
			}
			else
			{
				redirect();
			}
		
	}
	/*sản phẩm mới nhất*/
	public function typicalProducts()
	{
		//sent data
			//get info from products categories
			$listProducts=$this->m_products->listTypicalProducts();
			
			$this->_data['listProducts']=$listProducts;

			$this->_data['title']='Sản phẩm nổi bật';

			$this->_data['description']='Sản phẩm nổi bật';

			$this->_data['keywords']='Sản phẩm nổi bật';
			
			$this->_data['template']='body/product/mainTypicalProducts';
		//get data
			$this->load->view('index',$this->_data);
		
	}
	/*end danh sách sản phẩm khi click vào danh mục sản phẩm*/
	/*lấy chi tiết sản phẩm*/
	public function products($alias_products_categories,$alias_products)
	{
		//sent data
			$getProducts=$this->m_products->getProducts($alias_products);
			if(count($getProducts)>0)
			{
				$this->_data['getProducts']=$getProducts;
				$getProductsParent=$this->m_products->getProductsParent($alias_products);
				$this->_data['getProductsParent']=$getProductsParent;
				$this->_data['getListProducts']=$this->m_products->getListProducts($alias_products);
				//lấy related_products của parent
				$related_products=0;
				if($getProducts->related_products==0)
				{
					if(count($getProductsParent)>0)
					{
						$related_products=$getProductsParent[0]->related_products;
					}
				}
				else
				{
					$related_products=$getProducts->related_products;
				}
				$listOtherProducts=$this->m_products->listOtherProducts($related_products);
				$this->_data['listOtherProducts']=$listOtherProducts;
				$this->_data['getListDownload']=$this->m_products->getListDownload($alias_products);
				$this->_data['getListDownloadParent']=$this->m_products->getListDownloadParent($alias_products);
				
				/*$listNewProducts=$this->m_products->listNewProducts($idProductsCategories);
				$this->_data['listNewProducts']=$listNewProducts;*/
				
				$this->_data['name_parent']=$getProducts->name_products_categories;
				$this->_data['title_menus']=$getProducts->name_products_categories;
				$this->_data['alias_parent']=$getProducts->alias_products_categories;
				$this->_data['name_parent_sub']=$getProducts->name_products;
				$this->_data['name']=$getProducts->name_products;
				
			/*config*/
				//$getProducts=$this->m_products->getProducts($idProducts);
				$this->_data['title']=$getProducts->meta_title_products;
				$this->_data['description']=$getProducts->meta_desc_products;
				$this->_data['keywords']=$getProducts->meta_key_products;
				$this->_data['template']='body/product/detailProducts';
			//get data
				$this->load->view('index',$this->_data);
			}
			else
			{
				redirect();
			}
		
	}
	/*end lấy chi tiết sản phẩm*/
	
	public function subProducts($alias_products_categories,$idProductsCategories,$idProducts,$alias_products)

	{

		//sent data
			$getProducts=$this->m_products->getProducts($alias_products);
			
			$this->_data['getProducts']=$getProducts;
			
			$getProductsParent=$this->m_products->getProductsParent($alias_products);
			
			$this->_data['getProductsParent']=$getProductsParent;

			$this->_data['getListProducts']=$this->m_products->getListProducts($alias_products);

			$this->_data['getListDownload']=$this->m_products->getListDownload($alias_products);
			
			$this->_data['getListDownloadParent']=$this->m_products->getListDownloadParent($alias_products);
			
			//lấy related_products của parent
			$related_products=0;
			if($getProducts->related_products==0)
			{
				if(count($getProductsParent)>0)
				{
					$related_products=$getProductsParent[0]->related_products;
				}
			}
			else
			{
				$related_products=$getProducts->related_products;
			}
			$listOtherProducts=$this->m_products->listOtherProducts($related_products);
			$this->_data['listOtherProducts']=$listOtherProducts;

		/*config*/

			//$getProducts=$this->m_products->getProducts($idProducts);

			$this->_data['title']=$getProducts->meta_title_products;
			$this->_data['description']=$getProducts->meta_desc_products;
			$this->_data['keywords']=$getProducts->meta_key_products;
			$this->_data['template']='body/product/detailProducts';

		//get data

			$this->load->view('index',$this->_data);

		

	}

	
	
	/*download file pdf giới thiệu về sản phẩm*/
	public function download_file_home(){
		
		//load the download helper
		$this->load->helper('download');
		//set the textfile's content 
		$data = file_get_contents("./public/images/download/".$this->uri->segment(3)."/".$this->uri->segment(4)); 		// Read the file's contents
		//use this function to force the session/browser to download the created file
		force_download($this->uri->segment(4), $data);
	}
	/*end download file pdf giới thiệu về sản phẩm*/
	/*In sản phẩm ra file */
	public function export_file($idProducts)
	{
		//sent data
			$this->_data['getProducts']=$this->m_products->getProducts($idProducts);
			$this->_data['getProductsParent']=$this->m_products->getProductsParent($idProducts);
			$this->_data['getListProducts']=$this->m_products->getListProducts($idProducts);
			$this->_data['getListDownload']=$this->m_products->getListDownload($idProducts);
		/*config*/
			$getProducts=$this->m_products->getProducts($idProducts);
			$this->_data['title']=$getProducts[0]->title;
			$this->_data['description']=$getProducts[0]->description;
			$this->_data['keywords']=$getProducts[0]->keywords;
			$this->_data['template']='body/product/export_file';
		//get data
			$this->load->view('export',$this->_data);
		
	}
	/*end In sản phẩm ra file */
	
}