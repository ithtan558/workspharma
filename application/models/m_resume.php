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
	 class M_resume extends CI_Model {
	 
	/**
	 * Constructor 
	 *
	 */
	  function __construct(){
	        parent::__construct();
	  }
	 /*Start developer Huynh An*/
	 function addResume($insertData=array())
	 {
		 try{
			 $this->db->insert('resume', $insertData);
			 return $this->db->insert_id();
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }
	 }
	 function updateResume($condition='', $updateData=array())
	 {
		 try{
			 if($condition != ''){
				 $this->db->where($condition);
			 }
			 return $this->db->update('resume', $updateData);
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }
	 }

	 function getResume($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby = array())
	  {
		  if($conditions != '')
			  $this->db->where($conditions);

		  //Check For like statement
		  if(is_array($like) and count($like)>0)
			  $this->db->like($like);


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


		  $this->db->from('resume');

		  if($fields!='')
			  $this->db->select($fields);
		  else
			  $this->db->select();

		  $result = $this->db->get();
		  return $result;
	  }


	  function getResumeLanguage($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby = array())
	  {
		  if($conditions != '')
			  $this->db->where($conditions);

		  //Check For like statement
		  if(is_array($like) and count($like)>0)
			  $this->db->like($like);


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


		  $this->db->from('resume_languages');
		  $this->db->join('languages', 'languages.id = resume_languages.language_id', 'left');
		  $this->db->join('language_level', 'language_level.id = resume_languages.language_level_id', 'left');
		  if($fields!='')
			  $this->db->select($fields);
		  else
			  $this->db->select();

		  $result = $this->db->get();
		  return $result;
	  }


	  function getViewEmployer($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby = array())
	  {
		  if($conditions != '')
			  $this->db->where($conditions);
		  //Check For like statement
		  if(is_array($like) and count($like)>0)
			  $this->db->like($like);
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


		  $this->db->from('resume_view_employer');
		  $this->db->join('users', 'users.id = resume_view_employer.user_id', 'inner');
		  $this->db->join('user_employers', 'user_employers.user_id = users.id','left');
		  if($fields!='')
			  $this->db->select($fields);
		  else
			  $this->db->select();

		  $result = $this->db->get();
		  return $result;
	  }


	  function getResumeExperience($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby = array())
	  {
		  if($conditions != '')
			  $this->db->where($conditions);

		  //Check For like statement
		  if(is_array($like) and count($like)>0)
			  $this->db->like($like);


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


		  $this->db->from('resume_experiences');
		  if($fields!='')
			  $this->db->select($fields);
		  else
			  $this->db->select();

		  $result = $this->db->get();
		  return $result;
	  }


	  function getResumeEducation($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby = array())
	  {
		  if($conditions != '')
			  $this->db->where($conditions);

		  //Check For like statement
		  if(is_array($like) and count($like)>0)
			  $this->db->like($like);


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


		  $this->db->from('resume_educations');
		  if($fields!='')
			  $this->db->select($fields);
		  else
			  $this->db->select();

		  $result = $this->db->get();
		  return $result;
	  }



	  /**
	 *  deleteResume
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function deleteResume($id=0,$conditions=array())
	 {
	 	try{
			 if($conditions != ''){
				 $this->db->where($conditions);
			 }
			 else{
			 	$this->db->where(array('resume.id'=>$id));
			 }
			 return $this->db->update('resume', array('resume.is_deleted'=>1));
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }
		 
	 }//End of deleteProjects Function
	 /*End developer Huynh An*/


	 /**
	  * Duy thieu
	  * update: 05/06/2015
	  *
	  * @param string $condition
	  * @param array $updateData
	  * @return bool
	  * @throws Exception
	  */

	 function addResumeViewEmployer($insertData=array())
	 {
		 try{
			 $this->db->insert('resume_view_employer', $insertData);
			 return $this->db->insert_id();
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }
	 }
	 function updateResumeViewEmployer($condition='', $updateData=array())
	 {
		 try{
			 if($condition != ''){
				 $this->db->where($condition);
			 }
			 return $this->db->update('resume_view_employer', $updateData);
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }
	 }


	 function getResumeViewEmployers($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby = array())
	 {
		 if($conditions != '')
			 $this->db->where($conditions);

		 //Check For like statement
		 if(is_array($like) and count($like)>0)
			 $this->db->like($like);


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


		 $this->db->from('resume_view_employer');

		 if($fields!='')
			 $this->db->select($fields);
		 else
			 $this->db->select();

		 $result = $this->db->get();
		 return $result;
	 }
}


// End User_model Class
   
/* End of file User_model.php */ 
/* Location: ./app/models/User_model.php */
?>