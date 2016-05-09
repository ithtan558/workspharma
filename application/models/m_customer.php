<?php
if(!isset($_SESSION))session_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Huynh An
 * Description:Customer model class
 */
class M_customer extends CI_Model{
    function __construct(){
        parent::__construct();
		$this->load->database();
		$this->load->library('session');
    }
    //kiểm tra email
    public function check_email($email,$id=false)
	{
		if($id==false);
		else
		{
			$query=$this->db->get_where("nsp_users",array("idUsers"=>$id));
			$listUsers=$query->result();
			if($email==$listUsers[0]->email_users)
			{
				return true;
				exit;
			}
		}
		
		$query=$this->db->get_where("nsp_users",array("email_users"=>$email));
		if($query->num_rows())
		{
			$listUsers=$query->result();
			if($listUsers[0]->enable_users==0)
			{
				return -1;
			}
			else
			{
				return 1;
			}
		}
		else
		{
			return 0;
		}
	}
	//end kiểm tra email
	
	//kiểm tra phone
    public function check_phone($phone,$id=false)
	{
		if($id==false);
		else
		{
			$query=$this->db->get_where("nsp_users",array("idUsers"=>$id));
			$listUsers=$query->result();
			if($phone==$listUsers[0]->phone_users)
			{
				return false;
				exit;
			}
		}
		$query=$this->db->get_where("nsp_users",array("phone_users"=>$phone));
		if($query->num_rows())
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	//end kiểm tra phone
	
	//kiểm tra username
    public function check_username($username,$id=false)
	{
		if($id==false);
		else
		{
			$query=$this->db->get_where("nsp_users",array("idUsers"=>$id));
			$listUsers=$query->result();
			if($username==$listUsers[0]->username_users)
			{
				return true;
				exit;
			}
		}
		
		$query=$this->db->get_where("nsp_users",array("username_users"=>$username));
		if($query->num_rows())
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	//end kiểm tra username
	
	//kiểm tra insert record
	public function check_insert_users($email,$pass,$phone,$uname,$username)
	{
		$date=date("Y-m-d");
		if($this->session->userdata("__idUsers__"))
		{
			$idUsers=$this->session->userdata("__idUsers__");
			$data = array(
			   'name_users' => $uname ,
			   'username_users' => $username,
			   'email_users' => $email,
			   'password_users' => md5($pass),
			   'address_users' => '' ,
			   'phone_users' => $phone ,
			   'gid' =>4,
			   'registerdate_users' =>$date,
			   'lastvisitdate_users' =>$date,
			   'enable_users' =>1,
		 	);
			$this->db->where("idUsers",$idUsers);
		 	$this->db->update("nsp_users",$data);
			$query=$this->db->get_where("nsp_users",array("idUsers"=>$idUsers));
			$row = $query->row();
			$data = array(
				'__idUsers__' => $row->idUsers,
				'__name_users__' => $row->name_users,
				'__gid__' => $row->gid,
				'__phone_users__' => $row->phone_users,
				'__dia_chi__' => $row->diachi_users,
				'__email_users__' => $row->email_users,
				'__ngay_sinh__' => $row->ngaysinh_users,
				'__validated__' => true
				);
			$this->session->set_userdata($data);
		 	return true;
		}
		else
		{
			$data = array(
			   'idUsers' => 'NULL' ,
			   'name_users' => $uname ,
			   'username_users' => $username,
			   'email_users' => $email,
			   'password_users' => md5($pass),
			   'address_users' => '' ,
			   'phone_users' => $phone ,
			   'gid' =>4,
			   'registerdate_users' =>$date,
			   'lastvisitdate_users' =>$date,
			   'enable_users' =>1,
			 );
			 if($this->db->insert("nsp_users",$data))
			 {
				$idUsers=$this->db->insert_id();
				$query=$this->db->get_where("nsp_users",array("idUsers"=>$idUsers));
				$row = $query->row();
				$data = array(
					'__idUsers__' => $row->idUsers,
					'__name_users__' => $row->name_users,
					'__gid__' => $row->gid,
					'__phone_users__' => $row->phone_users,
					'__email_users__' => $row->email_users,
					'__validated__' => true
					);
				$this->session->set_userdata($data);
				return true;
			 }
			 else
			 {
			  return false;
			 }
		}
	}
	//kiểm tra update 
	public function check_update_users($pass_old,$pass,$phone,$address,$uname)
	{
		//kiểm tra xem mật khẩu củ có đúng hay không?
		$idUsers=$this->session->userdata("__idUsers__");
			if($pass_old!="")
			{
				
				$query=$this->db->query("select password_users from nsp_users where idUsers=".$idUsers."");
				$getUsers=$query->result();
				if($getUsers[0]->password_users!=md5($pass_old))
				{
					return false;
				}
			}
			else
			{
				$data = array(
				   'phone_users' => $phone ,
				   'name_users' => $uname ,
				   'password_users' => md5($pass),
				   'address_users' => $address,
				);
				$this->db->where("idUsers",$idUsers);
				$this->db->update("nsp_users",$data);
				return true;
			}
	}
	//kiểm tra đăng nhập
	public function check_user_login($email_users,$pass_users)
	{
		$query=$this->db->query("select * from nsp_users where password_users='".md5($pass_users)."' and ( email_users='".$email_users."' or phone_users='".$email_users."' or username_users='".$email_users."')");
		if($query->num_rows())
		{
			$listUsers=$query->result();
			if($listUsers[0]->enable_users==0)
			{
				return -1;
			}
			else
			{
				// If there is a user, then create session data
				$row = $query->row();
				$data = array(
					'__idUsers__' => $row->idUsers,
					'__name_users__' => $row->name_users,
					'__gid__' => $row->gid,
					'__phone_users__' => $row->phone_users,
					'__email_users__' => $row->email_users,
					'__validated__' => true
					);
				$this->session->set_userdata($data);
				return 1;
			}
		}
		else
		{
			return 0;
		}
	}
	//lấy thông tin cá nhân
	public function getInformationUsers()
	{
		$idUsers=$this->session->userdata("__idUsers__");
		$query=$this->db->query("select
		*
		from nsp_users
		where idUsers=".$idUsers." and enable_users=1");
		$listUsers=$query->result();
		return $listUsers;
	}
	//end lấy thông tin cá nhân
	/*add email*/
		public function accensp_email($data){
			$this->db->insert('nsp_email', $data);
		}
	/*end add email*/
}
?>