<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
require_once(APPPATH . 'models/admin/m_application_admin.php');
class M_products extends M_application_admin{
    function __construct(){
        parent::__construct();
		$this->load->database();
			$this->load->helper("url");
			$this->load->helper("getalias");
    }
	/*check connect ftp*/
		
	/*end connect ftp*/
	//upload images
    public function do_upload($fullimage_products,$id,$date){
    	//echo $date;die;
    	$this->_gallery_path = realpath(APPPATH. "../public/images/products/".$date."/".$id);
		$path = "./public/images/products/".$date;
		$in = array("jpg", "png", "gif", "bmp");
		$name=$_FILES[$fullimage_products]['name'];
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
			if(!$this->upload->do_upload($fullimage_products)){
				$error = array($this->upload->display_errors());
				echo $this->upload->display_errors();
			}else{
				$image_data = $this->upload->data(); 
			}
		}
		else
		{
			return false;
		}
    }
	
	//upload images
    public function do_upload_thumb($id,$date){
    	$this->_gallery_path_thumbs = realpath(APPPATH. "../public/images/products/".$date."/".$id."/thumbs/");
		$path = "./public/images/products/".$date."/thumbs/";
		$in = array("jpg", "png", "gif", "bmp");
		$name=$_FILES['thumb_products']['name'];
		$out = array("php", "php4", "php5", "exe","psd");
		if(in_array(end(explode('.',$name)),$in) && !in_array(end(explode('.',$name)),$out))
		{
			$name=getAlias($name);
			$filename=encrypt_name($name);
			$config = array('upload_path'   => $this->_gallery_path_thumbs,
							'allowed_types' => 'gif|jpg|png',
							'file_name'  => $filename);
			
			$this->load->library("upload");
			$this->upload->initialize($config);
			if(!$this->upload->do_upload('thumb_products')){
				$error = array($this->upload->display_errors());
				echo $this->upload->display_errors();
			}else{
				$image_data = $this->upload->data();
			}
			
		}
		else
		{
			return false;
		}
    }
	/*list products_categories*/
		public function listParent(){
			$querylistParent=$this->db->query('select * from '.PREFIX.'products where parentid=0 order by idProducts DESC');
			$listParent=$querylistParent->result();
		return $listParent;
    }
	/*end list products_categories*/
	/*get products_categories dùng để trích lọc theo nhóm sản phẩm*/

		public function listProductsCategoriesTemp($stringIdProductsCategories = false){
			$where="";
			if($stringIdProductsCategories!=false)
			{
				$where.=" and idProductsCategories in (".$stringIdProductsCategories.")";
			}
			else
			{
				//$where.=" and idProductsCategories in (0)";
			}
			$option_list = $this->db->query("select a.*,
			
			meta_title_products_categories,

			meta_key_products_categories,

			meta_desc_products_categories,

			name_products_categories,
			
			alias_products_categories

			from ".PREFIX."products a, ".PREFIX."products_categories b

			where a.parentid=0 and  a.catid=b.idProductsCategories ".$where." ");

		    $getProductsCategories = $option_list->result();

			return  $getProductsCategories;

		}

	/*end get products_categories*/
	
    /*list products_categories*/
		public function listProductsCategories(){
		$products_categories_list=$this->db->get(''.PREFIX.'products_categories');
		$productsCategorie = array();
		$product= array();
		foreach ($products_categories_list->result() as $productsCategories){
			$option_list = $this->db->get_where(''.PREFIX.'products', array('catid'=>$productsCategories->idProductsCategories,'parentid'=>0));
			$productsCategories->idProductsCategorie = $option_list->result();
			$productsCategorie[] = $productsCategories;
			foreach ($productsCategories->idProductsCategorie as $products){
				$option_list = $this->db->get_where(''.PREFIX.'products', array('parentid'=>$products->idProducts));
				$products->idProduct = $option_list->result();
				$product[] = $products;
			}
  		}
		return $productsCategorie;
    }
	/*end list products_categories*/
	/*list products_categories combobox*/
	public function listProductsCategoriesCombobox()
	{
		$menu = $this->productsCategories(0);
		$products="";
		$selected="";
		if(isset($_SESSION['__idProductsCategoriesTemp__']))
		{
			$idProductsCategories=$_SESSION['__idProductsCategoriesTemp__'];
		}
		elseif(isset($_SESSION['__idProductsCategories__']))
		{
			$idProductsCategories=$_SESSION['__idProductsCategories__'];
		}
		else
		{
			$idProductsCategories="";
		}
		foreach($menu as $k => $row)
		{
			
			if($idProductsCategories==$row['idProductsCategories']) 
			{
				$selected= "selected";
			}
			else
			{
				$selected="";
			}
			
			$products.='<option '.$selected.' value="'.$row['idProductsCategories'].'">'.$row['name_products_categories'].'</option>';
		}
		return $products;
	}
	public function productsCategories($parentid = 0, $space = "", $trees = array())
    {
        if(!$trees) 
        {
            $trees = array();
        }
        $query =$this->db->query("SELECT * FROM ".PREFIX."products_categories WHERE parentid = '".$parentid."' order by ordering_products_categories asc");
		$listMenu=$query->result();
        foreach($listMenu as $rs)
		{
            $trees[] = array( 'idProductsCategories' => $rs->idProductsCategories,
                                'name_products_categories'=>$space.$rs->name_products_categories,
								'parentid' => $rs->parentid,
                                ); 
            $trees = $this->productsCategories($rs->idProductsCategories, $space.'&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;', $trees); 
        }
        return $trees;
    }
	
	/*end list products_categories combobox*/
	/*list products_categories sub*/
		public function listProductsManufacture(){
			$querylistProductsManufacture=$this->db->query('select * from '.PREFIX.'products_manufacture order by idProductsManufacture DESC');
			$listProductsManufacture=$querylistProductsManufacture->result();
			return $listProductsManufacture;
		}
	/*end list products_categories sub*/
	
	/*list products_categories sub*/
		public function listProducts($idProducts=false){
			if(isset($_SESSION['__enable_products__']) )
			{
				if($_SESSION['__enable_products__']!=-1)
				{
					$this->db->where('enable_products',$_SESSION['__enable_products__']);
				}
			}
			if(isset($_SESSION['__idProductsCategories__']) )
			{
				if($_SESSION['__idProductsCategories__']!=0 )
				{
					$this->db->where_in('catid',$_SESSION['__idProductsCategories__']);
				}
			}
			/*if $idProducts == false then*/
			if($idProducts==false)
			{
				$this->db->order_by('ordering_products','catid');
				$this->db->where('parentid',0);
				$option_list = $this->db->get(''.PREFIX.'products');
			}
			/*else $idProducts != false then*/
			else
			{
				$this->db->order_by('ordering_products','catid');
				$this->db->where('parentid !=',0);
				$this->db->where('parentid',$idProducts);
				$option_list = $this->db->get(''.PREFIX.'products');
			}
			$product = array();
			foreach ($option_list->result() as $products){
			/*if $idProducts ==false then*/
				$this->db->order_by('ordering_products','catid');
				$option_list = $this->db->get_where(''.PREFIX.'products', array('parentid'=>$products->idProducts));
				$products->idProduct = $option_list->result();
				$product[] = $products;
			}
			return $product;
		}
		
	/*end list products_categories sub*/
	
	/*list products_categories sub*/
		public function listProductsTemp($catid,$parentid=false){
			$this->db->order_by('ordering_products','asc');
			$this->db->order_by('idProducts','desc');
			if($parentid!=false)
			{
				$this->db->where("parentid",$parentid);
			}
			else
			{
				$this->db->where("parentid",0);
			}
			$this->db->where("catid",$catid);
			$option_list = $this->db->get(''.PREFIX.'products');
			$listProductsTemp= $option_list->result();
			return $listProductsTemp;
		}
	/*end list products_categories sub*/
	/*list products_categories sub*/
		public function listProductsSubTemp($idProducts){
			$option_list = $this->db->get_where(''.PREFIX.'products', array('parentid'=>$idProducts));
			$products->idProduct = $option_list->result();
			$product[] = $products;
			return $productsCategorie;
		}
	/*end list products_categories sub*/
	
	
	/*get  products */
		public function getProducts($idProducts){
			$queryproducts=$this->db->query(
			'select *
			from '.PREFIX.'products
			where idProducts='.$idProducts.'');
			$getProducts=$queryproducts->result();
			$_SESSION['__idProductsCategories__']=$getProducts[0]->catid;
			return $getProducts;
		}
	/*end  products */

	/*get  max id products */
		public function maxIdProducts(){
			$maxIdProducts=$this->db->query(
			'select max(idProducts) as max
			from '.PREFIX.'products');
			$maxIdProducts=$maxIdProducts->row();
			return $maxIdProducts->max;
		}
	/*end  products */
	
	/*add products */
		public function addProducts($data){
			$this->db->insert(''.PREFIX.'products', $data);
			$id = $this->db->insert_id();
			return (isset($id)) ? $id : FALSE;
		}
	/*end add products */
	/*edit products */
		public function editProducts($idProducts,$data){
			$this->db->where("idProducts",$idProducts);
			$this->db->update(''.PREFIX.'products', $data);
		}
	/*end edit products */
	
	/*remove products*/
	public function removeProducts($idProducts)
	{
		$getProducts=$this->getProducts($idProducts);
		//chọn tất cả những sản phẩm con và xóa tất cả hình ảnh của sản phẩm con
		$query=$this->db->query("select * from ".PREFIX."products where parentid=".$idProducts." or idProducts=".$idProducts."");
		
		foreach($query->result() as $row)
		{
			if($row->thumb_products!="")
			{
				if(file_exists("./public/images/products/thumbs/".$row->thumb_products.""))
				{
					unlink("./public/images/products/thumbs/".$row->thumb_products."");
				}
			}
			if($row->fullimage_products!="")
			{
				if(file_exists("./public/images/products/".$row->fullimage_products.""))
				{
					unlink("./public/images/products/".$row->fullimage_products."");
				}
			}
			//xóa tất cả tài liệu của sản phẩm con
			$query_download=$this->db->query("select * from ".PREFIX."download where productid=".$row->idProducts."");
			foreach($query_download->result() as $row_download)
			{
				$this->db->where("idDownload",$row_download->idDownload);
				$this->db->delete("".PREFIX."download");
				if($row_download->filename_download!="")
				{
					if(file_exists("./public/images/download/".$row_download->filename_download.""))
					{
						unlink("./public/images/download/".$row_download->filename_download."");
					}
				}
			}
		}
		
		
		$this->db->where("idProducts",$idProducts);
		$this->db->or_where("parentid",$idProducts);
		$this->db->delete("".PREFIX."products");
	}
	/*end remove products*/
	/*enable products */
		public function enable($status,$id){
			if($status==0)
			$status=1;
			else
			$status=0;
			$qr = $this->db->query("UPDATE ".PREFIX."products_categories SET enable_products_categories=".$status." WHERE idProductsCategories=".$id."" );
		}
	/*end enable products */
	
	/*enable products */
		public function enable_products($status,$id){
			if($status==0)
			$status=1;
			else
			$status=0;
			$qr = $this->db->query("UPDATE ".PREFIX."products SET enable_products=".$status." WHERE idProducts=".$id."" );
		}
	/*end enable products */	
	
	/*check_ordering*/
		public function check_ordering($parentid=false,$idProducts,$data){
			if($parentid==false)
			{
				$this->db->where("parentid",$parentid);
			}
			$this->db->where("idProducts",$idProducts);
			$this->db->update(''.PREFIX.'products', $data);
		}
	/*end check_ordering*/
	/*get record next ordering*/
		public function getOrderingPrevious($idProductsCategories,$parentid=false,$ordering_products){
			if($parentid==false)
			{
				$parentid=0;
			}
			$queryOrderingPrevious=$this->db->query(
			'select *
			from '.PREFIX.'products
			where ordering_products='.($ordering_products+1).' and parentid='.$parentid.' and catid='.$idProductsCategories.'');
			$getOrderingPrevious=$queryOrderingPrevious->result();
			return $getOrderingPrevious;
		}
	/*end get record next ordering*/
	
	/*get record next ordering*/
		public function getOrderingNext($idProductsCategories,$parentid=false,$ordering_products){
			
			if($parentid==false)
			{
				$parentid=0;
			}
			$queryOrderingNext=$this->db->query(
			'select *
			from '.PREFIX.'products
			where ordering_products='.($ordering_products-1).' and parentid='.$parentid.' and catid='.$idProductsCategories.'');
			$getOrderingNext=$queryOrderingNext->result();
			return $getOrderingNext;
		}
	/*end get record next ordering*/
	
	/*list donwload of products*/
		public function listDownload($idProducts){
			$option_list = $this->db->query('select * from '.PREFIX.'download a, '.PREFIX.'products b where productid='.$idProducts.' and a.productid=b.idProducts and enable_download=1');
			$listDownload = $option_list->result();
			return $listDownload;
		}
	/*end list donwload of products*/
	/*list donwload of products*/
		public function listNameProductDownload($idProducts){
			$option_list = $this->db->query('select * from  '.PREFIX.'products  where  idProducts='.$idProducts.'');
			$listDownload = $option_list->result();
			return $listDownload;
		}
	/*end list donwload of products*/
	
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
			$queryProducts = $this->db->query("select * from ".PREFIX."products where idProducts not in (".$number.") and idProducts in (".$string.")");

			$insert_related=$queryProducts->result();

			

			return $insert_related;

		}

	/*end insert_related*/
	/*get list articles*/

		public function listProductRelated($idroducts){
			$getProducts=$this->getProducts($idroducts);
			$listProductRelated=$this->db->query('select * from '.PREFIX.'products where idProducts in ('.$getProducts[0]->related_products.')');

			$listProductRelated=$listProductRelated->result();

			return $listProductRelated;

		}

	/*end get list articles*/
	
	/*list string products categories sub*/
	function stringIdProductsCategories($idProductsCategories){
        $this->db->order_by('parentid','asc')->group_by('parentid,idProductsCategories');
        $q=$this->db->where('enable_products_categories',1);
        $q=$this->db->get(''.PREFIX.'products_categories');
        foreach($q->result() as $r){
            $data[$r->parentid][] = $r;
        }
        $menu=$this->getStringIdProductsCategories($data,$idProductsCategories);
        return $menu;
    } 
	/*end list string products categories sub*/
	
	/*list string products categories nhưng không lấy sub*/
	function listProductsCategoriesSubNotSub($idProductsCategories){
        $this->db->order_by('ordering_products_categories','asc');
        $q=$this->db->where('parentid',$idProductsCategories);
        $q=$this->db->where('enable_products_categories',1);
        $q=$this->db->get(''.PREFIX.'products_categories');
        $menu=$q->result();
        return $menu;
    } 
	/*end list string products categories nhưng không lấy sub*/
	
	
	function getStringIdProductsCategories($category,$parent){
        static $i = 1;
        if (array_key_exists($parent, $category)){
            $menu = '';
            $i++;
				$menu.=$parent.',';
            foreach ($category[$parent] as $r) {
                $child = $this->getStringIdProductsCategories($category, $r->idProductsCategories);
				$menu.=$r->idProductsCategories.',';
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
	/*list products_categories*/
}
?>