<?php
	 class M_resume_favourites extends CI_Model {
	 
	/**
	 * Constructor 
	 *
	 */
	  function __construct(){
            parent::__construct();
				
      }

	 function insert($insertData=array())
	 {
         try{
             $this->db->insert('resume_favourites', $insertData);
             return $this->db->insert_id();
         }catch (Exception $e){
             throw $e;
             return false;
         }
	 }

     function getResumeFavourites($conditions=array(),$fields='')
     {
         if(count($conditions)>0)
             $this->db->where($conditions);


         $this->db->from('resume_favourites');
         $this->db->join('resume', 'resume.id = resume_favourites.resume_id', 'inner');
         $this->db->group_by('resume.id');

         if($fields!='')
             $this->db->select($fields);
         else
             $this->db->select('resume.*, resume.id as rid, resume_favourites.*');

         $result = $this->db->get();
         return $result;
     }

     function getFavouriteByUser($conditions=array(),$fields='')
     {
         if(count($conditions)>0)
             $this->db->where($conditions);


         $this->db->from('resume_favourites');
         $this->db->join('resume', 'resume.id = resume_favourites.resume_id', 'inner');
         $this->db->join('users', 'users.id = resume.user_id', 'inner');
         $this->db->group_by('resume.id');

         if($fields!='')
             $this->db->select($fields);
         else
             $this->db->select('resume_favourites.id,resume_favourites.user_id,resume_favourites.resume_id, resume_favourites.created_at');

         $result = $this->db->get();
         return $result;
     }

     function update($conditions=array(), $updateData)
     {
         try{
             if($conditions != ''){
                 $this->db->where($conditions);
             }
             return $this->db->update('resume_favourites', $updateData);
         }catch (Exception $e){
             throw $e;
             return false;
         }
     }

     function delete($conditions=array())
     {
         if($conditions != '')
             $this->db->where($conditions);

         $this->db->delete('resume_favourites');

         return $this->db->affected_rows();
     }

}
