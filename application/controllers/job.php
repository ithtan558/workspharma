<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION))@session_start();
require_once(APPPATH . 'controllers/application.php');
class Job extends Application{
    /**
     * Constructor
     *
     * Loads language files and models needed for this controller
     */
    public function __construct(){
        parent::__construct();
        //Manage site Status
        if ($this->my_config->item('site_status') == 1)
            redirect(URL.'offline');
        $this->load->model('m_cities');
        $this->load->model('m_district');
        $this->load->model('m_resume_language');
        $this->load->model('m_resume_experience');
        $this->load->model('m_resume_education');
        $this->load->model('m_common');
        $this->load->model('m_job');
        $this->load->model('m_jobs');
        $this->load->model('m_employer_files');
        $this->load->model('m_resume');
        $this->load->model('m_user');
        $this->load->library('encrypt');
        //load all skills
        $condition_categories=array('categories.is_active'=>1);
        $order=array('id','ASC');
        $getCategories = $this->m_application->getCategories($condition_categories,NULL,NULL,NULL,$order);
        $this->_data['getCategories'] = $getCategories;
        $this->_data['idChild'] = 0;
        //load all location
        $getCities = $this->m_cities->getCities();
        $this->_data['getCities'] = $getCities;
        //load all $getCategoriesPopular
        $conditions=array('categories.is_active'=>1,'categories.is_active'=>1);
        $order=array('categories.view_search','DESC');
        $limit=array(6);
        $getCategoriesPopular = $this->m_application->getCategories($conditions,NULL,NULL,$limit,$order);
        $this->_data['getCategoriesPopular'] = $getCategoriesPopular;
        //load all exp
        $this->_data['default_exp'] = $this->my_config->item('default_exp');
        $this->lang->load('enduser/common', $this->my_config->item('language_code'));
    } //Controller End
    // --------------------------------------------------------------------
    function detailJobs($job_id){
        $this->load->helper('encrypt');
        $this->load->library('encrypt');
        $this->_data['default_skill_invoice'] = $this->my_config->item('default_skill_invoice');
        $params = get_params();
        $this->_data['params'] = $params;
        $condition_temp = array(
            'jobs.id' => $job_id
        );
        $jobs_temp = $this->m_job->getJobs($condition_temp);
        $condition = array(
            'jobs.id' => $job_id
        );
        if(!$this->session->userdata('__gidAdmin__')){
            $condition['jobs.status']=1;
        }
        $condition['jobs.is_deleted'] = 0;
        $jobs = $this->m_job->getJobs($condition);
        $this->_data['job_id'] = $job_id;
        if($jobs->num_rows() > 0){
            //check da apply job nay hay chua
            if($this->session->userdata('user_id')){
                $users_id = $this->session->userdata('user_id');
                $conditionsApply=array('job_apply.worker_id'=>$users_id,'job_apply.job_id'=>$job_id);
                $getApply=$this->m_job->getApply($conditionsApply);
                if($getApply->num_rows() > 0){
                    $this->_data['getApply']=$getApply;
                }
            }
            $this->_data['jobs'] = $jobs->row();
            $creatorInfo = getUserInfo($this->_data['jobs']->user_id);
            $this->_data['creatorInfo'] = $creatorInfo;
            $limit=array(5,0);
            $condition=array('jobs.user_id'=>$this->_data['jobs']->user_id,'jobs.id !='=>$job_id,'jobs.status'=>1, 'jobs.is_deleted' => 0);
            $this->_data['sameToJobs']=$this->m_job->sameToJobs($condition,null,null,$limit);
            //get all file of employer
            $this->_data['files'] = $this->m_employer_files->getFiles(array('user_id' => $this->_data['jobs']->user_id));
            $condition_same_jobs=array('jobs.status'=>1, 'jobs.is_deleted' => 0);
            $limit = array(4,0);
            $same_pr = $this->m_user->getSameJob($this->_data['jobs']->category_ids,$job_id,$limit,$condition_same_jobs);
            if($same_pr->num_rows() > 0){
                $this->_data['same_jobs'] = $same_pr;
            }
            //list worker available
            if ($this->lang->line('user_id')) {
                $conditions_jobs=array('jobs.user_id'=>$user_id,'jobs.id'=>$job_id);
                $getJobs=$this->m_job->getJobs($conditions_jobs);
                if($getJobs->num_rows()>0){
                    //check expired_at of services
                    $condition_job_service_extension=array('job_service_extension.job_id'=>$job_id,'job_service_extension.service_id'=>6);
                    $getServiceExtension=$this->m_job->getServiceExtension($condition_job_service_extension);
                    if($getServiceExtension->num_rows()>0) {
                        if (strtotime($getServiceExtension->row()->expired_at) >= time()) {
                            $conditions_users = array('users.is_available' => 1);
                            $order_user = array('users.id','random');
                            $limit_user = array('8');
                            $getUsers = $this->m_user->getUsers($conditions_users,NULL,$limit_user,$order_user,NULL,$this->_data['jobs']->category_ids);
                            //resume
                            if($getUsers->num_rows()>0){
                                $this->_data['getUsers']=$getUsers;
                                //list job_invitation
                                $jobInvitation=$this->m_user->getUsersJobInvitation();
                                if($jobInvitation->num_rows()>0){
                                    $this->_data['jobInvitation']=$jobInvitation;
                                }
                                $conditions = array('resume.user_id' => $this->_data['getUsers']->row()->id, 'resume.status' => 2);
                                $this->_data['getResume'] = $this->m_resume->getResume($conditions);
                            }
                        }
                    }
                }
            }
            //get job apply
            if ($this->session->userdata('user_id')) {
                $user_id=$this->session->userdata('user_id');
                $conditionsApplyAll=array('job_apply.worker_id'=>$user_id);
                $getApplyAll=$this->m_job->getApply($conditionsApplyAll);
                $this->_data['getApplyAll']=$getApplyAll;
            }
            /**
             * Duy Thieu
             * Updated: 11/06/2015
             * update hits job
             */
            if(!$this->session->userdata('timeout_hits') || time() >= $this->session->userdata('timeout_hits')){
                $views = $this->_data['jobs']->views + 1;
                $this->session->set_userdata('timeout_hits', time() + 60);
                $this->m_job->updateJob(array('jobs.id' => $this->_data['jobs']->id), array('jobs.views' => $views));
            }
        }
        else{
            redirect();
        }
        $this->_data['title'] = $jobs->row()->title;
        $this->_data['description'] = $jobs->row()->title;
        $this->_data['keywords'] = $jobs->row()->title;
        $this->_data['template']='job/detailJobs';
        $this->load->view('index', $this->_data);
    }
    function printJob($job_id){
        $this->load->helper('encrypt');
        $this->load->library('encrypt');
        $params = get_params();
        $this->_data['params'] = $params;
        $condition = array(
            'jobs.id' => $job_id
        );
        $condition['jobs.is_deleted'] = 0;
        $jobs = $this->m_job->getJobs($condition);
        
        if($jobs->num_rows() > 0){
            
            $this->_data['jobs'] = $jobs->row();
            $creatorInfo = getUserInfo($this->_data['jobs']->user_id);
            $this->_data['creatorInfo'] = $creatorInfo;
        }
        else{
            redirect();
        }
        $this->_data['title'] = $this->lang->line('Print');
        $this->_data['description'] = $jobs->row()->title;
        $this->_data['keywords'] = $jobs->row()->title;
        $this->_data['template']='job/printJobs';
        $this->load->view('print', $this->_data);
    }
    function check_file($name){
        //language file
        if (isset($_FILES[$name]) && !empty($_FILES[$name]['name'])) {
            //echo $_FILES[$name]['name'];
            // upload CV
            $type = end(explode('.', $_FILES[$name]['name']));
            $in = array("doc", "DOC", "pdf", "PDF","docx","DOCX");
            if(!in_array($type,$in)){
                echo json_encode(array('result'=>'error','msg'=>'resumeFile'));die;
            }
            $target = 'files/jobseeker/CV/'.date('Y', time()).'/'.date('m',time()).'/';
            $config['upload_path'] = $target;
            $config['allowed_types'] = '*';
            $config['max_size'] = 10240;
            $config['remove_spaces']    = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if($this->upload->my_do_upload($name)){
                $dataUpload = $this->upload->data();
                $_POST['file_path'] = $target.$dataUpload['file_name'];
                $_POST['file_name'] = $dataUpload['file_name'];
                //return true;
            } else {
                echo $this->upload->display_errors();
                echo json_encode(array('result'=>'error','msg'=>'resumeFile'));die;
            }
        }
        else{
            echo json_encode(array('result'=>'error','msg'=>'resumeFile'));die;
        }
    }
    function rand_string($lenght = 5) {
        $s = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        mt_srand ((double)microtime() * 1000000);
        $unique_id = '';
        for ($i=0;$i< $lenght;$i++)
            $unique_id .= substr($s, (mt_rand()%(strlen($s))), 1);
        return $unique_id;
    }
    /*Start developer Huynh An*/
        /**
         * getCategories
         *
         * @access    public
         * @param    nil
         * @return    json_encode
         */
        function getCategories()
        {
            $getCategories = $this->m_application->getCategories();
            foreach($getCategories->result() as $item){
                $getCategoriesTemp[] = $item->category_name;
            }
            echo json_encode($getCategoriesTemp);
        }
        /**
         * getCities
         *
         * @access    public
         * @param    nil
         * @return    json_encode
         */
        function getCities()
        {
            $getCities = $this->m_cities->getCities();
            foreach($getCities->result() as $item){
                $getCitiesTemp[] = $item->city_name;
            }
            echo json_encode($getCitiesTemp);
        }
        /**
         * search
         *
         * @access    public
         * @param    nil
         * @return    result array
         */
        function search()
        {
            if($_POST){
                redirect_page($_POST);
            }
            $this->_data['menuActive'] = 'searchFast';
            $this->load->library('encrypt');
            $this->load->library('pagination');
            $this->load->model('m_cities');
            $this->_data['params'] = $params  = (my_uri_to_assoc())?my_uri_to_assoc():'';
            $this->_data['cities'] = $this->m_cities->getCities();
            $page = isset($params['p'])?$params['p']:1;
            $page_rows = 10;
            $limit[0] = $page_rows;
            if($page > 0)
                $limit[1] = ($page-1) * $page_rows;
            else
                $limit[1] = $page * $page_rows;
            $condition = array(
                'jobs.status' => 1,
                'jobs.is_deleted' => 0
            );
            // keyword search
            $keywords = isset($params['keywords'])?trim($params['keywords']):'';
            if($keywords != ''){
                $keywords = urldecode($keywords);
                $keywords = str_replace('_', ' ',$keywords);
            }
            // location search
            if(isset($params['employer'])){
                $condition['jobs.user_id']=$params['employer'];
                //check employers
                $condition_company=array('user_employers.user_id'=>$params['employer']);
                $getUsers=$this->m_user->getUsers($condition_company);
                if($getUsers->num_rows() > 0){
                    $this->_data['company'] = $getUsers->row()->company;
                }
                else{
                    redirect();
                }
            }
            // filter date poster
            $experience = isset($params['experience'])?$params['experience']:0;
            if($experience != 0){
                $condition["jobs.year_exp"] = $experience;
            }
            // filter date poster
            $education = isset($params['education'])?$params['education']:0;
            if($experience != 0){
                $condition["jobs.education_id"] = $experience;
            }
            // filter date poster
            $type_id = isset($params['type'])?$params['type']:0;
            if($type_id != 0){
                $condition["jobs.type_id"] = $type_id;
            }
            // filter date poster
            $level_id = isset($params['level'])?$params['level']:0;
            if($level_id != 0){
                $condition["jobs.level_id"] = $level_id;
            }
            // filter date poster
            $salary = isset($params['salary'])?$params['salary']:0;
            if($salary != 0){
                $condition["jobs.salary"] = $salary;
            }
            //fillter nganh nghe
            $stringCategories="";
            if(isset($params['category'])){
                $stringCategories = $params['category'];
            }
            //fillter dia diem
            $stringCities="";
            if(isset($params['city'])){
                $stringCities = $params['city'];
            }
            
            $like=array('jobs.title'=>$keywords);
            $count_job = $this->m_job->getJobs($condition,null,$like,null,$stringCategories,$stringCities,NULL,NULL);
            $jobs = $this->m_job->getJobs($condition, null, $like, $limit,$stringCategories,$stringCities,NULL,NULL);
            //echo $this->db->last_query();
            $href = URL.$this->lang->line('l_job').'/';
            if($params != ''){
                unset($params['p']);
                $href .= '/'.build_url($params);
            }
            $config['base_url'] = $href;
            $config['total_rows'] = $count_job->num_rows();
            $config['per_page'] = $page_rows;
            $config['cur_page'] = $page;
            $config['num_links'] = 1;
            $this->pagination->initialize($config);
            $this->_data['pagination'] = $this->pagination->create_links(false, 'job');
            $this->_data['jobs'] = $jobs->result();
            if(isset($params['keywords'])){
                $this->_data['keywords_search']=$keywords;
            }
            else{
                //$this->_data['keywords_search']=$this->_data['keywords'];
            }
            //echo $jobs->num_rows();die;
            $this->_data['total_jobs'] = $config['total_rows'];
            $this->_data['template']='job/jobs';
            $this->load->view('index',$this->_data);
        }
        /**
         * search
         *
         * @access    public
         * @param    nil
         * @return    result array
         */
        function listJobs($category_id)
        {
            $this->load->library('encrypt');
            $this->load->library('pagination');
            $this->load->model('m_cities');
            $this->_data['params'] = $params  = (my_uri_to_assoc())?my_uri_to_assoc():'';
            $this->_data['cities'] = $this->m_cities->getCities();
            $page = isset($params['p'])?$params['p']:1;
            $page_rows = 10;
            $limit[0] = $page_rows;
            if($page > 0)
                $limit[1] = ($page-1) * $page_rows;
            else
                $limit[1] = $page * $page_rows;
            $condition = array(
                'jobs.status' => 1,
                'jobs.is_deleted' => 0,
                'jobs.category_ids' => $category_id
            );
            $count_job = $this->m_job->getJobs($condition,null,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
            $jobs = $this->m_job->getJobs($condition, null, NULL, $limit,NULL,NULL,NULL,NULL,NULL);
            //echo $this->db->last_query();
            $href = URL.$this->lang->line('l_job').'/';
            if($params != ''){
                unset($params['p']);
                $href .= '/'.build_url($params);
            }
            $config['base_url'] = $href;
            $config['total_rows'] = $count_job->num_rows();
            $config['per_page'] = $page_rows;
            $config['cur_page'] = $page;
            $config['num_links'] = 2;
            $this->pagination->initialize($config);
            $this->_data['pagination'] = $this->pagination->create_links(false, 'job');
            $this->_data['jobs'] = $jobs->result();
            if(isset($params['keywords'])){
                $this->_data['keywords_search']=$params['keywords'];
            }
            else{
                //$this->_data['keywords_search']=$this->_data['keywords'];
            }
            //echo $jobs->num_rows();die;
            $this->_data['total_jobs'] = $config['total_rows'];
            //get job apply
            if ($this->lang->line('user_id')) {
                $user_id=$this->session->userdata('user_id');
                $conditionsApply=array('job_apply.worker_id'=>$user_id);
                $getApply=$this->m_job->getApply($conditionsApply);
                $this->_data['getApply']=$getApply;
            }
            $getCategories = $this->m_application->getCategories(array('categories.id' => $category_id));
            $this->_data['title'] = $getCategories->row()->category_name;
            $this->_data['description'] = $getCategories->row()->category_name;
            $this->_data['keywords'] = $getCategories->row()->category_name;
            $this->_data['template']='job/jobs';
            $this->load->view('index',$this->_data);
        }
        /**
         * ajaxGetCity
         *
         * @access    public
         * @param    nil
         * @return    json_encode
         */
        function ajaxGetCity()
        {
            if($this->input->post('country')){
                $getCities = $this->m_cities->getCities(array('country_id'=>$this->input->post('country')));
            }
            else{
                $getCities = $this->m_cities->getCities();
            }
            $arrayCities=array();
            foreach($getCities->result() as $item){
                $arrayCities[''.$item->id.'']=$item->city_name;
            }
            echo json_encode($arrayCities);
        }
        /**
         * ajaxGetCity
         *
         * @access    public
         * @param    nil
         * @return    json_encode
         */
        function ajaxGetDistrict()
        {
            if($this->input->post('city')){
                $getDistrict = $this->m_district->getDistrict(array('city_id'=>$this->input->post('city')));
            }
            else{
                $getDistrict = $this->m_district->getDistrict();
            }
            $arrayDistrict=array();
            foreach($getDistrict->result() as $item){
                $arrayDistrict[''.$item->id.'']=$item->district_name;
            }
            echo json_encode($arrayDistrict);
        }
        /**
         * ajaxGetLanguage
         *
         * @access    public
         * @param    nil
         * @return    json_encode
         */
        function ajaxGetLanguage()
        {
            if($this->input->post('language')){
                $getDistrict = $this->m_district->getDistrict(array('city_id'=>$this->input->post('language')));
            }
            else{
                $getDistrict = $this->m_district->getDistrict();
            }
            $arrayDistrict=array();
            foreach($getDistrict->result() as $item){
                $arrayDistrict[''.$item->id.'']=$item->district_name;
            }
            echo json_encode($arrayDistrict);
        }
        /**
         * checkLoginApply
         *
         * @access    public
         * @param    nil
         * @return    json_encode
         */
        function checkLoginApply()
        {
            if($this->lang->line('user_id')){
                echo json_encode(array('result'=>'success'));
            }
            else{
                echo json_encode(array('result'=>'error'));
            }
        }
        /**
         * urlLoadModalApply
         *
         * @access    public
         * @param    nil
         * @return    json_encode
         */
        function urlLoadModalApply()
        {
            if($this->lang->line('user_id')){
                $condition = array('users.id' => $this->session->userdata('user_id'));
                $userInfo = $this->m_user->getUsers($condition)->row();
                if($userInfo->active_email!=1){
                    echo '1';
                }
                elseif($this->session->userdata('role_id')==1){
                    $params = get_params();
                    if(isset($params['idJobs'])) {
                        $idJobs=$params['idJobs'];
                        $idJobs=$this->encrypt->decode($idJobs);
                    }
                    $condition=array('jobs.id'=>$idJobs);
                    $jobs = $this->m_job->getJobs($condition);
                    //echo $this->db->last_query(); die;
                    $users_id = $this->session->userdata('user_id');
                    //get all info user and resume
                    $this->_data['user_info'] = $this->m_user->getUsers(array('users.id' => $users_id))->row();
                    //resume
                    $conditions=array('resume.user_id'=>$users_id,'resume.status'=>2,'resume.user_id'=>$users_id);
                    $this->_data['getResume']=$this->m_resume->getResume($conditions);
                    $this->_data['getCities']=$this->m_cities->getCities(array('cities.id > '=>0));
                    $this->_data['getJobs'] = $jobs->row();
                    $this->load->view('worker/applyJob', $this->_data);
                }
                else{
                    echo 'error';
                }
            }
        }
        /**
         * getPostInputApply
         *
         * @access    public
         * @param    nil
         * @return    json_encode
         */
        function getPostInputApply()
        {
            if($this->lang->line('user_id')){
                $value=$this->input->post('value');
                echo json_encode(array('value'=>$value));
            }
        }
        /**
         * setPostSelectCityApply
         *
         * @access    public
         * @param    nil
         * @return    json_encode
         */
        function setPostSelectCityApply()
        {
            if($this->lang->line('user_id')){
                $getCities=$this->m_cities->getCities(array('cities.id > '=>1));
                $array=array();
                foreach ($getCities->result() as $item) {
                    # code...
                    $array[$item->id]=$item->city_name;
                }
                echo json_encode($array);
            }
        }
       /**
         * ajaxAddFavourites
         *
         * @access    public
         * @param    nil
         * @return    json_encode
         */
        public function ajaxAddFavourites(){
            if($this->session->userdata('user_id')){
                if($this->session->userdata('role_id')==1){
                    if($this->input->post('status',TRUE)){
                        $status = $this->input->post('status',TRUE);
                        $favourites = $this->m_common->getTableData('job_favourites',array('user_id' => $this->session->userdata('user_id')),array('id','values'));
                        $id = $this->encrypt->decode($this->input->post('id',TRUE));
                        $conditions=array('jobs.id'=>$id);
                        $getJobs=$this->m_job->getJobs($conditions);
                        if($favourites->num_rows() > 0) {
                            if ($status == 'remove') {
                                $array_favourites = unserialize(stripslashes($favourites->row()->values));
                                $key = array_search($id,$array_favourites);
                                unset($array_favourites[$key]);
                                $se_favourites = serialize($array_favourites);
                                $this->m_common->updateTableData('job_favourites',null,array('values' => $se_favourites),array('user_id' => $this->session->userdata('user_id')));
                                // remove id project
                            } elseif ($status == 'add') {
                                $array_favourites = unserialize(stripslashes($favourites->row()->values));
                                if($key = array_search($id,$array_favourites) == false){
                                    $array_favourites[] = $id;
                                }
                                $se_favourites = serialize($array_favourites);
                                $this->m_common->updateTableData('job_favourites',null,array('values' => $se_favourites),array('user_id' => $this->session->userdata('user_id')));
                            }
                        }else{
                            $array_favourites[] = $id;
                            $se_favourites = serialize($array_favourites);
                            $this->m_common->insertData('job_favourites',array('values' => $se_favourites,'user_id' => $this->session->userdata('user_id')));
                        }
                        if ($status == 'remove') {
                            //update number favourites in table projects
                            $favourites=$getJobs->row()->favourites - 1;
                            $update=array(
                                'favourites' => $favourites
                            );
                            $this->m_job->updateJob(array('jobs.id'=>$id),$update);
                        }
                        else{
                            //update number favourites in table projects
                            $favourites=$getJobs->row()->favourites + 1;
                        $update=array(
                            'favourites' => $favourites
                        );
                        $this->m_job->updateJob(array('jobs.id'=>$id),$update);
                    }
                    echo json_encode(array('status' => 'success','favourites' =>$favourites));exit;
                }else{
                    echo json_encode(array('status' => 'error'));exit;
                }
            }
            else{
                echo json_encode(array('status' => 'error','message' => 'Not role'));exit;
            }
        }else{
            echo json_encode(array('status' => 'error','message' => 'Not logged'));exit;
        }
    }
    function shareForFriend(){
        $this->load->library('email');
        $email=$this->input->post('emailJR',TRUE);
        //send mail for worker
        if($this->input->post('idJobs',TRUE)){
            $idJobs=$this->encrypt->decode($this->input->post('idJobs',TRUE));
        }
        $user_id=$this->session->userdata('user_id');
        $conditionsJob=array('jobs.id'=>$idJobs);
        $getJobs=$this->m_job->getJobs($conditionsJob);
        if($getJobs->num_rows()>0){
            $conditions = array('users.id' => $user_id);
            $getUsers = $this->m_user->getUsers($conditions)->row();
            $paramSubject = array(
                '!jobtitle' => $getJobs->row()->title
            );
            $paramBody = array(
                '!jobtitle' => $getJobs->row()->title,
                '!url' =>URL.$this->lang->line('l_detail').'/'.$getJobs->row()->alias.'-'.$getJobs->row()->id,
                '!url_home' => site_url(),
                '!images'=>IMAGES.'rsz_logo.png'
            );
            $this->email->mailFrom = "no-reply@workspharma.com";
            $email = explode(';',$email);

            $this->email->templateType = 'share_job';
            $this->email->paramSubject = $paramSubject;
            $this->email->paramBody = $paramBody;
            foreach($email as $item){
                $this->email->mailTo = $item;
                $this->email->sendMail();
            }
            echo json_encode(array('result'=>'success'));
        }
    }
    function getDataWebsite1(){
        ini_set('max_execution_time', 300);
        $this->load->helper('simple_html_dom');
        $html = file_get_html('http://itviec.com/jobs/net-asp-net-agile-net-developers-for-both-hcm-ha-noi');
        $title=$html->find('.job-detail .header h1.job_title',0);
        echo $title;die;
    }
    function getDataWebsiteItViec(){
        ini_set('max_execution_time', 300);
        $this->load->helper('simple_html_dom');
        $this->load->helper('file');
        // Create DOM from URL or file
        $html = file_get_html('https://itviec.com/search/PostgreSql');
        // Find all links
        //foreach($html->find('#footer .tags li.tag a') as $elementCategories)
        //{
            //$htmlCategories = file_get_html('http://itviec.com'.$elementCategories->href);
            $i=99;
            foreach($html->find('.first-group .job .title a') as $elementItems)
            {
                $items = file_get_html('http://itviec.com'.$elementItems->href);
                //get id job other
                $idJobOther=$items->find('.main-content',0)->id;
                $idJobOther=explode('_',$idJobOther);
                $idJobOther=$idJobOther[1];
                //check elxit idJobOther
                $getJobs=$this->m_job->getJobs(array('jobs.idJobOther'=>$idJobOther));
                if($getJobs->num_rows()>0);
                else{
                    $dataJob=array();
                    $dataJob['idJobOther']=$idJobOther;
                    //get name employer
                    $name=$items->find('.side_bar div.inside .name',0)->plaintext;
                    //get title
                    $title=$items->find('.job-detail .header h1.job_title',0)->plaintext;
                    //check emplpyer elxit
                    $getUsers=$this->m_user->getUsers(array('user_employers.company'=>$name));
                    if($getUsers->num_rows()>0){
                        $id=$getUsers->row()->id;
                    }
                    else{
                        //create users
                        $dataUsers=array();
                        $dataUsers['user_name']='employer'.$i;
                        $i++;
                        $dataUsers['email']='donoreply@topdev.vn';
                        $dataUsers['password']=md5('123123123');
                        $dataUsers['role_id']=2;
                        $dataUsers['active_email']=1;
                        $id=$this->m_user->createUser($dataUsers);
                    }
                    $alias=standardURL($title);
                    //get address
                    $stringCitys='';
                    $address=$items->find('.job-detail .header div.address',0)->plaintext;
                    $listAddress=explode(',',$address);
                    $listCities = $this->m_cities->getCities();
                    foreach ($listAddress as $key=>$value) {
                        foreach ($listCities->result() as $item) {
                            if(strcasecmp(standardURL($item->city_name),standardURL(ltrim($value)))==0){
                                $idCity=$item->id;
                                break;
                            }
                        }
                        if(!isset($idCity)){
                            $idCity='';
                        }
                        if(empty($stringCitys)){
                            $stringCitys.=$idCity;
                        }
                        else{
                            $stringCitys.=','.$idCity;
                        }
                    }
                    //listCategories
                    $stringSkills='';
                    $listCategories=$this->m_application->getCategory();
                    foreach ($items->find('.job-detail .header .tags .tag-list .tag-content') as $tag) {
                        $nameSkill = $tag->find('h2.tag a',0)->plaintext;
                        foreach ($listCategories->result() as $item) {
                            if(strcasecmp($item->category_name,$nameSkill)==0){
                                $idSkill=$item->id;
                                break;
                            }
                        }
                        if(!isset($idSkill)){
                            $idSkill='';
                        }
                        if(empty($stringSkills)){
                            $stringSkills.=$idSkill;
                        }
                        else{
                            $stringSkills.=','.$idSkill;
                        }
                    }
                    //get salary
                    $salary=$items->find('.job-detail .header div.salary span',1)->plaintext;
                    //echo $salary;die;
                    if(strcasecmp($salary,'Attractive')){
                        $salary_min=0;
                        $salary_max=0;
                    }
                    elseif(strcasecmp($salary,'Competitive')){
                        $salary_min=0;
                        $salary_max=0;
                    }
                    elseif(strcasecmp($salary,'Negotiable')){
                        $salary_min=0;
                        $salary_max=0;
                    }
                    elseif(strcasecmp($salary,'You will love it!')){
                        $salary_min=0;
                        $salary_max=0;
                    }
                    elseif(strpos($salary,'Up to')){
                        $salary_min=0;
                        $salary_max=$int = filter_var($salary, FILTER_SANITIZE_NUMBER_INT);
                    }
                    else{
                        $listSalary=explode('-',$salary);
                        $salary_min=filter_var($listSalary[0], FILTER_SANITIZE_NUMBER_INT);
                        $salary_max=filter_var($listSalary[1], FILTER_SANITIZE_NUMBER_INT);
                    }
                    //get description
                    $stringDescription='';
                    $description=$items->find('.job-detail div.job_description',0);
                    $stringDescription=$description->find('div.title-apply-line div.title',0)->innertext;
                    $stringDescription=$description->find('div.description',0)->innertext;
                    //gete skill
                    $skills=$items->find('.job-detail div.skills_experience',0);
                    $stringDescription.=$skills->find('div.title',0)->innertext;
                    $stringDescription.=$skills->find('div.experience',0)->innertext;
                    //gete skill
                    $love_working_here=$items->find('.job-detail div.love_working_here',0);
                    $stringDescription.=$love_working_here->find('div.title',0)->innertext;
                    $stringDescription.=$love_working_here->find('div.culture_description',0)->innertext;
                    //insert job
                    $dataJob['user_id']=$id;
                    $dataJob['category_ids']=$stringSkills;
                    $dataJob['city_ids']=$stringCitys;
                    $dataJob['title']=$title;
                    $dataJob['alias']=$alias;
                    $dataJob['gender']=0;
                    $dataJob['age']=25;
                    $dataJob['year_exp']=2;
                    $dataJob['qty']=2;
                    $dataJob['salary_min']=$salary_min;
                    $dataJob['salary_max']=$salary_max;
                    $dataJob['description']=$stringDescription;
                    $dataJob['status']=1;
                    $dataJob['date_expiration']=date('Y-m-d H:i:s',time()+(30*86400));
                    $dataJob['date_created']=date('Y-m-d H:i:s',time());
                    $dataJob['update_at']=date('Y-m-d H:i:s',time());
                    $dataJob['favourites']=1;
                    $dataJob['views']=1;
                    $this->m_jobs->addJob($dataJob);
                    //check emplpyer elxit
                    if($getUsers->num_rows()>0){
                    }
                    else{
                        //get info employer
                        $description=$items->find('.side_bar div.inside .long_description',0)->innertext;
                        $output_dir_photo = realpath(APPPATH. "../files/employers/".date("Y").'/'.date("m").'/'.date("d"));
                        //echo $output_dir_photo;die;
                        $output_dir_logo = realpath(APPPATH. "../files/logos");
                        $pathPhotos = "./files/employers/".date("Y").'/'.date("m").'/'.date("d");
                        $pathLogo = "./files/logos/";
                        if(!is_dir($pathPhotos)) //create the folder if it's not already exists
                        {
                            @mkdir($pathPhotos,0777,TRUE);
                        }
                        //get slideshow images
                        $items->find('#jd-photo-slider',0)->style="display:block";
                        foreach ($items->find('#jd-photo-slider .item') as $itemPhoto){
                            $itemPhotoChild = $itemPhoto->find('.img',0)->style;
                            //echo $itemPhotoChild;die;
                            $photo='https://itviec.com'.substr($itemPhotoChild,22,-1);
                            $namePhoto=explode('/',substr($itemPhotoChild,22,-1));
                            //var_dump($namePhoto);die;
                            $nameSavePhoto=encrypt_name($namePhoto[6]);
                            copy($photo,$output_dir_photo.'/'.$nameSavePhoto);
                            //create employers files
                            $dataUserEmployersFiles=array();
                            $dataUserEmployersFiles['user_id']=$id;
                            $dataUserEmployersFiles['path']='files/employers/'.date("Y").'/'.date("m").'/'.date("d").'/'.$nameSavePhoto;
                            $dataUserEmployersFiles['is_deleted']=0;
                            $this->m_jobs->addEmployerFiles($dataUserEmployersFiles);
                        }
                        //gete images
                        $logo='https://itviec.com/'.$items->find('.side_bar div.inside .logo a img',0)->src;
                        $nameLogo=explode('/',$items->find('.side_bar div.inside .logo a img',0)->src);
                        $nameSaveLogo=encrypt_name($nameLogo[6]);
                        $nameSaveLogo=explode('?',$nameSaveLogo);
                        $nameSaveLogo=$nameSaveLogo[0];
                        copy($logo,$output_dir_logo.'/'.$nameSaveLogo);
                        //create employers
                        $dataUserEmployer=array();
                        $dataUserEmployer['logo']=$nameSaveLogo;
                        $dataUserEmployer['user_id']=$id;
                        $dataUserEmployer['company']=$name;
                        $dataUserEmployer['address']='';
                        $dataUserEmployer['description']=$description;
                        $dataUserEmployer['created_at']=date('Y-m-d H:i:s',time());
                        $dataUserEmployer['updated_at']=date('Y-m-d H:i:s',time());
                        $idUserEmployer=$this->m_jobs->addEmployer($dataUserEmployer);
                    }
                }
                //die;
            //}
        }
    }
    function getDataWebsiteVietNamWorks(){
        ini_set('max_execution_time', 300);
        $this->load->helper('simple_html_dom');
        $this->load->helper('file');
        // Create DOM from URL or file
        $html = file_get_html('http://www.vietnamworks.com/viec-lam-it-phan-mem-tai-ho-chi-minh-i35v29,24,15-vn');
        // Find all links
        //foreach($html->find('#footer .tags li.tag a') as $elementCategories)
        //{
            //$htmlCategories = file_get_html('http://itviec.com'.$elementCategories->href);
            $i=97;
            foreach($html->find('#job-list table tr.job-post a.job-title') as $elementItems)
            {
                $items = file_get_html($elementItems->href);
                //get id job other
                $idJobOther=$items->find('#jobId',0)->value;
                //check elxit idJobOther
                $getJobs=$this->m_job->getJobs(array('jobs.idJobOther'=>$idJobOther));
                if($getJobs->num_rows()>0) echo $idJobOther;
                else{
                    $dataJob=array();
                    $dataJob['idJobOther']=$idJobOther;
                    //get name employer
                    $name=$items->find('.job-header-info span.company-name strong',0)->plaintext;
                    //get title
                    $title=$items->find('.job-header-info h1.job-title',0)->plaintext;
                    //check emplpyer elxit
                    $getUsers=$this->m_user->getUsers(array('user_employers.company'=>$name));
                    if($getUsers->num_rows()>0){
                        $id=$getUsers->row()->id;
                    }
                    else{
                        //create users
                        $dataUsers=array();
                        $dataUsers['user_name']='employer'.$i;
                        $i++;
                        $dataUsers['email']='jobs@applancer.net';
                        $dataUsers['password']=md5('123123123');
                        $dataUsers['role_id']=2;
                        $dataUsers['user_status']=1;
                        $dataUsers['active_email']=1;
                        $id=$this->m_user->createUser($dataUsers);
                    }
                    $alias=standardURL($title);
                    //get address
                    $stringCitys='';
                    $address=$items->find('.job-header-info .work-location span');
                    $listAddress='';
                    foreach ($address as $itemCity) {
                        if(!empty($listAddress)){
                            $listAddress=','.substr($itemCity->find('a',0)->href,41,-7);
                        }
                        else{
                            $listAddress=substr($itemCity->find('a',0)->href,41,-7);
                        }
                    }
                    $listAddress=explode(',',$listAddress);
                    $listCities = $this->m_cities->getCities();
                    foreach ($listAddress as $key=>$value) {
                        foreach ($listCities->result() as $item) {
                            if(strcasecmp(standardURL($item->city_name),standardURL(ltrim($value)))==0){
                                $idCity=$item->id;
                                break;
                            }
                        }
                        if(!isset($idCity)){
                            $idCity='';
                        }
                        if(empty($stringCitys)){
                            $stringCitys.=$idCity;
                        }
                        else{
                            $stringCitys.=','.$idCity;
                        }
                    }
                    //listCategories
                    $stringSkills='';
                    $listCategories=$this->m_application->getCategory();
                    foreach ($items->find('.job-tag-add-skill1 span.addable') as $tag) {
                        $nameSkill = $tag->find('span.tag-name',0)->plaintext;
                        foreach ($listCategories->result() as $item) {
                            if(preg_match("/".$item->category_name."/",$nameSkill)){
                                $idSkill=$item->id;
                                break;
                            }
                            else{
                                $insertDataSkill=array();
                                $insertDataSkill['category_name']=$nameSkill;
                                $insertDataSkill['is_active']=1;
                                $insertDataSkill['description']=$nameSkill;
                                $insertDataSkill['page_title']=$nameSkill;
                                $insertDataSkill['meta_keywords']=$nameSkill;
                                $insertDataSkill['meta_description']=$nameSkill;
                                $insertDataSkill['created']=time();
                                $insertDataSkill['status_temp1']=1;
                                $idSkill=$this->m_application->addCategory($insertDataSkill);
                                break;
                            }
                        }
                        if(!isset($idSkill)){
                            $idSkill='';
                        }
                        if(empty($stringSkills)){
                            $stringSkills.=$idSkill;
                        }
                        else{
                            $stringSkills.=','.$idSkill;
                        }
                    }
                    //get salary
                    $salary=$items->find('.job-header .salary span',0)->plaintext;
                    //echo $salary;die;
                    if(strcasecmp($salary,'Thương lượng')){
                        $salary_min=0;
                        $salary_max=0;
                    }
                    else{
                        $listSalary=explode('-',$salary);
                        $salary_min=filter_var($listSalary[0], FILTER_SANITIZE_NUMBER_INT);
                        $salary_max=filter_var($listSalary[1], FILTER_SANITIZE_NUMBER_INT);
                    }
                    //get description
                    $stringDescription='';
                    //$stringDescription.='Bạn Sẽ Làm Gì';
                    $stringDescription.=$items->find('div#job-description',0)->innertext;
                    //gete skill
                    //$stringDescription.='Chuyên Môn Của Bạn';
                    $stringDescription.=$items->find('div#job-requirement',0)->innertext;
                    //gete skill
                    $stringDescription.='<div class="pr_title pr_name f18-m" style="font-weight:bold;">Về Công Ty Chúng Tôi</div>';
                    $stringDescription1=$items->find('div.company-info div.company-info',0)->innertext;
                    $stringDescription1=reg_replace('#<div class="push-top">(.*?)</div>#', ' ', $stringDescription1);
                    $stringDescription.=$stringDescription1;
                    //insert job
                    $dataJob['user_id']=$id;
                    $dataJob['category_ids']=$stringSkills;
                    $dataJob['city_ids']=$stringCitys;
                    $dataJob['title']=$title;
                    $dataJob['alias']=$alias;
                    $dataJob['gender']=0;
                    $dataJob['age']=25;
                    $dataJob['year_exp']=2;
                    $dataJob['qty']=2;
                    $dataJob['salary_min']=$salary_min;
                    $dataJob['salary_max']=$salary_max;
                    $dataJob['description']=$stringDescription;
                    $dataJob['status']=1;
                    $dataJob['date_expiration']=date('Y-m-d H:i:s',time()+(30*86400));
                    $dataJob['date_created']=date('Y-m-d H:i:s',time());
                    $dataJob['update_at']=date('Y-m-d H:i:s',time());
                    $dataJob['favourites']=1;
                    $dataJob['views']=1;
                    $this->m_jobs->addJob($dataJob);
                    //check emplpyer elxit
                    if($getUsers->num_rows()>0){
                    }
                    else{
                        //get info employer
                        $description=$items->find('div.company-info div.company-info span#companyprofile',0)->plaintext;
                        $output_dir_photo = realpath(APPPATH. "../files/employers/".date("Y").'/'.date("m").'/'.date("d"));
                        //echo $output_dir_photo;die;
                        $output_dir_logo = realpath(APPPATH. "../files/logos");
                        $pathPhotos = "./files/employers/".date("Y").'/'.date("m").'/'.date("d");
                        $pathLogo = "./files/logos/";
                        if(!is_dir($pathPhotos)) //create the folder if it's not already exists
                        {
                            @mkdir($pathPhotos,0777,TRUE);
                        }
                        //get slideshow images
                        foreach ($items->find('#multi-carousel-wrapper ul li ') as $itemPhoto){
                            $itemPhotoChild = $itemPhoto->find('.img-responsive',0)->src;
                            //echo $itemPhotoChild;die;
                            $photo=$itemPhotoChild;
                            $namePhoto=explode('/',$photo);
                            //var_dump($namePhoto);die;
                            $nameSavePhoto=encrypt_name($namePhoto[5]);
                            copy($photo,$output_dir_photo.'/'.$nameSavePhoto);
                            //create employers files
                            $dataUserEmployersFiles=array();
                            $dataUserEmployersFiles['user_id']=$id;
                            $dataUserEmployersFiles['path']='files/employers/'.date("Y").'/'.date("m").'/'.date("d").'/'.$nameSavePhoto;
                            $dataUserEmployersFiles['is_deleted']=0;
                            $this->m_jobs->addEmployerFiles($dataUserEmployersFiles);
                        }
                        //gete images
                        $logo=$items->find('.employer-logo img.logo',0)->src;
                        $nameLogo=explode('/',$logo);
                        $nameSaveLogo=encrypt_name($nameLogo[5]);
                        $nameSaveLogo=explode('?',$nameSaveLogo);
                        $nameSaveLogo=$nameSaveLogo[0];
                        copy($logo,$output_dir_logo.'/'.$nameSaveLogo);
                        //create employers
                        $dataUserEmployer=array();
                        $dataUserEmployer['logo']=$nameSaveLogo;
                        $dataUserEmployer['user_id']=$id;
                        $dataUserEmployer['company']=$name;
                        $dataUserEmployer['address']='';
                        $dataUserEmployer['description']=$description;
                        $dataUserEmployer['created_at']=date('Y-m-d H:i:s',time());
                        $dataUserEmployer['updated_at']=date('Y-m-d H:i:s',time());
                        $idUserEmployer=$this->m_jobs->addEmployer($dataUserEmployer);
                    }
                }
                die;
            //}
        }
    }
    function getRowDataWebsite(){
        ini_set('max_execution_time', 300);
        $this->load->helper('simple_html_dom');
        // Create DOM from URL or file
        $html = file_get_html('http://www.chupamobile.com/android-full-applications/world-cup-2014-application-for-android-3285');
        // Find all links
            $srcImagesScreenshots=$html->find('ul.popup-gallery li a');
            $screenshots="";
            $stt=0;
            $count=count($srcImagesScreenshots);
            echo $count;
            foreach ($srcImagesScreenshots as $item) {
                # code...
                $arrayImagesScreenshots=explode('/',$item->href);
                echo $arrayImagesScreenshots[4].'<br>';
            }
    }
    /*End developer Huynh An*/
}
/* End of file job.php */
/* Location: ./app/controllers/job.php */
?>
