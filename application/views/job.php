<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION))@session_start();
require_once(APPPATH . 'controllers/application.php');
class Job extends Application
{

    //Global variable
    public $outputData; //Holds the output data for each view
    public $loggedInUser;

    /**
     * Constructor
     *
     * Loads language files and models needed for this controller
     */
    public function __construct(){
        parent::__construct();

        //Get Config Details From Db
        $this->my_config->db_config_fetch();


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
        //Get Logged In user
        $this->loggedInUser = $this->m_common->getLoggedInUser();
        //var_dump($this->loggedInUser);die;
        $this->outputData['loggedInUser'] = $this->loggedInUser;
        //Page Title and Meta Tags
        $this->outputData = $this->m_common->getPageTitleAndMetaData();
        //load all skills
        $condition_categories=array('categories.is_active'=>1);
        $order=array('view_search','DESC');
        $getCategories = $this->m_application->getCategories($condition_categories,NULL,NULL,NULL,$order);
        $this->outputData['getCategories'] = $getCategories;
        $this->outputData['idChild'] = 0;
        //load all location
        $getCities = $this->m_cities->getCities();
        $this->outputData['getCities'] = $getCities;
        //load all $getCategoriesPopular
        $conditions=array('categories.is_active'=>1,'categories.is_active'=>1);
        $order=array('categories.view_search','DESC');
        $limit=array(6);
        $getCategoriesPopular = $this->m_application->getCategories($conditions,NULL,NULL,$limit,$order);
        $this->outputData['getCategoriesPopular'] = $getCategoriesPopular;

        //load all exp
        $this->outputData['default_exp'] = $this->my_config->item('default_exp');
        $this->lang->load('enduser/common', $this->my_config->item('language_code'));

    } //Controller End
    // --------------------------------------------------------------------
    function ajaxGetJobs(){
        $this->load->library('encrypt');

        $result = '';
        $client_id = $this->input->post('client_id', true);
        $limit = $this->input->post('limit');
        $count_str = $this->input->post('count_str');
        $users = $this->m_job->getUsers(array('client_id' => $client_id));

        if($users->num_rows() > 0){
            $user = $users->row();

            $token = $this->encrypt->encode($user->id);
            $link_iframe = site_url('job/jobs/'.$limit.'/'.$count_str.'/?token='.$token);
            $result = array(
                'status' => 'SUCCESS',
                'link_iframe' => $link_iframe
            );
        }else{
            $result = array(
                'status' => 'ERROR',
            );
        }
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
        header('Access-Control-Max-Age: 1000');
        header('Access-Control-Allow-Headers: Content-Type');
        echo json_encode($result);
    }
 
    function viewJobs(){
        $this->load->view('job/viewJobs', $this->outputData);
    }

    function jobs(){
        $this->load->library('encrypt');
        $this->load->library('pagination');
        $this->load->model('m_cities');

        $this->outputData['params'] = $params = get_params();
        $user_id = $this->encrypt->decode($params['token']);
        $this->outputData['default_skill_invoice'] = $this->my_config->item('default_skill_invoice');
        //$limit = $this->uri->segment(3, 10);
        $this->outputData['count_str'] = $this->uri->segment(4, 300);
        $this->outputData['limit'] = $this->uri->segment(3, 0);
        $this->outputData['default_skill_invoice'] = $this->my_config->item('default_skill_invoice');
        $this->outputData['default_exp'] = $this->my_config->item('default_exp_en');
        $this->outputData['cities'] = $this->m_cities->getCities();
        $page = ($this->input->post('page', true))?$this->input->post('page', true):0;
        $page_rows = $this->uri->segment(3, 10);

        $limit[0] = $page_rows;
        if($page > 0)
            $limit[1] = ($page-1) * $page_rows;
        else
            $limit[1] = $page * $page_rows;

        $condition = array(
            'jobs.status' => 1,
        );
        $count_job = $this->m_job->getJobs($condition);
        $jobs = $this->m_job->getJobs($condition, null, null, $limit);
        //echo $this->db->last_query(); die;

        //Pagination
        //$config['base_url'] = site_url();
        $config['total_rows'] = $count_job->num_rows();
        $config['per_page'] = $page_rows;
        $config['cur_page'] = $page;
        $this->pagination->initialize($config);
        $this->outputData['pagination'] = $this->pagination->create_links(false, 'ajax2');
        $this->outputData['jobs'] = $jobs->result();
        $this->outputData['params']   = $params;
        $this->load->view('job/jobs', $this->outputData);
    }

    function ajaxGetJob(){
        $this->load->library('encrypt');
        $this->load->library('pagination');

        $result = array();

        $user_id = $this->encrypt->decode($this->input->post('token', true));
        //$limit = $this->uri->segment(3, 10);

        if(is_numeric($user_id)){

            $page = ($this->input->post('page', true))?(int)$this->input->post('page', true):0;
            $page_rows = ($this->input->post('per_page', true))?$this->input->post('per_page', true):5;

            $limit[0] = (int) $page_rows;
            if($page > 0)
                $limit[1] = ($page-1) * $page_rows;
            else
                $limit[1] = $page * $page_rows;

            $condition = array(
                'jobs.status' => 1,
                'jobs.payment_status' => 1,
                'UNIX_TIMESTAMP(jobs.date_expiration) >= ' => time(),
            );

            //search
            $like = '';
            $or_like = '';
            if($this->input->post('keyword', true)){
                $keyword = $this->db->escape_like_str($this->input->post('keyword', true));

                $or_like = array(
                    'title' 	=> "jobs.title LIKE '%".$keyword."%'",
                    'description' 	=> "jobs.description LIKE '%".$keyword."%'",
                );
                //$condition['invoice.skills'] = $this->input->post('keyword', true);
            }

            if($this->input->post('skill', true)){
                $condition['jobs.skills'] = (int) $this->input->post('skill', true);
            }

            if($this->input->post('year_exp', true)){
                $condition['jobs.year_exp'] = (int) $this->input->post('year_exp', true);
            }

            if($this->input->post('city_id', true)){
                $condition['jobs.city_id'] = (int) $this->input->post('city_id', true);
            }

            if($this->input->post('salary', true)){
                $salary_str = $this->input->post('salary', true);

                if($salary_str == 2000){
                    $condition['jobs.salary >'] = (int) $salary_str;
                }elseif($salary_str == -1){
                    $condition['jobs.salary'] = '0';
                }else{
                    $tmp = explode('-', $salary_str);
                    $salary_min = $tmp[0];
                    $salary_max = $tmp[1];
                    $condition['jobs.salary >='] = (int) $salary_min;
                    $condition['jobs.salary <='] = (int) $salary_max;
                }
            }

            $count_job = $this->m_job->getJobs($condition, null, $like, null, null, $or_like);
            $jobs = $this->m_job->getJobs($condition, null, $like, $limit, null, $or_like);

            //Pagination
            //$config['base_url'] = site_url();
            $config['total_rows'] = $count_job->num_rows();
            $config['per_page'] = $page_rows;
            $config['cur_page'] = $page;
            $this->pagination->initialize($config);
            $pagination = $this->pagination->create_links(false, 'ajax2');
            $jobs = $jobs->result();

            $result = array(
                'jobs' => $jobs,
                'pagination' => $pagination,
                'default_skill' => $this->my_config->item('default_skill_invoice'),
            );
        }

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
        header('Access-Control-Max-Age: 1000');
        header('Access-Control-Allow-Headers: Content-Type');
        echo json_encode($result);
    }

