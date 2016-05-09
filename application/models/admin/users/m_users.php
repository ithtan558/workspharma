<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Jorge Torres

 * Description: Login model class

 */

class M_users extends CI_Model{

    function __construct(){

        parent::__construct();

		$this->load->database();

		//session

		$this->load->library('session');

    }

	

	/*get list UserGroup*/

		public function listUserGroup(){

			$queryQuyen=$this->db->query('select * from '.PREFIX.'user_group order by idUserGroup DESC');

			$listUserGroup=$queryQuyen->result();

			return $listUserGroup;

		}

	/*end list UserGroup*/

	

    /*get list users*/

		public function listUsers(){

			$queryusers=$this->db->query('select * from '.PREFIX.'users a, '.PREFIX.'user_group b where a.idUsers!=47 and a.gid=b.idUserGroup order by idUsers DESC');

			$listUsers=$queryusers->result();

			return $listUsers;

		}

	/*end list users*/

	

	/*get  users*/

		public function getUsers($idUsers){

			$queryusers=$this->db->query(

			'select *

			from '.PREFIX.'users

			where idUsers='.$idUsers.'');

			$getUsers=$queryusers->result();

			$data = array(

			'__username__' => $getUsers[0]->idUsers,

			);

			$this->session->set_userdata($data);

			return $getUsers;

		}

	/*end  users*/

	

	/*add users*/

		public function addUsers($data){

			$this->db->insert(''.PREFIX.'users', $data);

		}

	/*end add users*/

	/*edit users*/

		public function editUsers($idUsers,$data){

			$this->db->where("idUsers",$idUsers);

			$this->db->update(''.PREFIX.'users', $data);

		}

		/*public function suausersEmail($email,$data){

			$this->db->where("email_users",$email);

			$this->db->update(''.PREFIX.'users', $data);

		}*/

	/*end edit users*/

	

	/*remove users*/

	public function remove_users($idUsers)

	{

		$this->db->where("idUsers",$idUsers);

		$this->db->delete("".PREFIX."users");

	}

	/*end remove users*/

	/*enable users*/

	public function enable($status,$id){

		if($status==0)

		$status=1;

		else

		$status=0;

		$qr = $this->db->query("UPDATE ".PREFIX."users SET enable_users=".$status." WHERE idUsers=".$id."" );

	}

	/*end enable users*/

	

	/*check username when register */

	public function check_username($username)

	{

		$query=$this->db->get_where("".PREFIX."users",array("username_users"=>$username));

		if($query->num_rows())

		{

			return false;

		}

		else

		return true;

	}

	/*end  check username when register*/

	

	/* check Email when register*/

	public function check_email($email_users,$id=false)

	{

		if($id==false);

		else

		{

			$query=$this->db->get_where("".PREFIX."users",array("idUsers"=>$id));

			$listUsers=$query->result();

			if($email_users==$listUsers[0]->email_users)

			{

				return true;

				exit;

			}

		}

		

		$query=$this->db->get_where("".PREFIX."users",array("email_users"=>$email_users));

		if($query->num_rows())

		{

			return false;

		}

		else

		return true;

	}

	/*end  check Email when register*/

	

}

?>