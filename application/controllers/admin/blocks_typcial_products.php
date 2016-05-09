<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!isset($_SESSION))@session_start();

require_once(APPPATH . 'controllers/admin/admin_application.php');

class Blocks_typcial_products extends Admin_application{

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

		$this->_data['blocks_default']=1;	

		$this->_data['blocks_typcial_products']=1;	

		/*hepler*/

			$this->load->helper("url");

			$this->load->helper("getalias");		

		/*Load model*/

			$this->load->Model("admin/block/m_blocks_typcial_products");

			$this->_gallery_url = base_url()."public/images";

	}

	

	public function index()

	{

		//sent data

			$this->_data['title']=$this->config->item("title_index");

			$this->_data['template']='admin/bodyright/block/blocks_typcial_products/main';

		//get data

			$this->_data['listBlocksTypcialProducts']=$this->m_blocks_typcial_products->listBlocksTypcialProducts();

			$this->load->view('admin/main',$this->_data);

		

	}

	

	public function add_blocks_typcial_products()

	{

		//sent data

			$this->_data['title']=$this->config->item("title_index");

			$this->_data['template']='admin/bodyright/block/blocks_typcial_products/addBlocksTypcialProducts';

			$this->_data['listProductsNotTypcial']=$this->m_blocks_typcial_products->listProductsNotTypcial();

		//get data

			$this->load->view('admin/main',$this->_data);

	}

	

	public function check_add_blocks_typcial_products()

	{					

			if(isset($_POST["btnAddall"]))

			{

				if(empty($_POST['add']))

				redirect(URL.'admin/blocks_typcial_products');

				foreach($_POST['add'] as $id)

				{

					$data=array(

						'is_typcial_products' => 1

					);

					$this->m_blocks_typcial_products->addBlocksTypcialProducts($id,$data);

				}

				redirect(URL."admin/blocks_typcial_products");

			}

			$this->_data['template']='admin/bodyright/block/blocks_typcial_products/addBlocksTypcialProducts';

			$this->_data['messages']='Thêm sản phẩm nổi bật thành công.';

			$this->_data['listBlocksTypcialProducts']=$this->m_blocks_typcial_products->listBlocksTypcialProducts();

			$this->load->view('admin/main',$this->_data);

		

	}

	public function removeBlocksTypcialProducts()

	{					

	

			if(isset($_POST["btnDeleteall"]))

			{
				if(empty($_POST['delete']))

				redirect(URL.'admin/blocks_typcial_products');

				foreach($_POST['delete'] as $id)

				{

					$data=array(

						'is_typcial_products' => 0

					);

					$this->m_blocks_typcial_products->removeBlocksTypcialProducts($id,$data);

				}

				redirect(URL."admin/blocks_typcial_products");

			}

			$this->_data['listBlocksTypcialProducts']=$this->m_blocks_typcial_products->listBlocksTypcialProducts();

			$this->_data['template']='admin/bodyright/block/blocks_typcial_products/main';

			$this->_data['messages']='Thêm sản phẩm nổi bật thành công.';

			$this->_data['listBlocksTypcialProducts']=$this->m_blocks_typcial_products->listBlocksTypcialProducts();

			$this->load->view('admin/main',$this->_data);

		

	}

	

	public function edit_blocks($idBlocks_typcial_blockss)

	{

		//sent data

			$this->_data['title']=$this->config->item("title_index");

			$this->_data['template']='admin/bodyright/block/blocks/editBlocks_typcial_blockss';

		//get data

			$this->_data['listBlocksTypcialProducts']=$this->m_blocks_typcial_products->listBlocksTypcialProducts();

			$this->_data['listBlocks_typcial_blockssManufacture']=$this->m_blocks_typcial_products->listBlocks_typcial_blockssManufacture();

			$this->_data['getBlocks_typcial_blockss']=$this->m_blocks_typcial_products->getBlocks_typcial_blockss($idBlocks_typcial_blockss);

			$this->load->view('admin/main',$this->_data);

		

	}

	

	public function check_edit_blocks($idBlocks_typcial_blockss)

	{

			for($i=1;$i<=10;$i++)

			{

				$fullimage_blocks=$_FILES['fullimage'.$i.'_blocks']['name'];

				if($fullimage_blocks!="")

				{

					$this->m_blocks_typcial_products->do_upload('fullimage'.$i.'_blocks');

				}

			}

			$this->m_blocks_typcial_products->do_upload1();

			if($_FILES['fullimage1_blocks']['name']!="")

			{

				$fullimage1_blocks=date("m_Y").'/'.$_FILES['fullimage1_blocks']['name'];

			}

			else

			{

				$fullimage1_blocks="";

			}

			if($_FILES['fullimage2_blocks']['name']!="")

			{

				$fullimage2_blocks=date("m_Y").'/'.$_FILES['fullimage2_blocks']['name'];

			}

			else

			{

				$fullimage2_blocks="";

			}

			if($_FILES['fullimage3_blocks']['name']!="")

			{

				$fullimage3_blocks=date("m_Y").'/'.$_FILES['fullimage3_blocks']['name'];

			}

			else

			{

				$fullimage3_blocks="";

			}

			if($_FILES['fullimage4_blocks']['name']!="")

			{

				$fullimage4_blocks=date("m_Y").'/'.$_FILES['fullimage4_blocks']['name'];

			}

			else

			{

				$fullimage4_blocks="";

			}

			if($_FILES['fullimage5_blocks']['name']!="")

			{

				$fullimage5_blocks=date("m_Y").'/'.$_FILES['fullimage1_blocks']['name'];

			}

			else

			{

				$fullimage5_blocks="";

			}

			if($_FILES['fullimage6_blocks']['name']!="")

			{

				$fullimage6_blocks=date("m_Y").'/'.$_FILES['fullimage1_blocks']['name'];

			}

			else

			{

				$fullimage6_blocks="";

			}

			if($_FILES['fullimage7_blocks']['name']!="")

			{

				$fullimage7_blocks=date("m_Y").'/'.$_FILES['fullimage1_blocks']['name'];

			}

			else

			{

				$fullimage7_blocks="";

			}

			if($_FILES['fullimage8_blocks']['name']!="")

			{

				$fullimage8_blocks=date("m_Y").'/'.$_FILES['fullimage8_blocks']['name'];

			}

			else

			{

				$fullimage8_blocks="";

			}

			if($_FILES['fullimage9_blocks']['name']!="")

			{

				$fullimage9_blocks=date("m_Y").'/'.$_FILES['fullimage9_blocks']['name'];

			}

			else

			{

				$fullimage9_blocks="";

			}

			if($_FILES['fullimage10_blocks']['name']!="")

			{

				$fullimage10_blocks=date("m_Y").'/'.$_FILES['fullimage10_blocks']['name'];

			}

			else

			{

				$fullimage10_blocks="";

			}

			

			$action=$this->input->post('t');

			//get data

			$thumb_blocks=date("m_Y").'/'.$_FILES['thumb_blocks']['name'];

			$catid=$this->input->post('catid');

			$mid=$this->input->post('mid');

			$code_blocks=$this->input->post('code_blocks');

			$name_blocks=$this->input->post('name_blocks');

			$name_en_blocks=$this->input->post('name_en_blocks');

			$price_blocks=$this->input->post('price_blocks');

			$short_desc_blocks=$this->input->post('short_desc_blocks');

			$short_desc_en_blocks=$this->input->post('short_desc_en_blocks');

			$description_blocks=$this->input->post('description_blocks');

			$description_en_blocks=$this->input->post('description_en_blocks');

			$tech_pro_blocks=$this->input->post('tech_pro_blocks');

			$tech_pro_en_blocks=$this->input->post('tech_pro_en_blocks');

			$accessories_blocks=$this->input->post('accessories_blocks');

			$accessories_en_blocks=$this->input->post('accessories_en_blocks');

			$created_blocks=$this->input->post('created_blocks');

			$created_by_blocks=$this->input->post('created_by_blocks');

			$hits_blocks=$this->input->post('hits_blocks');

			$is_new_blocks=$this->input->post('is_new_blocks');

			$is_empty_blocks=$this->input->post('is_empty_blocks');

			$enable_blocks=$this->input->post('enable_blocks');

			$ordering_blocks=$this->input->post('ordering_blocks');

			$meta_title_blocks=$this->input->post('meta_title_blocks');

			$meta_key_blocks=$this->input->post('meta_key_blocks');

			$meta_desc_blocks=$this->input->post('meta_desc_blocks');

			$and=array();

			if($fullimage1_blocks!="") $and=array('fullimage1_blocks' => $fullimage1_blocks);

			if($fullimage2_blocks!="") $and=array_merge($and,array('fullimage2_blocks'=>$fullimage2_blocks));

			if($fullimage3_blocks!="") $and=array_merge($and,array('fullimage3_blocks'=>$fullimage2_blocks));

			if($fullimage4_blocks!="") $and=array_merge($and,array('fullimage4_blocks'=>$fullimage2_blocks));

			if($fullimage5_blocks!="") $and=array_merge($and,array('fullimage5_blocks'=>$fullimage2_blocks));

			if($fullimage6_blocks!="") $and=array_merge($and,array('fullimage6_blocks'=>$fullimage2_blocks));

			if($fullimage7_blocks!="") $and=array_merge($and,array('fullimage7_blocks'=>$fullimage2_blocks));

			if($fullimage8_blocks!="") $and=array_merge($and,array('fullimage8_blocks'=>$fullimage2_blocks));

			if($fullimage9_blocks!="") $and=array_merge($and,array('fullimage9_blocks'=>$fullimage2_blocks));

			if($fullimage10_blocks!="") $and=array_merge($and,array('fullimage10_blocks'=>$fullimage2_blocks));

			if($thumb_blocks!="") $and=array_merge($and,array('thumb_blocks'=>$thumb_blocks));

			$data=array(

			'catid' => $catid,

			'mid' => $mid,

			'code_blocks' => $code_blocks,

			'name_blocks' => $name_blocks,

			'name_en_blocks' => $name_en_blocks,

			'alias_blocks' => getAlias($name_blocks),

			'alias_en_blocks' => getAlias($name_en_blocks),

			'price_blocks' => $price_blocks,

			'short_desc_blocks' => $short_desc_blocks,

			'short_desc_en_blocks' => $short_desc_en_blocks,

			'description_blocks' => $description_blocks,

			'description_en_blocks' => $description_en_blocks,		

			'tech_pro_blocks' =>$tech_pro_blocks,

			'tech_pro_en_blocks' =>$tech_pro_en_blocks,

			'accessories_blocks' =>$accessories_blocks,

			'accessories_en_blocks' =>$accessories_en_blocks,

			'created_by_blocks' =>$this->session->userdata("__idUsers__"),

			'hits_blocks' =>1,

			'is_new_blocks' =>$is_new_blocks,

			'is_empty_blocks' =>$is_empty_blocks,

			'enable_blocks' =>$enable_blocks,

			'ordering_blocks' =>$ordering_blocks,

			'meta_title_blocks' =>$meta_title_blocks,

			'meta_key_blocks' =>$meta_key_blocks,

			'meta_desc_blocks' =>$meta_desc_blocks,

			);

			$data=array_merge($and,$data);

			if($action=='save')

			{

				$this->_data['template']='admin/bodyright/block/blocks/editBlocks_typcial_blockss';

			}

			else

			{

				$this->_data['template']='admin/bodyright/block/blocks/main';

			}

			$this->_data['title']=$this->config->item("title_index");

			$this->_data['messages']='Sữa sản phẩm nổi bật thành công.';

			$this->m_blocks_typcial_products->editBlocks_typcial_blockss($idBlocks_typcial_blockss,$data);

			$this->_data['listBlocksTypcialProducts']=$this->m_blocks_typcial_products->listBlocksTypcialProducts();

			

			$this->_data['getBlocks_typcial_blockss']=$this->m_blocks_typcial_products->getBlocks_typcial_blockss($idBlocks_typcial_blockss);

			$this->load->view('admin/main',$this->_data);

		

	}

	public function enable($enable,$id)

	{

		//sent data

			$this->_data['title']=$this->config->item("title_index");

			$this->_data['template']='admin/bodyright/block/blocks/main';

		//get data

			$this->m_blocks_typcial_products->enable($enable,$id);

			

			$this->_data['listBlocksTypcialProducts']=$this->m_blocks_typcial_products->listBlocksTypcialProducts();

			$this->load->view('admin/main',$this->_data);

		

	}

	public function enable_blocks($enable,$id)

	{

		//sent data

			$this->_data['title']=$this->config->item("title_index");

			$this->_data['template']='admin/bodyright/block/blocks/main';

		//get data

			$this->m_blocks_typcial_products->enable_blocks($enable,$id);

			$this->_data['listBlocksTypcialProducts']=$this->m_blocks_typcial_products->listBlocksTypcialProducts();

			$this->load->view('admin/main',$this->_data);

		

	}

	public function removeBlocks_typcial_blockss()

	{

		if(isset($_POST["btnDeleteall"]))

		{

			if(empty($_POST['delete']))

			redirect(URL.'admin/block');

			foreach($_POST['delete'] as $id)

			{

				//remove don hang

				$this->m_blocks_typcial_products->removeBlocks_typcial_blockss($id);

			}

			redirect(URL."admin/block");

		}

	}

	

}