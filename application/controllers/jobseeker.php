<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION))@session_start();
require_once(APPPATH . 'controllers/application.php');
class Jobseeker extends Application
{
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
        if ($this->config->item('site_status') == 1)
            redirect(URL.'offline');
        $this->load->Model("m_skills");
        $this->load->Model("m_job");
        $this->load->Model("m_district");
        $this->load->Model("m_cities");
        $this->load->Model("m_country");
        $this->load->Model("m_resume");
        $this->load->Model("m_resume_language");
        $this->load->Model("m_language");
        $this->load->Model("m_language_level");
        $this->load->Model("m_job_language");
        $this->load->library('encrypt');
        $condition_articles = array(
            'pt_articles.enable_articles' => 1,
            'pt_articles_categories.alias_articles_categories' => $this->lang->line('alias_carrer_tool')
        );
        $listArticles = $this->m_skills->getArticles($condition_articles);
        $this->_data['listArticles']=$listArticles;
        //load all district
        $getDistrict = $this->m_district->getDistrict();
        $this->_data['getDistrict'] = $getDistrict;
        //load all location
        $getCities = $this->m_cities->getCities();
        $this->_data['getCities'] = $getCities;
        //load all country
        $getCountry = $this->m_country->getCountry();
        $this->_data['getCountry'] = $getCountry;
        $this->_data['getLanguage'] = $this->m_language->getLanguage();
        $this->_data['getLanguageLevel'] = $this->m_language_level->getLanguageLevel();
        //language file
        $this->lang->load('enduser/common', $this->config->item('language_code'));
    } //Controller End
    // --------------------------------------------------------------------
    function signUp()
    {
        if($this->session->userdata('user_id'))
            redirect(URL);
        //load validation libraray
        $this->load->library('form_validation');
        $this->load->library('email');
        //Load Form Helper
        $this->load->helper('form');
        $this->load->helper('alert');
        $currentUrl = $this->uri->uri_string();
        $strParams = explode('/?',$currentUrl);
        if(!empty($strParams) && isset($strParams[1])){
            $arrParams = explode("&", $strParams[1]);
            $parsedParams = array();
            foreach ($arrParams as $i => $value) {
                $tmpAr = explode("=", $value);
                if(sizeof($tmpAr) > 1) {
                    $parsedParams[$tmpAr[0]] = $tmpAr[1];
                }
            }
        }
        $redirect = (isset($parsedParams['r']))?$parsedParams['r']:0;
        if($redirect && $redirect != 0) {
            if (!$this->session->userdata('redirect_url')) {
                $page_redirect = array('redirect_url' => url_ProjectView($redirect));
                $this->session->set_userdata($page_redirect);
            }else{
                $this->session->unset_userdata('redirect_url');
                $page_redirect = array('redirect_url' => url_ProjectView($redirect));
                $this->session->set_userdata($page_redirect);
            }
        }
        $this->_data['sex'] = ($this->input->post('sex', TRUE))?$this->input->post('sex', TRUE):'';
        $this->_data['level'] = ($this->input->post('level', TRUE))?$this->input->post('level', TRUE):'';
        //Intialize values for library and helpers
        $this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
        $this->_data['sex'] = ($this->input->post('sex', TRUE))?$this->input->post('sex', TRUE):'';
        $this->_data['level'] = ($this->input->post('level', TRUE))?$this->input->post('level', TRUE):'';
        //Get Form Data
        if ($this->input->post('usersConfirm')) {
            //Set rules
            $encrypt_name_filename_logo = encrypt_name(standardURL1($_FILES['logo']['name']));
            $this->form_validation->set_rules('logo', 'lang:Logo', 'callback__check_logo['.$encrypt_name_filename_logo.']');
            $this->form_validation->set_rules('password', 'lang:password', 'required|trim|max_length[50]|xss_clean');
            $this->form_validation->set_rules('confirm-password', 'lang:Re-type password', 'required|trim|max_length[50]|xss_clean|matches[password]');
            $this->form_validation->set_rules('email', 'lang:Email', 'required|trim|required|valid_email|min_length[5]|max_length[50]|xss_clean|callback__check_users_email|alpha_space|[users.email]');
            $this->form_validation->set_rules('fullname', 'lang:Fullname', 'required|trim|xss_clean');
            $this->form_validation->set_rules('birthday', 'lang:Birthday', 'required|trim|xss_clean');
            $this->form_validation->set_rules('address', 'lang:Address', 'required|trim|xss_clean');
            $this->form_validation->set_rules('sex', 'lang:Sex', 'required|xss_clean');
            $this->form_validation->set_rules('phone', 'lang:Phone', 'required|trim|numeric|xss_clean');
            // $this->form_validation->set_rules('role_id',"lang:I'm looking for",'required');
            $this->form_validation->set_message('required', '%s ' . $this->lang->line('required'));
            $this->form_validation->set_message('min_length', '%s ' . $this->lang->line('min_length'));
            $this->form_validation->set_message('max_length', '%s ' . $this->lang->line('max_length'));
            $this->form_validation->set_message('valid_email', '%s ' . $this->lang->line('valid_email'));
            $this->form_validation->set_message('matches', '%s ' . $this->lang->line('matches'));
            $this->form_validation->set_message('is_unique', '%s ' . $this->lang->line('is_unique'));
            if ($this->form_validation->run() == TRUE) {
                $data = array();
                $data['logo'] = date('Y', time()).'/'.date('m',time()).'/'.date('d',time()).'/'.$encrypt_name_filename_logo;
                $data['password'] = md5($this->input->post('password', TRUE));
                $data['email'] = $this->input->post('email', TRUE);
                $data['user_status'] = 1;
                $data['role_id'] = 1;
                $data['ip_address'] = $this->input->ip_address();
                $data['created'] = time();
                // create User into database
                $id = $this->m_user->createUser($data);
                $data = array();
                $data['logo'] = date('Y', time()).'/'.date('m',time()).'/'.date('d',time()).'/'.$encrypt_name_filename_logo;
                $data['fullname'] = $this->input->post('fullname', TRUE);
                $data['birthday'] = strtotime($this->input->post('birthday', TRUE));
                $data['address'] = $this->input->post('address', TRUE);
                $data['sex'] = $this->input->post('sex', TRUE);
                $data['phone'] = $this->input->post('phone', TRUE);
                $data['user_id'] = $id;
                if($this->input->post('category', TRUE)){
                    $data['category_ids'] = implode(',',$this->input->post('category', TRUE));
                }
                if($this->input->post('city', TRUE)){
                    $data['city_ids'] = implode(',',$this->input->post('city', TRUE));
                }
                $data['level_ids'] = $this->input->post('level', TRUE);
                $this->m_user->createUserJobseeker($data);
                $conditions = array('users.email' => $this->input->post('email', TRUE), 'users.password' => md5($this->input->post('password', TRUE)), 'users.user_status' => '1');
                $query = $this->m_user->getUsers($conditions);
                if ($query->num_rows() > 0) {
                    $row = $query->row();
                    if (1) {
                        //Set Session For User
                        $this->m_auth->setUserSession($row);
                        // tạo biến random và update vào csdl
                        $rand_temp = md5(uniqid(time(),TRUE));
                        // update vào csdl
                        $conditionUpdate = array("users.email" => $this->input->post("email",TRUE));
                        $updateData = array("users.active_email" => $rand_temp);
                        $this->m_user->updateKeyRand($conditionUpdate,$updateData);
                        $toEmail = $this->input->post("email",TRUE);
                        $username = $this->input->post("username",TRUE);
                        $paramSubject = array(
                            "!site_title" => $this->config->item('site_title')
                        );
                        $full_email=explode('@', $toEmail);
                        $first_email=$full_email[0];
                        $last_email=$full_email[1];
                        $paramBody = array(
                            "!username" => $username,
                            "!email" => $toEmail,
                            "!activation_url" => URL.'users/active/'.$first_email.'/'.$last_email.'/'.$rand_temp,
                            '!url_home' => site_url(),
                            '!images'=>base_url().'app/css/images/logo_new.png'
                        );
                        $this->email->mailFrom      = $this->config->item('site_admin_mail');
                        $this->email->mailTo        = $toEmail;
                        $this->email->templateType  = 'active_account';
                        $this->email->paramSubject  = $paramSubject;
                        $this->email->paramBody     = $paramBody;
                        if($this->email->sendMail()){
                            $this->session->set_flashdata('flash_message', $this->m_common->flash_message('success', 'Your password has been sent to your registered email address!'));
                        }else{
                            $this->session->set_flashdata('flash_message', $this->m_common->flash_message('error', 'Send Email failed'));
                        }
                        // get params
                        $parsedParams = get_params();
                        if(isset($parsedParams['v'])){
                            redirect($parsedParams['v']);
                        }
                        // Chuyển đến trang cụ thể tùy theo users hoặc developer
                        if($row->role_id == 2){
                            if($this->input->post('usersConfirm') != 'usersConfirm')
                                redirect($this->input->post('usersConfirm'));
                            // chuyển đến trang đăng dự án
                            $projectId = $this->uri->segment(3,'0');
                            if(!empty($projectId) && is_numeric($this->uri->segment(3,'0')) && $this->uri->segment(3,'0') != 0)
                                redirect(URL.'jobseekers/post-job/'.$this->uri->segment(3,'0'));
                            else
                                redirect(URL.'jobseekers/post-job');
                        }elseif($row->role_id == 1){
                            $this->load->model('m_resume');
                            $insertData=array();
                            $insertData['status'] = 2;
                            $insertData['email'] = $this->input->post('email', TRUE);
                            $insertData['fullname'] = $this->input->post('fullname', TRUE);
                            $insertData['birthday'] = strtotime($this->input->post('birthday', TRUE));
                            $insertData['address'] = $this->input->post('address', TRUE);
                            $insertData['gender'] = $this->input->post('sex', TRUE);
                            $insertData['cellPhone'] = $this->input->post('phone', TRUE);
                            $insertData['status'] = 2;
                            $insertData['date_created'] = time();
                            $insertData['update_at'] = time();
                            $insertData['user_id'] = $row->id;
                            $insertData['expectedJobLevel'] = $data['level_ids'];
                            $insertData['city'] = $data['city_ids'];
                            $insertData['expectedPosition'] = $data['category_ids'];
                            $this->m_resume->addResume($insertData);
                            $this->session->set_flashdata('flash_message', $this->m_common->flash_message('success', $this->lang->line('users_confirm_success')));
                            redirect($this->lang->line('l_jobseeker').'/'.$this->lang->line('l_my_job_apply'));
                        }
                    }
                }
            }//Form Validation End
        } //If - Form Submission End
        $this->_data['template']='jobseeker/usersSignUp';
        $this->load->view('index',$this->_data);
    } //Function signUp End
    /** funtion createResume
     * View jobs posted by a users
     *
     * @access    public
     * @param    nil
     * @return    void
     */
    function createResume()
    {
        //Load model
        $this->load->model('m_resume_projects');
        $this->load->model('m_resume');
        //library
        $this->load->library('email');
        $this->load->library('form_validation');
        //helper
        $this->load->helper('form');
        //addResume
        //check alreadly idResume
        $parsedParams = get_params();
        if(isset($parsedParams['option'])){
            $this->_data['option'] = $parsedParams['option'];
        }
        if ($this->session->userdata('user_id')) {
            $users_id = $this->session->userdata('user_id');
            if($this->session->userdata('role_id')==2){
                redirect(URL.'404');
            }
            else{
                $this->_data['getUser']=$users_id;
            }
            $conditions=array('resume.user_id'=>$users_id);
            $getResume=$this->m_resume->getResume($conditions);
            if($getResume->num_rows()==0){
                $insertData['status'] = 2;
                $insertData['date_created'] = time();
                $insertData['update_at'] = time();
                $insertData['user_id'] = $users_id;
                $insertData['accept_search'] = 1;
                $idResume=$this->m_resume->addResume($insertData);
            }
            else{
                $idResume=$getResume->row()->id;
            }
            $this->_data['getResume'] = $getResume->row();
            $this->_data['menuActive'] = 'My resume';
            $getResume->row();
            //get resume_language
            $conditions=array('resume_languages.resume_id'=>$idResume);
            $getResumeLanguage=$this->m_resume->getResumeLanguage($conditions);
            if($getResumeLanguage->num_rows()>0){
                $this->_data['getResumeLanguage'] = $getResumeLanguage;
            }
            //get resume_experience
            $conditions=array('resume_experiences.resume_id'=>$idResume);
            $this->_data['getResumeExperience']=$this->m_resume->getResumeExperience($conditions);
            //get resume_experience
            $conditions=array('resume_projects.resume_id'=>$idResume);
            $this->_data['resumeProjects']=$this->m_resume_projects->getResumeProjects($conditions);
            //get resume_education
            $conditions=array('resume_educations.resume_id'=>$idResume);
            $this->_data['getResumeEducation']=$this->m_resume->getResumeEducation($conditions);
            //info user
            $this->_data['user_info'] = $this->m_user->getUsers(array('users.id' => $users_id))->row();
            $this->_data['getResumeQuery'] = $this->m_resume->getResume(array('resume.user_id' => $users_id,'resume.id'=>$idResume));
            $this->_data['listPercentNoComplete'] = $this->m_user->getUsersPercentComplete(array('user_percent.status' => 0,'user_percent.user_id' => $users_id));
            if(!checkVerifyAccount($this->session->userdata('user_id'))){
                $this->_data['isVerify'] = false;
            }
            else{
                $this->_data['isVerify'] = true;
            }
            $condition = array('users.id' => $this->session->userdata('user_id'));
            $fields = array('users.is_available','users.email','users.display_name','users.phone','users.logo', 'users.active_email');
            $this->_data['userInfo'] = $this->m_user->getUsers($condition,$fields);
            if(isset($parsedParams['option'])){
                if($parsedParams['option']==1){
                    $this->_data['template']='jobseeker/resumeOption1';
                    $option=1;
                }
                else{
                    $this->_data['template']='jobseeker/resumeOption2';
                    $option=2;
                }
            }
            else{
                if($getResume->row()->title==''){
                    $this->_data['template']='jobseeker/main_resume';
                }
                else{
                    if($getResume->row()->option==1){
                        redirect(URL.$this->lang->line('l_jobseeker').'/'.$this->lang->line('l_my_resume').'/?option=1');
                    }
                    else{
                        redirect(URL.$this->lang->line('l_jobseeker').'/'.$this->lang->line('l_my_resume').'/?option=2');
                    }
                    //$this->_data['template']='jobseeker/resumeOption1';
                }
            }
            $updateData = array();
            // Case logined
            if($this->session->userdata('user_id')){
                $user_id=$this->session->userdata('user_id');
                $idResume=$this->m_resume->getResume(array('resume.user_id'=>$user_id))->row()->id;
                //check role users
                $conditions_resume=array('resume.id'=>$idResume,'resume.user_id'=>$user_id);
                $getResume=$this->m_resume->getResume($conditions_resume);
                if($getResume->num_rows()==0){
                    echo json_encode(array('result'=>'error','msg'=>'not idResume'));die;
                }
            }
            //else not login and create new account
            else{
            }
        }
        else{
            if(isset($parsedParams['option'])){
                if($parsedParams['option']==1){
                    $this->_data['template']='jobseeker/resumeOption1';
                    $option=1;
                }
                else{
                    $this->_data['template']='jobseeker/resumeOption2';
                    $option=2;
                }
            }
            else{
                $this->_data['template']='jobseeker/main_resume';
            }
        }
        $this->_data['job'] = ($this->input->post('job', TRUE))?$this->input->post('job', TRUE):'';
        $this->_data['marital'] = ($this->input->post('marital', TRUE))?$this->input->post('marital', TRUE):'';
        $this->_data['birthday'] = ($this->input->post('birthday', TRUE))?$this->input->post('birthday', TRUE):'';
        $this->_data['city'] = ($this->input->post('city', TRUE))?$this->input->post('city', TRUE):'';
        $this->_data['expectedPosition'] = ($this->input->post('expectedPosition', TRUE))?$this->input->post('expectedPosition', TRUE):'';
        $this->_data['language1'] = $year_exp = ($this->input->post('language1', TRUE))?$this->input->post('language1', TRUE):'';
        $this->_data['language_level1'] = $year_exp = ($this->input->post('language-level1', TRUE))?$this->input->post('language-level1', TRUE):'';
        $this->_data['gender'] = $year_exp = ($this->input->post('gender', TRUE))?$this->input->post('gender', TRUE):'';
        $this->_data['country'] = $year_exp = ($this->input->post('country', TRUE))?$this->input->post('country', TRUE):'';
        $this->_data['type'] = $year_exp = ($this->input->post('type', TRUE))?$this->input->post('type', TRUE):'';
        $this->_data['expectedJobLevel'] = $year_exp = ($this->input->post('expectedJobLevel', TRUE))?$this->input->post('expectedJobLevel', TRUE):'';
        $this->_data['expected_salary'] = $year_exp = ($this->input->post('expected_salary', TRUE))?$this->input->post('expected_salary', TRUE):'';
        $this->_data['education'] = $year_exp = ($this->input->post('education', TRUE))?$this->input->post('education', TRUE):'';
        $this->_data['major'] = $year_exp = ($this->input->post('major', TRUE))?$this->input->post('major', TRUE):'';
        $this->_data['yearOfExperience'] = $year_exp = ($this->input->post('yearOfExperience', TRUE))?$this->input->post('yearOfExperience', TRUE):'';
        if ($this->input->post('save',TRUE)) {
            //Set rules
            if(!$this->session->userdata('user_id')){
                $this->form_validation->set_rules('password_register', 'lang:password', 'required|trim|max_length[50]|xss_clean');
                $this->form_validation->set_rules('confirm-password-register', 'lang:Re-type password', 'required|trim|max_length[50]|xss_clean|matches[password_register]');
                $this->form_validation->set_rules('email_register', 'lang:email', 'required|trim|required|valid_email|min_length[5]|max_length[50]|xss_clean|callback__check_users_email|alpha_space|[users.email]');
            }
            $this->form_validation->set_rules('title', 'lang:Title resume', 'required|xss_clean');
            $this->form_validation->set_rules('fullname', 'lang:ho va ten', 'required|xss_clean');
            $this->form_validation->set_rules('birthday', 'lang:birthday', 'required|xss_clean');
            $this->form_validation->set_rules('gender', 'lang:Sex', 'required|xss_clean');
            $this->form_validation->set_rules('marital[]', 'lang:Marital', 'required|xss_clean');
            $this->form_validation->set_rules('address', 'lang:Address', 'required|xss_clean');
            $this->form_validation->set_rules('country', "lang:Country", 'required|xss_clean');
            $this->form_validation->set_rules('city', "lang:Address work", 'required|xss_clean');
            $this->form_validation->set_rules('cellPhone', "lang:Phone", 'required|xss_clean');
            //$this->form_validation->set_rules('type', "lang:Type job", 'required|xss_clean');
            $this->form_validation->set_rules('job', "lang:Skills", 'required|xss_clean');
            $this->form_validation->set_rules('major', "lang:Major", 'required|xss_clean');
            $this->form_validation->set_rules('email', "lang:Email", 'required|valid_email|xss_clean');
            $this->form_validation->set_rules('expectedPosition', "lang:Industry desired", 'required|xss_clean');
            $this->form_validation->set_rules('yearOfExperience', "lang:Experience", 'required|xss_clean');
            $this->form_validation->set_rules('language-level1', "lang:Languages level", 'required|xss_clean');
            $this->form_validation->set_rules('expectedJobLevel', "lang:Level", 'required|xss_clean');
            $this->form_validation->set_rules('language1', "lang:Languages", 'required|xss_clean');
            $this->form_validation->set_rules('expected_salary', "lang:Expected Salary", 'required|xss_clean');
            $this->form_validation->set_message('required', '%s ' . $this->lang->line('required'));
            $this->form_validation->set_message('min_length', '%s ' . $this->lang->line('min_length'));
            $this->form_validation->set_message('max_length', '%s ' . $this->lang->line('max_length'));
            $this->form_validation->set_message('valid_email', '%s ' . $this->lang->line('valid_email'));
            $this->form_validation->set_message('matches', '%s ' . $this->lang->line('matches'));
            $this->form_validation->set_message('is_unique', '%s ' . $this->lang->line('is_unique'));
            if ($this->form_validation->run() == TRUE) {
                if(!$this->session->userdata('user_id')){
                    $data = array();
                    $data['password'] = md5($this->input->post('password_register', TRUE));
                    $data['email'] = $this->input->post('email_register', TRUE);
                    $data['user_status'] = 1;
                    $data['role_id'] = 1;
                    $data['ip_address'] = $this->input->ip_address();
                    $data['created'] = time();
                    // create User into database
                    $id=$this->m_user->createUser($data);
                    
                    {
                        $conditions = array('users.email' => $this->input->post('email_register', TRUE), 'users.password' => md5($this->input->post('password_register', TRUE)), 'users.user_status' => '1');
                        $query = $this->m_user->getUsers($conditions);
                        if ($query->num_rows() > 0) {
                            $row = $query->row();
                            $this->m_auth->setUserSession($row);
                        }
                        $this->load->model('m_resume');
                        $insertData=array();
                        $insertData['status'] = 2;
                        $insertData['date_created'] = time();
                        $insertData['update_at'] = time();
                        $insertData['user_id'] = $id;
                        $idResume=$this->m_resume->addResume($insertData);
                    }
                }
                $save=$this->input->post('save',TRUE);
                $updateData['update_at'] = time();
                $updateData['title'] = $this->input->post('title', TRUE);
                $updateData['fullname'] = $this->input->post('fullname', TRUE);
                $arrayBirthday=explode('/', $this->input->post('birthday', TRUE));
                $updateData['birthday']=strtotime($arrayBirthday[2].'-'.$arrayBirthday[1].'-'.$arrayBirthday[0]);
                $updateData['gender'] = $this->input->post('gender', TRUE);
                $updateData['display_name_resume'] = '';
                $updateData['marital'] = $this->input->post('marital', TRUE);
                $updateData['address'] = $this->input->post('address', TRUE);;
                $updateData['country'] = $this->input->post('country', TRUE);
                $updateData['city'] = implode(',',$this->input->post('city', TRUE));
                $updateData['district'] = '';
                $updateData['cellPhone'] = $this->input->post('cellPhone', TRUE);
                $updateData['email'] = $this->input->post('email', TRUE);
                $updateData['type'] = $this->input->post('type', TRUE);
                $updateData['major'] = $this->input->post('major', TRUE);
                $updateData['job'] = implode(',',$this->input->post('job', TRUE));
                $updateData['job_other'] = $this->input->post('job_other', TRUE);
                $updateData['yearOfExperience'] = $this->input->post('yearOfExperience', TRUE);
                $updateData['summary_experience'] = $this->input->post('summary_experience', TRUE);
                $updateData['no_experience'] = '';
                $updateData['education'] = $this->input->post('education', TRUE);
                $updateData['recentCompany'] = '';
                $updateData['recentPosition'] = '';
                $updateData['currentJobLevel'] = '';
                $updateData['expectedJobLevel'] = $this->input->post('expectedJobLevel', TRUE);
                $updateData['expectedPosition'] = implode(',',$this->input->post('expectedPosition', TRUE));
                $updateData['location'] = implode(',',$this->input->post('city', TRUE));
                $updateData['expectedSalaryRange'] = '';
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
                //upload file cv and logo
                if($_FILES['cv_hard']['name']!=""){
                    $this->check_file('cv_hard','doc');
                    $updateData['cv']   = $_POST['file_path_cv_hard'];
                }
                if($_FILES['logo']['name']!=""){
                    $this->check_file('logo','images');
                    $updateData['logo']   = $_POST['file_path_logo'];
                    $data_user_worker['logo'] = $_POST['file_path_logo'];
                }

                $data_user_worker = array();
                $data_user_worker['fullname'] = $this->input->post('fullname', TRUE);
                $data_user_worker['birthday'] = $updateData['birthday'];
                $data_user_worker['address'] = $this->input->post('address', TRUE);
                $data_user_worker['sex'] = $this->input->post('gender', TRUE);
                $data_user_worker['phone'] = $this->input->post('cellPhone', TRUE);
                $data_user_worker['user_id'] = $id;
                $data_user_worker['category_ids'] = $updateData['job'];
                $data_user_worker['city_ids'] = implode(',',$this->input->post('city', TRUE));
                $data_user_worker['level_ids'] = $updateData['location'];
                $this->m_user->createUserJobseeker($data);

                $updateData['cover_letter'] = $this->input->post('cover_letter', TRUE);
                $updateData['name_referencer'] = $this->input->post('name_referencer', TRUE);
                $updateData['position_referencer'] = $this->input->post('position_referencer', TRUE);
                $updateData['phone_referencer'] = $this->input->post('phone_referencer', TRUE);
                $updateData['email_referencer'] = $this->input->post('email_referencer', TRUE);
                $updateData['info_relationship_referencer'] = $this->input->post('info_relationship_referencer', TRUE);
                $updateData['date_created'] = time();
                $updateData['option'] = $option;
                $updateKey=array('resume.id'=>$idResume);
                $this->m_resume->updateResume($updateKey,$updateData);
                if($save=='save'){
                    $this->session->set_flashdata('flash_message', setMessage('success',$this->lang->line('Update resume successful')));
                    redirect(URL.$this->lang->line('l_jobseeker').'/'.$this->lang->line('l_my_resume').'/?option='.$parsedParams['option'].'');
                }
                else{
                    redirect($this->lang->line('l_jobseeker'));
                }
            }
            else{
            }
        }
        $this->load->view('index', $this->_data);
    }//Function viewMyJob End
    function _check_username($username)
    {
        if (preg_match('/^[a-zA-Z0-9@_\.]+$/', $username)){
            return true;
        } else {
            $this->form_validation->set_message('_check_username', $this->lang->line('username_regex'));
            return false;
        }
        //If end
    }//Function  _check_usernam End
    /*function upload file
    params : namefile
    return : void
    */
    function check_file($name,$type_allow=null){
        //language file
        if (isset($_FILES[$name]) && !empty($_FILES[$name]['name'])) {
            $target = 'public/CV/'.date('Y', time()).'/'.date('m',time()).'/';
            $config['upload_path'] = $target;
            if($type_allow=='images'){
                $config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF';
            }
            else{
                $config['allowed_types'] = 'doc|DOC|xlsx|XLSX|xls|XLS|pdf|PDF|docx|DOCX';
            }
            $config['max_size'] = 10240;
            $config['remove_spaces']    = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if($this->upload->my_do_upload($name)){
                $dataUpload = $this->upload->data();
                $_POST['file_path_'.$name.''] = $target.$dataUpload['file_name'];
                $_POST['file_name_'.$name.''] = $dataUpload['file_name'];
            } else {
                $this->form_validation->set_message('check_file', $this->upload->display_errors());
                return false;
            }
        }
        else{
            $this->form_validation->set_message('check_file', $this->lang->line('This field is required'));
            return false;
        }
    }

    /*function upload file
    params : namefile
    return : void
    */
    function check_file_apply(){
        //language file
        if (isset($_FILES['resumeFile']) && !empty($_FILES['resumeFile']['name'])) {
            $target = 'public/CV/'.date('Y', time()).'/'.date('m',time()).'/';
            $config['upload_path'] = $target;
            $config['allowed_types'] = 'doc|DOC|xlsx|XLSX|xls|XLS|pdf|PDF|docx|DOCX';
            $config['max_size'] = 10240;
            $config['remove_spaces']    = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if($this->upload->my_do_upload('resumeFile')){
                $dataUpload = $this->upload->data();
                $_POST['file_path_resumeFile'] = $target.$dataUpload['file_name'];
                $_POST['file_name_resumeFile'] = $dataUpload['file_name'];
            } else {
                $this->form_validation->set_message('check_file_apply', $this->upload->display_errors());
                return false;
            }
        }
        else{
            $this->form_validation->set_message('check_file_apply', $this->lang->line('This field is required'));
            return false;
        }
    }

    function viewApply()
    {
        $currentUrl = current_url_temp1();
        if(!$this->session->userdata('user_id')){
            redirect (URL.$this->lang->line('l_sign_in').'/?next='.$currentUrl);
        }
        if($this->session->userdata('role_id')==2){
            $this->session->set_flashdata('error_applyjob',setMessage('error',$this->lang->line('Please login account job seekers to apply job')));
            redirect($_SERVER['HTTP_REFERER']);
        }
        $users_id = $this->session->userdata('user_id');
        //load validation libraray
        $this->load->library('form_validation');
        $this->load->library('email');
        //Load Form Helper
        $this->load->helper('form');
        $this->load->helper('alert');
        $params = get_params();
        if(isset($params['idJob'])){
            $job_id = $this->encrypt->decode($params['idJob']);
            //check da apply job nay hay chua
            $conditionsApply=array('job_apply.worker_id'=>$users_id,'job_apply.job_id'=>$job_id);
            $getApply=$this->m_job->getApply($conditionsApply);
            if($getApply->num_rows() > 0){
                redirect();
            }
            //end check da apply job nay hay chua
            $condition = array(
                'jobs.id' => $this->encrypt->decode($params['idJob'])
            );
            $jobs= $this->m_job->getJobs($condition);
        }
        else{
            redirect(URL.'404');
        }
        $conditions=array('resume.user_id'=>$users_id);
        $getResume=$this->m_resume->getResume($conditions);
        $this->_data['getResume']=$getResume->row();
        $this->_data['jobs']=$jobs->row();
        if ($this->input->post('submitApply',TRUE)) {
            if($this->input->post('resumeApply',TRUE)==2){
                $this->form_validation->set_rules('resumeFile', 'lang:Resume attachment', 'trim|xss_clean|callback_check_file_apply');
                if ($this->form_validation->run() == TRUE){
                    $insertApply['is_resume']   = 2;
                    $insertApply['cv']   = $_POST['file_path_resumeFile'];
                    $attachment = ROOT_PATH . '/'.$insertApply['cv'];
                    $this->email->namefile = $attachment;
                    $insertApply['worker_id']   = $users_id;
                    $insertApply['job_id']         = $job_id;
                    $insertApply['introtext']         = $this->input->post('coverLetter',TRUE);
                    $insertApply['date_created']         = date(DATETIME_FORMAT_DB,time());
                    $insertApply['status']         = 0;
                    $id=$this->m_job->addApply($insertApply);
                    // send mail for worker
                    $conditions = array('users.id' => $this->_data['jobs']->user_id);
                    $getUsers = $this->m_user->getUsers($conditions)->row();
                    $paramSubject = array(
                        '!company' => displayUserName($getUsers->user_name,$getUsers->company)
                    );
                    //your skills
                    $listMatchingCategories='';
                    $salary='';
                    $categories = $this->m_user->getUserSkill($users_id);
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
                            $url = URL.$this->lang->line('l_detail').'/'.$item->alias.'-'.$item->id;
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
                    else{
                        $listMatchingCategories = '';
                    }
                    $conditions_apply = array('users.id' => $users_id);
                    $getUsersApply = $this->m_user->getUsers($conditions_apply)->row();
                    $paramBody = array(
                        '!title' => $this->_data['jobs']->title,
                        '!company' => displayUserName($getUsers->user_name,$getUsers->company),
                        '!user_name' => displayUserName($getUsersApply->user_name,$getUsersApply->display_name_resume),
                        '!listMatchingCategories' =>$listMatchingCategories,
                        '!url_home' => site_url(),
                        '!images'=>IMAGES.'logo_email.png'
                    );
                    $this->email->mailFrom = $this->config->item('site_admin_mail');
                    $this->email->mailTo = $getUsersApply->email;
                    $this->email->templateType = 'worker_apply';
                    $this->email->paramSubject = $paramSubject;
                    $this->email->paramBody = $paramBody;
                    $this->email->sendMail();
                    // send mail for jobseeker
                    $paramSubject = array(
                        '!jobseekername' => displayUserName($getUsersApply->user_name,$getUsersApply->display_name_resume),
                        '!jobname' => $this->_data['jobs']->title,
                    );
                    $paramBody = array(
                        '!content' => nl2br($insertApply['introtext']),
                        '!url_home' => site_url(),
                        '!images'=>IMAGES.'logo.png'
                    );
                    $this->email->mailFrom = $this->config->item('site_admin_mail');
                    $this->email->mailTo = $getUsers->email;
                    $this->email->templateType = 'job_apply';
                    $this->email->paramSubject = $paramSubject;
                    $this->email->paramBody = $paramBody;
                    $this->email->sendMail();
                    $this->session->set_userdata('success_message',setMessage('success', 'Xin chúc mừng! Hồ sơ ứng tuyển của bạn đã được gửi thành công đến nhà tuyển dụng.'));
                    redirect(URL.$this->lang->line('l_jobseeker'));
                }
            }
            else{
                $insertApply['is_resume']   = 1;
                $insertApply['resume_id']   = $this->_data['getResume']->id;

                $insertApply['worker_id']   = $users_id;
                $insertApply['job_id']         = $job_id;
                $insertApply['introtext']         = $this->input->post('coverLetter',TRUE);
                $insertApply['date_created']         = date(DATETIME_FORMAT_DB,time());
                $insertApply['status']         = 0;
                $id=$this->m_job->addApply($insertApply);
                // send mail for worker
                $conditions = array('users.id' => $this->_data['jobs']->user_id);
                $getUsers = $this->m_user->getUsers($conditions)->row();
                $paramSubject = array(
                    '!company' => displayUserName($getUsers->user_name,$getUsers->company)
                );
                $conditions_apply = array('users.id' => $users_id);
                $getUsersApply = $this->m_user->getUsers($conditions_apply)->row();
                $paramBody = array(
                    '!title' => $this->_data['jobs']->title,
                    '!company' => displayUserName($getUsers->user_name,$getUsers->company),
                    '!user_name' => displayUserName($getUsersApply->user_name,$getUsersApply->display_name_resume),
                    '!url_home' => site_url(),
                    '!images'=>IMAGES.'logo.png'
                );
                $this->email->mailFrom = $this->config->item('site_admin_mail');
                $this->email->mailTo = $getUsersApply->email;
                $this->email->templateType = 'worker_apply';
                $this->email->paramSubject = $paramSubject;
                $this->email->paramBody = $paramBody;
                //$this->email->files = $attachment_pdf;
                $this->email->sendMail();
                // send mail for jobseeker
                $paramSubject = array(
                    '!jobseekername' => displayUserName($getUsersApply->user_name,$getUsersApply->display_name_resume),
                    '!jobname' => $this->_data['jobs']->title,
                );
                $paramBody = array(
                    '!content' => nl2br($insertApply['introtext']),
                    '!url_home' => site_url(),
                    '!images'=>IMAGES.'logo.png'
                );
                $this->email->mailFrom = $this->config->item('site_admin_mail');
                $this->email->mailTo = $getUsers->email;
                $this->email->templateType = 'job_apply';
                $this->email->paramSubject = $paramSubject;
                $this->email->paramBody = $paramBody;
                $this->email->sendMail();
                $this->session->set_flashdata('success_message',setMessage('success', 'Xin chúc mừng! Hồ sơ ứng tuyển của bạn đã được gửi thành công đến nhà tuyển dụng.'));
                redirect(URL.$this->lang->line('l_jobseeker'));
            }
        }
        $this->_data['template']='jobseeker/apply';
        $this->load->view('index',$this->_data);
    }
    /**
     * View job apply
     *
     * @access    public
     * @param    nil
     * @return    void
     */
    function viewMyJobsApply()
    {
        $this->load->Model("m_job_wishlist");
        //load validation libraray
        $this->load->library('form_validation');
        $this->load->library('email');
        //Load Form Helper
        $this->load->helper('form');
        $this->load->helper('alert');
        $params = (uri_to_assoc(2))?uri_to_assoc(2):'';
        $this->_data['params'] = $params;
        //Check For users Session
        if(!$this->session->userdata('user_id')){
            redirect(URL.$this->lang->line('l_sign_in').'/?next='.current_url_temp1());
        }
        if($this->session->userdata('role_id')==2){
            $this->session->set_flashdata('flash_message', setMessage('error', $this->lang->line('Your account is not allowed to access this section')));
            redirect(URL.'404');
        }
        $page = isset($params['p'])?$params['p']:1;
        $page_rows = $this->config->item('listing_limit');
        $max = array($page_rows, ($page - 1) * $page_rows);
        //Get users id
        $users_id = $this->session->userdata('user_id');
        //pagination limit
        $page_rows1 = $this->config->item('listing_limit');
        $limit1[0] = $page_rows1;
        $limit1[1] = '0';
        //Conditions list job users tạo ra
        $order = array('job_apply.updated_at', 'desc');
        $conditions = array('job_apply.worker_id' => $users_id);
        // filter job status
        $job_status = $this->input->post('status');
        if($job_status){
            $conditions['jobs.status'] = $job_status;
            $params['st'] = $job_status;
        }elseif(isset($params['st'])){
            $conditions['jobs.status'] = $params['st'];
        }
        $this->_data['getJobsApply'] = $this->m_job->getJobsApply($conditions, NULL, NULL, $max, NULL,NULL, $order);
        $created = $this->m_job->getJobsApply($conditions);
        $uri = '';
        if($params != ''){
            unset($params['p']);
            $uri = '/'.build_url($params);
        }
        $href = '/jobseeker/viewMyJobs'.$uri;
        //Pagination
        $this->load->library('pagination');
        $config['base_url'] = $href;
        $config['total_rows'] = $created->num_rows();
        $config['per_page'] = $page_rows;
        $config['cur_page'] = $page;
        $this->pagination->initialize($config);
        $this->_data['pagination'] = $this->pagination->create_links(false, 'job');
        //wishlist
        $JobWishlist = $this->m_job_wishlist->getJobWishlist(array('user_id' => $users_id, 'is_deleted' => 0))->result();
        $arrJobWishlist = '';
        foreach($JobWishlist as $item){
            $arrJobWishlist[] = $item->job_id;
        }
        $this->_data['job_wishlist'] = $arrJobWishlist;
        //info user
        $this->_data['userInfo'] = $this->m_user->getUserWorker(array('users.id' => $users_id))->row();
        $listJobsSave = $this->m_common->getTableData('job_favourites', array('user_id' => $this->session->userdata('user_id')));
        if ($listJobsSave->num_rows() > 0) {
            if(count(unserialize(stripslashes($listJobsSave->row()->values))) > 0){
                $this->_data['listJobsSave']  = $this->m_skills->getMyFavourites(array('jobs.status' => "1"), null, null, null, unserialize(stripslashes($listJobsSave->row()->values)));
            }
        }
        if($alias = $this->uri->segment(2)){
            if($alias == $this->lang->line('l_jobs_save'))
            {
                $this->_data['template']='jobseeker/myJobsSave';
                $this->_data['menuActive'] = 'My career';
                $this->_data['menuActiveChild'] = 'viewMyJobsSave';
            }
            else if($alias == $this->lang->line('l_view_resume_employee')){
                //get resume for user
                $conditions_user=array('resume.user_id'=>$users_id);
                $getResume=$this->m_resume->getResume($conditions_user);
                if($getResume->num_rows>0){
                    $idResume=$getResume->row()->id;
                }
                else{
                    $idResume=0;
                }
                $conditions = array('resume_view_employer.resume_id' => $idResume);
                $this->_data['myViewEmployer'] = $this->m_resume->getViewEmployer($conditions);
                $this->_data['template']='jobseeker/viewResumeOfEmployee';
                $this->_data['menuActive'] = 'My career';
                $this->_data['menuActiveChild'] = 'viewResumeOfEmployee';
            }
        }
        else{
            $this->_data['template']='jobseeker/myJobsApply';

            $this->_data['menuActive'] = 'My career';
            $this->_data['menuActiveChild'] = 'viewMyJobsApply';
        }
        //get Users Accept Job
        $getUsersAcceptJob = $this->m_user->getUsersAcceptJob(array('user_accept_jobs.user_id' => $users_id));
        if($getUsersAcceptJob->num_rows() > 0){
            $this->_data['getUsersAcceptJob']=$getUsersAcceptJob;
        }
        $this->load->view('index',$this->_data);
    }//Function viewMyJob End
    
    function editAccount()
    {
        $data = array();
        $this->_data['menuActive'] = 'Account';
        $this->_data['menuActiveChild'] = 'editAccount';
        $this->load->library('form_validation');
        if(!$this->session->userdata('user_id')){
            redirect(URL.$this->lang->line('l_sign_in').'/?next='.current_url_temp1());
        }
        if($this->session->userdata('role_id')==2){
            $this->session->set_flashdata('flash_message', setMessage('error', $this->lang->line('Your account is not allowed to access this section')));
            redirect(URL.'404');
        }
        $condition = array(
            'users.id' => $this->session->userdata('user_id')
        );
        $this->_data['jobseeker'] = $user = $this->m_user->getUserWorker($condition)->row();
        //Intialize values for library and helpers
        $this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
        //Get Form Data
        if ($this->input->post('usersConfirm')) {
            //Set rules
            if ($_FILES['logo']['name']==''){
                if($this->_data['jobseeker']->logo == ""){
                    $this->form_validation->set_rules('logo', 'lang:Logo', 'required');
                }
            }
            else{
                $encrypt_name_filename_logo = encrypt_name(standardURL1($_FILES['logo']['name']));
                $data['logo'] = date('Y', time()).'/'.date('m',time()).'/'.date('d',time()).'/'.$encrypt_name_filename_logo;
                $this->form_validation->set_rules('logo', 'lang:Logo', 'callback__check_logo['.$encrypt_name_filename_logo.']');
            }
            $this->form_validation->set_rules('fullname', 'lang:fullname', 'required|trim|xss_clean');
            $this->form_validation->set_rules('birthday', 'lang:birthday', 'required|trim|xss_clean');
            $this->form_validation->set_rules('address', 'lang:address', 'required|trim|xss_clean');
            $this->form_validation->set_rules('sex', 'lang:sex', 'required|xss_clean');
            $this->form_validation->set_rules('phone', 'lang:phone', 'required|trim|numeric|xss_clean');
            // $this->form_validation->set_rules('role_id',"lang:I'm looking for",'required');
            $this->form_validation->set_message('required', '%s ' . $this->lang->line('required'));
            $this->form_validation->set_message('min_length', '%s ' . $this->lang->line('min_length'));
            $this->form_validation->set_message('max_length', '%s ' . $this->lang->line('max_length'));
            $this->form_validation->set_message('valid_email', '%s ' . $this->lang->line('valid_email'));
            $this->form_validation->set_message('matches', '%s ' . $this->lang->line('matches'));
            $this->form_validation->set_message('is_unique', '%s ' . $this->lang->line('is_unique'));
            if ($this->form_validation->run() == TRUE) {
                
                $data['fullname'] = $this->input->post('fullname', TRUE);
                $data['birthday'] = strtotime($this->input->post('birthday', TRUE));
                $data['address'] = $this->input->post('address', TRUE);
                $data['sex'] = $this->input->post('sex', TRUE);
                $data['phone'] = $this->input->post('phone', TRUE);
                if($this->input->post('category', TRUE)){
                    $data['category_ids'] = implode(',',$this->input->post('category', TRUE));
                }
                if($this->input->post('city', TRUE)){
                    $data['city_ids'] = implode(',',$this->input->post('city', TRUE));
                }
                $data['level_ids'] = $this->input->post('level', TRUE);
                $this->m_user->updateWorker(array('user_worker.user_id'=>$this->session->userdata('user_id')),$data);
                $this->session->set_flashdata('flash_message', setMessage('success', $this->lang->line('Updates Successful')));
                redirect(URL.$this->lang->line('l_jobseeker').'/'.$this->lang->line('l_account').'/'.$this->lang->line('l_edit'));
            }//Form Validation End
            else{
                //echo validation_errors();
            }
        } //If - Form Submission End
        $this->_data['template']='jobseeker/editAccount';
        $this->load->view('index',$this->_data);
    }

    function editAccountPassword()
    {
        $this->_data['menuActive'] = 'Account';
        $this->_data['menuActiveChild'] = 'editAccountPassword';
        $this->load->library('form_validation');
        if(!$this->session->userdata('user_id')){
            redirect();
        }
        $condition = array(
            'users.id' => $this->session->userdata('user_id')
        );
        $this->_data['jobseeker'] = $user = $this->m_user->getUserWorker($condition)->row();
        //Intialize values for library and helpers
        $this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
        //Get Form Data
        if ($this->input->post('usersConfirm')) {
            //Set rules
            $this->form_validation->set_rules('password', 'lang:Password', 'required|trim|max_length[50]|xss_clean');
            $this->form_validation->set_rules('confirm-password', 'lang:Re-type password', 'required|trim|max_length[50]|xss_clean|matches[password]');
            // $this->form_validation->set_rules('role_id',"lang:I'm looking for",'required');
            $this->form_validation->set_message('required', '%s ' . $this->lang->line('required'));
            $this->form_validation->set_message('min_length', '%s ' . $this->lang->line('min_length'));
            $this->form_validation->set_message('max_length', '%s ' . $this->lang->line('max_length'));
            $this->form_validation->set_message('valid_email', '%s ' . $this->lang->line('valid_email'));
            $this->form_validation->set_message('matches', '%s ' . $this->lang->line('matches'));
            $this->form_validation->set_message('is_unique', '%s ' . $this->lang->line('is_unique'));
            if ($this->form_validation->run() == TRUE) {
                $data = array();
                $data['password'] = md5($this->input->post('password', TRUE));
                $this->m_user->updateUser(array('users.id'=>$this->session->userdata('user_id')),$data);
                $this->session->set_flashdata('flash_message', setMessage('success', $this->lang->line('Updates Successful')));
                redirect(URL.$this->lang->line('l_jobseeker').'/'.$this->lang->line('l_account').'/'.$this->lang->line('l_edit_password'));
            }//Form Validation End
            else{
                //echo validation_errors();
            }
        } //If - Form Submission End
        $this->_data['template']='jobseeker/editAccountPassword';
        $this->load->view('index',$this->_data);
    }

    function deleteJobsApply(){
        //load edit profile lang
        if($this->session->userdata('user_id')){
            if($this->session->userdata('role_id') ==1 ){
            $users_id=$this->session->userdata('user_id');
                //var_dump($this->input->post("job",TRUE));
                if($this->input->post("btnDelete",TRUE))
                {
                    $listIdJobsApply=$this->input->post("job",TRUE);
                    foreach($listIdJobsApply as $id)
                    {
                        $id=$this->encrypt->decode($id);
                        $this->m_job->deleteJobsApply(null,array('job_apply.worker_id'=>$users_id,'job_apply.job_id'=>$id));
                    }
                    redirect(URL.$this->lang->line('l_jobseeker'));
                }
                else{
                    redirect();
                }
            }
            else{
                redirect();
            }
        }
        else{
            redirect();
        }
    }

    /**
     * deleteJobsSaved
     *
     * @access    public
     * @param    nil
     * @return    json_encode
     */
    public function deleteJobsSaved(){
        if($this->session->userdata('user_id')){
            if($this->input->post("btnDelete",TRUE))
            {
                $favourites = $this->m_common->getTableData('job_favourites',array('user_id' => $this->session->userdata('user_id')),array('id','values'));
                $listIdJobsApply=$this->input->post("job",TRUE);
                foreach($listIdJobsApply as $id)
                {
                    $id=$this->encrypt->decode($id);
                    $conditions=array('jobs.id'=>$id);
                    $getJobs=$this->m_job->getJobs($conditions);
                    $array_favourites = unserialize(stripslashes($favourites->row()->values));
                    $key = array_search($id,$array_favourites);
                    unset($array_favourites[$key]);
                    $se_favourites = serialize($array_favourites);
                    $this->m_common->updateTableData('job_favourites',null,array('values' => $se_favourites),array('user_id' => $this->session->userdata('user_id')));
                    //update number favourites in table projects
                    $favourites=$getJobs->row()->favourites - 1;
                    $update=array(
                        'favourites' => $favourites
                    );
                    $this->m_job->updateJob(array('jobs.id'=>$id),$update);
                }
                redirect(URL.$this->lang->line('l_jobseeker').'/'.$this->lang->line('l_jobs_save'));
            }
        }
    }

    function createAcceptJob()
    {
        $this->_data['menuActive'] = 'viewMyJobsApply';
        $this->_data['menuActiveChild'] = 'editAccount';
        $this->load->library('form_validation');
        if(!$this->session->userdata('user_id')){
            redirect(URL.$this->lang->line('l_sign_in').'/?next='.URL.$this->lang->line('l_jobseeker').'/'.$this->lang->line('l_add_accept_job'));
        }
        else{
            if($this->session->userdata('role_id')==2){
                $this->session->set_flashdata('flash_message', setMessage('error', $this->lang->line('Your account is not allowed to access this section')));
                redirect(URL.'404');
            }
        }
        $condition = array(
            'users.id' => $this->session->userdata('user_id')
        );
        //get Users Accept Job
        $getUsersAcceptJob = $this->m_user->getUsersAcceptJob(array('user_accept_jobs.user_id' => $this->session->userdata('user_id')));
        if($getUsersAcceptJob->num_rows() > 0){
            $this->_data['getUsersAcceptJob']=$getUsersAcceptJob->row();
        }
        //Intialize values for library and helpers
        $this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
        //Get Form Data
        $this->_data['category'] = ($this->input->post('category', TRUE))?implode(',',$this->input->post('category', TRUE)):'';
        $this->_data['city'] = ($this->input->post('city', TRUE))?implode(',',$this->input->post('city', TRUE)):'';
        $this->_data['level'] = ($this->input->post('level', TRUE))?$this->input->post('level', TRUE):'';
        if ($this->input->post('createAcceptJob')) {
            //Set rules
            $this->form_validation->set_rules('category[]', 'lang:Choose nghanh', 'required|trim|xss_clean');
            $this->form_validation->set_rules('city[]', 'lang:Choose address', 'required|trim|xss_clean');
            $this->form_validation->set_rules('level', 'lang:Level', 'required|trim|xss_clean');
            // $this->form_validation->set_rules('role_id',"lang:I'm looking for",'required');
            $this->form_validation->set_message('required', '%s ' . $this->lang->line('required'));
            $this->form_validation->set_message('min_length', '%s ' . $this->lang->line('min_length'));
            $this->form_validation->set_message('max_length', '%s ' . $this->lang->line('max_length'));
            $this->form_validation->set_message('valid_email', '%s ' . $this->lang->line('valid_email'));
            $this->form_validation->set_message('matches', '%s ' . $this->lang->line('matches'));
            $this->form_validation->set_message('is_unique', '%s ' . $this->lang->line('is_unique'));
            if ($this->form_validation->run() == TRUE) {
                $data = array();
                if($this->input->post('category', TRUE)){
                    $data['category_ids'] = implode(',',$this->input->post('category', TRUE));
                }
                if($this->input->post('city', TRUE)){
                    $data['city_ids'] = implode(',',$this->input->post('city', TRUE));
                }
                $data['level_ids'] = $this->input->post('level', TRUE);
                $data['is_deleted'] = $this->input->post('is_deleted', TRUE);
                if($getUsersAcceptJob->num_rows() > 0){
                    $this->m_user->updateUserAcceptJobs(array('user_accept_jobs.user_id' => $this->session->userdata('user_id')),$data);
                }
                else{
                    $data['user_id'] = $this->session->userdata('user_id');
                    $this->m_user->createUserAcceptJobs($data);
                }
                $this->session->set_flashdata('flash_message', setMessage('success', $this->lang->line('Updates Successful')));
                redirect(URL.$this->lang->line('l_jobseeker').'/'.$this->lang->line('l_add_accept_job'));
            }//Form Validation End
            else{
                //echo validation_errors();
            }
        } //If - Form Submission End
        $this->_data['template']='jobseeker/createAcceptJob';
        $this->load->view('index',$this->_data);
    }

    /**
     * Loads _logo_check for uploading
     *
     * @access    public
     * @param    nil
     * @return    void
     */
    function _check_logo($str,$encrypt_name_filename){
        if (isset($_FILES['logo']) && !empty($_FILES['logo']['name'])) {
            // upload CV
            $target = ROOT_PATH.'/public/images/logo/'.date('Y', time()).'/'.date('m',time()).'/'.date('d',time()).'/';
            $config['upload_path'] = $target;
            $config['allowed_types'] = 'zip|rar|jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF';
            $config['file_name']= $encrypt_name_filename;
            $config['max_size'] = 1024000;
            $config['remove_spaces']    = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if($this->upload->my_do_upload('logo')){
                if (($this->input->post('file_old', true))) {
                    $file_old = $this->input->post('file_old', true);
                    @unlink(ROOT_PATH .'/public/'.$file_old);
                }
                return true;
            } else {
                // possibly do some clean up ... then throw an error
                $this->form_validation->set_message('_check_logo', $this->upload->display_errors());
                return false;
            }
        }
        else {
                // possibly do some clean up ... then throw an error
                $this->form_validation->set_message('_check_logo', $this->lang->line('Email is required.'));
                return false;
            }
        return false;
    }

    function testMail(){

        $this->load->library('email');
        $this->email->mailFrom      = $this->config->item('site_admin_mail');
        $this->email->mailTo        = 'ithtan660@gmail.com';
        $this->email->templateType  = 'active_account';
        $this->email->paramSubject  = array();
        $this->email->paramBody     = array();
        $this->email->sendMail();
        echo $this->email->print_debugger();
    }
    

} //End  Users Class
/* End of file Users.php */
/* Location: ./app/controllers/Users.php */
