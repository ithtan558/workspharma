<?php

class M_auth extends CI_Model {
	 
	function __construct(){
        parent::__construct();
		$this->load->database();
	}
	 
	// --------------------------------------------------------------------
		
	/**
	 * Get Users
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function loginAsAdmin($conditions=array())
	 {
	 	if(count($conditions)>0)		
	 		$this->db->where($conditions);
			 
	 	$this->db->select('admins.id');
		$result = $this->db->get('admins');
		if($result->num_rows()>0)
			return true;
		else 
			return false;	
	 }//End of loginAsAdmin Function
	 
 	// --------------------------------------------------------------------
		
	/**
	 * Get Users
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function setAdminSession($conditions=array())
	 {
	 	if(count($conditions)>0)		
	 		$this->db->where($conditions);
			 
	 	$this->db->select('admins.id,admins.admin_name');
		$result = $this->db->get('admins');
		if($result->num_rows()>0)
		{
			$row = $result->row();
			$values = array ('admin_id'=>$row->id,'logged_in'=>TRUE,'admin_role'=>'admin'); 
			$this->session->set_userdata($values);
		}
		
	 }//End of setAdminSession Function
	 
	// --------------------------------------------------------------------
		
	/**
	 * Get Users
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function setUserSession($row=NULL)
	 {
	 	switch($row->role_id)
		{
			case '1':
				$values = array('user_id'=>$row->id,'logged_in'=>TRUE,'role_id'=>$row->role_id);
				$this->session->set_userdata($values);
				break;
			case '2':
				$values = array('user_id'=>$row->id,'logged_in'=>TRUE,'role_id'=>$row->role_id);
				$this->session->set_userdata($values);
				break;	
		}
	 	
	 }//End of setUserSession Function
	 
	 
	 
	 // Puhal Changes Start Function added for the Remenber me option  (Sep 17 Issue 3)	
	 
	  function setUserCookie($name='',$value ='',$expire = '',$domain='',$path = '/',$prefix ='')
	 {
	 		 $cookie = array(
                   'name'   =>$name,
                   'value'  => $value,
                   'expire' => $expire,
                   'domain' => $domain,
                   'path'   => $path,
                   'prefix' => $prefix,
               );
			  set_cookie($cookie); 
	 }//End of setUserCookie Function	

		
		
	 function getUserCookie($name='')
	 {
		 $val=get_cookie($name,TRUE); 
		return $val;
	 }//End of getUserCookie Function		
	 
 
	  function clearUserCookie($name=array())
	 {
	 	foreach($name as $val)
		{
			delete_cookie($val);
		}	
	 }//End of clearSession Function*/
	 
// Puhal Changes End Function added for the Remenber me option  (Sep 17 Issue 3)		 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	// --------------------------------------------------------------------
		
	/**
	 * clearSession
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function clearAdminSession()
	 {
	 
	 	$array_items = array ('admin_id' => '','logged_in_admin'=>'','admin_role'=>'');
	    $this->session->unset_userdata($array_items);
		
	 }//End of clearSession Function
	 
	// --------------------------------------------------------------------
		
	/**
	 * clearUserSession
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function clearUserSession()
	 {
	 	$array_items = array('user_id' => '','logged_in'=>'','role'=>'', 'role_id' => '');

		$this->session->unset_userdata($array_items);
        //$this->session->sess_destroy();
         //session_destroy();

	 }//End of clearSession Function
	 
}
// End Auth_model Class
   
/* End of file Auth_model.php */ 
/* Location: ./app/models/Auth_model.php */