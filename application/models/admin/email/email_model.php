<?php
/**
 * Reverse bidding system Email_model Class
 *
 * Email settings information in database.
 *
 * @package		Reverse bidding system
 * @subpackage	Models
 * @category	Settings 
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
	 class Email_model extends CI_Model {
	 
	/**
	 * Constructor 
	 *
	 */
	function __construct(){

        parent::__construct();

		$this->load->database();

			$this->load->helper("url");

    }
	// --------------------------------------------------------------------
		
	/**
	 * Get Email settings from database
	 *
	 * @access	private
	 * @param	nil
	 * @return	array	payment settings informations in array format
	 */
	 function getEmailSettings($conditions=array())
	 {
	 	if(count($conditions)>0)		
	 		$this->db->where($conditions);
	  
	  	$this->db->from('pt_email_templates');
		$this->db->select('pt_email_templates.id,pt_email_templates.title,pt_email_templates.mail_subject,pt_email_templates.mail_body');
		$result = $this->db->get();
		return $result;
			
	 }//End of getEmailSettings Function
	 
	 	
	/**
	 * Add Email Settings
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function addEmailSettings($insertData=array())
	 {
	 	$this->db->insert('pt_email_templates', $insertData);
		return; 
	 }//End of getGroups Function
	 // --------------------------------------------------------------------
	 
	 /**
	 * delete Email Settings
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function deleteEmailSettings($condition=array())
	 {
	    if(isset($condition) and count($condition) > 0)
			$this->db->where($condition);
		
	 	$this->db->delete('pt_email_templates');
		return; 
	 }//End of getGroups Function
	 //------------------------------------------------------------------------
	 
	 /**
	 * Send Mail
	 *
	 * @access	private
	 * @param	array
	 * @return	array	site settings informations in array format
	 */
	function sendMail($to ='',$from ='',$subject='',$message='',$cc='')
	{
		//echo $from;exit;
		// load Email Library 
		$this->load->library('email');
		
		$config['mailtype'] = 'text';
		$config['wordwrap'] = TRUE;
		
		$this->email->initialize($config);

		$this->email->to($to);
    		$this->email->from($from);
		$this->email->cc($cc);
   		$this->email->subject($subject);
    		$this->email->message($message);
		if ( ! $this->email->send()){
		echo $this->email->print_debugger();
		}
		
	} // Function sendmail End
	
	/**
	 * Update Email Settings
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function updateEmailSettings($id=0,$updateData=array())
	 {
	 	$this->db->where('id', $id);
	 	$this->db->update('pt_email_templates', $updateData);
		 
	 }//End of editGroup Function 
	 

	function addMailQueue($data){
        try{
            $this->db->insert("pt_mail_queue", $this->db->escape_str($data));
            return $this->db->insert_id();
        }catch (Exception $e){
            throw $e;
            return false;
        }
    }

     function updateMailQueue($data, $condition){
         try{
             return $this->db->update('pt_mail_queue', $this->db->escape_str($data), $condition);
         }catch (Exception $e){
             throw $e;
             return false;
         }
     }

	 
}
// End Email_model Class
   
/* End of file Email_model.php */ 
/* Location: ./app/models/Email_model.php */
