<?php
/**
 * Reverse bidding system Skills_model Class
 *
 * Update site settings informations in database.
 *
 * @package		Reverse bidding system
 * @subpackage	Models
 * @category	Skills
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
class M_skills extends CI_Model {
   /**
	* Constructor
	*
	*/
    public $languages='';
	function __construct(){
        parent::__construct();
		$this->load->database();
		$this->load->library('session');
        if($this->session->userdata('languages')){
            if($this->session->userdata('languages') == 'vietnamese'){
                $this->languages= '';
            }
            else{
                $this->languages = '_en';
            }
        }
        else{
            if($this->config->item('language_code') == 'vietnamese'){
                $this->languages= '';
            }
            else{
                $this->languages = '_en';
            }
        }
    }

    // --------------------------------------------------------------------
    /**
     * Get Employers
     *
     * @access  private
     * @param   array   conditions to fetch data
     * @return  object  object with result set
     */
     function getEmployers($conditions=array(),$fields='',$limit=array(),$orderby=array())
     {
        //Check For Conditions
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
         //Check for Order by
         if(is_array($orderby) and count($orderby)>0)
             $this->db->order_by($orderby[0], $orderby[1]);
        $this->db->from('user_employers');
        //Check For Fields
        if($fields!='')
                $this->db->select($fields);
        else
            $this->db->select();
        $result = $this->db->get();
        return $result;
     }//End of getEmployers Function
	 // --------------------------------------------------------------------
	/**
	 * Get Categories
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getCategories($conditions=array(),$fields='', $where_in = '',$limit=array(),$orderby=array())
	 {
	 	//Check For Conditions
	 	if(count($conditions)>0)
	 		$this->db->where($conditions);
	 	if($where_in != ''){
	 		$this->db->where_in('categories.id', $where_in);
	 	}
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
		$this->db->from('categories');
		//Check For Fields
		if($fields!='')
				$this->db->select($fields);
		else
	 		$this->db->select('categories.view_search,categories.id,categories.group_id,categories.category_name,
	 			categories.description, categories.page_title, categories.meta_keywords,
	 			categories.meta_description, categories.is_active, categories.created, categories.modified');
		$result = $this->db->get();
		return $result;
	 }//End of getCategories Function
	 function getCategory($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby=array())
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
		$this->db->from('categories');
		$this->db->join('groups', 'groups.id = categories.group_id','left');
		//Check For Fields
		if($fields!='')
				$this->db->select($fields);
		else
	 		$this->db->select('categories.id,categories.group_id,categories.category_name,groups.group_name, categories.description, categories.page_title, categories.meta_keywords, categories.meta_description, categories.is_active, categories.created, categories.modified');
		$result = $this->db->get();
		return $result;
	 }//End of getCategories Function

	 // --------------------------------------------------------------------
    function getJobMatching($conditions=null,$fields='',$like=array(),$limit=array(),$orderby = array(), $or_like = array())
    {
        //Check For Conditions
        if($conditions != null)
            $this->db->where($conditions);
        //Check For like statement
        if(is_array($like) and count($like)>0)
            $this->db->like($like);
        if(is_array($or_like) and count($or_like)>0)
            $this->db->or_like($or_like);
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
        $this->db->from('jobs');
        $this->db->join('users', 'users.id = jobs.user_id','left');
//        $this->db->where('bids.user_id IS NULL AND bids.job_id IS NULL');
        $this->db->group_by(array('jobs.id'));
        //Check For Fields
        if($fields!='')
            $this->db->select($fields);
        else
            $this->db->select('jobs.id,projects.project_name,projects.project_alias,projects.group_id,projects.project_categories,projects.project_status,projects.description,projects.budget_min,projects.budget_max,projects.project_categories,projects.creator_id,projects.is_feature,projects.is_urgent,projects.is_hide_bids,projects.created,projects.attachment_name,projects.attachment_avatar,projects.attachment_url,users.display_name,users.user_name,projects.enddate,projects.programmer_id,projects.project_award_date,projects.project_award_date,projects.contact,projects.salary,projects.flag,projects.escrow_due,users.id as userid,projects.checkstamp,projects.provider_rated,projects.buyer_rated,projects.project_paid,projects.is_private,projects.private_users,projects.views,users.user_rating,users.num_reviews,users.email,projects.locations,projects.provider_rated, projects.group_ids, projects.device_ids, users.role_id');
        $result =$this->db->get();
        return $result;
    }
	/**
	 * updateUsers
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function updateUsers($id=0,$updateData=array())
	 {
	 	$this->db->where('id', $id);
	 	$this->db->update('users', $this->db->escape_str($updateData));
	 }//End of updateUsers Function

    function getJobWishlist($conditions=null,$fields='',$like=array(),$limit=array(),$orderby = array())
    {
        //Check For Conditions
        if($conditions != null)
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
        $this->db->from('jobs');
        $this->db->join('users', 'users.id = jobs.user_id','left');
        $this->db->join('job_wishlist', 'job_wishlist.job_id = jobs.id','inner');
        $this->db->group_by(array('jobs.id'));
        //Check For Fields
        if($fields!='')
            $this->db->select($fields);
        else
            $this->db->select('jobs.status,jobs.user_id,jobs.id,jobs.title,jobs.alias,jobs.gender,jobs.fromage, jobs.toage,jobs.year_exp,
								jobs.qty, jobs.salary_min,jobs.salary_max,jobs.description, jobs.date_created,
								users.user_rating,users.num_reviews,users.email');
        $result =$this->db->get();
        return $result;
    }

	function getMyFavourites($conditions=null,$fields='',$limit=array(),$orderby = array(),$in = array()){
         if($conditions != null)
             $this->db->where($conditions);
         if(!empty($in) && count($in) > 0) {
             $this->db->where_in('jobs.id',$in);
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
             $this->db->order_by('jobs.id','desc');
         $this->db->from('jobs');
         $this->db->join('users', 'users.id = jobs.user_id','left');
		 $this->db->join('user_employers', 'users.id = user_employers.user_id', 'left');
         //Check For Fields
         if($fields!='')
             $this->db->select($fields);
         else
             $this->db->select('jobs.id,jobs.title,jobs.status,jobs.alias,jobs.views,
             	users.user_name,users.display_name,jobs.date_created,jobs.status as jastatus,
             	user_employers.company, user_employers.address,user_employers.contact, user_employers.phone');
         $result =$this->db->get();
         return $result;
     }

     function getArticles($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby = array(), $or_like = null)
	 {
		if($conditions != '')
			 $this->db->where($conditions);
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
			 $this->db->order_by('pt_articles.created_articles', 'DESC');
		 $this->db->from('pt_articles');
		 $this->db->join('pt_articles_categories', 'pt_articles.catid = pt_articles_categories.idArticlesCategories', 'left');
		 $this->db->group_by(array('pt_articles.idArticles'));

		 if($fields!='')
			 $this->db->select($fields);
		 else
			 $this->db->select("pt_articles_categories.*,pt_articles.*, name_articles_categories, name".$this->languages."_articles_categories as name_articles_categories,
            
            alias_articles_categories, alias".$this->languages."_articles_categories as alias_articles_categories,

            title_articles, title".$this->languages."_articles as title_articles,
            
            alias_articles, alias".$this->languages."_articles as alias_articles");

		 $result = $this->db->get();
		 return $result;
	 }

     function getArticlesCategories($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby = array(), $or_like = null, $where_or= null)
     {
        if($conditions != '')
             $this->db->where($conditions);
         if(count($where_or)>0)
             $this->db->or_where($where_or);
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
         $this->db->from('pt_articles_categories');
         $this->db->group_by(array('pt_articles_categories.idArticlesCategories'));

         if($fields!='')
             $this->db->select($fields);
         else
             $this->db->select("*, name_articles_categories, name".$this->languages."_articles_categories as name_articles_categories,
            
            alias_articles_categories, alias".$this->languages."_articles_categories as alias_articles_categories");

         $result = $this->db->get();
         return $result;
     }

     function addResumeAlert($insertData=array())
     {
         try{
             $this->db->insert('user_employers_resume_alert', $insertData);
             return $this->db->insert_id();
         }catch (Exception $e){
             throw $e;
             return false;
         }
     }

     /**
     * Get Categories
     *
     * @access  private
     * @param   array   conditions to fetch data
     * @return  object  object with result set
     */
     function getResumeAlert($conditions=array(),$fields='', $where_in = '',$limit=array(),$orderby=array())
     {
        //Check For Conditions
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
         //Check for Order by
         if(is_array($orderby) and count($orderby)>0)
             $this->db->order_by($orderby[0], $orderby[1]);
        $this->db->from('user_employers_resume_alert');
        //Check For Fields
        if($fields!='')
                $this->db->select($fields);
        else
            $this->db->select();
        $result = $this->db->get();
        return $result;
     }//End of getCategories Function

     function updateResumeAlerts($id=0,$updateData=array())
     {
        $this->db->where('id', $id);
        $this->db->update('user_employers_resume_alert', $this->db->escape_str($updateData));
     }//End of updateUsers Function
}
// End Skills_model Class
/* End of file Skills_model.php */
/* Location: ./app/models/Skills_model.php */
?>
