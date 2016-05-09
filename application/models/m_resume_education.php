<?php 

	 class M_resume_education extends CI_Model {
	 
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
	 function getResumeEducation($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby=array())
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
			
		$this->db->from('resume_educations');

		$result = $this->db->get();
		return $result;
		
	 }//End of getUsers Function

	 
	 function addResumeEducation($insertData=array())
	 {
	 	$this->db->insert('resume_educations', $insertData);
	 }
	 
	 function updateResumeEducation($id=0,$updateData=array())
	 {
	 	$this->db->where('resume_educations.id', $id);
	 	$this->db->update('resume_educations', $updateData);
	 }
	 
	 function deleteResumeEducation($id=0,$conditions=array())
	 {
	 	if(is_array($conditions) and count($conditions)>0)
	 		$this->db->where($conditions);
	 	else
	 		$this->db->where('id', $id);
	 	$this->db->delete('resume_educations');
	 		
	 }
	 
}
// End Admin_roles_model Class
   
/* End of file Admin_roles_model.php */ 
/* Location: ./app/models/Admin_roles_model.php */