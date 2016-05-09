<?php
if(!isset($_SESSION))@session_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class M_login extends CI_Model{
    function __construct(){
        parent::__construct();
		$this->load->database();
		$this->load->library('session');
    }
	/*check number login*/
	public function check_number_login()
	{
		$ip = getenv("REMOTE_ADDR");
		$this->db->where("ip",$ip); 
		$query=$this->db->get("".PREFIX."limitlogin");
		$listLimitLogin=$query->result();
		if($listLimitLogin)
		return $listLimitLogin[0]->numberlogin;
	}
	public function getIp()
	{
		$ip = getenv("REMOTE_ADDR");
		$this->db->where("ip",$ip); 
		$query=$this->db->get("".PREFIX."limitlogin");
		$listLimitLogin=$query->result();
		return $listLimitLogin;
	}
	public function deleteIp()
	{
		$ip = getenv("REMOTE_ADDR");
		$this->db->where("ip",$ip); 
		$query=$this->db->delete("".PREFIX."limitlogin");
	}
	/*end check number login*/
	
	/* check admin login */
    public function check_admin_login($username,$password)
	{
		//echo md5($password);exit;
		$this->db->where("admin_name",$username); 
		$this->db->where("password",md5($password));
		$this->db->where("role_id !=",4);
		$this->db->where("is_deleted",0);
		$query=$this->db->get("admins");
		if($query->num_rows == 1)
		{
			//Bỏ limit login
			$this->deleteIp();
			// lấy thông tin người đăng nhập
			$row = $query->row();
			$data = array(
					'__idAdmin__' => $row->id,
					'__nameAdmin__' => $row->admin_name,
					'__gidAdmin__' => $row->role_id,
					'validatedAdmin' => true
					);
			$this->session->set_userdata($data);
			return true;
		}
		else
		{
			$numberlogin=1;
			$date=date("Y-m-d H:i:s");
			$ip = getenv("REMOTE_ADDR");
			$query=$this->db->get_where("".PREFIX."limitlogin",array("ip"=>$ip));
			$listLimitLogin=$query->result();
			if(count($listLimitLogin)<1)
			{
				
				$data = array(
					'idLimitLogin' =>'null',
					'ip' =>$ip,
					'numberlogin' =>1,
					'time_first' =>$date,
					'time_last' =>$date
				);
				$this->db->insert("".PREFIX."limitlogin",$data);
			}
			else
			{
				$numberlogin=$listLimitLogin[0]->numberlogin + 1;
				$data = array(
					'ip' =>$ip,
					'numberlogin' =>1,
					'time_first' =>$date,
					'time_last' =>$date
				);
				$this->db->where("ip",$ip);
				$this->db->update("".PREFIX."limitlogin",$data);
				$query=mysql_query("update ".PREFIX."limitlogin set numberlogin = '".$numberlogin."', time_last = '".$date."' where ip='".$ip."'");
				
			}
			return false;
		}
	}
	//kiểm tra username
    public function check_username($username,$id=false)
	{
		if($id==false);
		else
		{
			$query=$this->db->get_where("".PREFIX."users",array("idUsers"=>$id));
			$listUsers=$query->result();
			if($username==$listUsers[0]->username_users)
			{
				return true;
				exit;
			}
		}
		
		$query=$this->db->get_where("".PREFIX."users",array("username_users"=>$username));
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
	/* check admin remember */
    public function check_admin_remember($email_users,$captcha,$captcha_session)
	{
		$this->db->where("email",$email_users); 
		$this->db->where("role_id !=",4);
		$this->db->where("is_deleted",0);
		$query=$this->db->get("admins");
		if($query->num_rows == 1 && $captcha==$captcha_session)
		{
			//Bỏ limit login
			$this->deleteIp();
			// lấy thông tin người đăng nhập
			return true;
			exit;
		}
		else
		{
			return false;
			exit;
		}
	}
	//end check admin remember
	/* check admin remember */
    public function check_admin_captcha($captcha,$captcha_session)
	{
		if($captcha==$captcha_session)
		{
			return true;
			exit;
		}
		else
		{
			return false;
			exit;
		}
	}
	//end check admin remember
	function addLog($data){
		$this->db->insert("".PREFIX."logs",$data);
	}
	
	public function selectIdUsers($username,$password)
	{
		$this->db->where("admin_name",$username); 
		$this->db->where("password",md5($password));
		$this->db->where("role_id !=",4);
		$query=$this->db->get("admins");
		return $query->result();
	}
	public function editUsers($email_users,$data){

		$this->db->where("email_users",$email_users);

		$this->db->update('pt_users', $data);

	}
	// --------------------------------------------------------------------

	/**
	 * Update admin
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function updateAdminIsLogin($id=0,$updateData=array(),$conditions=array())
	 {
	 	if(count($conditions)>0 && is_array($conditions))
	 		$this->db->where($conditions);
	    else
		    $this->db->where('id', $id);
	 	$this->db->update('admins', $this->db->escape_str($updateData));

	 }//End of addGroup Function
}
?>