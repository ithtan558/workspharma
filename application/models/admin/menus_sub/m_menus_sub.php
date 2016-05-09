<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class M_menus_sub extends CI_Model{
    function __construct(){
        parent::__construct();
		$this->load->database();
			$this->load->helper("url");
    }
    /*list menu*/
		public function listMenu(){
		$this->db->order_by("ordering_menus");
		$menu_list=$this->db->get('nsp_menus');
		$menu = array();
		foreach ($menu_list->result() as $Menu){
			$this->db->order_by("ordering_menus_sub");
			$option_list = $this->db->get_where('nsp_menus_sub', array('idmenu'=>$Menu->idMenus));
			$Menu->idMenu = $option_list->result();
			$menu[] = $Menu;
  		}
		return $menu;
    }
	/*end list menu*/
	/*get  menu */
		public function getMenu($idMenu){
			$getMenus=$this->db->query(
			'select *
			from nsp_menus
			where idMenus='.$idMenu.'');
			$getMenus=$getMenus->result();
			
			return $getMenus;
		}
	/*end  menu */
	/*list menu sub*/
		public function listMenusSub($idMenus){
			$queryMenuSub=$this->db->query('select a.*,b.* from nsp_menus a,nsp_menus_sub b where a.idMenus=b.idmenu and b.idmenu='.$idMenus.' order by ordering_menus_sub');
			$listMenuSub=$queryMenuSub->result();
			return $listMenuSub;
		}
	/*end list menu sub*/
	
	/*list menu sub*/
		public function listMenuSub_ordering($idMenus){
			$queryMenuSub=$this->db->query('select a.*,b.* from nsp_menus a,nsp_menus_sub b where a.idMenus=b.idmenu and b.idmenu='.$idMenus.' order by ordering_menus_sub');
			$listMenuSub=$queryMenuSub->result();
			return $listMenuSub;
		}
	/*end list menu sub*/
	
	/*get  menu sub */
		public function getMenusSub($idMenusSub){
			$queryMenusSub=$this->db->query(
			'select *
			from nsp_menus_sub
			where idMenusSub='.$idMenusSub.'');
			$getMenusSub=$queryMenusSub->result();
			
			return $getMenusSub;
		}
	/*end  menu sub */
	
	/*add menu sub */
		public function addMenusSub($data){
			$this->db->insert('nsp_menus_sub', $data);
		}
	/*end add menu sub */
	/*edit menu sub */
		public function editMenusSub($idMenus,$data){
			$this->db->where("idMenusSub",$idMenus);
			$this->db->update('nsp_menus_sub', $data);
		}
	/*end edit menu sub */
	
	/*remove menu sub*/
	public function removeMenusSub($idMenus)
	{
		$this->db->where("idMenusSub",$idMenus);
		$this->db->delete("nsp_menus_sub");
	}
	/*end remove menu sub*/
	
	/*enable menu sub */
		public function enable_sub($status,$id){
			if($status==0)
			$status=1;
			else
			$status=0;
			$qr = $this->db->query("UPDATE nsp_menus_sub SET enable_menus_sub=".$status." WHERE idMenusSub=".$id."" );
		}
	/*end enable menu sub */
	
	/*edit menu sub */
		public function check_ordering($idMenusSub,$data){
			$this->db->where("idMenusSub",$idMenusSub);
			$this->db->update('nsp_menus_sub', $data);
		}
	/*end edit menu sub */
	
	/*get record next ordering*/
		public function getOrderingPrevious($ordering_menus_sub){
			$queryOrderingPrevious=$this->db->query(
			'select *
			from nsp_menus_sub
			where ordering_menus_sub='.($ordering_menus_sub+1).'');
			$getOrderingPrevious=$queryOrderingPrevious->result();
			return $getOrderingPrevious;
		}
	/*end get record next ordering*/
	
	/*get record next ordering*/
		public function getOrderingNext($ordering_menus_sub){
			$queryOrderingNext=$this->db->query(
			'select *
			from nsp_menus_sub
			where ordering_menus_sub='.($ordering_menus_sub-1).'');
			$getOrderingNext=$queryOrderingNext->result();
			return $getOrderingNext;
		}
	/*end get record next ordering*/
	
}
?>