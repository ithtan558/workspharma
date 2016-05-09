<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
require_once(APPPATH . 'models/admin/m_application_admin.php');
class M_products_categories extends M_application_admin{
    function __construct(){
        parent::__construct();
		$this->load->database();
			$this->load->helper("url");
			$this->load->helper("getalias");
			$this->_gallery_path = realpath(APPPATH. "../public/images/products/products_categories/".date("m_Y"));
    }
	
	//upload images
    public function do_upload(){
		$path = "./public/images/products/products_categories/".date("m_Y");
		if(!is_dir($path)) //create the folder if it's not already exists
		{
			
			mkdir($path,0777,TRUE);
			// if(!is_dir($path)) //create the folder if it's not already exists
			// {
			// 	parent::connect();
			// 	if($this->ftp->mkdir($path, 0777));
			// 	$this->ftp->chmod($path, 0777);
			// 	$this->ftp->close();
			// }
			// else
			// {
			// 	return false;
			// }
		}
		$in = array("jpg", "png", "gif", "bmp");
		$name=getAlias($_FILES['preview_img_products_categories']['name']);
		$out = array("php", "php4", "php5", "exe","psd");
		if(in_array(end(explode('.',$name)),$in) && !in_array(end(explode('.',$name)),$out))
		{
			$config = array('upload_path'   => $this->_gallery_path,
							'allowed_types' => 'gif|jpg|png',
							'max_size'      => '200000',
							'file_name' => $name);
			$this->load->library("upload");
			$this->upload->initialize($config);
			if(!$this->upload->do_upload("preview_img_products_categories")){
				$error = array($this->upload->display_errors());
				echo $this->upload->display_errors();
			}else{
				$image_data = $this->upload->data();  
			}
			//kết thúc công đoạn upload hình ảnh

				$config = array("source_image" => $image_data['full_path'],

							"new_image" => $this->_gallery_path,

							"maintain_ration" => true);

				$this->load->library("image_lib",$config);

				$this->image_lib->resize();
		}
		else
		{
			return false;
		}
    }
	/*list products_categories*/
	function listProductsCategories($number, $offset){
		$_SESSION['__stt_temp__']=1;
		if(isset($_SESSION['__enable_products_categories__']) )
		{
			if($_SESSION['__enable_products_categories__']!=-1)
			{
				$this->db->where('enable_products_categories',$_SESSION['__enable_products_categories__']);
			}
		}
		if(isset($_SESSION['__keyword__']) )
		{
			if($_SESSION['__keyword__']!="")
			$this->db->like('name_products_categories',$_SESSION['__keyword__']);
		}
		if(isset($_SESSION['__show_products_categories__']) )
		{
			$number=$_SESSION['__show_products_categories__'];
		}
		else
		{
			
		}
        $this->db->order_by('ordering_products_categories','ASC')->group_by('parentid,idProductsCategories');
        $q=$this->db->get(''.PREFIX.'products_categories',$number,$offset);
		if(count($q->result())==0)
		{
			return false;
		}
        foreach($q->result() as $r){
            $data[$r->parentid][] = $r;
        }
        $products_categories=$this->getCategoryProducts($data,0);
        return $products_categories;
    } 
	function getCategoryProducts($category,$parent,$space=""){
        static $i = 1;
		if(isset($_SESSION['__stt_temp__']))
		{
			$stt_temp=$_SESSION['__stt_temp__'];
			
		}
		else
		{
			$stt_temp=0;
		}
        if (array_key_exists($parent, $category)){
            $i++;
			$products_categories = '';
			$stt=0;
			$total_r=count($category[$parent]);
            foreach ($category[$parent] as $r) {
                
				/*id products*/
				$products_categories .= '<tr>';
                $products_categories .= '<td id="'.$parent.'">';
                $products_categories .= '<a href="#">'.$r->idProductsCategories.'</a>';
                $products_categories .= '</td>';
				
				/*name products*/
                $products_categories .= '<td id="'.$parent.'">';
                $products_categories .= $space.'<a href="#">'.$r->name_products_categories.'</a>';
                $products_categories .= '</td>';

				/*ví trí products*/
                $products_categories .= '<td id="'.$parent.'">';
                switch ($r->paramid) {
                	case '1':
                		# code...
                		$valueParam='Menu top';
                		break;
                	case '2':
                		# code...
                		$valueParam='Menu left';
                		break;
                	case '3':
                		# code...
                		$valueParam='Menu bottom';
                		break;
                	
                	default:
                		# code...
                		$valueParam='Not found';
                		break;
                }
                $products_categories .= $space.'<a href="#">'.$valueParam.'</a>';
                $products_categories .= '</td>';
				/*ordering products*/
                $products_categories .= '<td id="'.$parent.'">';
				if($stt==$total_r-1)
				{
					 $products_categories .='<img src="'.IMAGES_ADMIN.'movedown1.png">';
				}
				else
				{
					$products_categories .='<a href="'.URL.'admin/products_categories/check_ordering_previous/'.$r->idProductsCategories.'/'.$r->ordering_products_categories.'/'.$r->parentid.'">';
						$products_categories .='<img src="'.IMAGES_ADMIN.'movedown.png" />';
					$products_categories .='</a>';
				}
				if($stt==0)
				{
					$products_categories .='<img style="margin-left:-5px;" src="'.IMAGES_ADMIN.'moveup1.png" />';
				}
				else
				{
					$products_categories .='<a href="'.URL.'admin/products_categories/check_ordering_next/'.$r->idProductsCategories.'/'.$r->ordering_products_categories.'/'.$r->parentid.'"><img style="margin-left:-5px;" src="'.IMAGES_ADMIN.'moveup.png" /></a>';
				}
				$products_categories .='<input name="ordering_products_categories'.$stt_temp.$stt.'" class="save_ordering" type="text" value="'.$r->ordering_products_categories.'" />';
                    $products_categories .='<input name="idProductsCategories[]" type="hidden" value="'.$r->idProductsCategories.'" />';
                    $products_categories .='<input type="button" data="'.$r->idProductsCategories.'" class="btn" value="Lưu" onclick="javascript:submitOrdering('.$r->idProductsCategories.','.$stt_temp.$stt.',\'products_categories/check_ordering/'.$r->parentid.'\');" />';
                $products_categories .= '</td>';
				/*enable products*/
                $products_categories .= '<td id="'.$parent.'">';
				$products_categories .= '<a title="Duyệt tuyển dụng" href="'.URL.'admin/products_categories/enable/'.$r->enable_products_categories.'/'.$r->idProductsCategories.'"';
				if($r->enable_products_categories==1) 
				{
					$products_categories .=  'class="daduyet"'; 
				}
				else 
				{
					$products_categories .=  'class="chuaduyet"';
				}
                $products_categories .= 'id="status">';
				if($r->enable_products_categories==1)
				{
						
						$products_categories .='Bật';
				}
				else
				{
					$products_categories .= 'Tắt';
				}
				$products_categories .='</a>';
                $products_categories .= '</td>';
				/*thao tac products*/
                $products_categories .= '<td id="'.$parent.'">';
                $products_categories .= '<a id="sua-hoadon" href="'.URL.'admin/products_categories/edit_products_categories/'.$r->idProductsCategories.'">[&nbsp;Sửa&nbsp;]</a>
                    <input type="checkbox" name="delete[]" value="'.$r->idProductsCategories.'">';
                $products_categories .= '</td>';
				$products_categories .= '</tr>';
				
				$stt++;
				$stt_temp=$stt_temp+1;
				$_SESSION['__stt_temp__']=$stt_temp++;
				$child = $this->getCategoryProducts($category, $r->idProductsCategories,$space.'&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;');
				if ($child) {
                    $i--;
                    $products_categories .= $child;
					
                }
            }
            return $products_categories;
        } else {

            return false;
        }
    } 
	/*list products_categories*/
	/*list products_categories combobox*/
	public function listProductsCategoriesCombobox()
	{
		$menu = $this->productsCategories(0);
		$products="";
		$selected="";
		if(isset($_SESSION['__idProductsCategories__']))
		{
			$idProductsCategories=$_SESSION['__idProductsCategories__'];
		}
		else
		{
			$idProductsCategories=0;
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
	
	/*list products_categories*/
		public function listProductsCategoriesOrdering($parentid=false){
			if($parentid==false)
			{
				$this->db->where("parentid",0);
			}
			else
			{
				$this->db->where("parentid",$parentid);
			}
			$this->db->order_by("ordering_products_categories");
			$products_categories_list=$this->db->get(''.PREFIX.'products_categories');
			$listProductsCategoriesOrdering=$products_categories_list->result();
			return $listProductsCategoriesOrdering;
		}
	/*end list products_categories*/
	
	/*list products_categories*/
		public function listProductsCategoriesPagination(){
			return $this->db->count_all(''.PREFIX.'products_categories');
		}
	/*end list products_categories*/
	
    /*/*list products_categories
		public function listProductsCategories($idProductsCategories=false){
			if($idProductsCategories==false)
			{
				$this->db->where("parentid",0);
			}
			else
			{
				$this->db->where("parentid",$idProductsCategories);
			}
			$this->db->order_by("ordering_products_categories");
			$products_categories_list=$this->db->get(''.PREFIX.'products_categories');
			$productsCategorie = array();
			foreach ($products_categories_list->result() as $productsCategories){
				
				$option_list = $this->db->get_where(''.PREFIX.'products', array('catid'=>$productsCategories->idProductsCategories,'parentid'=>0));
				$productsCategories->idProductsCategorie = $option_list->result();
				$productsCategorie[] = $productsCategories;
			}
			return $productsCategorie;
		}
	/*end list products_categories*/
	/*list products_categories sub
	public function listProductsCategoriesSub(){
		$this->db->order_by("ordering_products_categories");
		$products_categories_list=$this->db->get(''.PREFIX.'products_categories');
		$productsCategorie = array();
		foreach ($products_categories_list->result() as $productsCategories){
			
			$option_list = $this->db->get_where(''.PREFIX.'products', array('catid'=>$productsCategories->idProductsCategories,'parentid'=>0));
			$productsCategories->idProductsCategorie = $option_list->result();
			$productsCategorie[] = $productsCategories;
		}
		return $productsCategorie;
	}
	/*end list products_categories sub*/
	
	/*get  products_categories*/
		public function getProductsCategories($idProductsCategories){
			$queryproducts_categories=$this->db->query(
			'select *
			from '.PREFIX.'products_categories
			where idProductsCategories='.$idProductsCategories.'');
			$getProductsCategories=$queryproducts_categories->result();
			$_SESSION['__idProductsCategories__']=$getProductsCategories[0]->parentid;
			return $getProductsCategories;
		}
	/*end  products_categories*/
	
	/*add products_categories*/
		public function addProductsCategories($data){
			$this->db->insert(''.PREFIX.'products_categories', $data);
		}
	/*end add products_categories*/
	/*edit products_categories*/
		public function editProductsCategories($idProductsCategories,$data){
			$this->db->where("idProductsCategories",$idProductsCategories);
			$this->db->update(''.PREFIX.'products_categories', $data);
		}
	/*end edit products_categories*/
	
	/*remove products_categories*/
	public function removeProductsCategories($idProductsCategories)
	{
		$this->db->where("idProductsCategories",$idProductsCategories);
		$this->db->delete("".PREFIX."products_categories");
	}
	/*end remove products_categories*/
	/*enable products_categories*/
		public function enable($status,$id){
			if($status==0)
			$status=1;
			else
			$status=0;
			$qr = $this->db->query("UPDATE ".PREFIX."products_categories SET enable_products_categories=".$status." WHERE idProductsCategories=".$id."" );
		}
	/*end enable products_categories*/
	
	/*enable products_categories*/
		public function enable_products($status,$id){
			if($status==0)
			$status=1;
			else
			$status=0;
			$qr = $this->db->query("UPDATE ".PREFIX."products SET enable_products=".$status." WHERE idProducts=".$id."" );
		}
	/*end enable products_categories*/
	/*check_ordering*/
		public function check_ordering($idProductsCategories,$data){
			$this->db->where("idProductsCategories",$idProductsCategories);
			$this->db->update(''.PREFIX.'products_categories', $data);
		}
	/*end check_ordering*/
	/*get record next ordering*/
		public function getOrderingPrevious($ordering_products_categories){
			$queryOrderingPrevious=$this->db->query(
			'select *
			from '.PREFIX.'products_categories
			where ordering_products_categories='.($ordering_products_categories+1).'');
			$getOrderingPrevious=$queryOrderingPrevious->result();
			return $getOrderingPrevious;
		}
	/*end get record next ordering*/
	
	/*get record next ordering*/
		public function getOrderingNext($ordering_products_categories){
			$queryOrderingNext=$this->db->query(
			'select *
			from '.PREFIX.'products_categories
			where ordering_products_categories='.($ordering_products_categories-1).'');
			$getOrderingNext=$queryOrderingNext->result();
			return $getOrderingNext;
		}
	/*end get record next ordering*/
	
}
?>