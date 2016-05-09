<?php
/**
 * Reverse bidding system User_model Class
 *
 * helps to achieve common tasks related to the site like flash message formats,pagination variables.
 *
 * @package		Reverse bidding system
 * @subpackage	Models
 * @category	Common_model
 * @author		Cogzidel Dev Team
 * @version		Version 1.0
 * @link		http://www.cogzidel.com
  <Reverse bidding system>
    Copyright (C) <2009>  <Cogzidel Technologies>
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>
    If you want more information, please email me at bala.k@cogzidel.com or
    contact us from http://www.cogzidel.com/contact
 */
require_once(APPPATH . 'models/admin/m_application_admin.php');
	 class M_users extends M_application_admin {
	/**
	 * Constructor
	 *
	 */
	  function __construct()
	  {
		parent::__construct();
      }//Controller End
	// --------------------------------------------------------------------
    /**
	 * Get getWorkers
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getUsersTrash($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby = array(), $params = null,$conditionOrCategories='',$or_like=array())
	 {
		 $this->searchFields = array(
			 'users.id' 			=> "users.id = '{{param}}'",
			 'users.status' 	=> "users.status = '{{param}}'",
			 'users.user_name' 	=> "users.user_name LIKE '%{{param}}%'",
			 'users.email' 	=> "users.email LIKE '%{{param}}%'"
		 );
		 $this->denyFields = array(
			 'users.status',
		 );
		 $this->createSQL($params);
		 if($conditionOrCategories != ''){
	 		$category_ids = explode(',',$conditionOrCategories);
	 		foreach($category_ids as $item){
	 			$whereOr[] = 'FIND_IN_SET('.$item.', resume.job)';
	 		}
	 		//var_dump($whereOr);die;
	 		if(isset($whereOr) && count($whereOr) > 0){
				$strWhereOr = implode(' OR ', $whereOr);
			}
			$where[] = '('.$strWhereOr.')';
	 	}
	 	if(isset($where) && count($where) > 0){
	 		$where = implode(' OR ', $where);
	 		$this->db->where($where);
	 	}
	 	if(is_array($conditions) and count($conditions)>0)
	 		$this->db->where($conditions);
		//Check For like statement
	 	if(is_array($like) and count($like)>0)
	 		$this->db->like($like);
	 	if(is_array($or_like) and count($or_like)>0)
	 		$this->db->or_like($or_like);
		//Check For Limit
		if(is_array($limit))
		{
			if(count($limit)==1)
	 			$this->db->limit($limit[0]);
			else if(count($limit)==2)
				$this->db->limit($limit[0],$limit[1]);
		}
		//pr($orderby);
		//Check for Order by
		if(is_array($orderby) and count($orderby)>0)
			$this->db->order_by($orderby[0], $orderby[1]);
		$this->db->from('users');
	 	$this->db->order_by("users.id", "desc");
		if($fields!='')
				$this->db->select($fields);
		else
	 		$this->db->select();
		$result = $this->db->get();
		return $result;
		$result = $this->db->get();
		return $result;
	 }//End of getUsers Function

	 /**
	 * Get Users
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getUsers($conditions=array(),$fields='',$like=array(),$orderby=array())
	 {
	 	if(count($conditions)>0)		
	 		$this->db->where($conditions);
			
			//print_r($conditions);
		 //Check For like statement
		 if(is_array($like) and count($like)>0)
			 $this->db->like($like);//Check for Order by
		 if(is_array($orderby) and count($orderby)>0)
			 $this->db->order_by($orderby[0], $orderby[1]);

		 $this->db->from('users');
         $this->db->join('user_employers', 'user_employers.user_id = users.id','left');
		$this->db->join('roles', 'roles.id = users.role_id','left');	
		
		if($fields!='')
				$this->db->select($fields);
		else 		
	 		$this->db->select();
		 
		$result = $this->db->get();
		return $result;
		
	 }//End of getUsers Function
	  /**
	 * delete user
	 *
	 * @access	private
	 * @param	array	an associative array of delete values
	 * @return	void
	 */
	 function restoreUsers($id=0,$conditions=array())
	 {
	    if(count($conditions)>0)
	 		$this->db->where($conditions);
			else
		    $this->db->where('id', $id);
		$this->db->update('users', array('is_deleted' => 0));
		//$this->db->delete('users');
	 }//End of editGroup Function
	/**
	 * Update users
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function updateUser($updateKey=array(),$updateData=array())
	 {
	    $this->db->update('users',$updateData,$updateKey);
	 }//End of editGroup Function

	 /**
	 * create user
	 *
	 * @access	public
	 * @param	string	the type of the flash message
	 * @param	string  flash message 
	 * @return	string	flash message with proper style
	 */
	 function createUser($insertData=array())
	 {
	 	try{
			 $this->db->insert('users', $insertData);
			 return $this->db->insert_id();
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }
	 }//End of createUser Function
}
// End User_model Class
/* End of file User_model.php */
/* Location: ./app/models/User_model.php */
?>