<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Jorge Torres

 * Description: Login model class

 */

class M_menus_parent extends CI_Model{

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

	

	/*list menu*/

		public function listMenu(){

		$menu_list=$this->db->query('select *

		from '.PREFIX.'menus a, '.PREFIX.'menus_parent b group by a.idMenus');

		$menu= $menu_list->result();

		return $menu;

    }

	/*list menu*/

		public function check_listMenu($idMenusParent){

		$menu_list=$this->db->query('select *

		from '.PREFIX.'menus a, '.PREFIX.'menus_have b, '.PREFIX.'menus_parent c

		where a.idMenus=b.idmenu and b.idmenusparent=c.idMenusParent and c.idMenusParent='.$idMenusParent.'');

		$menu= $menu_list->result();

		return $menu;

    }

	/*end list menu*/

	

	

    /*list menus_parent*/

		public function listMenusParent(){

		$menu_list=$this->db->get(''.PREFIX.'menus_parent');

		$listMenusParent = array();

		foreach ($menu_list->result() as $Menu){

			$option_list = $this->db->get_where(''.PREFIX.'menus_have', array('idmenusparent'=>$Menu->idMenusParent));

			$Menu->idMenuHave = $option_list->result();

			$listMenusParent[] = $Menu;

  		}

		return $listMenusParent;

    }

	/*end list menus_parent*/

	

	/*get MenusParent*/

		public function getMenusParent($idMenusParent){

			$queryMenusParent=$this->db->query(

			'select *

			from '.PREFIX.'menus_parent

			where idMenusParent='.$idMenusParent.'');

			$getMenusParent=$queryMenusParent->result();

			

			return $getMenusParent;

		}

	/*end get MenusParent*/

	

	/*add MenusParent*/

		public function addMenusParent($data){

			$this->db->insert(''.PREFIX.'menus_parent', $data);

		}

	/*end add MenusParent*/

	/*sửa edit MenusParent*/

		public function editMenusParent($idMenusParent,$data){

			$this->db->where("idMenusParent",$idMenusParent);

			$this->db->update(''.PREFIX.'menus_parent', $data);

		}

	/*end edit MenusParent*/

	

	/*remove MenusParent*/

	public function removeMenusParent($idMenusParent)



	{

		$this->db->where("idMenusParent",$idMenusParent);

		$this->db->delete("".PREFIX."menus_parent");

	}

	/*end remove MenusParent*/

	/*remove add items menu*/

	public function removeMenusHave($idMenusParent)

	{

		$this->db->where("idMenusParent",$idMenusParent);

		$this->db->delete("".PREFIX."menus_have");

	}

	/*end remove add items menu*/

	

	/*add MenusHave*/

		public function addMenusHave($data){

			$this->db->insert(''.PREFIX.'menus_have', $data);

		}

	/*end add MenusHave*/

}

?>