<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class M_menu extends CI_Model{
	public $languages; 
    function __construct(){
        parent::__construct();
		$this->load->database();
			$this->load->helper("url");
			//load library session
			$this->load->library('session');
			//check languages
			if($this->session->userdata("languages"))
			{
				$languages=$this->session->userdata("languages");
			}
    }
	
	/*list menus parent*/
		public function listMenusParent(){
		$menu_list=$this->db->get(''.PREFIX.'menus_parent');
		$listMenusParent= $menu_list->result();
		return $listMenusParent;
    }
	/*end list menus parent*/
	
    /*list menu*/
	function listMenu($idMenusParent=false){
		$_SESSION['__stt_temp__']=0;
		$this->db->order_by('ordering_menus','ASC')->group_by('parentid,idMenus');
		$this->db->select('*');
		$this->db->from(''.PREFIX.'menus a');
		
		if(isset($_SESSION['__enable_menus__']) )
		{
			if($_SESSION['__enable_menus__']!=-1)
			{
				$this->db->where('enable_menus',$_SESSION['__enable_menus__']);
			}
		}
		if(isset($_SESSION['__keyword__']) )
		{
			if($_SESSION['__keyword__']!="")
			$this->db->like('title_menus',$_SESSION['__keyword__']);
		}
		if($idMenusParent!=false)
		{
			$this->db->where('b.idMenusParent',$idMenusParent);
			$this->db->join(''.PREFIX.'menus_have c','c.idmenu= a.idMenus');
			$this->db->join(''.PREFIX.'menus_parent b','c.idmenusparent = b.idMenusParent');
		}
       
		$q=$this->db->get();
		if(count($q->result())==0)
		{
			return false;
		}
        foreach($q->result() as $r){
            $data[$r->parentid][] = $r;
        }
        $menu=$this->getCategoryMenu($data,0);
        return $menu;
    } 
	function getCategoryMenu($category,$parent,$space=""){
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
			$menu = '';
			$stt=0;
			$total_r=count($category[$parent]);
            foreach ($category[$parent] as $r) {
                $child = $this->getCategoryMenu($category, $r->idMenus,$space.'&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;');
				/*id menus*/
				$menu .= '<tr>';
                $menu .= '<td id="'.$parent.'">';
                $menu .= '<a href="#">'.$r->idMenus.'</a>';
                $menu .= '</td>';
				/*name menus*/
                $menu .= '<td id="'.$parent.'">';
                $menu .= $space.'<a href="#">'.$r->title_menus.'</a>';
                $menu .= '</td>';
				/*ordering menus*/
                $menu .= '<td id="'.$parent.'">'.$space.'';
				if($stt==$total_r-1)
				{
					 $menu .='<img src="'.IMAGES_ADMIN.'movedown1.png">';
				}
				else
				{
					$menu .='<a href="'.URL.'admin/menu/check_ordering_previous/'.$r->idMenus.'/'.$r->ordering_menus.'/'.$r->parentid.'">';
						$menu .='<img src="'.IMAGES_ADMIN.'movedown.png" />';
					$menu .='</a>';
				}
				if($stt==0)
				{
					$menu .='<img style="margin-left:-5px;" src="'.IMAGES_ADMIN.'moveup1.png" />';
				}
				else
				{
					$menu .='<a href="'.URL.'admin/menu/check_ordering_next/'.$r->idMenus.'/'.$r->ordering_menus.'/'.$r->parentid.'"><img style="margin-left:-5px;" src="'.IMAGES_ADMIN.'moveup.png" /></a>';
				}
				$menu .='<input name="ordering_menus'.$stt_temp.'" class="save_ordering" type="text" value="'.$r->ordering_menus.'" />';
                    $menu .='<input name="idMenus[]" type="hidden" value="'.$r->idMenus.'" />';
                    $menu .='<input type="button" data="'.$r->idMenus.'" class="btn" value="Lưu" onclick="javascript:submitOrdering('.$r->idMenus.','.$stt_temp.',\'menu/check_ordering/'.$r->parentid.'\');" />';
                $menu .= '</td>';
				/*enable menus*/
                $menu .= '<td id="'.$parent.'">';
				$menu .= '<a title="Duyệt tuyển dụng" href="'.URL.'admin/menu/enable/'.$r->enable_menus.'/'.$r->idMenus.'"';
				if($r->enable_menus==1) 
				{
					$menu .=  'class="daduyet"'; 
				}
				else 
				{
					$menu .=  'class="chuaduyet"';
				}
                $menu .= 'id="status">';
				if($r->enable_menus==1)
				{
						
						$menu .='Bật';
				}
				else
				{
					$menu .= 'Tắt';
				}
				$menu .='</a>';
                $menu .= '</td>';
				/*thao tac menus*/
                $menu .= '<td id="'.$parent.'">';
                $menu .= '<a id="sua-hoadon" href="'.URL.'admin/menu/edit_menu/'.$r->idMenus.'">[&nbsp;Sửa&nbsp;]</a>
                    <input type="checkbox" name="delete[]" value="'.$r->idMenus.'">';
                $menu .= '</td>';
				$menu .= '</tr>';
				if ($child) {
                    $i--;
                    $menu .= $child;
					
                }
				$stt++;
				$stt_temp++;
				$_SESSION['__stt_temp__']=$stt_temp++;
            }
            return $menu;
        } else {
            return false;
        }
    } 
	/*list menu*/
	/*list Menu combobox*/
	public function listMenuCombobox()
	{
		$menu = $this->Menu(0);
		$menus="";
		$selected="";
		$idMenus=$_SESSION['__idMenus__'];
		foreach($menu as $k => $row)
		{
			
			if($idMenus==$row['idMenus']) 
			{
				$selected= "selected";
				
			}
			else
			{
				$selected="";
			}
			
			$menus.='<option '.$selected.' value="'.$row['idMenus'].'">'.$row['title_menus'].'</option>';
		}
		return $menus;
	}
	public function Menu($parentid = 0, $space = "", $trees = array())
    {
        if(!$trees) 
        {
            $trees = array();
        }
        $query =$this->db->query("SELECT * FROM ".PREFIX."menus WHERE parentid = '".$parentid."'");
		$listMenu=$query->result();
        foreach($listMenu as $rs)
		{
            $trees[] = array( 'idMenus' => $rs->idMenus,
                                'title_menus'=>$space.$rs->title_menus,
								'parentid' => $rs->parentid,
                                ); 
            $trees = $this->Menu($rs->idMenus, $space.'&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;', $trees); 
        }
        return $trees;
    }
	
	/*end list Menu combobox*/
	public function listMenuOrdering($parentid=false){
		if($parentid!=false)
		{
			$this->db->where("parentid",$parentid);
		}
		else
		{
			$this->db->where("parentid",0);
		}
		$this->db->order_by("ordering_menus", "asc");
		$menu_list=$this->db->get(''.PREFIX.'menus');
		$menu = $menu_list->result();
		return $menu;
	}
	/*end list menu*/
	
	/*list menu*/
	/*public function listMenusTemp($idMenusParent=false,$parentid=false){
		$where =" ";
		if($idMenusParent!=false)
		{
			$where.='where  b.idmenusparent='.$idMenusParent.' ';
		}
		if($parentid!=false)
		{
			$where.=' and a.parentid='.$parentid.' ';
		}
		if($idMenusParent!=false && $parentid==false)
		{
			$where.=' and a.parentid=0';
		}
		$menu_list=$this->db->query('select * 
		from ".PREFIX."menus a, ".PREFIX."menus_have b
		'.$where.' group by a.idMenus order by idMenus, ordering_menus asc');
		$listMenusTemp=$menu_list->result();
		return $listMenusTemp;
    }*/
	/*end list menu*/
	
	
	/*list menu sub*/
		public function listMenuSub(){
			$queryMenuSub=$this->db->query('select a.*,b.title_menus_sub from '.PREFIX.'menus a,'.PREFIX.'menus_sub b where a.idmenu=b.idMenus order by ordering_menus_sub asc');
			$listMenuSub=$queryMenuSub->result();
			return $listMenuSub;
		}
	/*end list menu sub*/
	
	/*get menu*/
		/*public function getMenu($idMenus){
			//Chọn idmenu trước - sau đó
			$queryMenu=$this->db->query(
			'select *
			from ".PREFIX."menus
			where idMenus='.$idMenus.'');
			$getMenu=$queryMenu->result();
			//xét xem menu này có parentid hay không
			if($getMenu[0]->parentid!=0)
			{
				$queryMenu=$this->db->query(
				'select *
				from ".PREFIX."menus a, ".PREFIX."menus_have b, ".PREFIX."menus_parent c
				where idMenuds='.$idMenus.' and '.$getMenu[0]->parentid.'=b.idmenu and b.idmenusparent=c.idMenusParent');
				
			}
			else
			{
				$queryMenu=$this->db->query(
				'select *
				from ".PREFIX."menus a, ".PREFIX."menus_have b, ".PREFIX."menus_parent c
				where idMenus='.$idMenus.' and a.idMenus=b.idmenu and b.idmenusparent=c.idMenusParent');
			}
			$getMenu=$queryMenu->result();
			
			return $getMenu;
		}*/
		public function getMenu($idMenus){
			//Chọn idmenu trước - sau đó
			$queryMenu=$this->db->query(
			'select *
			from '.PREFIX.'menus
			where idMenus='.$idMenus.'');
			$getMenu=$queryMenu->result();
			$_SESSION['__idMenus__']=$getMenu[0]->parentid;
			return $getMenu;
		}
	/*end get menu*/
	
	/*thêm add menu*/
		public function addMenu($data){
			$this->db->insert(''.PREFIX.'menus', $data);
		}
	/*end add menu */
	/* edit menu*/
		public function editMenu($idMenus,$data){
			$this->db->where("idMenus",$idMenus);
			$this->db->update(''.PREFIX.'menus', $data);
		}
	/*end edit menu*/
	
	/*remove menu*/
	public function removeMenu($idMenus)
	{
		$this->db->where("idMenus",$idMenus);
		$this->db->delete("".PREFIX."menus");
		
		$this->db->where("idmenu",$idMenus);
		$this->db->delete("".PREFIX."menus_have");
	}
	/*end remove menu*/
	/*enable menu*/
		public function enable($status,$id){
			if($status==0)
			$status=1;
			else
			$status=0;
			$qr = $this->db->query("UPDATE ".PREFIX."menus SET enable_menus=".$status." WHERE idMenus=".$id."" );
		}
	/*end enable menu*/
	
	/*enable menu sub*/
		public function enable_sub($status,$id){
			if($status==0)
			$status=1;
			else
			$status=0;
			$qr = $this->db->query("UPDATE ".PREFIX."menus_sub SET enable_menus_sub=".$status." WHERE idMenusSub=".$id."" );
		}
	/*end enable menu sub*/
	
	/*check_ordering*/
		public function check_ordering($idMenus,$data){
			$this->db->where("idMenus",$idMenus);
			$this->db->update(''.PREFIX.'menus', $data);
		}
	/*end check_ordering*/
	/*get record next ordering*/
		public function getOrderingPrevious($ordering_menus,$parentid){
			$queryOrderingPrevious=$this->db->query(
			'select *
			from '.PREFIX.'menus
			where ordering_menus='.($ordering_menus+1).' and parentid='.$parentid.'');
			$getOrderingPrevious=$queryOrderingPrevious->result();
			return $getOrderingPrevious;
		}
	/*end get record next ordering*/
	
	/*get record next ordering*/
		public function getOrderingNext($ordering_menus,$parentid){
			$queryOrderingNext=$this->db->query(
			'select *
			from '.PREFIX.'menus
			where ordering_menus='.($ordering_menus-1).'  and parentid='.$parentid.'');
			$getOrderingNext=$queryOrderingNext->result();
			return $getOrderingNext;
		}
	/*end get record next ordering*/
	
}
?>