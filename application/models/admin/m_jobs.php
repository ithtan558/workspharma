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
	 class M_jobs extends M_application_admin {

   /**
	* Constructor
	*
	*/
	function __construct()
  {
  	parent::__construct();

  }//Controller End
	/**
	 * Get Jobs
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getJobs($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby = array(), $params = null)
	 {
	 	$this->searchFields = array(
	 			'id' 			=> "jobs.id = '{{param}}'",
	 			'status' 	=> "jobs.status = '{{param}}'",
	 			'is_deleted' 	=> "jobs.is_deleted = '{{param}}'",
	 			'title' 	=> "jobs.title LIKE '%{{param}}%'"
	 	);

	 	$this->sortFields = array(
	 			'id_sort'   	=> "jobs.id {{param}}",
	 			'project_name_sort' => "jobs.title {{param}}",
	 			'created_sort' => "jobs.date_created {{param}}"
	 	);
		 $this->denyFields = array(
			 'status',
			 'is_deleted'
		 );

	 	$this->createSQL($params);

	 	//Check For Conditions
	 	if(is_array($conditions) and count($conditions)>0){
	 		$this->db->where($conditions);
	 	}

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
		if(is_array($orderby) and count($orderby)>0){
			$this->db->order_by($orderby[0], $orderby[1]);
		}


		$this->db->from('jobs');
		$this->db->join('users', 'users.id = jobs.user_id','left');
		$this->db->join('user_employers', 'user_employers.user_id = users.id','left');
		//$this->db->join('list_objects', 'list_objects.id = object_relative.list_object_id','left');
		$this->db->group_by("jobs.id");

		//Check For Fields
		if($fields!='')
				$this->db->select($fields);
		else
	 		$this->db->select('jobs.*,users.user_name, user_employers.company');

		//$this->createSQL(array('is_feature' => 1));

		$result =$this->db->get();

		return $result;

	 }//End of getJobs Function
	/**
	 * Update Jobs
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function updateJobs($id=0,$updateData=array(),$conditions=array())
	 {
	 //pr($conditions);exit;
	 	if(is_array($conditions) and count($conditions)>0)
	 		$this->db->where($conditions);
		else
		    $this->db->where('id', $id);
	 	$this->db->update('jobs', $updateData);

	 }//End of updateJobs Function

	 // --------------------------------------------------------------------


	function createJobs($insertData=array())
	 {
	 	try{
			 $this->db->insert('jobs', $insertData);
			 return $this->db->insert_id();
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }
	 }//End of createUser Function

	/**
	 * delete Jobs
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function deleteJobs($id=0,$conditions=array())
	 {
	 	if(is_array($conditions) and count($conditions)>0)
	 		$this->db->where($conditions);
		else
		    $this->db->where('id', $id);

	 	$this->db->update('jobs',  array('is_deleted' => 1));
	 	//$this->db->delete('Jobs');

	 }//End of deleteJobs Function

	 // --------------------------------------------------------------------

	 function restoreJobs($id=0,$conditions=array())
	 {
	 	if(is_array($conditions) and count($conditions)>0)
	 		$this->db->where($conditions);
	 	else
	 		$this->db->where('id', $id);

	 	$this->db->update('jobs',  array('is_deleted' => 0));
	 	//$this->db->delete('Jobs');

	 }

	 function getUserApplies($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby=array(), $or_like = array(),$params = null)
	 {
		 //Check For Conditions
		 if(is_array($conditions) and count($conditions)>0)
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

		 //Check For like statement
		 if(is_array($like) and count($like)>0)
			 $this->db->like($like);

		 if(is_array($or_like) and count($or_like)>0){
			 $strOrLike = implode ( ' OR ', $or_like );
			 $this->db->where ( '('.$strOrLike.')');
		 }

		 //Check for Order by
		 if(is_array($orderby) and count($orderby)>0)
			 $this->db->order_by($orderby[0], $orderby[1]);

		 $this->db->from('users');
		 $this->db->join('resume', 'resume.user_id = users.id', 'inner');
		 $this->db->join('job_apply', 'job_apply.worker_id = users.id', 'inner');
		 $this->db->join('jobs', 'jobs.id = job_apply.job_id', 'inner');
		 $this->db->group_by('users.id');

		 //Check For Fields
		 if($fields!='')
			 $this->db->select($fields);
		 else
			 $this->db->select('users.id, users.user_name, users.display_name, users.email, users.phone,
			 	resume.id AS resume_id, resume.yearOfExperience, resume.expectedSalaryRange,
			 	resume.expected_salary, resume.date_updated, resume.expectedPosition, resume.location, job_apply.date_created, job_apply.status, job_apply.id AS apply_id, jobs.title, jobs.alias, jobs.id AS job_id,resume.display_name_resume');

		 $result = $this->db->get();
		 return $result;

	 }

	 function addEmployer($insertData=array())
	 {
		 try{
			 $this->db->insert('user_employers', $insertData);
			 return $this->db->insert_id();
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }
	 }

	 function addJob($insertData=array())
	 {
		 try{
			 $this->db->insert('jobs', $insertData);
			 return $this->db->insert_id();
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }
	 }
}
// End Skills_model Class

/* End of file Skills_model.php */
/* Location: ./app/models/Skills_model.php */
?>