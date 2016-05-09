<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
 require_once(APPPATH . 'models/m_application.php');
class M_Order extends M_application{
    function __construct(){
        parent::__construct();
		$this->load->database();
		/*session*/
			$this->load->library('session');
    }
    /*Lấy danh sách đơn đặt hàng*/
		public function listOrder(){
			$queryOrder=$this->db->query('select * 
			from pt_order a, pt_users b where a.userid = b.idUsers limit 0,100');
			$listOrder=$queryOrder->result();
			return $listOrder;
		}
	/*end danh sách đơn đặt hàng*/
	
	/*Lấy đơn đặt hàng*/
		public function getOrder($idorder){
			$queryOrder=$this->db->query(
			'select *
			from pt_order a, pt_users b, pt_detail_order c, pt_products d 
			where 
			c.productid=d.idProducts and
			a.userid = b.idUsers and 
			a.idOrder='.$idorder.' and 
			c.orderid='.$idorder.' and 
			a.idOrder=c.orderid 
			order by idOrder');
			$getOrder=$queryOrder->result();
			return $getOrder;
		}
	/*end đơn đặt hàng*/
	
	/*danh sách sản phẩm khi tìm kiểm trong admin*/

		public function listProducts($keywords){
			$where= " (code_products like '%".$keywords."%' or name_products like '%".$keywords."%' or price_products like '%".$keywords."%' or price_products like '%".$keywords."%') and";
			$option_list = $this->db->query("select 
			*
			from pt_products a, pt_products_categories b 

			where ".$where." a.catid=b.idProductsCategories and enable_products=1 order by ordering_products limit 0,4");

		    $listProducts = $option_list->result();

			return  $listProducts;

		}

	/*end danh sách sản phẩm khi tìm kiểm trong admin*/
	
	/*Thêm đơn hàng*/
		/*Lấy id và mã ++*/
			public function getMaxId()
			{
				$query=$this->db->query("SELECT max(idOrder) as idOrder FROM pt_order");
				$listorder=$query->result();
				$total= $listorder[0]->idOrder +1; 
				$data=array();
				$data['idOrder']=$total;
				$maso= "HTV" . $total;
				$data['code_order']=$maso;
				return $data;
			}
		/*end Lấy id và mã ++*/
		
		//thong tin lien he
		public function check_thongtinlienhe($email,$matkhau,$hoten,$cmnd,$diachi,$dienthoai)
		{
			 $data = array(
			   'userid' => 'NULL' ,
			   'idquyen' => 3 ,
			   'email_users' => $email,
			   'pass_users' => $matkhau,
			   'hoten_users' => $hoten ,
			   'cmnd_users' =>$cmnd,
			   'diachi_users' =>$diachi,
			   'dienthoai_users' =>$dienthoai,
			   'validated' =>true,
			 );
			 $this->session->set_userdata($data);
		}
		
	    public function insert_user_themOrder($email,$matkhau,$hoten,$cmnd,$diachi,$dienthoai)
		{
			 $data = array(
			   'userid' => 'NULL' ,
			   'idquyen' => 3 ,
			   'email_users' => $email,
			   'pass_users' => $matkhau,
			   'hoten_users' => $hoten ,
			   'cmnd_users' =>$cmnd,
			   'diachi_users' =>$diachi,
			   'dienthoai_users' =>$dienthoai,
			   'enable_users' =>1,
			 );
			 if($this->db->insert("pt_users",$data))
			 {
				$userid=$this->db->insert_id();
				$query=$this->db->get_where("pt_users",array("userid"=>$userid));
				$row = $query->row();
				$data = array(
							'__tai_khoan_id__' => $row->userid,
							'__ten_tk__' => $row->hoten_users,
							'__ma_quyen__' => $row->idquyen,
							'validated' => true
							);
				$this->session->set_userdata($data);
				$id = $this->db->insert_id();
				return (isset($id)) ? $id : FALSE;
			 }
			 else
			 {
			  return false;
			 }
		}
		//end thong tin lien he
	/*end thêm đơn hàng*/
	/*Lấy chi tiết đơn đặt hàng*/
		public function getdetail_order($iddetail_order){
			$querydetail_order=$this->db->query(
			'select * from pt_detail_order where iddetail_order = '.$iddetail_order.'');
			$getdetail_order=$querydetail_order->result();
			
			return $getdetail_order;
		}
	/*end chi tiết đơn đặt hàng*/
	
	/*remove chi tiet hoa don*/
	public function remove_detail_order($iddetail_order)
	{
		$this->db->where("iddetail_order",$iddetail_order);
		$this->db->delete("pt_detail_order");
	}
	/*end remove chi tiet hoa don*/
	
	/*remove chi tiet hoa don*/
	public function remove_listdetail_order($idorder)
	{
		$this->db->where("idorder",$idorder);
		$this->db->delete("pt_detail_order");
	}
	/*end remove chi tiet hoa don*/
	
	/*cap nhat hoa don*/
	public function update_order($data,$idorder)
	{
		$this->db->where("idorder",$idorder);
		$this->db->update('pt_order', $data);
	}
	/*end cap nhat  hoa don*/
	/*kiểm tra sản phẩm còn đủ số lượng hay không*/

		public function getProducts($idProducts){
			$option_list = $this->db->query('select *
			from pt_products
			where idProducts='.$idProducts.'');
		    $getProducts = $option_list->result();
			$this->idProduct=$getProducts;
			return  $getProducts;

		}

	/*end kiểm tra sản phẩm còn đủ số lượng hay không*/
	/*thêm sản phẩm vào đơn hàng*/
	public function addDetailOrder($data)
	{
		$this->db->insert('pt_detail_order', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	/*end thêm sản phẩm vào đơn hàng*/
	/*cập nhật số lượng sản phẩm vào đơn hàng*/
		//kiểm tra xem sản phẩm đã có trong đơn hàng hay chưa
		public function isHaveProducts($idProducts,$orderid)
		{
			$query=$this->db->query("select idDetailOrder from pt_detail_order where orderid=".$orderid." and productid=".$idProducts."");
			$listProducts=$query->result();
			return $listProducts;
			
		}
		//end kiểm tra xem sản phẩm đã có trong đơn hàng hay chưa
		public function updateDetailOrder($idProducts,$idOrder, $data)
		{
			$getDetailOrder=$this->isHaveProducts($idProducts,$idOrder);
			$this->db->where("idDetailOrder",$getDetailOrder[0]->idDetailOrder);
			$this->db->update('pt_detail_order', $data);
		}
	/*end cập nhật số lượng sản phẩm vào đơn hàng*/
	/*chọn sản phẩm vừa mới thêm vào đơn hàng*/
	public function getDetailOrder($idDetailOrder)
	{
		$query=$this->db->query("select * 
		from pt_detail_order a, pt_products b 
		where a.productid=b.idProducts and idDetailOrder=".$idDetailOrder."");
		$getDetailOrder=$query->result();
		return $getDetailOrder;
	}
	/*end chọn sản phẩm vừa mới thêm vào đơn hàng*/
	/*remove hoa don*/
	public function remove_order($idorder)
	{
		$this->db->where("idorder",$idorder);
		$this->db->delete("pt_order");
	}
	/*end remove hoa don*/
	
	/*remove chi tiết đơn hàng*/
	public function remove_detailorder($idDetailOrder)
	{
		$this->db->where("idDetailOrder",$idDetailOrder);
		$this->db->delete("pt_detail_order");
	}
	/*end remove chi tiết đơn hàng*/
	/*add users*/

		public function addUsers($data){

			$this->db->insert('pt_users', $data);
			$id = $this->db->insert_id();
			return (isset($id)) ? $id : FALSE;

		}

	/*end add users*/
	
	/*add users*/

		public function editUsers($data,$idUsers){

			$this->db->where("idUsers",$idUsers);

			$this->db->update('pt_users', $data);

		}

	/*end add users*/
	
	/*add order*/
	public function add_order($data)
	{
		$this->db->insert('pt_order', $data);
		
		$id = $this->db->insert_id();
		
		return (isset($id)) ? $id : FALSE;
	}
	/*end add order*/
	/*add detail order*/
	public function add_detailorder($data)
	{
		$this->db->insert('pt_detail_order', $data);
	}
	/* end add detailorder*/
	/*cập nhật số lượng sản phẩm sau khi thanh toán đơn hàng*/

		public function updateProducts($data,$idProducts){

			$this->db->where("idProducts",$idProducts);

			$this->db->update('pt_products', $data);

		}

	/*end cập nhật số lượng sản phẩm sau khi thanh toán đơn hàng*/
	/*enable don hang*/
		public function enable($status,$id){
			if($status==0)
			$status=1;
			else
			$status=0;
			$qr = $this->db->query("UPDATE pt_order SET enable_order=".$status." WHERE idorder=".$id."" );
		}
	/*end enable don hang**/
	
	
}
?>