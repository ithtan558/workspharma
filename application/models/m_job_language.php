<?php 

	 class M_job_language extends CI_Model {
	 
	/**
	 * Constructor 
	 *
	 */

	  function __construct(){
	        parent::__construct();
      }//Controller End
	 
	/**
	 * Get admin roles
	 *
	 * @access	private
	 * @param	nil
	 * @return	object	object with result set
	 */
	 function getJobLanguage($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby=array())
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
			
		//Check for Order by
		if(is_array($orderby) and count($orderby)>0)
			$this->db->order_by($orderby[0], $orderby[1]);
			
		$this->db->from('job_languages');

		$result = $this->db->get();
		return $result;
		
	 }//End of getUsers Function

	 
	 function addJobLanguage($insertData=array())
	 {
	 	$this->db->insert('job_languages', $insertData);
	 }
	 
	 function updateJobLanguage($id=0,$updateData=array())
	 {
	 	$this->db->where('job_languages.id', $id);
	 	$this->db->update('job_languages', $updateData);
	 }
	 
	 function deleteJobLanguage($id=0,$conditions=array())
	 {
	 	if(is_array($conditions) and count($conditions)>0)
	 		$this->db->where($conditions);
	 	else
	 		$this->db->where('id', $id);
	 	$this->db->delete('job_languages');
	 		
	 }
	 
}
// End Admin_roles_model Class
   
/* End of file Admin_roles_model.php */ 
/* Location: ./app/models/Admin_roles_model.php */