<?php
	 class M_user extends CI_Model {
	/**
	 * Constructor
	 *
	 */
	  function __construct(){
        parent::__construct();
		$this->load->database();
	}
	// --------------------------------------------------------------------
	/**
	 * create user
	 *
	 * @access	public
	 * @param	string	the type of the flash message
	 * @param	string  flash message
	 * @return	string	flash message with proper style
	 */
	 function createUser($insertData=array())
	 {
		 $this->db->insert('users', $this->db->escape_str($insertData));
		 return $this->db->insert_id();
	 }//End of createUser Function
	 /**
	 * create user employers
	 *
	 * @access	public
	 * @param	string	the type of the flash message
	 * @param	string  flash message
	 * @return	string	flash message with proper style
	 */
	 function createUserEmployers($insertData=array())
	 {
		 try{
			 $this->db->insert('user_employers', $this->db->escape_str($insertData));
			 return $this->db->insert_id();
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }
	 	/*if($this->db->insert('users', $this->db->escape_str($insertData)))
            return TRUE;
         else
             return FALSE;*/
	 }//End of createUser Function
	 /**
	 * create user employers
	 *
	 * @access	public
	 * @param	string	the type of the flash message
	 * @param	string  flash message
	 * @return	string	flash message with proper style
	 */
	 function createUserJobseeker($insertData=array())
	 {
		 try{
			 $this->db->insert('user_worker', $this->db->escape_str($insertData));
			 return $this->db->insert_id();
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }
	 	/*if($this->db->insert('users', $this->db->escape_str($insertData)))
            return TRUE;
         else
             return FALSE;*/
	 }//End of createUser Function
	 /**
	 * create user accept job
	 *
	 * @access	public
	 * @param	string	the type of the flash message
	 * @param	string  flash message
	 * @return	string	flash message with proper style
	 */
	 function createUserAcceptJobs($insertData=array())
	 {
		 try{
			 $this->db->insert('user_accept_jobs', $this->db->escape_str($insertData));
			 return $this->db->insert_id();
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }
	 	/*if($this->db->insert('users', $this->db->escape_str($insertData)))
            return TRUE;
         else
             return FALSE;*/
	 }//End of createUser Function

	 /**
	 * create user accept job
	 *
	 * @access	public
	 * @param	string	the type of the flash message
	 * @param	string  flash message
	 * @return	string	flash message with proper style
	 */
	 function updateUserAcceptJobs($updateKey=array(),$updateData=array())
	 {
	    $this->db->update('user_accept_jobs',$this->db->escape_str($updateData),$updateKey);
	 }//End of editGroup Function
 	// --------------------------------------------------------------------
	/**
	 * Update users
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function updateUser($updateKey=array(),$updateData=array())
	 {
	    $this->db->update('users',$this->db->escape_str($updateData),$updateKey);
	 }//End of editGroup Function
	 /**
	 * Update users
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function updateWorker($updateKey=array(),$updateData=array())
	 {
	    $this->db->update('user_worker',$this->db->escape_str($updateData),$updateKey);
	 }//End of editGroup Function
	 // --------------------------------------------------------------------
	/**
	 * Update usersCategories
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function updateCategories($updateKey=array(),$updateData1=array())
	 {
	    $this->db->update('user_categories',$this->db->escape_str($updateData1),$updateKey);
	 }//End of editGroup Function
	// --------------------------------------------------------------------
	 function getUsersRecommend($conditions = array()){
	 	if(count($conditions)>0)
	 		$this->db->where($conditions);
		$this->db->from('users');
		$this->db->join('roles', 'roles.id = users.role_id','left');
	 	$this->db->select('users.id,roles.role_name,users.display_name,users.user_name,users.name,users.role_id,users.password,users.email,users.profile_desc,users.logo,users.user_status,users.activation_key,users.created');
		$result = $this->db->get();
		return $result;
	 }
	 // --------------------------------------------------------------------
	/**
	 * Get Users
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getUsers($conditions=array(),$fields='',$limit = array(),$orderby = array(),$like = array(),$conditionOrCategories='',$or_where=array())
	 {
	 	if($conditionOrCategories != ''){
			//echo $conditionOrCategories;die;
	 		$category_ids = explode(',',$conditionOrCategories);
	 		foreach($category_ids as $item){
	 			$whereOr[] = 'FIND_IN_SET('.$item.', resume.job)';
	 		}
	 		//var_dump($whereOr);die;
	 		if(isset($whereOr) && count($whereOr) > 0){
				$strWhereOr = implode(' OR ', $whereOr);
			}
			$where[] = '('.$strWhereOr.')';
	 	}
	 	//var_dump($where);
	 	if(count($conditions)>0)
	 		$this->db->where($conditions);
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
         if(is_array($orderby) and count($orderby)>0)
             $this->db->order_by($orderby[0], $orderby[1]);
         $this->db->from('users');
         $this->db->join('user_employers', 'user_employers.user_id = users.id','left');
         $this->db->join('resume', 'resume.user_id = users.id','left');
		$this->db->join('roles', 'roles.id = users.role_id','left');
		$this->db->group_by(array('users.id'));
		if($fields!='')
				$this->db->select($fields);
		else
	 		$this->db->select('users.is_available,users.id,roles.role_name,
	 			users.user_name,users.name,users.phone,users.role_id,
	 			users.password,users.email,
	 			users.profile_desc,users.user_status,
	 			users.activation_key,users.created,
	 			users.logo,
	 			users.active_email,
	 			user_employers.logo as elogo, user_employers.company, user_employers.address,
	 			user_employers.phone, user_employers.description,user_employers.contact,
	 			resume.display_name_resume,resume.city,resume.job,resume.recentPosition,resume.location,
	 			resume.yearOfExperience,resume.no_experience,resume.expectedSalaryRange,resume.expected_salary');
		$result = $this->db->get();
		return $result;
	 }//End of getUsers Function
	 // --------------------------------------------------------------------
	/**
	 * Get Users
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getUsersAcceptJob($conditions=array(),$fields='',$limit = array(),$orderby = array(),$like = array(),$conditionOrCategories='')
	 {
	 	//var_dump($where);
	 	if(isset($where) && count($where) > 0){
	 		$where = implode(' AND ', $where);
	 		$this->db->where($where);
	 	}
	 	if(count($conditions)>0)
	 		$this->db->where($conditions);
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
         if(is_array($orderby) and count($orderby)>0)
             $this->db->order_by($orderby[0], $orderby[1]);
         $this->db->from('users');
         $this->db->join('user_accept_jobs', 'user_accept_jobs.user_id = users.id','inner');
		$this->db->group_by(array('users.id'));
		if($fields!='')
				$this->db->select($fields);
		else
	 		$this->db->select();
		$result = $this->db->get();
		return $result;
	 }//End of getUsers Function
	 
	 function getUsersVerify($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby = array())
	 {
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
		 //pr($orderby);
		 //Check for Order by
		 if(is_array($orderby) and count($orderby)>0){
			 $this->db->order_by($orderby[0], $orderby[1]);
		 }else{
			 $this->db->order_by("users.percentProfile", "desc");
			 $this->db->order_by("users.tot_rating  DIV users.user_rating", "desc");
			 $this->db->order_by("users.created", "desc");
		 }
		 $this->db->from('users');
		 $this->db->where(array('users.is_deleted' => 0, 'users.is_verify_studio' => 1));
		 if($fields!='')
			 $this->db->select($fields);
		 else
			 $this->db->select('users.id,users.display_name,users.user_name,users.logo,users.role_id,
			 	users.is_verify_studio');
		 $result = $this->db->get();
		 return $result;
	 }
	
	 //---------------------------------------------------------------------------------------------------------------//
	 /**
	 * Get User Categories
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getUserCategories($conditions=array(),$fields='')
	 {
	 	if(count($conditions)>0)
	 		$this->db->where($conditions);
		$this->db->from('user_categories');
		if($fields!='')
				$this->db->select($fields);
		else
	 	$this->db->select('user_categories.user_categories');
		$result = $this->db->get();
		return $result;
	 }//End of getUserContacts Function
	 //---------------------------------------------------------------------------------------------------------------//
	 /**
	 * Get User Categories
	 * controller project,action create
     * update 14/11/2014 son
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getUsersWithCategories($conditions=array(),$fields='',$where_in = array())
	 {
	 	if(count($conditions)>0)
	 		$this->db->where($conditions);
        if(!empty($where_in))
            $this->db->where_in('user_categories.user_categories',$where_in);
		$this->db->from('users');
		$this->db->join('user_categories', 'user_categories.user_id = users.id','left');
		if($fields!='')
				$this->db->select($fields);
		else
	 	$this->db->select('users.id,users.email,user_categories.user_categories,users.user_name,users.display_name');
		$result = $this->db->get();
		return $result;
	 }//End of getUserContacts Function
	// --------------------------------------------------------------------
	/**
	 * Get Users
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function allowToPostProject($creator_id = false)
	 {
	 }//End of getCategories Function
	 /**
	 * Loads userslist for transfer money
	 *
	 * @access	private
	 * @param	nil
	 * @return	void
	 */
	function userProjectdata($conditions=array())
	{
		if(count($conditions)>0)
	 		$this->db->where($conditions);
	 	$this->db->select('users.id,users.user_name,users.role_id,users.display_name');
		$result = $this->db->get('users');
		return $result;
	} //Function logout End
	/**
	 *
	 * Get the favourite and blocked users list from user_list atable
	 * @access	private
	 * @return	favourite and blocked users list
	 */
	 function getFavourite($conditions=array())
	 {
	  	if(count($conditions)>0)
	 		$this->db->where($conditions);
		$this->db->from('user_list');
	 	$this->db->select('user_list.id,user_list.creator_id,user_list.user_id,user_list.user_name,user_list.user_role');
		$result = $this->db->get();
		//pr($result);
		return $result;
	 }//End of flash_message Function
	// --------------------------------------------------------------------
	/**
	 * insert User details for favourite users
	 *
	 * @access	public
	 * @param	string	the type of the flash message
	 * @param	string  flash message
	 * @return	string	flash message with proper style
	 */
	 function addFavourite($insertData=array())
	 {
	 	$this->db->insert('user_list',$this->db->escape_str($insertData));
	 }//End of insertUserContacts Function
	 /**
	 * Update user_list for favourite users and blockedusers
	 *
	 * @access	private
	 * @param	array	an associative array of update values
	 * @return	void
	 */
	 function updateFavourite($updateData=array(),$conditions=array())
	 {
	    if(count($conditions)>0)
	 		$this->db->where($conditions);
		$this->db->update('user_list',$updateData);
	 }//End of editGroup Function
	function updateKeyRand($condition = array(),$insertData = array()){
	 	if(is_array($condition) && count($condition) > 0)
	 		$this->db->where($condition);
	 	$this->db->update("users",$insertData);
	}
	function checkKeyRand($conditions){
        if($conditions != null)
            $this->db->where($conditions);
		$this->db->from("users");
		$this->db->select("users.email,users.id,users.password,users.forgot_time");
		$result = $this->db->get();
		return $result;
	}
	function checkActiveEmail($conditions){
        if($conditions != null)
            $this->db->where($conditions);
		//$this->db->where(array("users.active_email" => $key));
		$this->db->from("users");
		$this->db->select("users.email,users.id,users.password");
		$result = $this->db->get();
		return $result;
	}
	 // --------------------------------------------------------------------
	 /**
	 * delete from user_list for favourite users and blockedusers
	 *
	 * @access	private
	 * @param	array	an associative array of delete values
	 * @return	void
	 */
	 function deleteFavourite($conditions=array())
	 {
	    if(count($conditions)>0)
	 		$this->db->where($conditions);
		$this->db->delete('user_list');
	 }//End of editGroup Function
	  // --------------------------------------------------------------------
	 /**
	 * delete portfolios
	 *
	 * @access	private
	 * @param	array	an associative array of delete values
	 * @return	void
	 */
	 function deletePortfolio($conditions=array())
	 {
	    if(count($conditions)>0)
	 		$this->db->where($conditions);
		$this->db->delete('portfolio');
	 }//End of editGroup Function
	 // --------------------------------------------------------------------
	 /**
	 * delete ban list
	 *
	 * @access	private
	 * @param	array	an associative array of delete values
	 * @return	void
	 */
	 function deleteBan($id=0,$conditions=array())
	 {
	    if(count($conditions)>0)
	 		$this->db->where($conditions);
			else
		    $this->db->where('id', $id);
		$this->db->delete('bans');
	 }//End of deleteBan Function
	  function deleteSuspend($id=0,$conditions=array())
	 {
	    if(count($conditions)>0)
	 		$this->db->where($conditions);
			else
		    $this->db->where('id', $id);
		$this->db->delete('suspend');
	 }//End of deleteBan Function
	 // --------------------------------------------------------------------
	 /**
	 * delete user
	 *
	 * @access	private
	 * @param	array	an associative array of delete values
	 * @return	void
	 */
	 function deleteUser($id=0,$conditions=array())
	 {
	    if(count($conditions)>0)
	 		$this->db->where($conditions);
			else
		    $this->db->where('id', $id);
		$this->db->delete('users');
	 }//End of editGroup Function
	  function deleteBookmark($id=0,$conditions=array())
	 {
	    if(count($conditions)>0)
	 		$this->db->where($conditions);
			else
		    $this->db->where('id', $id);
		$this->db->delete('bookmark');
	 }//End of editGroup Function
	  function deleteFile($id=0,$conditions=array())
	 {
	    if(count($conditions)>0)
	 		$this->db->where($conditions);
			else
		    $this->db->where('id', $id);
		$this->db->delete('files');
	 }//End of editGroup Function
	  function deleteBalance($id=0,$conditions=array())
	 {
	    if(count($conditions)>0)
	 		$this->db->where($conditions);
			else
		    $this->db->where('id', $id);
		$this->db->delete('user_balance');
	 }//End of editGroup Function
	  function deleteCategory($id=0,$conditions=array())
	 {
	    if(count($conditions)>0)
	 		$this->db->where($conditions);
			else
		    $this->db->where('id', $id);
		$this->db->delete('user_categories');
	 }//End of editGroup Function
	  function deleteContact($id=0,$conditions=array())
	 {
	    if(count($conditions)>0)
	 		$this->db->where($conditions);
			else
		    $this->db->where('id', $id);
		$this->db->delete('user_contacts');
	 }//End of editGroup Function
	  function deleteUserlist($id=0,$conditions=array())
	 {
	    if(count($conditions)>0)
	 		$this->db->where($conditions);
			else
		    $this->db->where('id', $id);
		$this->db->delete('user_list');
	 }//End of editGroup Function
	 // --------------------------------------------------------------------
	/**
	 * create ban
	 *
	 * @access	public
	 * @param	string	the type of the flash message
	 * @param	string  flash message
	 * @return	string	flash message with proper style
	 */
	 function insertBan($insertData=array())
	 {
	 	$this->db->insert('bans', $this->db->escape_str($insertData));
	 }//End of createUser Function
	 // --------------------------------------------------------------------
	/**
	 *
	 * Get the favourite and blocked users list from user_list atable
	 * @access	private
	 * @return	favourite and blocked users list
	 */
	 function getNumUsersByMonth($mon,$year,$rid)
	 {
	 	$query = "SELECT count(*) as cnt FROM users WHERE role_id = $rid AND FROM_UNIXTIME(created, '%c,%Y') = '$mon,$year' ";
	  	$que = $this->db->query($query);
		$res = $que->row();
		return $res->cnt;
	 }//End of flash_message Function
	 // --------------------------------------------------------------------
	 /**
	 * select from user_list from admin
	 *
	 * @access	private
	 * @param	array	an associative array of delete values
	 * @return	void
	 */
	 function viewAdmin($conditions=array())
	 {
		if(count($conditions)>0)
	 		$this->db->where($conditions);
		$this->db->from('admins');
	 	$this->db->select('admins.id,admins.admin_name,admins.password');
		$result = $this->db->get();
		return $result->result();
	 }//End of Function
	  function viewAdminuser($conditions=array())
	 {
		if(count($conditions)>0)
	 		$this->db->where($conditions);
		$this->db->from('admins');
	 	$this->db->select('admins.id,admins.admin_name,admins.password');
		$result = $this->db->get();
		return $result;
	 }//End of Function
	 function viewAdmins($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby = array())
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
		//pr($orderby);
		//Check for Order by
		if(is_array($orderby) and count($orderby)>0)
			$this->db->order_by($orderby[0], $orderby[1]);
		$this->db->from('admins');
	 	$this->db->select('admins.id,admins.admin_name,admins.password');
		$result = $this->db->get();
		return $result->result();
	 }//End of Function
	 // --------------------------------------------------------------------
	 /**
	 * insert User details for admin
	 *
	 * @access	public
	 * @param	string	the type of the flash message
	 * @param	string  flash message
	 * @return	string	flash message with proper style
	 */
	 function addAdmin($insertData=array())
	 {
	 	$result = $this->db->insert('admins',$this->db->escape_str($insertData));
		return $result;
	 }//End of Function
	 function getAdmin($conditions=array(),$fields='')
	 {
	 	if(count($conditions)>0)
	 		$this->db->where($conditions);
		$this->db->from('admins');
		if($fields!='')
				$this->db->select($fields);
		else
	 		$this->db->select('admins.id,admins.admin_name,admins.password');
		$result = $this->db->get();
		return $result;
	 }//End of getBans Function
	 /**
	 * Update user_list for admin
	 *
	 * @access	private
	 * @param	array	an associative array of update values
	 * @return	void
	 */
	 function updateAdmin($conditions=array(),$updateData=array())
	 {
	    if(count($conditions)>0)
	 		$this->db->where($conditions);
		$result = $this->db->update('admins',$updateData);
		return $result;
	 }//End of Function
	 // --------------------------------------------------------------------
	 /**
	 * delete from user_list for admin
	 *
	 * @access	private
	 * @param	array	an associative array of delete values
	 * @return	void
	 */
	 function deleteAdmin($conditions=array())
	 {
	    if(count($conditions)>0)
	 		$this->db->where($conditions);
		$result = $this->db->delete('admins');
		return $result;
	 }//End of Function
	 // --------------------------------------------------------------------
	  function getUsersfromusername($condition='')
	{
		$query='SELECT * FROM `users` WHERE '.$condition;
		//$this->db->where($condition);
		//$this->db->select('id,email,user_name');
		//$this->db->from('users');
		$result=$this->db->query($query);
		return($result);
	}
	function addRemerberme($insertData=array(),$expire)
	{
		 $this->m_auth->setUserCookie('inputfield',$insertData['inputField'], $expire);
		 $this->m_auth->setUserCookie('pwd',$insertData['password'], $expire);
	}
	function removeRemeberme()
	{
	  $this->m_auth->clearUserCookie(array('inputfield','pwd'));
	}
	function getUsersMoreInvite($userCate,$not_in,$id_other,$limit = array()){
		$not_in = implode(",", $not_in);
		$uCate = explode(',', $userCate);
		$count = count($uCate);
		$dem = 0;
		$query = 	"SELECT users.id as uid,users.display_name,users.user_name,users.logo,user_categories.user_categories
					FROM users
					INNER JOIN user_categories ON users.id = user_categories.user_id
					WHERE (";
		foreach ($uCate as $value) {
			$dem++;
			if($dem == $count)
				$or = "";
			else
				$or = "OR";
			$query .= "FIND_IN_SET($value,user_categories.user_categories) ".$or." ";
		}
		$query .= ") AND users.role_id = 2 AND users.is_deleted = 0 AND users.id != ".$id_other;
		$query.= " AND users.id NOT IN ($not_in) ORDER BY users.user_rating desc ";
		if(is_array($limit) && count($limit) > 0){
			if(count($limit)==1)
				$query .= "LIMIT ".$limit[0];
	 			//$this->db->limit($limit[0]);
			else if(count($limit)==2)
				$query .= "LIMIT ".$limit[1].",".$limit[0];
				//$this->db->limit($limit[0],$limit[1]);
		}
		//print_r($query);exit;
		$result = $this->db->query($query);
		return $result;
	}
	function getFreelancerRecommendInvite($userCate,$user_id,$limit=array()){
		$uCate = explode(',', $userCate);
		$count = count($uCate);
		$dem = 0;
		$query = 	"SELECT users.id as uid,users.display_name,users.user_name,users.logo,user_categories.user_categories
					FROM users
					INNER JOIN user_categories ON users.id = user_categories.user_id
					WHERE (";
		foreach ($uCate as $value) {
			$dem++;
			if($dem == $count)
				$or = "";
			else
				$or = "OR";
			$query .= "FIND_IN_SET($value,user_categories.user_categories) ".$or." ";
		}
		$query .= ") AND users.role_id = 2 AND users.is_deleted = 0 AND users.id != ".$user_id." ORDER BY users.user_rating desc ";
		if(is_array($limit) && count($limit) > 0){
			if(count($limit)==1)
				$query .= "LIMIT ".$limit[0];
	 			//$this->db->limit($limit[0]);
			else if(count($limit)==2)
				$query .= "LIMIT ".$limit[1].",".$limit[0];
				//$this->db->limit($limit[0],$limit[1]);
		}
		//print_r($query);exit;
		$result = $this->db->query($query);
		return $result;
	}
	/**
	 * create user
	 *
	 * @access	public
	 * @param	string	the type of the flash message
	 * @param	string  flash message
	 * @return	string	flash message with proper style
	 */
	function getSameJob($pr_cate,$jid,$limit = array(),$conditions=array(),$fields='',$like=array(),$conditionOrCategories = '',$conditionOrCities = '',$orderby = array(), $or_like = null){
		if($conditions != '')
			 $this->db->where($conditions);
		if($pr_cate != ''){
			//echo $conditionOrCategories;die;
	 		$category_ids = explode(',',$pr_cate);
	 		foreach($category_ids as $item){
	 			$whereOr[] = 'FIND_IN_SET('.$item.', jobs.category_ids)';
	 		}
	 		if(isset($whereOr) && count($whereOr) > 0){
				$strWhereOr = implode(' OR ', $whereOr);
			}
			$where[] = '('.$strWhereOr.') and jobs.id != '.$jid.'';
	 	}
	 	if(isset($where) && count($where) > 0){
	 		$where = implode(' AND ', $where);
	 		$this->db->where($where);
	 	}
		 //Check For like statement
		 if(is_array($like) and count($like)>0)
			 $this->db->like($like);
		 if(is_array($or_like) and count($or_like)>0){
			 $strOrLike = implode ( ' OR ', $or_like );
			 $this->db->where ( '('.$strOrLike.')');
		 }
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
		 else
			 $this->db->order_by('jobs.date_created', 'DESC');
		 $this->db->from('jobs');
		 $this->db->join('job_apply', 'job_apply.job_id = jobs.id', 'left');
		 $this->db->join('users', 'users.id = jobs.user_id', 'inner');
		 $this->db->join('user_employers', 'users.id = user_employers.user_id', 'left');
		 $this->db->group_by(array('jobs.id'));
		 if($fields!='')
			 $this->db->select($fields);
		 else
			 $this->db->select('jobs.favourites,jobs.user_id,jobs.status,jobs.user_id,jobs.id,jobs.title,jobs.alias,jobs.gender,
			 	jobs.fromage, jobs.toage,jobs.year_exp, jobs.qty, jobs.salary_min,jobs.salary_max,
			 	jobs.description, jobs.date_created, jobs.category_ids,jobs.city_ids,jobs.category_ids,
			 	job_apply.date_created, users.user_name, users.display_name, job_apply.status as jastatus,
			 	user_employers.company, user_employers.address,user_employers.contact, user_employers.phone');
		 $result = $this->db->get();
		 return $result;
	}
	function getUsersByUserCategory($project_categories,$limit = array(),$type = 1){
		$pCateId = explode(',', $project_categories);
		$count = count($pCateId);
		$dem = 0;
		$query = 	"SELECT users.id,users.display_name,users.user_name,users.name,users.role_id,users.password,users.email,users.profile_desc,users.user_status,users.activation_key,users.created,users.logo,user_categories.user_categories
					FROM users
				 	INNER JOIN user_categories ON user_categories.user_id = users.id
					WHERE (";
		foreach ($pCateId as $value) {
			$dem++;
			if($dem == $count)
				$or = "";
			else
				$or = "OR";
		 	$query .= "FIND_IN_SET($value,user_categories.user_categories) ".$or." ";
		}
		$query .= ") AND users.role_id = 2";
		if(is_array($limit) && count($limit) > 0)
		{
			if(count($limit)==1)
				$query .= "LIMIT ".$limit[0];
	 			//$this->db->limit($limit[0]);
			else if(count($limit)==2)
				$query .= "LIMIT ".$limit[1].",".$limit[0];
		}
		$result = $this->db->query($query);
        if($type == 1)
		    return $result->result();
        else
            return $result;
	}// end function
	 /**
	  * Duy Thieu
	  *
	  * get category of user for job feed
	  * @param $project_categories
	  * @param array $limit
	  * @param int $type
	  * @return mixed
	  */
	 function getUserCategory($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby=array()){
		 //Check For Conditions
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
		 //Check for Order by
		 if(is_array($orderby) and count($orderby)>0)
			 $this->db->order_by($orderby[0], $orderby[1]);
		 $this->db->from('users');
		 $this->db->join('user_categories', 'user_categories.user_id = users.id', 'inner');
		 $this->db->group_by('users.id');
		 if($fields!='')
			 $this->db->select($fields);
		 else
			 $this->db->select('users.id,users.display_name,users.user_name,users.name,users.role_id,users.password,users.email,users.profile_desc,users.user_status,users.activation_key,users.created,users.logo,user_categories.user_categories');
		 $result = $this->db->get();
		 return $result;
	 }
	function getUserScore($userId){
		if (!isset($this->loggedInUser->id)) {
            $this->session->set_flashdata('flash_message', $this->common_model->flash_message('error', $this->lang->line('You must be login access to this page')));
            redirect(URL.'info');
        }
        $this->db->from("user_balance");
        $this->db->select("user_balance.amount,user_balance.id");
        $this->db->where(array("user_balance.user_id" => $userId));
        $result = $this->db->get();
        return $result->row();
	}
	function checkEmailExists($email){
		$this->db->from("users");
		$this->db->where(array("email"=>$email));
		$this->db->select("users.id");
		$result = $this->db->get();
		return $result;
	}
	function checkEmailPassIsExists($condition = array()){
		if(is_array($condition) && count($condition) > 0)
			$this->db->where($condition);
		$this->db->from("users");
		$this->db->select("users.id");
		$result = $this->db->get();
		//print_r($this->db->last_query());exit;
		return $result;
	}
	function checkPassExists($condition = array()){
		if(is_array($condition) && count($condition) > 0)
			$this->db->where($condition);
		$this->db->from("users");
		$this->db->select("users.user_name",'users.display_name');
		$result = $this->db->get();
		//print_r($this->db->last_query());exit;
		return $result;
	}
	function checkUsernameExists($username){
		$this->db->from("users");
		$this->db->where(array("user_name"=>$username));
		$this->db->select("users.id");
		$result = $this->db->get();
		return $result;
	}
	function checkUserPassword($condition = array()){
		if(is_array($condition) && count($condition) > 0)
			$this->db->where($condition);
		$this->db->select("users.id");
		$result = $this->db->get();
		return $result;
	}
	function updatePassword($condition = array(), $updateData = array())
    {
        if (is_array($condition) && count($condition) > 0)
            $this->db->where($condition);
        $this->db->update('users', $updateData);
    }
    function addUserFacebook($insertData = array()){
        return $this->db->insert('user_facebook', $this->db->escape_str($insertData));
    }
     function getUserFacebook($conditions=array(),$fields='')
     {
         if(count($conditions)>0)
             $this->db->where($conditions);
         $this->db->from('user_facebook');
         if($fields!='')
             $this->db->select($fields);
         else
             $this->db->select('user_facebook.id');
         $result = $this->db->get();
         return $result;
     }//End of getUsers Function
	function getTotalJobUserDone($condition = array()){
		if(is_array($condition) && count($condition) > 0)
			$this->db->where($condition);
		$this->db->select("jobs.id");
		$this->db->from("jobs");
		$result = $this->db->get();
		return $result->num_rows();
	}
    function getUsersRandom($conditions=array(),$fields='',$limit = array(),$orderby = array(),$where_not_in = array())
    {
         if(count($conditions)>0)
             $this->db->where($conditions);
         if(is_array($where_not_in)){
             if(count($where_not_in) > 0){
                 $this->db->where_not_in('users.id',$where_not_in);
             }
         }
         if(is_array($limit))
         {
             if(count($limit)==1)
                 $this->db->limit($limit[0]);
             else if(count($limit)==2)
                 $this->db->limit($limit[0],$limit[1]);
         }
         if(is_array($orderby) and count($orderby)>0)
             $this->db->order_by($orderby[0], $orderby[1]);
         $this->db->from('users');
         $this->db->join('roles', 'roles.id = users.role_id','left');
         $this->db->join('user_categories','user_categories.user_id = users.id','left');
         if($fields!='')
             $this->db->select($fields);
         else
             $this->db->select('users.country_id,users.id,roles.role_name,users.display_name,users.user_name,users.name,users.role_id,users.password,users.email,users.profile_desc,users.user_status,users.activation_key,users.created,users.logo,user_categories.user_categories, users.is_verify_studio');
         $result = $this->db->get();
         return $result;
    }//End of getUsers Function
    function getCountCategorybyUser($cate_id = null){
        if($cate_id != null) {
            $result = $this->db->query("SELECT user_categories.user_categories FROM `user_categories` where FIND_IN_SET({$cate_id},user_categories.user_categories)");
            return $result;
        }else{
            return false;
        }
    }
    function addWatchList($insertData = array()){
        $this->db->insert('user_watchlist',$this->db->escape_str($insertData));
    }
     function removeWatchList($conditions=array())
     {
         if(count($conditions)>0)
             $this->db->where($conditions);
         $this->db->delete('user_watchlist');
     }//End of editGroup Function
    function getWatchList($conditions = array(),$fields = array()){
        if(count($conditions)>0)
            $this->db->where($conditions);
        $this->db->from('user_watchlist');
        if(count($fields) > 0)
            $this->db->select($fields);
        else
            $this->db->select('user_watchlist.user_id,user_watchlist.dev_id');
        $result = $this->db->get();
        return $result;
    }
	function getFreelanceWatchlist($conditions = array(),$fields = array(), $limit = array(), $orderby = array()){
         if(count($conditions)>0)
             $this->db->where($conditions);
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
         }else{
             $orderby[] = 'user_watchlist.created';
             $orderby[] = 'asc';
             $this->db->order_by($orderby[0], $orderby[1]);
         }
         $this->db->from('users');
         $this->db->join('user_watchlist', 'user_watchlist.dev_id = users.id','inner');
         $this->db->join('user_categories','user_categories.user_id = users.id','left');
         $this->db->join('projects','projects.programmer_id = user_watchlist.dev_id','left');
         $this->db->join('country','country.id = users.country_id','left');
         $this->db->group_by("users.id");
         if(count($fields) > 0)
             $this->db->select($fields);
         else
             $this->db->select('users.id,users.display_name,users.user_name,  users.num_reviews,users.logo,users.profile_desc,country.country_name,user_categories.user_categories,users.title, count(projects.id) AS num_project');
         $result = $this->db->get();
         return $result;
     }
         /**
          * controller programmer,action viewMyProjects
          * @param array $conditions
          * @param string $fields
          * @param array $limit
          * @param array $orderby
          * @param null $where_or
          * @return mixed
          */
     function getUsersBids($conditions=array(),$fields='',$limit = array(),$orderby = array(), $where_or = null)
     {
         if(count($conditions)>0)
             $this->db->where($conditions);
         if(count($where_or)>0)
             $this->db->or_where($where_or);
         if(is_array($limit))
         {
             if(count($limit)==1)
                 $this->db->limit($limit[0]);
             else if(count($limit)==2)
                 $this->db->limit($limit[0],$limit[1]);
         }
         if(is_array($orderby) and count($orderby)>0)
             $this->db->order_by($orderby[0], $orderby[1]);
         $this->db->from('users');
         $this->db->join('roles', 'roles.id = users.role_id','left');
         $this->db->join('user_categories','user_categories.user_id = users.id','left');
         $this->db->join('bids','bids.user_id = users.id','left');
         $this->db->join('projects','projects.id = bids.project_id','left');
         $this->db->where(array('bids.is_deleted' => 0, 'projects.is_deleted' => 0));
         if($fields!='')
             $this->db->select($fields);
         else
             $this->db->select('users.id,roles.role_name,users.display_name,users.user_name,users.name,users.role_id,users.password,users.email,users.profile_desc,users.user_status,users.activation_key,users.created,users.logo,user_categories.user_categories, users.group_ids, count(DISTINCT bids.id) AS num_bids');
         $result = $this->db->get();
         return $result;
     }
         /**
          * @param array $conditions
          * @param array $fields
          * @return mixed
          */
         function getListUsersWorkWithProject($conditions = array(),$fields = array()){
             $this->db->distinct();
             if(count($conditions)>0)
                 $this->db->where($conditions);
             $this->db->from('projects');
             $this->db->join('users', 'users.id = projects.creator_id','left');
             if($fields!='')
                 $this->db->select($fields);
             else
                 $this->db->select('name_percent.name,name_percent.value');
             $result = $this->db->get();
             return $result;
         }
         /**
          * @param null $conditions
          * @return mixed
          */
         function getReviewUser($conditions = null){
             $query = "SELECT sum(`project_review`) / ( SELECT count(`project_review`) FROM `reviews` WHERE {$conditions} ) as `percent_project_review`,
            sum(`info_review`) / ( SELECT count(`info_review`) FROM `reviews` WHERE {$conditions} ) as `percent_info_review`,
            sum(`expertise_review`) / ( SELECT count(`expertise_review`) FROM `reviews` WHERE {$conditions} ) as `percent_expertise_review`,
            sum(`hire_review`) / ( SELECT count(`hire_review`) FROM `reviews` WHERE {$conditions} ) as `percent_hire_review`,
            sum(`professional_review`) / ( SELECT count(`professional_review`) FROM `reviews` WHERE {$conditions} ) as `percent_professional_review`,
            sum(`percent_review`) / ( SELECT count(`percent_review`) FROM `reviews` WHERE {$conditions} ) as `percent_review`,
            sum(`budget_review`) / ( SELECT count(`budget_review`) FROM `reviews` WHERE {$conditions} ) as `budget_review`,
            sum(`time_review`) / ( SELECT count(`time_review`) FROM `reviews` WHERE {$conditions} ) as `time_review`
            FROM `reviews`
            WHERE {$conditions}
   ";
             return $this->db->query($query);
         }
         /**
          * controller programmer,action viewMyProjects
          * @param array $conditions
          * @param string $fields
          * @param array $limit
          * @param array $orderby
          * @param null $where_or
          * @return mixed
          */
         function getUsersPercentComplete($conditions=array(),$fields='',$limit = array(),$orderby = array(), $where_or = null)
         {
             if(count($conditions)>0)
                 $this->db->where($conditions);
             if(count($where_or)>0)
                 $this->db->or_where($where_or);
             if(is_array($limit))
             {
                 if(count($limit)==1)
                     $this->db->limit($limit[0]);
                 else if(count($limit)==2)
                     $this->db->limit($limit[0],$limit[1]);
             }
             if(is_array($orderby) and count($orderby)>0)
                 $this->db->order_by($orderby[0], $orderby[1]);
             $this->db->from('users');
             $this->db->join('user_percent', 'users.id = user_percent.user_id','left');
             $this->db->join('name_percent','user_percent.percent_id = name_percent.id','left');
             if($fields!='')
                 $this->db->select($fields);
             else
                 $this->db->select('name_percent.name,name_percent.value');
             $result = $this->db->get();
             return $result;
         }
		 
		 function getUnsubscribe($condition=array())
		 {
			 if(count($condition)>0)
			 	$this->db->where($condition);
			 $this->db->from('unsubscribe');
			 $this->db->select('unsubscribe.id,unsubscribe.user_id,unsubscribe.reason,unsubscribe.message,unsubscribe.date_created');
			 $result = $this->db->get();
			 return $result;
		 }
		 function addUnsubscribe($insertData=array())
		 {
			 try{
				 $this->db->insert('unsubscribe', $insertData);
				 return $this->db->insert_id();
			 }catch (Exception $e){
				 throw $e;
				 return false;
			 }
		 }
		 /**
	 * Get User worker
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getUserWorker($conditions=array(),$fields='',$limit = array(),$orderby = array())
	 {
	 	if(count($conditions)>0)
	 		$this->db->where($conditions);
         if(is_array($limit))
         {
             if(count($limit)==1)
                 $this->db->limit($limit[0]);
             else if(count($limit)==2)
                 $this->db->limit($limit[0],$limit[1]);
         }
         if(is_array($orderby) and count($orderby)>0)
             $this->db->order_by($orderby[0], $orderby[1]);
         $this->db->from('users');
		$this->db->join('roles', 'roles.id = users.role_id','left');
		$this->db->join('user_worker', 'user_worker.user_id = users.id','inner');
		$this->db->group_by(array('users.id'));
	 	$this->db->select();
		$result = $this->db->get();
		return $result;
	 }//End of getUsers Function

	 function getUserSkill($user_id){
	 	$this->db->from("user_categories");
	 	$this->db->select("user_categories");
	 	$this->db->where("user_id",$user_id);
	 	$query = $this->db->get();
	 	return $query;

	 }
}
// End User_model Class
/* End of file User_model.php */
/* Location: ./app/models/User_model.php */
?>