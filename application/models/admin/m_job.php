<?php
/**
 * Reverse bidding system User_model Class
 *
 * helps to achieve common tasks related to the site like flash message formats,pagination variables.
 *
 * @package		Reverse bidding system
 * @subpackage	Models
 * @category	Common_model 
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
	 class M_job extends M_application_admin {
	 
	/**
	 * Constructor 
	 *
	 */
	  function __construct()
	  {
		  parent::__construct();
	  }

	  function getUsers($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby = array())
	  {
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
		  //pr($orderby);
		  //Check for Order by
		  if(is_array($orderby) and count($orderby)>0)
			  $this->db->order_by($orderby[0], $orderby[1]);


		  $this->db->from('users');

		  if($fields!='')
			  $this->db->select($fields);
		  else
			  $this->db->select('users.id,users.full_name,users.email,users.phone,users.status, users.date_created');

		  $result = $this->db->get();
		  return $result;
	  }

	 function getJobs($conditions=array(),$fields='',$like=array(),$limit=array(),$conditionOrCategories = '',$conditionOrCities = '',$orderby = array(), $or_like = null, $stringEmployers = '',$where_not_in=array())
	 {
		if($conditions != '')
			 $this->db->where($conditions);

		if($stringEmployers != '' && $stringEmployers != 0){

			//echo $conditionOrCategories;die;
	 		$employer_ids = explode(',',$stringEmployers);
	 		foreach($employer_ids as $item){
	 			$whereOr[] = 'FIND_IN_SET('.$item.', jobs.user_id)';
	 		}
	 		//var_dump($whereOr);die;
	 		if(isset($whereOr) && count($whereOr) > 0){
				$strWhereOr = implode(' OR ', $whereOr);
			}
			$where[] = '('.$strWhereOr.')';
	 	}
		if($conditionOrCategories != ''){

			//echo $conditionOrCategories;die;
	 		$category_ids = explode(',',$conditionOrCategories);
	 		foreach($category_ids as $item){
	 			$whereOr[] = 'FIND_IN_SET('.$item.', jobs.category_ids)';
	 		}
	 		//var_dump($whereOr);die;
	 		if(isset($whereOr) && count($whereOr) > 0){
				$strWhereOr = implode(' OR ', $whereOr);
			}
			$where[] = '('.$strWhereOr.')'; 
	 	}
	 	if($conditionOrCities != ''){
	 		$city_ids = explode(',',$conditionOrCities);
	 		foreach($city_ids as $item){
	 			$whereOrCities[] = 'FIND_IN_SET('.$item.', jobs.city_ids)';
	 		}
	 		if(isset($whereOrCities) && count($whereOrCities) > 0){
				$strWhereOr = implode(' AND ', $whereOrCities);
			}
			$where[] = '('.$strWhereOr.')'; 
	 	}
	 	//var_dump($where);
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

		if(is_array($where_not_in) and count($where_not_in)>0)
			 $this->db->where_not_in('jobs.id',$where_not_in);
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
			 	jobs.description, jobs.date_created, jobs.category_ids,jobs.city_ids,jobs.category_ids,jobs.views,
			 	job_apply.date_created, users.user_name, users.display_name, job_apply.status as jastatus,
			 	user_employers.company, user_employers.address,user_employers.contact, user_employers.phone');

		 $result = $this->db->get();
		 return $result;
	 }


	 function getJobsApply($conditions=array(),$fields='',$like=array(),$limit=array(),$conditionOrCategories = '',$conditionOrCities = '',$orderby = array(), $or_like = null)
	 {
		if($conditions != '')
			 $this->db->where($conditions);
		if($conditionOrCategories != ''){
			//echo $conditionOrCategories;die;
	 		$category_ids = explode(',',$conditionOrCategories);
	 		foreach($category_ids as $item){
	 			$whereOr[] = 'FIND_IN_SET('.$item.', jobs.category_ids)';
	 		}
	 		if(isset($whereOr) && count($whereOr) > 0){
				$strWhereOr = implode(' OR ', $whereOr);
			}
			$where[] = '('.$strWhereOr.')'; 
	 	}
	 	if($conditionOrCities != ''){
	 		$city_ids = explode(',',$conditionOrCities);
	 		foreach($city_ids as $item){
	 			$whereOr[] = 'FIND_IN_SET('.$item.', jobs.city_ids)';
	 		}
	 		if(isset($whereOr) && count($whereOr) > 0){
				$strWhereOr = implode(' OR ', $whereOr);
			}
			$where[] = '('.$strWhereOr.')'; 
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
		 $this->db->join('job_apply', 'job_apply.job_id = jobs.id', 'inner');
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
			 	users.user_name, users.display_name, user_employers.company, user_employers.address,user_employers.contact, user_employers.phone');

		 $result = $this->db->get();
		 return $result;
	 }


	 function getJobsHot($conditions=array(),$fields='',$like=array(),$limit=array(),$conditionOrCategories = '',$conditionOrCities = '',$orderby = array(), $or_like = null)
	 {
		if($conditions != '')
			 $this->db->where($conditions);
		if($conditionOrCategories != ''){
			//echo $conditionOrCategories;die;
	 		$category_ids = explode(',',$conditionOrCategories);
	 		foreach($category_ids as $item){
	 			$whereOr[] = 'FIND_IN_SET('.$item.', jobs.category_ids)';
	 		}
	 		if(isset($whereOr) && count($whereOr) > 0){
				$strWhereOr = implode(' OR ', $whereOr);
			}
			$where[] = '('.$strWhereOr.')'; 
	 	}
	 	if($conditionOrCities != ''){
	 		$city_ids = explode(',',$conditionOrCities);
	 		foreach($city_ids as $item){
	 			$whereOr[] = 'FIND_IN_SET('.$item.', jobs.city_ids)';
	 		}
	 		if(isset($whereOr) && count($whereOr) > 0){
				$strWhereOr = implode(' OR ', $whereOr);
			}
			$where[] = '('.$strWhereOr.')'; 
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
		 $this->db->join('job_service_extension', 'job_service_extension.job_id = jobs.id', 'inner');
		 $this->db->join('users', 'users.id = jobs.user_id', 'inner');
         $this->db->join('user_employers', 'users.id = user_employers.user_id', 'left');
		 $this->db->group_by(array('jobs.id'));

		 if($fields!='')
			 $this->db->select($fields);
		 else
			 $this->db->select('job_service_extension.expired_at,jobs.favourites,jobs.user_id,jobs.status,jobs.user_id,jobs.id,jobs.title,jobs.alias,jobs.gender,
			 	jobs.fromage, jobs.toage,jobs.year_exp, jobs.qty, jobs.salary_min,jobs.salary_max,
			 	jobs.description, jobs.date_created, jobs.category_ids,jobs.city_ids,jobs.category_ids, users.user_name, users.display_name,
			 	user_employers.company, user_employers.address,user_employers.contact, user_employers.phone');

		 $result = $this->db->get();
		 return $result;
	 }

     function sameToJobs($conditions=array(),$fields='',$like=array(),$limit=array(),$conditionOrCategories = '',$conditionOrCities = '',$orderby = array(), $or_like = null)
     {
         if($conditions != '')
             $this->db->where($conditions);
         if($conditionOrCategories != ''){
             //echo $conditionOrCategories;die;
             $category_ids = explode(',',$conditionOrCategories);
             foreach($category_ids as $item){
                 $whereOr[] = 'FIND_IN_SET('.$item.', jobs.category_ids)';
             }
             if(isset($whereOr) && count($whereOr) > 0){
                 $strWhereOr = implode(' OR ', $whereOr);
             }
             $where[] = '('.$strWhereOr.')';
         }
         if($conditionOrCities != ''){
             $city_ids = explode(',',$conditionOrCities);
             foreach($city_ids as $item){
                 $whereOr[] = 'FIND_IN_SET('.$item.', jobs.city_ids)';
             }
             if(isset($whereOr) && count($whereOr) > 0){
                 $strWhereOr = implode(' OR ', $whereOr);
             }
             $where[] = '('.$strWhereOr.')';
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
         $this->db->join('users', 'users.id = jobs.user_id', 'inner');
         $this->db->group_by(array('jobs.id'));

         if($fields!='')
             $this->db->select($fields);
         else
             $this->db->select('jobs.status,jobs.user_id,jobs.id,jobs.title,jobs.alias,jobs.gender,
            jobs.fromage, jobs.toage,jobs.year_exp, jobs.qty, jobs.salary_min,jobs.salary_max,
            jobs.description, jobs.date_created, jobs.category_ids,jobs.city_ids,jobs.category_ids');

         $result = $this->db->get();
         return $result;
     }

	 function getApply($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby = array())
	 {
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
		 //pr($orderby);
		 //Check for Order by
		 if(is_array($orderby) and count($orderby)>0)
			 $this->db->order_by($orderby[0], $orderby[1]);


		 $this->db->from('job_apply');

		 if($fields!='')
			 $this->db->select($fields);
		 else
			 $this->db->select('job_apply.id,job_apply.worker_id,job_apply.job_id,
			 	job_apply.date_created');

		 $result = $this->db->get();
		 return $result;
	 }

	 function getPackages($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby = array())
	 {
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
		 //pr($orderby);
		 //Check for Order by
		 if(is_array($orderby) and count($orderby)>0)
			 $this->db->order_by($orderby[0], $orderby[1]);


		 $this->db->from('job_packages');

		 if($fields!='')
			 $this->db->select($fields);
		 else
			 $this->db->select('job_packages.id,job_packages.package_name,job_packages.fee,job_packages.total_item,job_packages.description,job_packages.date_created');

		 $result = $this->db->get();
		 return $result;
	 }

	 function getWorkerReferral($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby = array())
	 {
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
		 //pr($orderby);
		 //Check for Order by
		 if(is_array($orderby) and count($orderby)>0)
			 $this->db->order_by($orderby[0], $orderby[1]);


		 $this->db->from('worker_referral');
		 $this->db->join('job_referral', 'job_referral.worker_id = worker_referral.id', 'inner');
		 $this->db->group_by(array('worker_referral.id'));

		 if($fields!='')
			 $this->db->select($fields);
		 else
			 $this->db->select('worker_referral.id,worker_referral.fullname,worker_referral.email,worker_referral.phone,job_referral.date_created');

		 $result = $this->db->get();
		 return $result;
	 }

	 function addUser($insertData=array())
	 {
		 try{
			 $this->db->insert('users', $insertData);
			 return $this->db->insert_id();
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }
	 }

	 function updateUser($condition='', $updateData=array())
	 {
		 try{
			 if($condition != ''){
				 $this->db->where($condition);
			 }
			 return $this->db->update('users', $updateData);
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

	 function addApply($insertData=array())
	 {
		 try{
			 $this->db->insert('job_apply', $insertData);
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

	 function addjobReferral($insertData=array())
	 {
		 try{
			 $this->db->insert('job_referral', $insertData);
			 return $this->db->insert_id();
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }
	 }

	 function setUserSession($row=NULL)
	 {
		 switch($row->role_id)
		 {
			 case '1':
				 $values = array('aff_user_id'=>$row->id,'role_id'=>$row->role_id,'role'=>'customer');
				 $this->session->set_userdata($values);
				 break;
			 case '2':
				 $values = array('aff_user_id'=>$row->id,'role_id'=>$row->role_id,'role'=>'employer');
				 $this->session->set_userdata($values);
				 break;
			 case '3':
				 $values = array('aff_user_id'=>$row->id,'role_id'=>$row->role_id,'role'=>'developer');
				 $this->session->set_userdata($values);
				 break;
		 }

	 }

	 function clearUserSession()
	 {
		 $array_items = array('aff_user_id' => '','role_id'=>'','role'=>'');

		 $this->session->unset_userdata($array_items);
		 //$this->session->sess_destroy();
		 //session_destroy();

	 }

	 function addTransaction($insertData=array())
	 {
		 try{
			 $this->db->insert('job_transactions', $insertData);
			 return $this->db->insert_id();
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }
	 }

	 function addTransactionResponse($insertData=array())
	 {
		 try{
			 $this->db->insert('job_transaction_responses', $insertData);
			 return $this->db->insert_id();
		 }catch (Exception $e){
			 throw $e;
			 return false;
		 }

	 }
	 /*Start developer Huynh An*/

	 /**
	 * delete deleteJobsApply
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function deleteJobsApply($id=0,$conditions=array())
	 {
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
		else	
		    $this->db->where('id', $id);
	 	$this->db->delete('job_apply');
		 
	 }//End of deleteProjects Function


	 function getServiceExtension($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby = array())
	 {
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
		 //pr($orderby);
		 //Check for Order by
		 if(is_array($orderby) and count($orderby)>0)
			 $this->db->order_by($orderby[0], $orderby[1]);


		 $this->db->from('job_service_extension');
		 $this->db->join('jobs', 'job_service_extension.job_id = jobs.id', 'inner');

		 if($fields!='')
			 $this->db->select($fields);
		 else
			 $this->db->select();

		 $result = $this->db->get();
		 return $result;
	 }
	 /*End developer Huynh An*/
}


// End User_model Class
   
/* End of file User_model.php */ 
/* Location: ./app/models/User_model.php */
?>