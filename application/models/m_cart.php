<?php
if(!isset($_SESSION))@session_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class M_cart extends CI_Model{
    function __construct(){
        parent::__construct();
		$this->load->database();
		$this->load->library('session');
    }
    
    function update_cart($rowid, $qty, $price, $amount) {
 		$data = array(
			'rowid'   => $rowid,
			'qty'     => $qty,
			'price'   => $price,
			'amount'   => $amount
		);
		$this->cart->update($data);
	}
	
	/*get product not parent*/

		public function getProducts($idProducts){

			$option_list = $this->db->query('select price_products,

			idProducts,short_desc_products,thumb_products,is_sale_products,name_products,quantily_products

			from pt_products a

			where idProducts='.$idProducts.' and enable_products=1');
		    $getProducts = $option_list->result();
			$this->idProduct=$getProducts;
			return  $getProducts;

		}

	/*get product not parent*/

		public function getOrder($idOrder){

			$option_list = $this->db->query('select *
			from pt_order

			where idOrder='.$idOrder.'');
		    $getOrder = $option_list->row();
			return  $getOrder;

		}
		
		public function getListDetailOrder($idOrder){

			$option_list = $this->db->query('select *
			from pt_detail_order a, pt_products b

			where a.productid=b.idProducts and orderid='.$idOrder.'');
		    $getOrder = $option_list->result();
			return  $getOrder;

		}

	/*end get product not parent*/	
	
	/*cập nhật số lượng sản phẩm sau khi thanh toán đơn hàng*/

		public function updateProducts($data,$idProducts){

			$this->db->where("idProducts",$idProducts);

			$this->db->update('pt_products', $data);

		}

	/*end cập nhật số lượng sản phẩm sau khi thanh toán đơn hàng*/
	
	/*thêm hóa đơn*/
	public function add_order($data)
	{
		$this->db->insert('pt_order', $data);
		
		$id = $this->db->insert_id();
		
		return (isset($id)) ? $id : FALSE;
	}
	/*end thêm hóa đơn*/
	/*lấy code_order lớn nhất*/
	public function getMaxId()
	{
		$query=$this->db->query("SELECT max(idOrder) as idOrder FROM pt_order");
		$listOrder=$query->result();
		$total= $listOrder[0]->idOrder +1;
        $code= "HTV" . $total;
		return $code;
	}
	/*end lấy code_order lớn nhất*/
	
	/*list products when nhan nut like*/

		public function listProducts($listProducts){

			$languages=$this->languages;
			$string="0";
			$stt=0;
			foreach($listProducts as $product)
			{
				if($stt==count($listProducts)-1)
				{
					$string.=$product;
				}
				else
				{
					$string.=$product.',';
				}
				$stt++;
			}

			$option_list = $this->db->query("select 

			idProducts, thumb_products, price_sale_products,catid,

			name_products, name".$languages."_products as name_products,

			alias_products, alias".$languages."_products as alias_products,
			
			quantily_bought_products,
			
			name_products_categories, name".$languages."_products_categories as name_products_categories,

			alias_products_categories, alias".$languages."_products_categories as alias_products_categories

			from pt_products a, pt_products_categories b 

			where a.catid=b.idProductsCategories and  idProducts in (".$string.") and enable_products=1 order by ordering_products");

		    $listProducts = $option_list->result();

			return  $listProducts;

		}

	/*end list products when nhan nut like*/
	
	
	
	public function add_detailorder($data)
	{
		$this->db->insert('pt_detail_order', $data);
	}
	
	public function editOrder($idOrder,$data){

		$this->db->where("idOrder",$idOrder);

		$this->db->update(''.PREFIX.'order', $data);

	}
	
	/*get config order*/
		public function getConfigOrder(){
			$queryorder_config=$this->db->query(
			'select *
			from '.PREFIX.'order_config');
			$getOrderConfig=$queryorder_config->result();
			
			return $getOrderConfig;
		}
	/*end config order*/
	
}
?>