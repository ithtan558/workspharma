<?php
	 class M_employer_files extends CI_Model {
	 
	/**
	 * Constructor 
	 *
	 */
	  function __construct(){
            parent::__construct();
				
      }

	 function insertFile($insertData=array())
	 {
         try{
             $this->db->insert('employer_files', $this->db->escape_str($insertData));
             return $this->db->insert_id();
         }catch (Exception $e){
             throw $e;
             return false;
         }

	 }

     function getFiles($conditions='',$fields='')
     {
         if($conditions != '')
             $this->db->where($conditions);

         $this->db->from('employer_files');
         $this->db->where(array('employer_files.is_deleted' => 0));
         if($fields!='')
             $this->db->select($fields);
         else
             $this->db->select('employer_files.id,employer_files.user_id,employer_files.name,employer_files.path, employer_files.file_type, employer_files.file_size, employer_files.date_created');

         $result = $this->db->get();
         return $result;
     }

     function updateFile($conditions='', $updateData)
     {
         if($conditions != '')
             $this->db->where($conditions);

         $this->db->update('employer_files', $this->db->escape_str($updateData));
     }

     function removeFiles($conditions=array())
     {
         if($conditions != '')
             $this->db->where($conditions);

         $this->db->update('employer_files', array('employer_files.is_deleted' => 1));
         //$this->db->delete('project_wishlist');
     }

}