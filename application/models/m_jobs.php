<?php 

	 class M_jobs extends CI_Model {
	 
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
	 function getPackage($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby=array())
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
			
		$this->db->from('job_packages');

		//Check For Fields
		if($fields!='')
			$this->db->select($fields);
		else
			$this->db->select('job_packages.id,job_packages.package_name,job_packages.description,job_packages.status,job_packages.date_created');


	 	$result = $this->db->get();
		return $result;
		
	 }//End of getUsers Function

	 function getServices($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby=array())
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

		 $this->db->from('job_services');

		 //Check For Fields
		 if($fields!='')
			 $this->db->select($fields);
		 else
			 $this->db->select('job_services.id,job_services.title,job_services.price,job_services.items,job_services.description,job_services.type,job_services.status,job_services.date_created');

		 $result = $this->db->get();
		 return $result;

	 }

	 function getServiceExtensions($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby=array())
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

		 $this->db->from('job_services');
		 $this->db->join('job_service_extension', 'job_service_extension.service_id = job_services.id', 'inner');
		 $this->db->group_by('job_services.id');

		 //Check For Fields
		 if($fields!='')
			 $this->db->select($fields);
		 else
			 $this->db->select('job_services.id,job_services.title,job_services.price,job_services.items,job_services.description,job_services.type,job_services.status,job_service_extension.created_at, job_service_extension.expired_at');

		 $result = $this->db->get();
		 return $result;

	 }

	 function getServiceInvoices($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby=array())
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

		 $this->db->from('job_services');
		 $this->db->join('invoice_details', 'invoice_details.job_service_id = job_services.id', 'left');
		 $this->db->group_by('job_services.id');

		 //Check For Fields
		 if($fields!='')
			 $this->db->select($fields);
		 else
			 $this->db->select('job_services.id,job_services.title,job_services.price,job_services.items,job_services.description,job_services.type,job_services.status,job_services.date_created, invoice_details.expired_at, invoice_details.id as invoice_id');

		 $result = $this->db->get();
		 return $result;

	 }

	 function getCategories($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby=array(), $or_like='')
	 {
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

		 $this->db->from('categories');

		 //Check For Fields
		 if($fields!='')
			 $this->db->select($fields);
		 else
			 $this->db->select('categories.id,categories.category_name');

		 $result = $this->db->get();
		 return $result;

	 }

	 function getJobs($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby=array())
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

		 $this->db->from('jobs');
		 $this->db->join('job_apply', 'job_apply.job_id = jobs.id', 'left');
		 $this->db->group_by('jobs.id');

		 //Check For Fields
		 if($fields!='')
			 $this->db->select($fields);
		 else
			 $this->db->select('jobs.hide_infomation,jobs.address_contact,jobs.name_contact, jobs.email_contact, jobs.phone_contact, jobs.submission, jobs.type_contact, jobs.language_contact,jobs.experience_skill,jobs.education_id,jobs.country_id,jobs.gender,jobs.toage,jobs.fromage,jobs.level_id,jobs.type_id,count(job_apply.id) as cid, jobs.id, jobs.title, jobs.alias, jobs.user_id, jobs.city_ids, jobs.category_ids, jobs.year_exp, jobs.qty, jobs.salary, jobs.salary_min, jobs.salary_max, jobs.description, jobs.status, jobs.views, jobs.date_expiration, jobs.date_created, jobs.update_at, COUNT(job_apply.id) AS num_apply');

		 $result = $this->db->get();
		 return $result;
	 }

	 function geInvoices($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby=array())
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

		 $this->db->from('invoices');

		 //Check For Fields
		 if($fields!='')
			 $this->db->select($fields);
		 else
			 $this->db->select('invoices.id,invoices.user_id, invoices.total, invoices.status, invoices.payment_id, invoices.update_at');

		 $result = $this->db->get();
		 return $result;

	 }

	 function getDetailInvoices($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby=array())
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

		 $this->db->from('invoice_details');
		 $this->db->join('invoices', 'invoices.id = invoice_details.invoice_id', 'inner');
		 $this->db->join('job_services', 'job_services.id = invoice_details.job_service_id', 'inner');
		 $this->db->group_by('invoice_details.id');

		 //Check For Fields
		 if($fields!='')
			 $this->db->select($fields);
		 else
			 $this->db->select('invoice_details.id,invoice_details.job_service_id, invoice_details.countdown, invoice_details.quantity, invoice_details.price, invoice_details.fee, invoice_details.expired_at,invoice_details.created_at, invoice_details.update_at, job_services.title');

		 $result = $this->db->get();
		 return $result;

	 }

	 function getInvoiceCountdown($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby=array())
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

		 $this->db->from('invoice_details');
		 $this->db->join('invoices', 'invoices.id = invoice_details.invoice_id', 'inner');
		 $this->db->join('job_services', 'job_services.id = invoice_details.job_service_id', 'inner');
		 $this->db->join('user_countdown', 'user_countdown.job_service_id = job_services.id', 'inner');
		 $this->db->group_by('invoice_details.job_service_id');

		 //Check For Fields
		 if($fields!='')
			 $this->db->select($fields);
		 else
			 $this->db->select('invoice_details.id,user_countdown.job_service_id, invoices.user_id, user_countdown.countdown, user_countdown.expired_at, user_countdown.update_at, job_services.title');

		 $result = $this->db->get();
		 return $result;

	 }

	 function getUserCountdown($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby=array())
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

		 $this->db->from('invoices');
		 $this->db->join('invoice_details', 'invoice_details.invoice_id = invoices.id', 'inner');
		 $this->db->group_by('invoice_details.id');

		 //Check For Fields
		 if($fields!='')
			 $this->db->select($fields);
		 else
			 $this->db->select('invoice_details.id, invoice_details.quantity, invoice_details.price, invoice_details.fee, invoice_details.countdown');

		 $result = $this->db->get();
		 return $result;

	 }

	 function getUserResumes($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby=array(), $or_like = array(), $or_where= '',$conditionOrCategories = '',$conditionOrCities = '')
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

		 $strOrWhere = '';
		 if(is_array($or_where) and count($or_where)>0){
			 $strOrWhere = implode ( ' OR ', $or_where );
		 }

		 if(is_array($or_like) and count($or_like)>0){
			 if($strOrWhere != ''){
				$strOrWhere .= ' OR '.implode ( ' OR ', $or_like );
			 }else{
				 $strOrWhere .= implode ( ' OR ', $or_like );
			 }

		 }

		 if($strOrWhere != '') {
			 $this->db->where('(' . $strOrWhere . ')');
		 }

		 if($conditionOrCategories != ''){
	 		$category_ids = explode('-',$conditionOrCategories);
	 		foreach($category_ids as $item){
	 			$whereOr[] = 'FIND_IN_SET('.$item.', resume.expectedPosition)';
	 		}
	 		//var_dump($whereOr);die;
	 		if(isset($whereOr) && count($whereOr) > 0){
				$strWhereOr = implode(' OR ', $whereOr);
			}
			$where[] = '('.$strWhereOr.')'; 
	 	}
	 	if($conditionOrCities != ''){
	 		$city_ids = explode('-',$conditionOrCities);
	 		foreach($city_ids as $item){
	 			$whereOrCities[] = 'FIND_IN_SET('.$item.', resume.city)';
	 		}
	 		if(isset($whereOrCities) && count($whereOrCities) > 0){
				$strWhereOr = implode(' OR ', $whereOrCities);
			}
			$where[] = '('.$strWhereOr.')'; 
	 	}
	 	//var_dump($where);
	 	if(isset($where) && count($where) > 0){
	 		$where = implode(' AND ', $where);
	 		$this->db->where($where);
	 	}
		 //Check for Order by
		 if(is_array($orderby) and count($orderby)>0)
			 $this->db->order_by($orderby[0], $orderby[1]);

		 $this->db->from('users');
		 $this->db->join('resume', 'resume.user_id = users.id', 'inner');
		 $this->db->join('resume_languages', 'resume_languages.resume_id = resume.id', 'left');
		 $this->db->group_by('users.id');

		 //Check For Fields
		 if($fields!='')
			 $this->db->select($fields);
		 else
			 $this->db->select('users.*,resume.*,resume_languages.*, resume.id as rid, resume.date_created as rdate_created');

		 $result = $this->db->get();
		 return $result;

	 }

	 function getUserMessagesDefault($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby=array(), $or_like = array(), $or_where= '',$conditionOrCategories = '',$conditionOrCities = '')
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

		 $strOrWhere = '';
		 if(is_array($or_where) and count($or_where)>0){
			 $strOrWhere = implode ( ' OR ', $or_where );
		 }

		 if(is_array($or_like) and count($or_like)>0){
			 if($strOrWhere != ''){
				$strOrWhere .= ' OR '.implode ( ' OR ', $or_like );
			 }else{
				 $strOrWhere .= implode ( ' OR ', $or_like );
			 }

		 }

		 if($strOrWhere != '') {
			 $this->db->where('(' . $strOrWhere . ')');
		 }

		 if($conditionOrCategories != ''){
	 		$category_ids = explode('-',$conditionOrCategories);
	 		foreach($category_ids as $item){
	 			$whereOr[] = 'FIND_IN_SET('.$item.', resume.expectedPosition)';
	 		}
	 		//var_dump($whereOr);die;
	 		if(isset($whereOr) && count($whereOr) > 0){
				$strWhereOr = implode(' OR ', $whereOr);
			}
			$where[] = '('.$strWhereOr.')'; 
	 	}
	 	if($conditionOrCities != ''){
	 		$city_ids = explode('-',$conditionOrCities);
	 		foreach($city_ids as $item){
	 			$whereOrCities[] = 'FIND_IN_SET('.$item.', resume.city)';
	 		}
	 		if(isset($whereOrCities) && count($whereOrCities) > 0){
				$strWhereOr = implode(' OR ', $whereOrCities);
			}
			$where[] = '('.$strWhereOr.')'; 
	 	}
	 	//var_dump($where);
	 	if(isset($where) && count($where) > 0){
	 		$where = implode(' AND ', $where);
	 		$this->db->where($where);
	 	}
		 //Check for Order by
		 if(is_array($orderby) and count($orderby)>0)
			 $this->db->order_by($orderby[0], $orderby[1]);

		 $this->db->from('users');
		 $this->db->join('user_message_default', 'user_message_default.user_id = users.id', 'inner');
		 $this->db->group_by('user_message_default.id');

		 //Check For Fields
		 if($fields!='')
			 $this->db->select($fields);
		 else
			 $this->db->select('users.*, user_message_default.*, user_message_default.id as mid');

		 $result = $this->db->get();
		 return $result;

	 }

	 function getUserApplies($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby=array(), $or_like = array())
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
		 $this->db->join('resume_languages', 'resume_languages.resume_id = resume.id', 'left');
		 $this->db->join('job_apply', 'job_apply.worker_id = users.id', 'inner');
		 $this->db->join('jobs', 'jobs.id = job_apply.job_id', 'inner');
		 $this->db->group_by('users.id');

		 //Check For Fields
		 if($fields!='')
			 $this->db->select($fields);
		 else
			 $this->db->select('job_apply.id as jaid,job_apply.worker_id,job_apply.job_id, job_apply.status as jstatus, users.*,resume.*, jobs.title as jtitle,resume_languages.*, resume.id as rid, resume.date_created as rdate_created');

		 $result = $this->db->get();
		 return $result;

	 }

	 function getUserEmployers($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby=array(), $or_like = array())
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
		 $this->db->join('user_employers', 'user_employers.user_id = users.id', 'left');
		 $this->db->group_by('users.id');

		 //Check For Fields
		 if($fields!='')
			 $this->db->select($fields);
		 else
			 $this->db->select();

		 $result = $this->db->get();
		 return $result;

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

	 function addMessagesDefault($insertData=array())
	 {
		 try{
			 $this->db->insert('user_message_default', $insertData);
			 return $this->db->insert_id();
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }
	 }

	 function addSendResumeAlert($insertData=array())
	 {
		 try{
			 $this->db->insert('send_resume_alert', $insertData);
			 return $this->db->insert_id();
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }
	 }

	 function updateJob($condition='', $updateData=array())
	 {
		 try{
			 if($condition != ''){
				 $this->db->where($condition);
			 }
			 return $this->db->update('jobs', $updateData);
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }
	 }

	 function updateApply($condition='', $updateData=array())
	 {
		 try{
			 if($condition != ''){
				 $this->db->where($condition);
			 }
			 return $this->db->update('job_apply', $updateData);
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }
	 }

	 function updateMessagesDefault($condition='', $updateData=array())
	 {
		 try{
			 if($condition != ''){
				 $this->db->where($condition);
			 }
			 return $this->db->update('user_message_default', $updateData);
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }
	 }

	 function deleteMessagesDefault($id=0,$conditions=array())
	 {
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
		else	
		    $this->db->where('id', $id);
	 	$this->db->delete('user_message_default');
		 
	 }//End of deleteProjects Function

	 function addUserCountdown($insertData=array())
	 {
		 try{
			 $this->db->insert('user_countdown', $insertData);
			 return $this->db->insert_id();
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }
	 }

	 function updateUserCountdown($condition='', $updateData=array())
	 {
		 try{
			 if($condition != ''){
				 $this->db->where($condition);
			 }
			 return $this->db->update('user_countdown', $updateData);
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }
	 }

	 function updateDetailInvoice($condition='', $updateData=array())
	 {
		 try{
			 if($condition != ''){
				 $this->db->where($condition);
			 }
			 return $this->db->update('invoice_details', $updateData);
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }
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
	 function addEmployerFiles($insertData=array())
	 {
		 try{
			 $this->db->insert('employer_files', $insertData);
			 return $this->db->insert_id();
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }
	 }

	 function updateEmployer($condition='', $updateData=array())
	 {
		 try{
			 if($condition != ''){
				 $this->db->where($condition);
			 }
			 return $this->db->update('user_employers', $updateData);
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }
	 }

	 function addJobServiceExtension($insertData=array())
	 {
		 try{
			 $this->db->insert('job_service_extension', $insertData);
			 return $this->db->insert_id();
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }
	 }

	 function deleteJobs($condition='', $updateData=array())
	 {
		 try{
			 if($condition != ''){
				 $this->db->where($condition);
			 }
			 return $this->db->update('user_employers', $updateData);
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }
	 }
}
// End Admin_roles_model Class
   
/* End of file Admin_roles_model.php */ 
/* Location: ./app/models/Admin_roles_model.php */