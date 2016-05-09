<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Jorge Torres

 * Description: Login model class

 */

class M_usergroup extends CI_Model{

    function __construct(){

        parent::__construct();

		$this->load->database();

    }

    

	/*get list UserGroup*/

		public function listUserGroup(){

			$queryQuyen=$this->db->query('select * from '.PREFIX.'user_group order by idUserGroup');

			$listQuyen=$queryQuyen->result();

			return $listQuyen;

		}

	/*end list UserGroup*/

	

	

	/*get UserGroup*/

		public function getUserGroup($idUserGroup){

			$queryusergroup=$this->db->query(

			'select *

			from '.PREFIX.'user_group

			where idUserGroup='.$idUserGroup.'');

			$getusergroup=$queryusergroup->result();

			return $getusergroup;

		}

	/*end UserGroup*/

	

	/*add UserGroup*/

		public function themUserGroup($data){

			$this->db->insert(''.PREFIX.'user_group', $data);

		}

	/*end add UserGroup*/

	/*edit UserGroup*/

		public function suaUserGroup($idUserGroup,$data){

			$this->db->where("idUserGroup",$idUserGroup);

			$this->db->update(''.PREFIX.'user_group', $data);

		}

	/*end edit UserGroup*/

	

	/*remove UserGroup*/

	public function removeUserGroup($idUserGroup)

	{

		$this->db->where("idUserGroup",$idUserGroup);

		$this->db->delete("".PREFIX."user_group");

	}

	/*end remove UserGroup*/

	/*enable UserGroup*/

		public function enable($status,$id){

			if($status==0)

			$status=1;

			else

			$status=0;

			$qr = $this->db->query("UPDATE ".PREFIX."user_group SET enable=".$status." WHERE idUserGroup=".$id."" );

		}

	/*end enable UserGroup*/

	

}

?>