    function detailJobs($job_id){
        // $order=array('view_search','DESC');
        // $getCategories = $this->m_application->getCategories(NULL,NULL,NULL,NULL,$order);
        // $this->outputData['getCategories'] = $getCategories;

        $this->load->helper('encrypt');
        $this->load->library('encrypt');
        $this->outputData['default_skill_invoice'] = $this->my_config->item('default_skill_invoice');
        $params = get_params();
        $this->outputData['params'] = $params;
        $condition_temp = array(
            'jobs.id' => $job_id
        );
        $jobs_temp = $this->m_job->getJobs($condition_temp);
        $condition = array(
            'jobs.id' => $job_id
        );
        if(isLoggedIn()){
            if($this->loggedInUser->id==$jobs_temp->row()->user_id);
            else{
                $condition['jobs.status']=1;
            }
        }
        else{
            $condition['jobs.status']=1;
        }
        
        $jobs = $this->m_job->getJobs($condition);
        $this->outputData['job_id'] = $job_id;
        if($jobs->num_rows() > 0){
            $this->outputData['jobs'] = $jobs->row();
            $creatorInfo = getUserInfo($this->outputData['jobs']->user_id);

            if($creatorInfo != ''){
                $this->outputData['creatorInfo'] = $creatorInfo;
            }
            $limit=array(5,0);
            $condition=array('jobs.user_id'=>$this->outputData['jobs']->user_id,'jobs.id !='=>$job_id,'jobs.status'=>1);
            $this->outputData['sameToJobs']=$this->m_job->sameToJobs($condition,null,null,$limit);
            //get all file of employer
            $this->outputData['files'] = $this->m_employer_files->getFiles(array('user_id' => $this->outputData['jobs']->user_id));

            //get job apply
            if (isLoggedIn()) {
                $user_id=$this->loggedInUser->id;
                $conditionsApply=array('job_apply.worker_id'=>$user_id,'job_apply.job_id'=>$job_id);
                $getApply=$this->m_job->getApply($conditionsApply);
                $this->outputData['getApply']=$getApply;
            }
            $condition_same_jobs=array('jobs.status'=>1);
            $limit = array(4,0);
            $same_pr = $this->m_user->getSameJob($this->outputData['jobs']->category_ids,$job_id,$limit,$condition_same_jobs);
            if($same_pr->num_rows() > 0){
                $this->outputData['same_jobs'] = $same_pr;
            }

            //list worker available
            if (isLoggedIn()) {
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
                            $getUsers = $this->m_user->getUsers($conditions_users,NULL,$limit_user,$order_user,NULL,$this->outputData['jobs']->category_ids);
                            //resume
                            if($getUsers->num_rows()>0){
                                $this->outputData['getUsers']=$getUsers;
                                //list job_invitation
                                $jobInvitation=$this->m_user->getUsersJobInvitation();
                                if($jobInvitation->num_rows()>0){
                                    $this->outputData['jobInvitation']=$jobInvitation;
                                }
                                $conditions = array('resume.user_id' => $this->outputData['getUsers']->row()->id, 'resume.status' => 2);
                                $this->outputData['getResume'] = $this->m_resume->getResume($conditions);
                            }
                        }
                    }
                }
            }
            //get job apply
            if (isLoggedIn()) {
                $user_id=$this->loggedInUser->id;
                $conditionsApplyAll=array('job_apply.worker_id'=>$user_id);
                $getApplyAll=$this->m_job->getApply($conditionsApplyAll);
                $this->outputData['getApplyAll']=$getApplyAll;
            }

            /**
             * Duy Thieu
             * Updated: 11/06/2015
             * update hits job
             */
            if(!$this->session->userdata('timeout_hits') || time() >= $this->session->userdata('timeout_hits')){
                $views = $this->outputData['jobs']->views + 1;
                $this->session->set_userdata('timeout_hits', time() + 60);
                $this->m_job->updateJob(array('jobs.id' => $this->outputData['jobs']->id), array('jobs.views' => $views));
            }
        }
        else{
            redirect();
        }
        $this->load->view('job/detailJobs', $this->outputData);
    }

    function previewJobs($job_id){
        $this->lang->load('enduser/common', $this->my_config->item('language_code'));

        $this->load->library('encrypt');
        $this->outputData['default_skill_invoice'] = $this->my_config->item('default_skill_invoice');
        $params = get_params();
        $this->outputData['params'] = $params;
        $condition = array(
            'jobs.id' => $job_id,
            'jobs.status'=>0
        );
        $jobs = $this->m_job->getJobs($condition);
        if($jobs->num_rows() > 0){
            $this->outputData['jobs'] = $jobs->row();
            $creatorInfo = getUserInfo($this->outputData['jobs']->user_id);

            if($creatorInfo != ''){
                $this->outputData['creatorInfo'] = $creatorInfo;
            }
            $limit=array(5,0);
            $condition=array('jobs.user_id'=>$this->outputData['jobs']->user_id,'jobs.id !='=>$job_id);
            $this->outputData['sameToJobs']=$this->m_job->sameToJobs($condition,null,null,$limit);

            //get job apply
            if (isLoggedIn()) {

                $user_id=$this->loggedInUser->id;
                $conditionsApply=array('job_apply.worker_id'=>$user_id,'job_apply.job_id'=>$job_id);
                $getApply=$this->m_job->getApply($conditionsApply);
                $this->outputData['getApply']=$getApply;
            }

            //list worker available
            if (isLoggedIn()) {
                $conditions_jobs=array('jobs.user_id'=>$user_id,'jobs.id'=>$job_id);
                $getJobs=$this->m_job->getJobs($conditions_jobs);
                if($getJobs->num_rows()>0){
                    //check expired_at of services
                    $condition_job_service_extension=array('job_service_extension.job_id'=>$job_id,'job_service_extension.service_id'=>6);
                    $getServiceExtension=$this->m_job->getServiceExtension($condition_job_service_extension);
                    if($getServiceExtension->num_rows()>0) {
                        if (strtotime($getServiceExtension->row()->expired_at) >= time()) {
                            $conditions_users = array('users.is_available' => 1);
                            $this->outputData['getUsers'] = $this->m_user->getUsers($conditions_users);
                            //resume
                            $conditions = array('resume.user_id' => $this->outputData['getUsers']->row()->id, 'resume.status' => 2);
                            $this->outputData['getResume'] = $this->m_resume->getResume($conditions);
                        }
                    }
                }
            }


        }
        else{
            redirect();
        }
        $this->load->view('job/previewJobs', $this->outputData);
    }

    function ajaxApplyJobOnline(){

        $this->load->library('encrypt');
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->helper('form');
        //echo $token = $this->encrypt->encode('job/binh@applancer.net');die;
        $params = get_params();
        if(!isLoggedIn());
        else{
            $condition = array('users.id' => $this->loggedInUser->id);
            $userInfo = $this->m_user->getUsers($condition)->row();
            if($userInfo->active_email!=1){
                echo json_encode(array('result'=>'error','msg'=>'not active'));
            }
            elseif($userInfo->role_id!=1){
                echo json_encode(array('result'=>'error','msg'=>'not role'));
            }
            else{
                $job_id=$this->encrypt->decode($params['idJobs']);
                $user_id=$this->loggedInUser->id;
                if(!is_numeric($user_id) || $job_id < 0){
                    echo json_encode(array('result'=>'error'));
                }else{
                    $condition = array(
                        'jobs.id' => $job_id,
                        'jobs.status'=>1
                    );
                    $jobs = $this->m_job->getJobs($condition);

                    if($jobs->num_rows() == 0){
                        echo json_encode(array('result'=>'error'));
                    }
                }
                if ($this->input->post('applySendProcessBtn')) {
                    $insertApply = array();
                    //upload images
                    if($this->input->post('resumeApply',TRUE)==2){
                        $this->check_file('resumeFile');
                        $insertApply['is_resume']   = 2;
                        $insertApply['cv']   = $_FILES['resumeFile']['name'];//$attachment_pdf=$filename;
                        $attachment_pdf = ROOT_PATH . '/files/jobseeker/CV/'.date('Y', time()).'/'.date('m',time()).'/'.$insertApply['cv'];
                        //echo $attachment_pdf;
                        $this->email->files = $attachment_pdf;
                        $this->email->namefile=$insertApply['cv'];
                        // $this->email->tmp_name='resumeFile';
                    }
                    else{
                        $insertApply['is_resume']   = 1;
                        $insertApply['resume_id']   = $this->encrypt->decode($this->input->post('onlineResumeId',TRUE));
                    }
                    $conditionsJob=array('jobs.id'=>$job_id,'jobs.status'=>1);
                    $getJobs=$this->m_job->getJobs($conditionsJob);
                    $conditions = array('users.id' => $getJobs->row()->user_id);
                    $getUsers = $this->m_user->getUsers($conditions)->row();
                    //getuser apply
                    $conditions_apply = array('users.id' => $user_id);
                    $getUsersApply = $this->m_user->getUsers($conditions_apply)->row();
                    $insertApply['worker_id']   = $user_id;
                    $insertApply['job_id']         = $job_id;
                    $insertApply['app_title']         = $this->input->post('inputAppJobTitle',TRUE);
                    $insertApply['app_company']         = $this->input->post('inputAppCompanyName',TRUE);
                    $insertApply['app_location']         = $this->input->post('inputAppExpectedLocation',TRUE);
                    $insertApply['app_phone']         = $this->input->post('inputAppPhoneNumber',TRUE);
                    $insertApply['introtext']         = $this->input->post('coverLetter',TRUE);
                    $insertApply['date_created']         = date(DATETIME_FORMAT_DB,time());
                    $insertApply['status']         = 0;
                    $id=$this->m_job->addApply($insertApply);

                    // send mail for worker
                    $paramSubject = array(
                     '!company' => displayUserName($getUsers->user_name,$getUsers->company)
                    );

                    //your skills
                    $listMatchingCategories='';
                    $salary='';
                    $categories = $this->m_user->getUserSkill($user_id);
                    $categories=$categories->row_array();
                    $strWhere = "jobs.status = 1 AND jobs.id !=".$job_id.""; //"AND jobs.enddate >= ".time();
                    if(isset($categories['job_categories']) && $categories['job_categories'] != ''){
                        $categoryIds = explode(',',$categories['job_categories']);
                        foreach($categoryIds as $key => $val){
                            $whereOr[] = "FIND_IN_SET({$val}, job.job_categories)";
                        }
                    }
                    if(isset($whereOr) && $whereOr != ''){
                        $strWhereOr = implode(' OR ', $whereOr);
                        $condition_job = $strWhere . ' AND (' . $strWhereOr . ')';
                    }else{
                        $condition_job = $strWhere;
                    }
                    $jobMatching = $this->m_job->getJobs($condition_job, null, null, array(3));
                    if($jobMatching->num_rows()>0) {

                        foreach ($jobMatching->result() as $item){
                            $url=site_url('detail-jobs/'.$item->alias.'-'.$item->id);
                            if($item->salary_min == 0 && $item->salary_max == 0){
                                $salary= $this->lang->line('Negtiable');
                            }else{
                                $salary .= ($item->salary_min != 0) ? formatPrice($item->salary_min) : '';
                                $salary .= ($item->salary_min != 0) ? ' - ' : ' > ';
                                $salary .= ($item->salary_max != 0) ? formatPrice($item->salary_max) : '';
                            }

                            $listMatchingCategories.='<tr>
                                <td style="padding:10px 0;font-family:Arial,sans-serif;font-size:14px;line-height:20px;color:#555;border-bottom:1px #ddd solid;width:80%">
                                    <h3 style="margin:0;font-family:Arial,sans-serif;font-size:16px">
                                                                <a href="'.$url.'" style="font-family:arial,sans-serif;text-decoration:none;color:#00b9f2" target="_blank">'.$item->title.'</a></h3>
                                    <span style="font-family:Arial,sans-serif;font-size:13px;line-height:22px">'.displayUserName($item->user_name,$item->company).'</span>
                                    <br>
                                    <span style="color:#999;font-family:Arial,sans-serif;font-size:13px">'.$this->lang->line('Salary').':&nbsp;<strong>'.$salary.'</strong>&nbsp;|&nbsp;Ngày Đăng Tuyển:&nbsp;'.date('d-m-Y',strtotime($item->date_created)).'</span></td>
                                <td style="padding:0;vertical-align:top;border-bottom:1px #ddd solid;width:20%">
                                    <table align="right" border="0" cellpadding="0" cellspacing="0" style="margin:15px auto">
                                        <tbody>
                                            <tr>
                                                <td bgcolor="#ebebeb" style="padding:10px 18px;border:1px #d8d8d8 solid;border-radius:3px;text-align:center">
                                                    <a href="'.$url.'" style="font-family:Arial,sans-serif;font-size:14px;font-weight:bold;color:#666;text-decoration:none;display:inline-block" target="_blank">'.$this->lang->line('Apply now').'</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>';
                        }
                    }
                    $paramBody = array(
                     '!title' => $getJobs->row()->title,
                     '!company' => displayUserName($getUsers->user_name,$getUsers->company),
                     '!user_name' => displayUserName($getUsersApply->user_name,$getUsersApply->display_name_resume),
                     '!listMatchingCategories' =>$listMatchingCategories,
                     '!url_home' => site_url(),
                     '!images'=>base_url().'app/css/images/logo_new.png'
                    );
                    $this->email->mailFrom = "no-reply@topdev.vn";
                    $this->email->mailTo = $getUsersApply->email;
                    $this->email->templateType = 'worker_apply';
                    $this->email->paramSubject = $paramSubject;
                    $this->email->paramBody = $paramBody;
                    //$this->email->files = $attachment_pdf;
                    $this->email->sendMail();

                    // send mail for employer
                    $paramSubject = array(
                     '!jobseekername' => displayUserName($getUsersApply->user_name,$getUsersApply->display_name_resume),
                     '!jobname' => $getJobs->row()->title,
                    );
                    $paramBody = array(
                     '!content' => nl2br($insertApply['introtext']),
                     '!url_home' => site_url(),
                     '!images'=>base_url().'app/css/images/logo_new.png'
                    );

                    $this->email->mailFrom = "no-reply@topdev.vn";
                    $this->email->mailTo = $getUsers->email;
                    $this->email->templateType = 'job_apply';
                    $this->email->paramSubject = $paramSubject;
                    $this->email->paramBody = $paramBody;
                    $this->email->sendMail();
                    addNotification($this->loggedInUser->id,$getUsers->id,2,$job_id);
                    $this->session->set_userdata('success_message',setMessage('success', 'Xin chúc mừng! Hồ sơ ứng tuyển của bạn đã được gửi thành công đến nhà tuyển dụng.'));
                    echo json_encode(array('result'=>'succees'));
                }
            }
        }
    }

    function referral(){
        $this->load->library('encrypt');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->helper('form');

        $params = get_params();
        $customer_id = $this->encrypt->decode($params['token']);
        $job_id = $this->uri->segment(3,0);

        if(!is_numeric($customer_id) || $job_id < 0){
            $this->session->set_flashdata('flash_message', setMessage('error', 'Link invalid. Please return to home page.'));
            redirect(URL.'job/confirm');
        }else{
            $condition = array(
                'jobs.id' => $job_id
            );
            $jobs = $this->m_job->getJobs($condition);

            if($jobs->num_rows() == 0){
                $this->session->set_flashdata('flash_message', setMessage('error', 'Link invalid. Please return to home page.'));
                redirect(URL.'job/confirm');
            }
        }

        if(RE_CAPTCHA != 1){
            $this->load->helper('captcha');

            // load captcha
            $vals = array(
                'img_path'	 => APPPATH.'../files/captcha/images/',
                'img_url'	 => base_url().'/files/captcha/images/',
                'font_path'	 => APPPATH.'../files/captcha/fonts/AHGBold.ttf',
                'img_width'	 => '170',
                'img_height' => '47',
                'expiration' => 7200
            );
            $cap = create_captcha($vals);

            $data = array(
                'captcha_time'	=> $cap['time'],
                'ip_address'	=> $this->input->ip_address(),
                'word'	 => $cap['word']
            );
            $this->load->model('captcha_model');
            $b_SaveData = $this->captcha_model->saveData($data);
            $this->outputData['captcha'] = $cap['image'];
        }
        $default_exp = $this->my_config->item('default_exp');
        $default_skills = $this->my_config->item('default_skills');
        $this->outputData['year_exp'] = $year_exp = ($this->input->post('year_exp', TRUE))?$this->input->post('year_exp', TRUE):'';
        $this->outputData['sector'] = ($this->input->post('sector', TRUE))?$this->input->post('sector', TRUE):'';

        $this->form_validation->set_error_delimiters($this->my_config->item('field_error_start_tag'), $this->my_config->item('field_error_end_tag'));

        if ($this->input->post('workerConfirm')) {
            $this->form_validation->set_rules('email', 'lang:email_valid_exists', 'required|trim|valid_email|xss_clean');
            $this->form_validation->set_rules('fullname', 'lang:fullname_required', 'required|trim|xss_clean');
            $this->form_validation->set_rules('phone', 'lang:phone_required', 'required|trim|xss_clean');
            $this->form_validation->set_rules('year_exp', 'lang:year_exp_required', 'required|trim|xss_clean');
            $this->form_validation->set_rules('fullname_referral', 'lang:fullname_required', 'required|trim|xss_clean');
            $this->form_validation->set_rules('email_referral', 'lang:email_valid_exists', 'required|trim|valid_email|xss_clean|callback__check_email_referral');
            $this->form_validation->set_rules('phone_referral', 'lang:phone_required', 'required|trim|xss_clean');

            if(RE_CAPTCHA == 1){
                $this->form_validation->set_rules('g-recaptcha-response','lang:captcha_validation','required|trim|xss_clean|callback_reCaptchaCheck');
            }else{
                $this->form_validation->set_rules('captcha','lang:captcha_validation','required|trim|xss_clean|callback_captchaCheck');
            }


            if ($this->form_validation->run() == TRUE) {
                $email = $this->input->post('email', TRUE);
                $workers = $this->workers_model->getWorkers(array('workers.email' => $email));

                $workerData = array();
                $workerData['fullname'] = $user_worker = $this->input->post('fullname', TRUE);
                $workerData['email']    = $email_worker = $this->input->post('email', TRUE);
                $workerData['phone']    = $this->input->post('phone', TRUE);

                if($workers->num_rows() > 0){
                    $worker = $workers->row();
                    $worker_id = $worker->id;

                    $this->workers_model->updateWorker(array('id' => $worker_id), $workerData);
                }else{
                    $worker_id = $this->workers_model->addWorker($workerData);
                }

                if($worker_id > 0){
                    $email_referral = $this->input->post('email_referral', TRUE);
                    $referrals = $this->workers_model->getWorkerReferral(array('worker_referral.email' => $email_referral));

                    if($referrals->num_rows() == 0) {
                        $updateData = array();
                        $updateData['worker_id'] = $worker_id;
                        $updateData['fullname']  = $referral_user = $this->input->post('fullname_referral', TRUE);
                        $updateData['email'] = $referral_email = $this->input->post('email_referral', TRUE);
                        $updateData['phone'] = $this->input->post('phone_referral', TRUE);
                        $updateData['year_exp'] = $this->input->post('year_exp', TRUE);
                        $updateData['sector'] = implode(',', $this->input->post('sector', TRUE));
                        $updateData['type'] = 1;
                        $referral_id = $this->workers_model->addWorkerReferral($updateData);
                    }else{
                        $referral = $referrals->row();
                        $referral_id = $referral->id;
                        $referral_email = $referral->email;
                        $referral_user = $referral->fullname;
                    }

                    $insertReferralData = array(
                        'worker_id' => $worker_id,
                        'developer_id' => $referral_id,
                        'customer_id' => $customer_id,
                        'job_id' => $job_id,
                    );
                    $this->m_job->addjobReferral($insertReferralData);

                    $job = $this->m_job->getJobs(array('jobs.id' => $job_id))->row();

                    // send mail for referral
                    $token =  $this->encrypt->encode($customer_id);
                    $link_apply = site_url('job/apply/'.$job_id.'/?ref='.$referral_id.'&token=' . $token);
                    $link_detail_job = site_url('job/detailJobs/'.$job_id.'/?ref='.$referral_id   .'&token=' . $token);

                    $paramSubject = array(
                        '!user_name' => $referral_user,
                        '!user_name_referral' => $user_worker,
                    );
                    $paramBody = array(
                        '!user_name' =>  $referral_user,
                        '!user_name_referral' =>  $user_worker,
                        '!job_title' =>  $job->title,
                        '!link_detail_job' =>  $link_detail_job,
                        '!link' => $link_apply,
                    );

                    $this->email->mailFrom = "no-reply@applancer.net";
                    $this->email->mailTo = $referral_email;
                    $this->email->templateType = 'job_apply_referral';
                    $this->email->paramSubject = $paramSubject;
                    $this->email->paramBody = $paramBody;
                    $this->email->sendMail();

                    // send mail for worker
                    $token = $this->encrypt->encode('job/'.$email_worker);
                    $link = 'http://referral.applancer.net/index.php/job/viewReferral/?token='.$token;

                    $paramSubject = array(
                        '!user_name' => $user_worker,
                        '!user_name_referral' => $referral_user,
                    );
                    $paramBody = array(
                        '!user_name' => $user_worker,
                        '!user_name_referral' => $referral_user,
                        '!job_title' => $job->title,
                        '!link' => $link,
                    );

                    $this->email->mailFrom = "no-reply@applancer.net";
                    $this->email->mailTo = $email_worker;
                    $this->email->templateType = 'job_worker_referral';
                    $this->email->paramSubject = $paramSubject;
                    $this->email->paramBody = $paramBody;
                    $this->email->sendMail();

                    $link_referral_continue = '<a href="'.site_url('job/referral/'.$job_id.'/?token='.$this->encrypt->encode($customer_id)).'">Click here</a>';
                    $this->session->set_flashdata('flash_message', setMessage('success', 'Thank you for submitting. '.$link_referral_continue.' to go for the next referee.'));
                    redirect(URL.'job/confirm');
                }
            }
        }

        $this->load->view('job/referral', $this->outputData);
    }

    function ajaxCreateResumeOnline(){
        
        $this->load->library('encrypt');
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('m_cities');
        $updateData = array();
        if(!$this->loggedInUser->id){
            echo json_encode(array('result'=>'error','msg'=>'not login'));die;
        }
        if($this->input->post('action',TRUE)){
            $action=$this->input->post('action',TRUE);
            if($action='delete-employment-history'){
                $idResumeExperiences=$this->encrypt->decode($this->input->post('idResumeExperiences',TRUE));
                $idResume=$this->encrypt->decode($this->input->post('idResume',TRUE));

                $conditions=array('resume_experiences.resume_id'=>$idResume,'resume_experiences.id'=>$idResumeExperiences);
                $this->m_resume_experience->deleteResumeExperience(null,$conditions);
            }
            if($action='delete-education-history'){
                $idResumeEducations=$this->encrypt->decode($this->input->post('idResumeEducations',TRUE));
                $idResume=$this->encrypt->decode($this->input->post('idResume',TRUE));

                $conditions=array('resume_educations.resume_id'=>$idResume,'resume_educations.id'=>$idResumeEducations);
                $this->m_resume_education->deleteResumeEducation(null,$conditions);
            }
            die;
        }
        $params = get_params();
        if(isset($params['id'])) {
            $idResume=$params['id'];
            $idResume=$this->encrypt->decode($idResume);
        }
        $updateData['user_id'] = $this->loggedInUser->id;
        if ($this->input->post('saveContactInforBtn',TRUE)) {
            $arrayBirthday=explode('/', $this->input->post('birthday', TRUE));
            $updateData['birthday']=strtotime($arrayBirthday[2].'-'.$arrayBirthday[1].'-'.$arrayBirthday[0]);
            $updateData['gender'] = $this->input->post('gender', TRUE);
            $updateData['marital'] = $this->input->post('marital', TRUE);
            $updateData['address'] = $this->input->post('address', TRUE);
            $updateData['country'] = $this->input->post('country', TRUE);
            $updateData['city'] = $this->input->post('city_infomation', TRUE);
            $updateData['district'] = $this->input->post('district', TRUE);
            $updateData['cellphone'] = $this->input->post('cellphone', TRUE);
            $updateData['visible_to_employer'] = $this->input->post('visible_to_employer', TRUE);
            
        }
        if ($this->input->post('saveSummaryInforBtn',TRUE)) {
            $updateData['yearOfExperience'] = $this->input->post('yearOfExperience', TRUE);
            $updateData['no_experience'] = $this->input->post('no-experience-check-box', TRUE);
            $updateData['education'] = $this->input->post('education', TRUE);
            $updateData['recentCompany'] = $this->input->post('recentCompany', TRUE);
            $updateData['recentPosition'] = $this->input->post('recentPosition', TRUE);
            $updateData['currentJobLevel'] = $this->input->post('currentJobLevel', TRUE);
            $updateData['expectedJobLevel'] = $this->input->post('expectedJobLevel', TRUE);
            $updateData['expectedPosition'] = $this->input->post('expectedPosition', TRUE);
            $updateData['location'] = implode(',',$this->input->post('city', TRUE));
            $updateData['job'] = implode(',',$this->input->post('skills', TRUE));
            $updateData['expectedSalaryRange'] = $this->input->post('expectedSalaryRange', TRUE);
            $updateData['expected_salary'] = $this->input->post('expected_salary', TRUE);
            //delete before insert Language
            $deleteDataLanguage=array();
            $deleteDataLanguage['resume_languages.resume_id']=$idResume;
            $this->m_resume_language->deleteResumeLanguage(null,$deleteDataLanguage);
            //insert Language
            for($i=1;$i<=3;$i++){
                if($this->input->post('language'.$i.'', TRUE)!=''){
                    $insertDataLanguage=array();
                    $insertDataLanguage['resume_id']=$idResume;
                    $insertDataLanguage['language_id']=$this->input->post('language'.$i.'', TRUE);
                    $insertDataLanguage['language_level_id']=$this->input->post('language-level'.$i.'', TRUE);
                    $this->m_resume_language->addResumeLanguage($insertDataLanguage);
                }
            }
        }  
        if ($this->input->post('saveProfile',TRUE)) {
            $updateData['profile'] = $this->input->post('profile', TRUE);
        } 
        //EmploymentHistory
        if ($this->input->post('saveEmploymentHistory',TRUE)) {
            $insertDataExperience=array();
            $insertDataExperience['resume_id'] = $idResume;
            $insertDataExperience['position_experiences'] = $this->input->post('position_experiences', TRUE);
            $insertDataExperience['companyName_experiences'] = $this->input->post('companyName_experiences', TRUE);
            if($this->input->post('fromDate_experiences', TRUE)){
                $arrayfromDate_experience=explode('/', $this->input->post('fromDate_experiences', TRUE));
                $insertDataExperience['fromDate_experiences']=strtotime($arrayfromDate_experience[1].'-'.$arrayfromDate_experience[0]);
            }
            if($this->input->post('toDate_experiences', TRUE)){
                $arraytoDate_experience=explode('/', $this->input->post('toDate_experiences', TRUE));
                $insertDataExperience['toDate_experiences']=strtotime($arraytoDate_experience[1].'-'.$arraytoDate_experience[0]);
            }
            $insertDataExperience['description_experiences'] = $this->input->post('description_experience', TRUE);
            $insertDataExperience['date_created'] = time();

            //check validation 
            $arrayError=array('result'=>'error');
            $flagError=0;
            if($insertDataExperience['position_experiences']==''){
                $arrayError['position_experiences']=1;
                $flagError=1;
            }
            if($insertDataExperience['companyName_experiences']==''){
                $arrayError['companyName_experiences']=1;
                $flagError=1;
            }
            //check fromdate todate
            if($this->input->post('toDate_experiences', TRUE)){
                if(!$this->input->post('fromDate_experiences', TRUE)){
                    $arrayError['fromDate_experiences']=1;
                    $flagError=1;
                }
            }
            if($this->input->post('fromDate_experiences', TRUE)){
                if(!$this->input->post('toDate_experiences', TRUE)){
                    $arrayError['toDate_experiences']=1;
                    $flagError=1;
                }
            }
            if($this->input->post('fromDate_experiences', TRUE) && $this->input->post('toDate_experiences', TRUE)){
                if($insertDataExperience['fromDate_experiences']>=$insertDataExperience['toDate_experiences']){
                    $arrayError['fromDate_experiences_toDate_experiences']=1;
                    $flagError=1;
                }
            }
            //check date
            if($flagError==1){
                echo json_encode($arrayError);die;
            }
            $this->m_resume_experience->addResumeExperience($insertDataExperience);
        }
        if ($this->input->post('updateSaveEmploymentHistory',TRUE)) {
            $updateDataExperience=array();
            $idResumeExperiences=$this->encrypt->decode($this->input->post('idResumeExperiences',TRUE));
            $updateDataExperience['position_experiences'] = $this->input->post('position_experiences', TRUE);
            $updateDataExperience['companyName_experiences'] = $this->input->post('companyName_experiences', TRUE);
            if($this->input->post('fromDate_experiences', TRUE)){
                $arrayfromDate_experience=explode('/', $this->input->post('fromDate_experiences', TRUE));
                $updateDataExperience['fromDate_experiences']=strtotime($arrayfromDate_experience[1].'-'.$arrayfromDate_experience[0]);
            }
            if($this->input->post('toDate_experiences', TRUE)){
                $arraytoDate_experience=explode('/', $this->input->post('toDate_experiences', TRUE));
                $updateDataExperience['toDate_experiences']=strtotime($arraytoDate_experience[1].'-'.$arraytoDate_experience[0]);
            }
            $updateDataExperience['description_experiences'] = $this->input->post('description_experiences', TRUE);
            $updateDataExperience['date_created'] = time();


            //check validation 
            $arrayError=array('result'=>'error');
            $flagError=0;
            if($updateDataExperience['position_experiences']==''){
                $arrayError['position_experiences']=1;
                $flagError=1;
            }
            if($updateDataExperience['companyName_experiences']==''){
                $arrayError['companyName_experiences']=1;
                $flagError=1;
            }
            //check fromdate todate
            if($this->input->post('toDate_experiences', TRUE)){
                if(!$this->input->post('fromDate_experiences', TRUE)){
                    $arrayError['fromDate_experiences']=1;
                    $flagError=1;
                }
            }
            if($this->input->post('fromDate_experiences', TRUE)){
                if(!$this->input->post('toDate_experiences', TRUE)){
                    $arrayError['toDate_experiences']=1;
                    $flagError=1;
                }
            }
            if($this->input->post('fromDate_experiences', TRUE) && $this->input->post('toDate_experiences', TRUE)){
                if($updateDataExperience['fromDate_experiences']>=$updateDataExperience['toDate_experiences']){
                    $arrayError['fromDate_experiences_toDate_experiences']=1;
                    $flagError=1;
                }
            }
            //check date
            if($flagError==1){
                echo json_encode($arrayError);die;
            }


            $updateDataExperienceKey=$idResumeExperiences;
            $this->m_resume_experience->updateResumeExperience($updateDataExperienceKey,$updateDataExperience);
        }
        //end EmploymentHistory
        //EducationHistory
        if ($this->input->post('saveEducationHistory',TRUE)) {
            $insertDataEducation=array(); 
            $insertDataEducation['resume_id'] = $idResume;
            $insertDataEducation['subject_educations'] = $this->input->post('subject_educations', TRUE);
            $insertDataEducation['school_educations'] = $this->input->post('school_educations', TRUE);
            $insertDataEducation['qualification_educations'] = $this->input->post('qualification_educations', TRUE);

            if($this->input->post('fromDate_educations', TRUE)){
                $arrayfromDate_educations=explode('/', $this->input->post('fromDate_educations', TRUE));
                $insertDataEducation['fromDate_educations']=strtotime($arrayfromDate_educations[1].'-'.$arrayfromDate_educations[0]);
            }
            if($this->input->post('toDate_educations', TRUE)){
                $arraytoDate_educations=explode('/', $this->input->post('toDate_educations', TRUE));
                $insertDataEducation['toDate_educations']=strtotime($arraytoDate_educations[1].'-'.$arraytoDate_educations[0]);
            }

            $insertDataEducation['description_educations'] = $this->input->post('description_educations', TRUE);
            $insertDataEducation['date_created'] = time();

            //check validation 
            $arrayError=array('result'=>'error');
            if($insertDataEducation['subject_educations']==''){
                $arrayError['subject_educations']=1;
            }
            if($insertDataEducation['school_educations']==''){
                $arrayError['school_educations']=1;
            }
            if($insertDataEducation['qualification_educations']==''){
                $arrayError['qualification_educations']=1;
            }
            if($insertDataEducation['subject_educations']=='' || $insertDataEducation['school_educations']=='' || $insertDataEducation['qualification_educations']==''){
                echo json_encode($arrayError);die;
            }
            $this->m_resume_education->addResumeEducation($insertDataEducation);
        }
        if ($this->input->post('updateSaveEducationHistory',TRUE)) {
            $updateDataEducation=array();
            $idResumeEducations=$this->encrypt->decode($this->input->post('idResumeEducations',TRUE));
            $updateDataEducation['subject_educations'] = $this->input->post('subject_educations', TRUE);
            $updateDataEducation['school_educations'] = $this->input->post('school_educations', TRUE);
            $updateDataEducation['qualification_educations'] = $this->input->post('qualification_educations', TRUE);
            if($this->input->post('fromDate_educations', TRUE)){
                $arrayfromDate_educations=explode('/', $this->input->post('fromDate_educations', TRUE));
                $updateDataEducation['fromDate_educations']=strtotime($arrayfromDate_educations[1].'-'.$arrayfromDate_educations[0]);
            }
            if($this->input->post('toDate_educations', TRUE)){
                $arraytoDate_educations=explode('/', $this->input->post('toDate_educations', TRUE));
                $updateDataEducation['toDate_educations']=strtotime($arraytoDate_educations[1].'-'.$arraytoDate_educations[0]);
            }

            $updateDataEducation['description_educations'] = $this->input->post('description_educations', TRUE);

            //check validation 
            $arrayError=array('result'=>'error');
            $flagError=0;
            if($updateDataEducation['subject_educations']==''){
                $arrayError['subject_educations']=1;
                $flagError=1;
            }
            if($updateDataEducation['school_educations']==''){
                $arrayError['school_educations']=1;
                $flagError=1;
            }
            if($updateDataEducation['qualification_educations']==''){
                $arrayError['qualification_educations']=1;
                $flagError=1;
            }
            //check fromdate todate
            if($this->input->post('fromDate_educations', TRUE)){
                if(!$this->input->post('fromDate_educations', TRUE)){
                    $arrayError['fromDate_educations']=1;
                    $flagError=1;
                }
            }
            if($this->input->post('toDate_educations', TRUE)){
                if(!$this->input->post('toDate_educations', TRUE)){
                    $arrayError['toDate_educations']=1;
                    $flagError=1;
                }
            }
            if($this->input->post('fromDate_educations', TRUE) && $this->input->post('toDate_educations', TRUE)){
                if($updateDataEducation['fromDate_educations']>=$updateDataEducation['toDate_educations']){
                    $arrayError['fromDate_educations_toDate_educations']=1;
                    $flagError=1;
                }
            }
            //check date
            if($flagError==1){
                echo json_encode($arrayError);die;
            }

            $updateDataEducationKey=$idResumeEducations;
            $this->m_resume_education->updateResumeEducation($updateDataEducationKey,$updateDataEducation);
        }
        if ($this->input->post('publishResume',TRUE)) {
            $updateData['status'] = 1;
            $updateData['accept_search'] = $this->input->post('accept_search',TRUE);
        }
        //end educationHistory
        $updateKey=array('resume.id'=>$idResume);
        $updateData['date_created'] = DATETIME_FORMAT_DB;
        $updateData['update_at'] = DATETIME_FORMAT_DB;
        $this->m_resume->updateResume($updateKey,$updateData);
        $updateData['birthday'] = $this->input->post('birthday', TRUE);
        $updateData['fromDate_experiences'] = $this->input->post('fromDate_experiences', TRUE);
        $updateData['toDate_experiences'] = $this->input->post('toDate_experiences', TRUE);
        $updateData['fromDate_educations'] = $this->input->post('fromDate_educations', TRUE);
        $updateData['toDate_educations'] = $this->input->post('toDate_educations', TRUE);
        $updateData['school_educations'] = $this->input->post('school_educations', TRUE);
        echo json_encode($updateData);
    }

    function priceList(){
        $this->load->library('encrypt');
        $this->load->library('email');
        $this->load->library('payments');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('m_cities');
        $this->load->model('invoices_model');

        $params = get_params();
        $customer_id = $this->encrypt->decode($params['token']);

        if(!is_numeric($customer_id)){
            redirect(URL.'job/confirm');
        }

        if(!$this->session->userdata('job_insert_data')){
            redirect(site_url('job/post-job/?token='.$params['token']));
        }

        $this->form_validation->set_error_delimiters($this->my_config->item('field_error_start_tag'), $this->my_config->item('field_error_end_tag'));

        if ($this->input->post('btn_payment')) {
            $this->form_validation->set_rules('package_id', 'lang:package_id', 'required|trim|xss_clean');
            $insertData = $this->session->userdata('job_insert_data');

            if ($this->form_validation->run() == TRUE) {

                //$insertData['type'] = 1;
                $package_id = $this->input->post('package_id', TRUE);

                // && $insertData['email'] != 'ngoc.do@applancer.net'
                if($package_id == 2 && $insertData['email'] != 'ngoc.do@applancer.net'){
                    $condition_package =  array('job_packages.id' => $package_id);
                    $package = $this->m_job->getPackages($condition_package)->row();
                    //$amount = convertUSDtoVND($package->fee);
                    $amount = 12000;

                    // add user
                    $users = $this->m_job->getUsers(array('job_users.email' => $insertData['email']));
                    if($users->num_rows() > 0){
                        $user = $users->row();
                        $user_id = $user->id;
                    }else{
                        $insertUser = array(
                            'email' => $insertData['email'],
                            'phone' => $insertData['phone'],
                            'role_id' => 2,
                        );

                        $user_id = $this->m_job->addUser($insertUser);
                    }

                    //add job
                    $insertData['user_id'] = $user_id;
                    $insertData['package_id'] = $package_id;
                    $insertData['customer_id'] = $customer_id;
                    $insertData['payment_status'] = 0;
                    $insertData['date_expiration'] = date(DATETIME_FORMAT_DB, time() + (30 * 24 * 60 *60));
                    unset($insertData['email']);
                    unset($insertData['phone']);

                    $job_id = $this->m_job->addJob($insertData);
                    $this->session->unset_userdata('job_insert_data');

                    // ghi log
                    $logData = array(
                        'user_id' => $user_id,
                        'type' => "APPOTA",
                        'description' => "Thanh toan qua appota",
                        'amount' => $amount,
                        'ip_address' => $this->input->ip_address(),
                        'portal' => $_SERVER['HTTP_HOST'],
                        'created' => date('Y-m-d', time()),
                        'created_time' => date('H:s:i', time())
                    );
                    $transaction_id = $this->m_job->addTransaction($logData);

                    //payment appota
                    $param_appota = array(
                        'state' => $transaction_id,
                        'target' => $job_id,
                        'amount' => $amount,
                        'notice_url' => site_url_none_suffix('job/paymentCallBack'),
                        'success_url' => site_url_none_suffix('job/paymentConfirm2/?type=1&token='.$this->encrypt->encode($job_id)),
                        'error_url' => site_url_none_suffix('job/paymentConfirm2/?type=2&token='.$this->encrypt->encode($job_id)),
                    );

                    $this->payments->appota->params = $param_appota;
                    //$this->session->set_userdata('params', $params);

                    if ($this->payments->appota->payment_bank()) {
                        redirect($this->payments->appota->httpResponseArray->data->options[1]->url);
                    }else{
                        $this->session->set_flashdata('flash_message', setMessage('error', $this->payments->appota->httpResponseArray->message));
                        redirect(URL.'job/price-list/?token=' . $params['token']);
                    }
                }else {
                    // add user
                    $users = $this->m_job->getUsers(array('job_users.email' => $insertData['email']));
                    if($users->num_rows() > 0){
                        $user = $users->row();
                        $user_id = $user->id;
                    }else{
                        $insertUser = array(
                            'email' => $insertData['email'],
                            'phone' => $insertData['phone'],
                            'role_id' => 2,
                        );

                        $user_id = $this->m_job->addUser($insertUser);
                    }

                    // add job
                    $insertData['user_id'] = $user_id;
                    $insertData['customer_id'] = $customer_id;
                    $insertData['package_id'] = $this->input->post('package_id', TRUE);
                    $insertData['date_expiration'] = date(DATETIME_FORMAT_DB, time() + (30 * 24 * 60 *60));
                    $insertData['payment_status'] = 1;
                    unset($insertData['email']);
                    unset($insertData['phone']);

                    $this->m_job->addJob($insertData);

                    // send mail for user
                    $token = $this->encrypt->encode('job/' . $insertData['email']);
                    $link = 'http://referral.applancer.net/index.php/job/viewJobs/?token=' . $token;

                    $user_name = explode('@', $insertData['email']);
                    $paramSubject = array(
                        '!user_name' => $user_name[0],
                    );
                    $paramBody = array(
                        '!user_name' => $user_name[0],
                        '!link' => $link,
                    );

                    $this->email->mailFrom = "no-reply@applancer.net";
                    $this->email->mailTo = $insertData['email'];
                    $this->email->templateType = 'job_post_job';
                    $this->email->paramSubject = $paramSubject;
                    $this->email->paramBody = $paramBody;
                    $this->email->sendMail();

                    // send mail for customer
                    $user = $this->m_job->getUsers(array('id' => $customer_id))->row();

                    $token_customer = $this->encrypt->encode('job_user/' . $user->email);
                    $link_customer = 'http://referral.applancer.net/index.php/job/viewJobs/?token=' . $token_customer;

                    $paramSubject = array(
                        '!user_name' => $user->full_name,
                    );
                    $paramBody = array(
                        '!user_name' => $user->full_name,
                        '!link' => $link_customer,
                    );

                    $this->email->mailFrom = "no-reply@applancer.net";
                    $this->email->mailTo = $user->email;
                    $this->email->templateType = 'job_customer_post_job';
                    $this->email->paramSubject = $paramSubject;
                    $this->email->paramBody = $paramBody;
                    $this->email->sendMail();

                    $this->session->unset_userdata('job_insert_data');

                    $link_continue = '<a href="'.site_url('job/post-job/?token='.$this->encrypt->encode($customer_id)).'">Click here</a>';
                    $this->session->set_flashdata('flash_message', setMessage('success', 'Post job success. '.$link_continue.' to continue to post job'));
                    redirect(URL.'job/payment-confirm');
                }
            }
        }

        $this->load->view('job/priceList', $this->outputData);
    }

    function paymentConfirm(){
        $this->load->view('job/paymentConfirm', $this->outputData);
    }

    function paymentConfirm2(){
        $this->load->library('encrypt');
        $this->load->library('email');
        $params = get_params();

        $job_id = $this->encrypt->decode($params['token']);
        $fields = 'jobs.id, jobs.customer_id, job_users.id AS user_id, job_users.email';
        $job = $this->m_job->getJobs(array('jobs.id' => $job_id), $fields)->row();

        $token_cus = $this->encrypt->encode($job->customer_id);
        $link_continue = '<a href="'.site_url('job/post-job/?token='.$token_cus).'">Click here</a>';
        $mess = 'An error occurred during the payment process. '.$link_continue.' to continue to post job';
        $type_mess = 'error';
        if($params['type'] == 1){
            // send mail for user
            $token = $this->encrypt->encode('job/' . $job->email);
            $link = 'http://referral.applancer.net/index.php/job/viewJobs/?token=' . $token;

            $user_name = explode('@', $job->email);
            $paramSubject = array(
                '!user_name' => $user_name[0],
            );
            $paramBody = array(
                '!user_name' => $user_name[0],
                '!link' => $link,
            );

            $this->email->mailFrom = "no-reply@applancer.net";
            $this->email->mailTo = $job->email;
            $this->email->templateType = 'job_post_job';
            $this->email->paramSubject = $paramSubject;
            $this->email->paramBody = $paramBody;
            $this->email->sendMail();

            // send mail for customer
            $user = $this->m_job->getUsers(array('id' => $job->customer_id))->row();

            $token_customer = $this->encrypt->encode('job_user/' . $user->email);
            $link_customer = 'http://referral.applancer.net/index.php/job/viewUserjob/?token=' . $token_customer;

            $paramSubject = array(
                '!user_name' => $user->full_name,
            );
            $paramBody = array(
                '!user_name' => $user->full_name,
                '!link' => $link_customer,
            );

            $this->email->mailFrom = "no-reply@applancer.net";
            $this->email->mailTo = $user->email;
            $this->email->templateType = 'job_customer_post_job';
            $this->email->paramSubject = $paramSubject;
            $this->email->paramBody = $paramBody;
            $this->email->sendMail();

            $type_mess = 'success';
            $mess = 'Post job successfully. '.$link_continue.' to continue to post job';
        }
        $this->outputData['message'] = array('type' => $type_mess, 'message' => $mess);

        $this->load->view('job/paymentConfirm2', $this->outputData);
    }

    function confirm(){
        $this->load->view('job/confirm', $this->outputData);
    }

    function paymentCallback(){
        //load model
        $this->load->model('invoices_model');

        $this->load->helper('transaction');
        $this->load->helper('form');

        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->library('payments');
        $this->load->library('encrypt');

        //$checkout = $this->payments->appota->verify_response($_POST);

        if($this->payments->appota->verify_response($_POST)){
            $job_id = @$_POST['target'];
            $fields = 'jobs.id, jobs.customer_id, job_users.id AS user_id, job_users.email';
            $job = $this->m_job->getJobs(array('jobs.id' => $job_id), $fields)->row();

            //$amount = $_POST['amount'];

            $logData = array(
                'user_id' => $job->user_id,
                'transaction_id' => @$_POST['state'],
                'transaction_partner' => @$_POST['transaction_id'],
                'type' => 'APPOTA',
                'amount' => @$_POST['amount'],
                'currency' => @$_POST['currency'],
                'status' => @$_POST['status'],
                'order_time' => date('Y-m-d H:s:i', time()),
                //'error_code' => $this->payments->paypal->httpResponseArray['REASONCODE'],
                'portal' => $_SERVER['HTTP_HOST'],
                'created' => date('Y-m-d', time()),
                'created_time' => date('H:s:i', time())
            );

            $this->m_job->addTransactionResponse($logData);

            if($_POST['status'] == 1) {
                $updateJobs['payment_status'] = 1;

                $this->m_job->updateJob(array('jobs.id' => $job_id), $updateJobs);
            }
            $this->session->unset_userdata('params');
            $this->session->unset_userdata('job_insert_data');
        }
    }

    function _check_email($mail){
        //language file
        $this->lang->load('enduser/job', $this->my_config->item('language_code'));

        //Conditions
        $conditions = array('job_users.email' => $mail);
        $result = $this->m_job->getUsers($conditions);

        if ($result->num_rows() == 0) {
            return true;
        } else {
            $this->form_validation->set_message('_check_email', $this->lang->line('This email already exists'));
            return false;
        }
        //If end

    }

    function _check_email_referral($mail){
        //language file
        $this->lang->load('enduser/job', $this->my_config->item('language_code'));

        //Conditions
        $job_id = $this->uri->segment(3,0);
        $conditions = array('worker_referral.email' => $mail, 'job_referral.job_id' => $job_id);
        $result = $this->m_job->getWorkerReferral($conditions);

        if ($result->num_rows() == 0) {
            return true;
        } else {
            $this->form_validation->set_message('_check_email_referral', $this->lang->line('email_valid_exists'));
            return false;
        }
        //If end

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
            $config['max_size']	= 10240;
            $config['remove_spaces'] 	= TRUE;

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

    function captchaCheck(){
        $this->load->model('captcha_model');

        $captcha = $this->input->post('captcha');
        $b_Check = $this->captcha_model->check($captcha);

        if(!$b_Check)
        {
            $this->form_validation->set_message('captchaCheck', "Captcha incorrect");
            return FALSE;
        }else{
            return TRUE;
        }
    }

    function reCaptchaCheck(){
        $recaptcha = $this->input->post('g-recaptcha-response',TRUE);
        $google_url="https://www.google.com/recaptcha/api/siteverify";
        $sitekey = "6LeV9v8SAAAAAMna_OdCkSOph3tKlhY2DCBRIlo1";
        $secret='6LeV9v8SAAAAAHfKkA_gLZUZpw54nJIv2b0vfCOs';
        $ip=$_SERVER['REMOTE_ADDR'];
        $url=$google_url."?secret=".$secret."&response=".$recaptcha."&remoteip=".$ip;
        $res=$this->getCurlData($url);
        $res= json_decode($res, true);

        if($res['success']){
            return TRUE;
        }else{
            $this->form_validation->set_message('captcha', "Captcha incorrect");
            return FALSE;
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

    function getCurlData($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
        $curlData = curl_exec($curl);
        curl_close($curl);
        return $curlData;
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
            // $order=array('view_search','DESC');
            // $getCategories = $this->m_application->getCategories(NULL,NULL,NULL,NULL,$order);
            // $this->outputData['getCategories1'] = $getCategories;
            $this->load->library('encrypt');
            $this->load->library('pagination');
            $this->load->model('m_cities');
            $this->outputData['params'] = $params  = (uri_to_assoc())?uri_to_assoc():'';
            //var_dump($params);die;
            //$limit = $this->uri->segment(3, 10);
            //list jobs hot
            $conditions_jobs_hot=array('job_service_extension.service_id'=>5,'jobs.status'=>1);
            $this->outputData['getJobsHot']=$getJobsHot=$this->m_job->getJobsHot($conditions_jobs_hot);
            $stringIdHot='';
            foreach ($this->outputData['getJobsHot']->result() as $item) {
                if(!empty($stringIdHot)){
                    $stringIdHot.=','.$item->id;
                }
                else{
                    $stringIdHot.=$item->id;
                }
            }

            $this->outputData['cities'] = $this->m_cities->getCities();
            $page = isset($params['p'])?$params['p']:1;
            $page_rows = 10;
            $limit[0] = $page_rows;
            if($page > 0)
                $limit[1] = ($page-1) * $page_rows;
            else
                $limit[1] = $page * $page_rows;

            $condition = array(
                'jobs.status' => 1
            );
            // keyword search
            $stringCategories="";
            $stringEmployers='';
            if(isset($params['keywords'])){
                $keyword = urldecode($params['keywords']);
                $keywords = explode(',', $keyword);
                foreach($keywords as $key=>$value){
                    $like=array('category_name'=>$value);
                    $listCategoriesKeyword=$this->m_application->getCategory(NULL,NULL,$like);
                    foreach($listCategoriesKeyword->result() as $item){
                        if(empty($stringCategories)){
                            $stringCategories.=$item->id;
                        }
                        else{
                            $stringCategories.=','.$item->id;
                        }
                    }
                }

                //check employers
                foreach($keywords as $key=>$value){
                    $like=array('user_employers.company'=>$value);
                    $getUsers=$this->m_user->getUsers(NULL,NULL,NULL,NULL,$like);
                    foreach($getUsers->result() as $item){
                        if(empty($stringEmployers)){
                            $stringEmployers.=$item->id;
                        }
                        else{
                            $stringEmployers.=','.$item->id;
                        }
                    }
                }
            }
            if($stringCategories==""){
                $stringCategories='0';
            }
            if(!isset($params['keywords'])){
                $stringCategories="";
            }
            if($stringEmployers==""){
                $stringEmployers='0';
            }
            if(!isset($params['keywords'])){
                $stringEmployers="";
            }

            //echo $stringEmployers;

            //update view search categories
            $arrayCategories=explode(',',$stringCategories);
            foreach($arrayCategories as $key=>$value){
                $getCategories=$this->m_application->getCategories(array('categories.id'=>$value,'categories.is_active'=>1));
                if($getCategories->num_rows()>0) {
                    $this->m_application->updateCategory($value, array('categories.view_search' => $getCategories->row()->view_search + 1));
                }
            }
            //echo $stringCategories;die;
            // location search
            $stringCities="";
            if(isset($params['location'])){
                $condition_cities=array('cities.id'=>$params['location']);
                $listCitiesKeyword=$this->m_cities->getCities($condition_cities,NULL);
                foreach($listCitiesKeyword->result() as $item){
                    if(empty($stringCities)){
                        $stringCities.=$item->id;
                    }
                    else{
                        $stringCities.=','.$item->id;
                    }
                }
            }
            
            if($stringCities==""){
                $stringCities='0';
            }
            if(!isset($params['location'])){
                $stringCities="";
            }
            
            // location search
            $employer="";
            if(isset($params['employer'])){
                $employer=explode('+', $params['employer']);
                $condition['jobs.user_id']=end($employer);
            }
            // filter date poster
            $datePoster = isset($params['dp'])?$params['dp']:0;
            if($datePoster != 0){
                $timePoster = time() - $datePoster * 24 * 60 * 60;
                $condition["UNIX_TIMESTAMP(jobs.date_created) >= "] = $timePoster;
            }

            // filter date poster
            $experience = isset($params['experience'])?$params['experience']:0;
            if($experience != 0){
                $condition["jobs.year_exp"] = $experience;
            }
            $where_not_in=explode(',',$stringIdHot);
            $count_job = $this->m_job->getJobs($condition,null,null,null,$stringCategories,$stringCities,NULL,NULL,$stringEmployers,$where_not_in);
            $jobs = $this->m_job->getJobs($condition, null, null, $limit,$stringCategories,$stringCities,NULL,NULL,$stringEmployers,$where_not_in);
            //echo $this->db->last_query();

            $href = site_url('search/');
            if($params != ''){
                unset($params['p']);
                $href .= '/'.build_url($params);
            }
            $config['base_url'] = $href;
            $config['total_rows'] = $count_job->num_rows();
            $config['per_page'] = $page_rows;
            $config['cur_page'] = $page;
            //var_dump($config);die;
            $this->pagination->initialize($config);
            $this->outputData['pagination'] = $this->pagination->create_links(false, 'job');
            $this->outputData['jobs'] = $jobs->result();
            //echo $jobs->num_rows();die;
            $this->outputData['total_jobs'] = $config['total_rows'];
            //get job apply
            if (isLoggedIn()) {
                $user_id=$this->loggedInUser->id;
                $conditionsApply=array('job_apply.worker_id'=>$user_id);
                $getApply=$this->m_job->getApply($conditionsApply);
                $this->outputData['getApply']=$getApply;
            }
            $this->load->view('job/jobs', $this->outputData);
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
            if(isLoggedIn()){
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
            if(isLoggedIn()){
                $condition = array('users.id' => $this->loggedInUser->id);
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
                    $users_id = $this->loggedInUser->id;
                    //get all info user and resume
                    $this->outputData['user_info'] = $this->m_user->getUsers(array('users.id' => $users_id))->row();
                    //resume
                    $conditions=array('resume.user_id'=>$users_id,'resume.status'=>2,'resume.user_id'=>$users_id);
                    $this->outputData['getResume']=$this->m_resume->getResume($conditions);
                    $this->outputData['getCities']=$this->m_cities->getCities(array('cities.id > '=>0));
                    $this->outputData['getJobs'] = $jobs->row();
                    $this->load->view('worker/applyJob', $this->outputData);
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
            if(isLoggedIn()){
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
            if(isLoggedIn()){
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
            if(isLoggedIn()){
                if($this->session->userdata('role_id')==1){
                if($this->input->post('status',TRUE)){
                    $status = $this->input->post('status',TRUE);

                    $favourites = $this->m_common->getTableData('job_favourites',array('user_id' => $this->loggedInUser->id),array('id','values'));

                    $id = $this->encrypt->decode($this->input->post('id',TRUE));

                    $conditions=array('jobs.id'=>$id);

                    $getJobs=$this->m_job->getJobs($conditions);

                    if($favourites->num_rows() > 0) {

                        if ($status == 'remove') {
                            $array_favourites = unserialize(stripslashes($favourites->row()->values));

                            $key = array_search($id,$array_favourites);

                            unset($array_favourites[$key]);


                            $se_favourites = serialize($array_favourites);

                            $this->m_common->updateTableData('job_favourites',null,array('values' => $se_favourites),array('user_id' => $this->loggedInUser->id));

                            // remove id project


                        } elseif ($status == 'add') {
                            $array_favourites = unserialize(stripslashes($favourites->row()->values));

                            if($key = array_search($id,$array_favourites) == false){
                                $array_favourites[] = $id;
                            }

                            $se_favourites = serialize($array_favourites);

                            $this->m_common->updateTableData('job_favourites',null,array('values' => $se_favourites),array('user_id' => $this->loggedInUser->id));
                            addNotification($this->loggedInUser->id,$getJobs->row()->user_id,1,$id);
                        }
                    }else{
                        $array_favourites[] = $id;
                        $se_favourites = serialize($array_favourites);
                        $this->m_common->insertData('job_favourites',array('values' => $se_favourites,'user_id' => $this->loggedInUser->id));
                        addNotification($this->loggedInUser->id,$getJobs->row()->user_id,1,$id);
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
        if(!isLoggedIn()){
            echo json_encode(array('result'=>'error','msg'=>'not login'));die;
        }
        if($this->input->post('idJobs',TRUE)){
            $idJobs=$this->encrypt->decode($this->input->post('idJobs',TRUE));
        }
        $user_id=$this->loggedInUser->id;
        $conditionsJob=array('jobs.id'=>$idJobs);
        $getJobs=$this->m_job->getJobs($conditionsJob);
        if($getJobs->num_rows()>0){
            $conditions = array('users.id' => $user_id);
            $getUsers = $this->m_user->getUsers($conditions)->row();
            $salary="";
            if($getJobs->row()->salary_min == 0 && $getJobs->row()->salary_max == 0){
                $salary.= $this->lang->line('Negotiable');
            }else{
                $salary.= ($getJobs->row()->salary_min != 0) ? formatPrice($getJobs->row()->salary_min) : '';
                $salary.= ($getJobs->row()->salary_min != 0) ? ' - ' : ' > ';
                $salary.= ($getJobs->row()->salary_max != 0) ? formatPrice($getJobs->row()->salary_max) : '';
            }

            $paramSubject = array(
                '!jobname' => $getJobs->row()->title
            );
            $paramBody = array(
                '!jobname' => $getJobs->row()->title,
                '!joburl' =>site_url('detail-jobs/'.standardURL($getJobs->row()->title).'-'.$getJobs->row()->id),
                '!url_home' => site_url(),
                '!images'=>base_url().'app/css/images/logo_new.png'
            );
            $this->email->mailFrom = "no-reply@topdev.vn";
            $this->email->mailTo = $email;
            $this->email->templateType = 'share_job';
            $this->email->paramSubject = $paramSubject;
            $this->email->paramBody = $paramBody;
            $this->email->sendMail();
            echo json_encode(array('result'=>'success'));
        }
        else{
            echo json_encode(array('result'=>'error','msg'=>'not job'));die;
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
