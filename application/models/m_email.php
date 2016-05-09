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
	 class M_email extends CI_Model {
	 
	/**
	 * Constructor 
	 *
	 */
	

	  function __construct(){ 
        parent::__construct();
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
	  
	  	$this->db->from('email_templates');
		$this->db->select('email_templates.id,email_templates.title,email_templates.mail_subject,email_templates.mail_body');
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
	 	$this->db->insert('email_templates', $this->db->escape_str($insertData));
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
		
	 	$this->db->delete('email_templates');
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
	 	$this->db->update('email_templates',$this->db->escape_str ($updateData));
		 
	 }//End of editGroup Function 
	 
	 function sendHtmlMail($to ='',$from ='',$subject='',$message='',$cc='',$bc='',$priority='')
	{
		// lưu vào queue mail table
		$insertData = array(
			"subject"	=> $subject,
			"body"		=> $message,
			"from"		=> $from,
			"to"		=> $to,
			"cc"		=> $cc,
			"bc"		=> $bc,
			"status"	=> 1,
			"priority"	=> $priority,
		);
		//$this->db->insert("mail_queue",$this->db->escape_str($insertData));
		$config = Array(
			  'protocol' => 'smtp',
				'smtp_host' => 'ssl://mail.applancer.net',
				'smtp_port' => 465,
				'smtp_user' => 'do-not-reply@applancer.net', // change it to yours
				'smtp_pass' => '@pplancer2014##', // change it to yours
				'mailtype' => 'html',
			  'charset' => 'utf-8',
			  'wordwrap' => TRUE,
			  'validation' => TRUE
		);
		$this->load->library('email',$config);
        $this->email->set_newline("\r\n");
	
		
		//$config['mailtype'] = 'html';
		//$config['wordwrap'] = TRUE;
		
		//$this->email->initialize($config);

		$this->email->to($to);
    	$this->email->from($from);
		$this->email->cc($cc);
   		$this->email->subject($subject);
    	$this->email->message($message);
		if ($this->email->send())
        {
			return true;
		}else{
			return $this->email->print_debugger();
		}		
	}

    function addMailQueue($data){
        try{
            $this->db->insert("mail_queue", $data);
            return $this->db->insert_id();
        }catch (Exception $e){
            throw $e;
            return false;
        }
    }

     function updateMailQueue($data, $condition){
         try{
             return $this->db->update('mail_queue', $data, $condition);
         }catch (Exception $e){
             throw $e;
             return false;
         }
     }

     function getMailQueue($conditions=array(),$fields='',$like=array(),$limit=array(),$order=array()){
         if($conditions != '')
             $this->db->where($conditions);

         if(is_array($like) and count($like)>0)
             $this->db->like($like);

         //Check For Limit
         if(is_array($limit)) {
             if(count($limit)==1)
                 $this->db->limit($limit[0]);
             else if(count($limit)==2)
                 $this->db->limit($limit[0],$limit[1]);
         }

         if(is_array($order) and count($order)>0)
             $this->db->orderby($order[0],$order[1]);
         else
             $this->db->orderby('priority','desc');

         $this->db->from('mail_queue');

         //Check For Fields
         if($fields!='')
             $this->db->select($fields);
         else
             $this->db->select('mail_queue.id, mail_queue.subject, mail_queue.body, mail_queue.from, mail_queue.to, mail_queue.cc, mail_queue.bc, mail_queue.status');

         $result = $this->db->get();
         return $result;
     }

	 function getEmailMarketing($conditions=array(),$fields='',$like=array(),$limit=array(),$order=array()){
		 if($conditions != '')
			 $this->db->where($conditions);

		 if(is_array($like) and count($like)>0)
			 $this->db->like($like);

		 //Check For Limit
		 if(is_array($limit)) {
			 if(count($limit)==1)
				 $this->db->limit($limit[0]);
			 else if(count($limit)==2)
				 $this->db->limit($limit[0],$limit[1]);
		 }

		 if(is_array($order) and count($order)>0)
			 $this->db->orderby($order[0],$order[1]);
		 else
			 $this->db->orderby('id','asc');

		 $this->db->from('email_marketing');

		 //Check For Fields
		 if($fields!='')
			 $this->db->select($fields);
		 else
			 $this->db->select('email_marketing.id, email_marketing.subject, email_marketing.content');

		 $result = $this->db->get();
		 return $result;
	 }

	 function getEmailMarketingQueue($conditions=array(),$fields='',$like=array(),$limit=array(),$order=array()){
		 if($conditions != '')
			 $this->db->where($conditions);

		 if(is_array($like) and count($like)>0)
			 $this->db->like($like);

		 //Check For Limit
		 if(is_array($limit)) {
			 if(count($limit)==1)
				 $this->db->limit($limit[0]);
			 else if(count($limit)==2)
				 $this->db->limit($limit[0],$limit[1]);
		 }

		 if(is_array($order) and count($order)>0)
			 $this->db->orderby($order[0],$order[1]);
		 else
			 $this->db->orderby('email_marketing_queue.id','asc');

		 $this->db->from('email_marketing');
		 $this->db->join('email_marketing_queue', 'email_marketing_queue.email_id = email_marketing.id','inner');
		 $this->db->join('users', 'users.id = email_marketing_queue.user_id','inner');
		 $this->db->group_by(array('email_marketing_queue.id'));

		 //Check For Fields
		 if($fields!='')
			 $this->db->select($fields);
		 else
			 $this->db->select('email_marketing_queue.id, email_marketing_queue.user_id, users.email, users.user_name, email_marketing.id AS email_id, email_marketing.subject, email_marketing.content');

		 $result = $this->db->get();
		 return $result;
	 }

	 function addEmailMarketingQueue($insertData=array())
	 {
		 try{
			 $this->db->insert('email_marketing_queue', $insertData);
			 return $this->db->insert_id();
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }
	 }

	 function updateEmailMarketing($condition = array(), $updateData=array())
	 {
		 try{
			 if($condition != ''){
				 $this->db->where($condition);
			 }
			 $this->db->update('email_marketing', $updateData);
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }

	 }

	 function updateEmailMarketingQueue($condition = array(), $updateData=array())
	 {
		 try{
			 if($condition != ''){
				 $this->db->where($condition);
			 }
			 $this->db->update('email_marketing_queue', $updateData);
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }

	 }

	 function getEmailHits($conditions=array())
	 {
		 if(count($conditions)>0)
			 $this->db->where($conditions);

		 $this->db->from('email_marketing_hits');
		 $this->db->select('email_marketing_hits.id,email_marketing_hits.code,email_marketing_hits.url,email_marketing_hits.type,email_marketing_hits.hits, email_marketing_hits.date_created');
		 $result = $this->db->get();
		 return $result;
	 }

	 function getLogEmailHits($conditions=array())
	 {
		 if(count($conditions)>0)
			 $this->db->where($conditions);

		 $this->db->from('email_marketing_hits_log');
		 $this->db->select('email_marketing_hits_log.id,email_marketing_hits_log.email_hits_id,email_marketing_hits_log.email');
		 $result = $this->db->get();
		 return $result;
	 }

	 function addLogEmailHits($insertData=array())
	 {
		 try{
			 $this->db->insert('email_marketing_hits_log', $insertData);
			 return $this->db->insert_id();
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }
	 }

	 function updateEmailHits($condition = array(), $updateData=array())
	 {
		 try{
			 if($condition != ''){
				 $this->db->where($condition);
			 }
			 $this->db->update('email_marketing_hits', $updateData);
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }

	 }

	 function addTmpEmail($insertData=array())
	 {
		 try{
			 $this->db->insert('tmp_email', $insertData);
			 return $this->db->insert_id();
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }
	 }
}
// End Email_model Class
   
/* End of file Email_model.php */ 
/* Location: ./app/models/Email_model.php */
