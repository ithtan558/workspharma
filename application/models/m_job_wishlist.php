<?php
	 class M_job_wishlist extends CI_Model {
	 
	/**
	 * Constructor 
	 *
	 */
	  function __construct(){
            parent::__construct();
				
      }

	 function insertJobWishlist($insertData=array())
	 {
         try{
             return $this->db->insert('job_wishlist', $this->db->escape_str($insertData));
         }catch (Exception $e){
             throw $e;
             return false;
         }

	 }

     function getJobWishlist($conditions=array(),$fields='')
     {
         if(count($conditions)>0)
             $this->db->where($conditions);


         $this->db->from('job_wishlist');

         if($fields!='')
             $this->db->select($fields);
         else
             $this->db->select('job_wishlist.id,job_wishlist.user_id,job_wishlist.job_id');

         $result = $this->db->get();
         return $result;
     }

     function updateJobWishlist($conditions=array(), $updateData)
     {
         if(count($conditions)>0 && is_array($conditions))
             $this->db->where($conditions);

         $this->db->update('job_wishlist', $this->db->escape_str($updateData));
     }

     function removeJobWishlist($conditions=array())
     {
         if(is_array($conditions) and count($conditions)>0)
             $this->db->where($conditions);

         $this->db->update('job_wishlist', array('is_deleted' => 1));
         //$this->db->delete('job_wishlist');
     }

}
