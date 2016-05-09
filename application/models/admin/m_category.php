<?php
/**
 * Reverse bidding system Skills_model Class
 *
 * Update site settings informations in database.
 *
 * @package		Reverse bidding system
 * @subpackage	Models
 * @category	Skills
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
	 class M_category extends M_application_admin {
   /**
	* Constructor
	*
	*/
	function __construct()
	  {
	  	parent::__construct();
      }//Controller End
	 /* Update category
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function updateCategory($id=0,$updateData=array())
	 {
	 	$this->db->where('categories.id', $id);
	 	$this->db->update('categories', $updateData);
	 }//End of editGroup Function
 	 // --------------------------------------------------------------------
	/**
	 * delete Jobs
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function deleteCategory($id=0,$conditions=array())
	 {
	 	if(is_array($conditions) and count($conditions)>0)
	 		$this->db->where($conditions);
		else
		    $this->db->where('id', $id);
	 	$this->db->update('categories', array('is_deleted' => 1));
	 	//$this->db->delete('categories');
	 }//End of deleteJobs Function
	 // --------------------------------------------------------------------
	 function restoreCategory($id=0,$conditions=array())
	 {
	 	if(is_array($conditions) and count($conditions)>0)
	 		$this->db->where($conditions);
	 	else
	 		$this->db->where('id', $id);
	 	$this->db->update('categories', array('is_deleted' => 0));
	 	//$this->db->delete('categories');
	 }
	/**
	 * Add category
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function addCategory($insertData=array())
	 {
	 	try{
			 $this->db->insert('categories', $insertData);
			 return $this->db->insert_id();
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }
	 }//End of getGroups Function
	 function getCategory($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby=array(), $params = null)
	 {
	 	$this->searchFields = array(
	 			'id' 			=> "categories.id = '{{param}}'",
	 			'is_active' 	=> "categories.is_active = '{{param}}'",
	 			'is_deleted' 	=> "categories.is_deleted = '{{param}}'",
	 			'category_name' 	=> "categories.category_name LIKE '%{{param}}%'",
	 	);
	 	$this->sortFields = array(
	 			'category_name_sort' => "categories.category_name {{param}}",
	 			'created_sort' => "categories.created {{param}}",
	 	);
	 	$this->createSQL($params);
	 	//Check For Conditions
	 	if(count($conditions)>0)
	 		$this->db->where($conditions);
		//Check for Order by
		if(is_array($orderby) and count($orderby)>0)
			$this->db->order_by($orderby[0], $orderby[1]);
		$this->db->from('categories');
		//Check For Fields
		if($fields!='')
				$this->db->select($fields);
		else
	 		$this->db->select();
		$result = $this->db->get();
		return $result;
	 }//End of getCategories Function
}
// End Skills_model Class
/* End of file Skills_model.php */
/* Location: ./app/models/Skills_model.php */
?>