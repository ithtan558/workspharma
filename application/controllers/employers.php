<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION))@session_start();
require_once(APPPATH . 'controllers/application.php');
class Employers extends Application
{
    /**
     * Constructor
     *
     * Loads language files and models needed for this controller
     */
    public function __construct(){
        parent::__construct();
        $this->load->Model("m_skills");
        $this->load->Model("m_job");
        $this->load->Model("m_jobs");
        $this->load->Model("m_district");
        $this->load->Model("m_cities");
        $this->load->Model("m_country");
        $this->load->Model("m_language");
        $this->load->Model("m_language_level");
        $this->load->Model("m_job_language");
        $this->load->model('m_resume_favourites');
        //Get Config Details From Db
        $this->my_config->db_config_fetch();
        //load validation libraray
        $this->load->library('form_validation');
        $this->load->library('email');
        //Load Form Helper
        $this->load->helper('form');
        $this->load->helper('alert');
        $this->load->library('encrypt');
        //Manage site Status
        if ($this->config->item('site_status') == 1)
            redirect(URL.'offline');
        $this->_data['current_page'] = 'employer';
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
        $condition_articles = array(
            'pt_articles.enable_articles' => 1,
            'pt_articles_categories.alias_articles_categories' => $this->lang->line('alias_carrer_tool')
        );
        $listArticles = $this->m_skills->getArticles($condition_articles);
        $this->_data['listArticles']=$listArticles;
    } //Controller End
    function signUp()
    {
        if($this->session->userdata('user_id'))
            redirect(URL.'home');
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
        $this->_data['num_of_staff'] = ($this->input->post('num_of_staff', TRUE))?$this->input->post('num_of_staff', TRUE):'';
        $this->_data['country'] = ($this->input->post('country', TRUE))?$this->input->post('country', TRUE):'';
        $this->_data['city'] = ($this->input->post('city', TRUE))?$this->input->post('city', TRUE):'';
        $this->_data['accept_new'] = ($this->input->post('accept_new', TRUE))?$this->input->post('accept_new', TRUE):'';
        //Intialize values for library and helpers
        $this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
        //Get Form Data
        if ($this->input->post('usersConfirm')) {
            //Set rules
            $encrypt_name_filename_logo = encrypt_name(standardURL1($_FILES['logo']['name']));
            $this->form_validation->set_rules('password', 'lang:Password', 'required|trim|max_length[50]|xss_clean');
            $this->form_validation->set_rules('confirm-password', 'lang:Re-type password', 'required|trim|max_length[50]|xss_clean|matches[password]');
            $this->form_validation->set_rules('email', 'lang:Email', 'required|trim|required|valid_email|min_length[5]|max_length[50]|xss_clean|callback__check_users_email|alpha_space|[users.email]');
            $this->form_validation->set_rules('company', 'lang:Company', 'required|xss_clean');
            if($_FILES['logo']['name']!=''){
                $this->form_validation->set_rules('logo', 'lang:Logo', 'callback__check_logo['.$encrypt_name_filename_logo.']');
            }
            $this->form_validation->set_rules('description', 'lang:gioi thieu so luoc', 'required|xss_clean');
            $this->form_validation->set_rules('linhvuchoatdong', 'lang:linh vuc hoat dong', 'required|xss_clean');
            $this->form_validation->set_rules('num_of_staff', 'lang:tong so nhan vien', 'required|xss_clean');
            $this->form_validation->set_rules('website', 'lang:website cong ty', 'required|xss_clean');
            $this->form_validation->set_rules('name', 'lang:ho va ten', 'required|xss_clean');
            $this->form_validation->set_rules('chucvu', 'lang:chuc vu', 'required|xss_clean');
            $this->form_validation->set_rules('email_contact', 'lang:email lien he', 'required|xss_clean');
            $this->form_validation->set_rules('phone_contact', 'lang:dien thoai cty', 'required|xss_clean');
            $this->form_validation->set_rules('address_contact', 'lang:dia chi lien he', 'required|xss_clean');
            $this->form_validation->set_rules('country', 'lang:quoc gia', 'required|xss_clean');
            $this->form_validation->set_rules('city', 'lang:tinh thanh', 'required|xss_clean');
            $this->form_validation->set_message('required', '%s ' . $this->lang->line('required'));
            $this->form_validation->set_message('min_length', '%s ' . $this->lang->line('min_length'));
            $this->form_validation->set_message('max_length', '%s ' . $this->lang->line('max_length'));
            $this->form_validation->set_message('valid_email', '%s ' . $this->lang->line('valid_email'));
            $this->form_validation->set_message('matches', '%s ' . $this->lang->line('matches'));
            $this->form_validation->set_message('is_unique', '%s ' . $this->lang->line('is_unique'));
            if ($this->form_validation->run() == TRUE) {
                $data = array();
                $data['password'] = md5($this->input->post('password', TRUE));
                $data['email'] = $this->input->post('email', TRUE);
                $data['user_status'] = 1;
                $data['role_id'] = 2;
                $data['ip_address'] = $this->input->ip_address();
                $data['created'] = time();
                // create User into database
                    $id = $this->m_user->createUser($data);
                    $dataEmployer=array();
                    $dataEmployer['user_id'] = $id;
                    $dataEmployer['company'] = $this->input->post('company', TRUE);
                    if($_FILES['logo']['name']!=''){
                        $dataEmployer['logo'] = date('Y', time()).'/'.date('m',time()).'/'.date('d',time()).'/'.$encrypt_name_filename_logo;
                    }
                    $dataEmployer['description'] = $this->input->post('description', TRUE);
                    $dataEmployer['linhvuchoatdong'] = $this->input->post('linhvuchoatdong', TRUE);
                    $dataEmployer['chinhanh'] = $this->input->post('chinhanh', TRUE);
                    $dataEmployer['num_of_staff'] = $this->input->post('num_of_staff', TRUE);
                    $dataEmployer['website'] = $this->input->post('website', TRUE);
                    $dataEmployer['name'] = $this->input->post('name', TRUE);
                    $dataEmployer['chucvu'] = $this->input->post('chucvu', TRUE);
                    $dataEmployer['email_contact'] = $this->input->post('email_contact', TRUE);
                    $dataEmployer['phone_contact'] = $this->input->post('phone_contact', TRUE);
                    $dataEmployer['mobile_contact'] = $this->input->post('mobile_contact', TRUE);
                    $dataEmployer['address'] = $this->input->post('address_contact', TRUE);
                    $dataEmployer['country'] = $this->input->post('country', TRUE);
                    $dataEmployer['city'] = $this->input->post('city', TRUE);
                    $dataEmployer['accept_new'] = $this->input->post('accept_new', TRUE);
                    $conditions = array('users.email' => $this->input->post('email', TRUE), 'users.password' => md5($this->input->post('password', TRUE)), 'users.user_status' => '1');
                    $this->m_user->createUserEmployers($dataEmployer);
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
                                '!images'=>IMAGES.'rsz_logo.png'
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
                            redirect($this->lang->line('l_employer').'/'.$this->lang->line('l_post_job'));
                        }
                    }
            }//Form Validation End
            else{
                //echo validation_errors();
            }
        } //If - Form Submission End
        $this->_data['template']='employers/usersSignUp';
        $this->load->view('index',$this->_data);
    }
    function editAccount()
    {
        $this->_data['menuActive'] = 'Account';
        $this->_data['menuActiveChild'] = 'editAccount';
        if(!$this->session->userdata('user_id')){
            redirect(URL.$this->lang->line('l_sign_in').'/?next='.current_url_temp1());
        }
        if($this->session->userdata('role_id')==1){
            redirect(URL.'404');
        }
        $condition = array(
            'users.id' => $this->session->userdata('user_id')
        );
        $this->_data['employer'] = $user = $this->m_jobs->getUserEmployers($condition)->row();
        //Intialize values for library and helpers
        $this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
        //Get Form Data
        if ($this->input->post('usersConfirm')) {
            $dataEmployer=array();
            //Set rules
            $this->form_validation->set_rules('company', 'lang:company', 'required|xss_clean');
            if ($_FILES['logo']['name']==''){
                if($this->_data['employer']->logo == ""){
                    $this->form_validation->set_rules('logo', 'lang:logo cong ty', 'required');
                }
            }
            else{
                $encrypt_name_filename_logo = encrypt_name(standardURL1($_FILES['logo']['name']));
                $dataEmployer['logo'] = date('Y', time()).'/'.date('m',time()).'/'.date('d',time()).'/'.$encrypt_name_filename_logo;
                $this->form_validation->set_rules('logo', 'lang:logo cong ty', 'callback__check_logo['.$encrypt_name_filename_logo.']');
            }
            $this->form_validation->set_rules('description', 'lang:description', 'required|xss_clean');
            $this->form_validation->set_rules('linhvuchoatdong', 'lang:linh vuc hoat dong', 'required|xss_clean');
            $this->form_validation->set_rules('chinhanh', 'lang:cac chi nhanh', 'required|xss_clean');
            $this->form_validation->set_rules('num_of_staff', 'lang:tong so nhan vien', 'required|xss_clean');
            $this->form_validation->set_rules('website', 'lang:website cong ty', 'required|xss_clean');
            $this->form_validation->set_rules('name', 'lang:Họ và tên', 'required|xss_clean');
            $this->form_validation->set_rules('chucvu', 'lang:chuc vu', 'required|xss_clean');
            $this->form_validation->set_rules('email_contact', 'lang:email lien he', 'required|xss_clean');
            $this->form_validation->set_rules('phone_contact', 'lang:dien thoai cty', 'required|xss_clean');
            $this->form_validation->set_rules('mobile_contact', 'lang:dien thoai di dong', 'required|xss_clean');
            $this->form_validation->set_rules('address_contact', 'lang:dia chi lien he', 'required|xss_clean');
            $this->form_validation->set_rules('country', 'lang:quoc gia', 'required|xss_clean');
            $this->form_validation->set_rules('city', 'lang:tinh thanh', 'required|xss_clean');
            $this->form_validation->set_rules('company', 'lang:company', 'required|xss_clean');
            $this->form_validation->set_message('required', '%s ' . $this->lang->line('required'));
            $this->form_validation->set_message('min_length', '%s ' . $this->lang->line('min_length'));
            $this->form_validation->set_message('max_length', '%s ' . $this->lang->line('max_length'));
            $this->form_validation->set_message('valid_email', '%s ' . $this->lang->line('valid_email'));
            $this->form_validation->set_message('matches', '%s ' . $this->lang->line('matches'));
            $this->form_validation->set_message('is_unique', '%s ' . $this->lang->line('is_unique'));
            if ($this->form_validation->run() == TRUE) {
                $id=$this->m_user->getUsers(array('users.id'=>$this->session->userdata('user_id')))->row()->id;
                // create User into database
                if($id){
                    $dataEmployer['company'] = $this->input->post('company', TRUE);
                    $dataEmployer['description'] = $this->input->post('description', TRUE);
                    $dataEmployer['linhvuchoatdong'] = $this->input->post('linhvuchoatdong', TRUE);
                    $dataEmployer['chinhanh'] = $this->input->post('chinhanh', TRUE);
                    $dataEmployer['num_of_staff'] = $this->input->post('num_of_staff', TRUE);
                    $dataEmployer['website'] = $this->input->post('website', TRUE);
                    $dataEmployer['name'] = $this->input->post('name', TRUE);
                    $dataEmployer['chucvu'] = $this->input->post('chucvu', TRUE);
                    $dataEmployer['email_contact'] = $this->input->post('email_contact', TRUE);
                    $dataEmployer['phone_contact'] = $this->input->post('phone_contact', TRUE);
                    $dataEmployer['mobile_contact'] = $this->input->post('mobile_contact', TRUE);
                    $dataEmployer['address'] = $this->input->post('address_contact', TRUE);
                    $dataEmployer['country'] = $this->input->post('city', TRUE);
                    $dataEmployer['city'] = $this->input->post('city', TRUE);
                    $dataEmployer['accept_new'] = $this->input->post('accept_new', TRUE);
                    $conditions = array('email' => $this->input->post('email', TRUE), 'password' => md5($this->input->post('password', TRUE)), 'users.user_status' => '1');
                    $this->m_jobs->updateEmployer(array('user_employers.user_id'=>$this->session->userdata('user_id')),$dataEmployer);
                    $this->session->set_flashdata('flash_message', setMessage('success', $this->lang->line('Updates Successful')));
                    redirect(URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_account').'/'.$this->lang->line('l_edit'));
                }
            }//Form Validation End
            else{
                //echo validation_errors();
            }
        } //If - Form Submission End
        $this->_data['template']='employers/editAccount';
        $this->load->view('index',$this->_data);
    }
    function editAccountPassword()
    {
        $this->_data['menuActive'] = 'viewMyJobsApply';
        $this->_data['menuActiveChild'] = 'editAccountPassword';
        $this->load->library('form_validation');
        if(!$this->session->userdata('user_id')){
            redirect(URL.$this->lang->line('l_sign_in').'/?next='.current_url_temp1());
        }
        if($this->session->userdata('role_id')==1){
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
        $this->_data['template']='employers/editAccountPassword';
        $this->load->view('index',$this->_data);
    }
    function index()
    {
        $getEmployers = $this->m_skills->getEmployers();
        $this->_data['getEmployers']=$getEmployers;
        $this->_data['menuActive'] = 'Manage job';
        //danh sach san pham
        $this->_data['index']=true;
        $title_job = $this->uri->segment(2);
        $conditions =array();
        if($title_job == $this->lang->line('l_jobs_expired')){
            $this->_data['title_job']=$this->lang->line('Jobs expired');
            $this->_data['menuActiveChild'] = $this->lang->line('Jobs expired');
            $conditions['jobs.date_expiration <'] = date('Y-m-d H:i:s',time());
            $conditions['jobs.is_deleted'] = 0;
        }
        elseif($title_job == $this->lang->line('l_jobs_deleted')){
            $this->_data['title_job']=$this->lang->line('Jobs deleted');
            $this->_data['menuActiveChild'] = $this->lang->line('Jobs deleted');
            $conditions['jobs.is_deleted'] = 1;
        }
        else{
            $this->_data['title_job']=$this->lang->line('Jobs are posted');
            $this->_data['menuActiveChild'] = $this->lang->line('Jobs are posted');
            $conditions['jobs.date_expiration >'] = date('Y-m-d H:i:s',time());
            $conditions['jobs.is_deleted'] = 0;
        }
        if($this->siteoffline==1)
        {
            $this->_data['error']=$offlinemsg;
            $this->load->view('maintenance',$this->_data);
        }
        else
        {
            if($this->session->userdata('user_id')){
                if($this->session->userdata('role_id')==2){
                    $condition = array(
                        'users.id' => $this->session->userdata('user_id')
                    );
                    $this->_data['userInfo'] = $user = $this->m_jobs->getUserEmployers($condition)->row();
                    $this->load->helper('jobs');
                    $params = (uri_to_assoc(2)) ? uri_to_assoc(2) : '';
                    $this->_data['params'] = $params;
                    if(!isEmployer()){
                        $message = $this->lang->line('Please login account employer');
                        $this->session->set_flashdata('flash_message', setMessage('error', $message));
                        redirect(URL.'users/login/?next='.site_url('employers/orders'));
                    }
                    $page = isset($params['p']) ? $params['p'] : 1;
                    $this->_data['default_exp'] = $this->config->item('default_exp');
                    $page_rows = $this->config->item('listing_limit');
                    $max = array($page_rows, ($page - 1) * $page_rows);
                    $limit1[0] = $page_rows;
                    $limit1[1] = '0';
                    $order = array('jobs.date_created', 'desc');
                    $conditions['jobs.user_id'] = $this->session->userdata('user_id');
                    $this->_data['jobs'] = $this->m_jobs->getJobs($conditions, NULL, NULL, $max, $order);
                    $num_getJobs = $this->m_jobs->getJobs($conditions);
                    $uri = '';
                    if($params != ''){
                        unset($params['p']);
                        $uri = '/'.build_url($params);
                    }
                    $href = $title_job.$uri;
                    //Pagination
                    $this->load->library('pagination');
                    $config['base_url'] = $href;
                    $config['total_rows'] = $num_getJobs->num_rows();
                    $config['per_page'] = $page_rows;
                    $config['cur_page'] = $page;
                    $this->pagination->initialize($config);
                    $this->_data['pagination'] = $this->pagination->create_links(false, 'job');
                    $this->_data['template']='employers/main';
                    $this->load->view('index',$this->_data);
                }
                else{
                    $this->load->Model("m_slideshow");
                    $this->_data['listSlideshow']=$this->m_slideshow->listSlideshow();
                    //list job hap dan
                    $order=array('jobs.update_at','DESC');
                    $limit=array(10);
                    $condition=array('jobs.status'=>1, 'jobs.is_deleted'=>0);
                    $jobs = $this->m_job->getJobs($condition,NULL,NULL,$limit,NULL,NULL,$order);
                    $this->_data['jobs']=$jobs;
                    $this->_data['template']='main';
                    $this->load->view('index',$this->_data);
                }
            }
            else{
                $this->load->Model("m_slideshow");
                $this->_data['listSlideshow']=$this->m_slideshow->listSlideshow();
                //list job hap dan
                $order=array('jobs.update_at','DESC');
                $limit=array(10);
                $condition=array('jobs.status'=>1);
                $jobs = $this->m_job->getJobs($condition,NULL,NULL,$limit,NULL,NULL,$order);
                $this->_data['jobs']=$jobs;
                $this->_data['template']='main';
                $this->load->view('index',$this->_data);
            }
        }
        /*end check_maintenace*/
    }
    function postJob(){
        if(!$this->session->userdata('user_id')){
            redirect(URL.$this->lang->line('l_sign_in').'/?next='.URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_job').'/'.$this->lang->line('l_post_job'));
        }
        if($this->session->userdata('role_id')==1){
            redirect(URL.'404');
        }
        $id = $this->uri->segment(5, 0);
        if($id > 0){
            $condition = array(
                'jobs.id' => $id
            );
            //get resume_language
            $conditions=array('job_languages.job_id'=>$id);
            $getJobLanguage=$this->m_job_language->getJobLanguage($conditions);
            if($getJobLanguage->num_rows()>0){
                $this->_data['getJobLanguage'] = $getJobLanguage;
            }
            $this->_data['job'] = $job = $this->m_jobs->getJobs($condition)->row();
        }else {
            // lay job chua dc approved (status = 0)
            $condition = array(
                'jobs.user_id' => $this->session->userdata('user_id'),
                'jobs.status' => 0,
            );
        }
        $this->_data['menuActive'] = 'createJob';
        $this->_data['category_ids'] = '';
        if(($this->input->post('category_ids', TRUE))){
            $this->_data['category_ids'] = $this->input->post('category_ids', TRUE);
        }elseif(isset($job) && $job->category_ids != ''){
            $this->_data['category_ids'] = explode(',', $job->category_ids);
        }
        $this->_data['city_ids'] = '';
        if($this->input->post('city_ids', TRUE)){
            $this->_data['city_ids'] = $this->input->post('city_ids', TRUE);
        }elseif(isset($job) && $job->city_ids != ''){
            $this->_data['city_ids'] = explode(',', $job->city_ids);
        }
        $this->_data['submission'] = ($this->input->post('submission', TRUE))?$this->input->post('submission', TRUE):'';
        $this->_data['category'] = ($this->input->post('category', TRUE))?$this->input->post('category', TRUE):'';
        $this->_data['city'] = ($this->input->post('city', TRUE))?$this->input->post('city', TRUE):'';
        $this->_data['type_job'] = ($this->input->post('type_job', TRUE))?$this->input->post('type_job', TRUE):'';
        $this->_data['level'] = ($this->input->post('level', TRUE))?$this->input->post('level', TRUE):'';
        $this->_data['salary'] = ($this->input->post('salary', TRUE))?$this->input->post('salary', TRUE):'';
        $this->_data['fromage'] = ($this->input->post('fromage', TRUE))?$this->input->post('fromage', TRUE):'';
        $this->_data['toage'] = ($this->input->post('toage', TRUE))?$this->input->post('toage', TRUE):'';
        $this->_data['sex'] = ($this->input->post('sex', TRUE))?$this->input->post('sex', TRUE):'';
        $this->_data['country'] = ($this->input->post('country', TRUE))?$this->input->post('country', TRUE):'';
        $this->_data['education'] = ($this->input->post('education', TRUE))?$this->input->post('education', TRUE):'';
        $this->_data['year_exp'] = ($this->input->post('year_exp', TRUE))?$this->input->post('year_exp', TRUE):'';
        $this->_data['type_contact'] = ($this->input->post('type_contact', TRUE))?$this->input->post('type_contact', TRUE):'';
        $this->_data['language_contact'] = ($this->input->post('language_contact', TRUE))?$this->input->post('language_contact', TRUE):'';
        $this->_data['language_level1'] = ($this->input->post('language-level1', TRUE))?$this->input->post('language-level1', TRUE):'';
        $this->_data['language1'] = ($this->input->post('language1', TRUE))?$this->input->post('language1', TRUE):'';
        //Intialize values for library and helpers
        $this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
        if ($this->input->post('action')) {
            //Set rules
            $this->form_validation->set_rules('title', 'lang:Title', 'required|xss_clean');
            $this->form_validation->set_rules('quantity', 'lang:Number job', 'required|xss_clean');
            $this->form_validation->set_rules('category[]', 'lang:Choose nghanh', 'required|xss_clean');
            $this->form_validation->set_rules('city[]', 'lang:Choose address', 'required|xss_clean');
            $this->form_validation->set_rules('type_job', "lang:Type job", 'required|xss_clean');
            $this->form_validation->set_rules('level', "lang:Level", 'required|xss_clean');
            $this->form_validation->set_rules('salary', "lang:Salary", 'required|xss_clean');
            $this->form_validation->set_rules('fromage', "lang:From age", 'required|xss_clean');
            $this->form_validation->set_rules('toage', "lang:To age", 'required|xss_clean');
            $this->form_validation->set_rules('sex', "lang:Sex", 'required|xss_clean');
            $this->form_validation->set_rules('country', "lang:quoc gia", 'required|xss_clean');
            $this->form_validation->set_rules('description', "lang:Describe your job in detail", 'required|xss_clean');
            $this->form_validation->set_rules('education', "lang:Education", 'required|xss_clean');
            $this->form_validation->set_rules('language1', "lang:Languages", 'required|xss_clean');
            $this->form_validation->set_rules('language-level1', "lang:Languages level", 'required|xss_clean');
            $this->form_validation->set_rules('year_exp', "lang:Experience", 'required|xss_clean');
            $this->form_validation->set_rules('detail_skills', "lang:Detail skills", 'required|xss_clean');
            $this->form_validation->set_rules('type_contact', "lang:Type contact", 'required|xss_clean');
            $this->form_validation->set_rules('language_contact', "lang:Type accept resume", 'required|xss_clean');
            $this->form_validation->set_rules('address_contact', "lang:Address contact", 'required|xss_clean');
            $this->form_validation->set_rules('name_contact', "lang:Name contact", 'required|xss_clean');
            $this->form_validation->set_rules('email_contact', "lang:Email contact", 'required|trim|xss_clean');
            $this->form_validation->set_rules('phone_contact', "lang:Phone contact", 'required|trim|xss_clean');
            $this->form_validation->set_message('required', '%s ' . $this->lang->line('required'));
            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'user_id' => $this->session->userdata('user_id'),
                    'category_ids' => implode(',', $this->input->post('category', true)),
                    'city_ids' => implode(',', $this->input->post('city', true)),
                    'education_id' => $this->input->post('education', true),
                    'type_id' => $this->input->post('type_job', true),
                    'level_id' => $this->input->post('level', true),
                    'country_id' => $this->input->post('country', true),
                    'title' => $this->input->post('title', true),
                    'alias' => standardURL($this->input->post('title', true)),
                    'gender'=> $this->input->post('sex', true),
                    'fromage' => $this->input->post('fromage', true),
                    'toage' => $this->input->post('toage', true),
                    'year_exp' => $this->input->post('year_exp', true),
                    'qty' => $this->input->post('quantity', true),
                    'salary' => $this->input->post('salary', true),
                    'salary_min' => 0,
                    'salary_max' => 0,
                    'description' => $this->input->post('description', true),
                    'experience_skill' => $this->input->post('detail_skills', true),
                    'status' => 1,
                    'date_expiration' => date(DATETIME_FORMAT_DB, time()+(86400*30)),
                    'date_created' => date(DATETIME_FORMAT_DB, time()),
                    'update_at' => date(DATETIME_FORMAT_DB, time()),
                    'favourites' => 0,
                    'views' => 1,
                    'idJobOther' => '',
                    'type_contact' => $this->input->post('type_contact', true),
                    'email_contact' => $this->input->post('email_contact', true),
                    'name_contact' => $this->input->post('name_contact', true),
                    'address_contact' => $this->input->post('address_contact', true),
                    'people_contact' => $this->input->post('people_contact', true),
                    'phone_contact' => $this->input->post('phone_contact', true),
                    'language_contact' => $this->input->post('language_contact', true),
                    'hide_infomation' => $this->input->post('hide_infomation', true),
                    'submission' => $this->input->post('submission', true)
                );
                if($job != null && $id != 0){
                    $job_id = $job->id;
                    $this->m_jobs->updateJob(array('jobs.id' => $job->id), $data);
                    //delete before insert Language
                    $deleteDataLanguage=array();
                    $deleteDataLanguage['job_languages.job_id']=$id;
                    $this->m_job_language->deleteJobLanguage(null,$deleteDataLanguage);
                    //insert Language
                    for($i=1;$i<=3;$i++){
                        if($this->input->post('language'.$i.'', TRUE)!=''){
                            $insertDataLanguage=array();
                            $insertDataLanguage['job_id']=$job_id;
                            $insertDataLanguage['language_id']=$this->input->post('language'.$i.'', TRUE);
                            $insertDataLanguage['language_level_id']=$this->input->post('language-level'.$i.'', TRUE);
                            $this->m_job_language->addJobLanguage($insertDataLanguage);
                        }
                    }
                    $message = $this->lang->line('edit job success').'<a href="'.URL.$this->lang->line('l_detail').'/'.$data['alias'].'-'.$job_id.'">'.$data['title'].'</a>';
                }else{
                    $job_id = $this->m_jobs->addJob($data);
                    //insert Language
                    for($i=1;$i<=3;$i++){
                        if($this->input->post('language'.$i.'', TRUE)!=''){
                            $insertDataLanguage=array();
                            $insertDataLanguage['job_id']=$job_id;
                            $insertDataLanguage['language_id']=$this->input->post('language'.$i.'', TRUE);
                            $insertDataLanguage['language_level_id']=$this->input->post('language-level'.$i.'', TRUE);
                            $this->m_job_language->addJobLanguage($insertDataLanguage);
                        }
                    }
                    $getUsers=$this->m_user->getUsers(array('users.id'=>$this->session->userdata('user_id')))->row();
                    $paramBody = array(
                     '!joburl' => site_url('detail-jobs/'.standardURL($this->input->post('title', true)).'-'.$job_id),
                     '!dashboardurl' => site_url('detail-jobs/'.standardURL($this->input->post('title', true)).'-'.$job_id),
                     '!url_home' => site_url(),
                     '!images'=>IMAGES.'rsz_logo.png'
                    );
                    $this->email->mailFrom = "no-reply@workspharma.com";
                    $this->email->mailTo = $getUsers->email;
                    $this->email->templateType = 'job_post';
                    $this->email->paramBody = $paramBody;
                $this->email->sendMail();
                    $message = $this->lang->line('post job success').'<a href="'.URL.$this->lang->line('l_detail').'/'.$data['alias'].'-'.$job_id.'">'.$data['title'].'</a>';
                }
                $this->session->set_flashdata('flash_message', setMessage('success', $message));
                redirect($this->lang->line('l_employers'));
            }
        }
        $this->_data['template']='employers/postJob';
        $this->load->view('index', $this->_data);
    }
    function search()
    {
        $this->load->helper('jobs');
        $params = (my_uri_to_assoc(0))?my_uri_to_assoc(0):'';
        $this->_data['params'] = $params;
        if($this->input->post('salary',TRUE)){
            $salary = $this->input->post('salary',TRUE);
            $url = current_url_temp1();
            if(isset($params['salary'])){
                $url = preg_replace('/salary\/([0-9])/', 'salary/'.$salary.'', $url);
                echo json_encode(array('url'=>$url));die;
            }
            else{
                echo json_encode(array('url'=>$url.'/salary/'.$salary));die;
            }
        }
        if($this->input->post('experience',TRUE)){
            $experience = $this->input->post('experience',TRUE);
            $url = current_url_temp1();
            if(isset($params['experience'])){
                echo json_encode(array('url'=>$url));die;
            }
            else{
                echo json_encode(array('url'=>$url.'/experience/'.$experience));die;
            }
        }
        redirect_page($_POST);
        $page = isset($params['p']) ? $params['p'] : 1;
        $this->_data['menuActive'] = 'findResume';
        $this->_data['menuActiveChild'] = 'findResume';
        $this->_data['default_exp'] = $this->config->item('default_exp');
        $page_rows = $this->config->item('listing_limit');
        $max = array($page_rows, ($page - 1) * $page_rows);
        $limit1[0] = $page_rows;
        $limit1[1] = '0';
        $order = array('resume.date_updated', 'DESC');
        $conditions = array(
            'users.role_id' => 1,
            'resume.visible_to_employer' => 1
        );
        if(isset($params['salary'])){
            $this->_data['salary'] = $params['salary'];
            $conditions['resume.expected_salary'] = $params['salary'];
        }
        if(isset($params['experience'])){
            $this->_data['experience'] = $params['experience'];
            $conditions['resume.yearOfExperience'] = $params['experience'];
        }
        $orderby = array('resume.date_created','DESC');
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
        $exp = (isset($params['exp']))?$params['exp']:'';
        if($exp != ''){
            $conditions["resume.yearOfExperience"] = $params['exp'];
        }
        $gender = (isset($params['gender']))?$params['gender']:'';
        if($gender != ''){
            $conditions["resume.gender"] = $params['gender'];
        }
        $marital = (isset($params['marital']))?$params['marital']:'';
        if($marital != ''){
            $conditions["resume.marital"] = $params['marital'];
        }
        $country = (isset($params['country']))?$params['country']:'';
        if($country != ''){
            $conditions["resume.country"] = $params['country'];
        }
        $language = (isset($params['language']))?$params['language']:'';
        if($language != ''){
            $conditions["resume_languages.language_id"] = $params['language'];
        }
        $language_level = (isset($params['language-level']))?$params['language-level']:'';
        if($language_level != ''){
            $conditions["resume_languages.language_level_id"] = $params['language-level'];
        }
        $language = (isset($params['language']))?$params['language']:'';
        if($exp != ''){
            $conditions["resume.language"] = $params['language'];
        }
        $education = (isset($params['education']))?$params['education']:'';
        if($education != ''){
            $conditions["resume.education"] = $params['education'];
        }
        $type = (isset($params['type']))?$params['type']:'';
        if($type != ''){
            $conditions["resume.type"] = $params['type'];
        }
        $level = (isset($params['level']))?$params['level']:'';
        if($level != ''){
            $conditions["resume.expectedJobLevel"] = $params['level'];
        }
        $salary = (isset($params['salary']))?$params['salary']:'';
        if($salary != ''){
            $conditions["resume.expected_salary "] = $params['salary'];
        }
        $like = '';
        // keyword search
        $keywords = isset($params['keywords'])?trim($params['keywords']):'';
        if($keywords != ''){
            $keywords = urldecode($keywords);
            $like = array('resume.title'=>$keywords);
        }
        $day = isset($params['day'])?trim($params['day']):'';
        if($day != ''){
            $conditions["resume.date_created > "] = time() - ($day * 24 * 24 * 60);
        }
        $or_like = '';
        $or_where = null;
        $href = $this->lang->line('l_employers').'/'.$this->lang->line('l_find_resume');
        $uri = '';
        if ($params != '') {
            unset($params['keywords']);
            $uri = '/' . build_url($params);
        }
        $href .= $uri;
        $this->_data['resumes'] = $this->m_jobs->getUserResumes($conditions, NULL, $like, $max, $orderby, $or_like, $or_where,$stringCategories,$stringCities);
        $num_users = $this->m_jobs->getUserResumes($conditions, null, $like, null, $orderby, $or_like, $or_where,$stringCategories,$stringCities);
        //Pagination
        $this->load->library('pagination');
        $config['base_url'] = $href;
        $config['total_rows'] = $num_users->num_rows();
        $config['per_page'] = $page_rows;
        $config['cur_page'] = $page;
        $this->pagination->initialize($config);
        $this->_data['pagination'] = $this->pagination->create_links(false, 'job');
        $this->_data['template'] = 'employers/findResume';
        if(isset($params['tab'])){
            $this->_data['tab'] = $params['tab'];
        }
        $this->load->view('index', $this->_data);
    }
    function viewMyResumeAlerts()
    {
        if(!$this->session->userdata('user_id')){
            redirect(URL.$this->lang->line('l_sign_in').'/?next='.current_url_temp1());
        }
        if($this->session->userdata('role_id')==1){
            redirect(URL.'404');
        }
        $users_id = $this->session->userdata('user_id');
        $getResumeAlert = $this->m_skills->getResumeAlert();
        if($getResumeAlert->num_rows() > 0){
            $this->_data['getResumeAlert'] = $getResumeAlert->row();
        }
        $this->_data['default_my_resume_alerts'] = $this->config->item('default_my_resume_alerts');
        $this->_data['menuActive'] = 'Manage resume';
        $this->_data['menuActiveChild'] = 'viewMyResumeAlerts';
        $this->_data['type'] = ($this->input->post('type_job', TRUE))?$this->input->post('type_job', TRUE):'';
        $this->_data['level'] = ($this->input->post('level', TRUE))?$this->input->post('level', TRUE):'';
        $this->_data['salary'] = ($this->input->post('salary', TRUE))?$this->input->post('salary', TRUE):'';
        $this->_data['sex'] = ($this->input->post('gender', TRUE))?$this->input->post('gender', TRUE):'';
        $this->_data['category'] = ($this->input->post('category', TRUE))?implode(',',$this->input->post('category', TRUE)):'';
        $this->_data['city'] = ($this->input->post('city', TRUE))?implode(',',$this->input->post('city', TRUE)):'';
        $this->_data['country'] = ($this->input->post('country', TRUE))?$this->input->post('country', TRUE):'';
        $this->_data['education'] = ($this->input->post('education', TRUE))?$this->input->post('education', TRUE):'';
        $this->_data['year_exp'] = ($this->input->post('year_exp', TRUE))?$this->input->post('year_exp', TRUE):'';
        $this->_data['language_level'] = ($this->input->post('language-level', TRUE))?$this->input->post('language-level', TRUE):'';
        $this->_data['language'] = ($this->input->post('language', TRUE))?$this->input->post('language', TRUE):'';
        //Intialize values for library and helpers
        $this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
        if ($this->input->post('submitResumeAlert')) {
            //Set rules
            $this->form_validation->set_rules('level_resume_find', 'lang:Level resume find', 'required|xss_clean');
            $this->form_validation->set_message('required', '%s ' . $this->lang->line('required'));
            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'user_id' => $users_id,
                    'level_resume_find' => $this->input->post('level_resume_find', true),
                    'keywords' => $this->input->post('keywords', true),
                    'sex'=> $this->input->post('gender', true),
                    'marital' => $this->input->post('marital', true),
                    'country' => $this->input->post('country', true),
                    'language' => $this->input->post('language', true),
                    'language_level' => $this->input->post('language-level', true),
                    'education' => $this->input->post('education', true),
                    'type' => $this->input->post('type', true),
                    'level' => $this->input->post('level', true),
                    'year_exp' => $this->input->post('year_exp', true),
                    'salary' => $this->input->post('salary', true),
                    'my_resume_alerts' => $this->input->post('my_resume_alerts', true),
                    'email' => $this->input->post('email', true)
                );
                if($this->_data['category'] != ''){
                    $data['category_ids'] = implode(',', $this->input->post('category', true));
                }
                if($this->_data['city'] != ''){
                    $data['city_ids'] = implode(',', $this->input->post('city', true));
                }
                if(isset($this->_data['getResumeAlert'])){
                    $this->m_skills->updateResumeAlerts($this->_data['getResumeAlert']->id,$data);
                }
                else{
                    $this->m_skills->addResumeAlert($data);
                }
                $this->session->set_flashdata('flash_message', setMessage('success', $this->lang->line('You have successfully updated search profiles / Announcement records.')));
                redirect(URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_my_resume_alerts'));
            }
        }
        $this->_data['template'] = 'employers/viewMyResumeAlerts';
        $this->load->view('index', $this->_data);
    }
    function viewSendResumeAlerts($idApply)
    {
        if(!$this->session->userdata('user_id')){
            redirect(URL.$this->lang->line('l_sign_in').'/?next='.current_url_temp1());
        }
        if($this->session->userdata('role_id')==1){
            redirect(URL.'404');
        }
        if(!is_numeric($idApply)){
            redirect(URL.'404');
        }
        $getUserApplies = $this->m_jobs->getUserApplies(array('job_apply.id' => $idApply));
        if($getUserApplies->num_rows() ==0){
            redirect($_SERVER['HTTP_REFERER']);
        }
        $this->_data['getUserApplies'] = $getUserApplies->row();
        $getUserMessagesDefault = $this->m_jobs->getUserMessagesDefault(array('user_message_default.status'=>1));
        if($getUserMessagesDefault->num_rows() ==0){
            redirect($_SERVER['HTTP_REFERER']);
        }
        $this->_data['getUserMessagesDefault'] = $getUserMessagesDefault;
        $getUserWorker = $this->m_user->getUserWorker(array('users.id'=>$getUserApplies->row()->worker_id));
        $this->_data['getUserWorker'] = $getUserWorker->row();
        if($getUserMessagesDefault->num_rows() ==0){
            redirect($_SERVER['HTTP_REFERER']);
        }
        $users_id = $this->session->userdata('user_id');
        $this->_data['menuActive'] = 'My carrer';
        $this->_data['menuActiveChild'] = $this->lang->line('Jobs are posted');
        $this->_data['resume_alert_id'] = ($this->input->post('resume_alert_id', TRUE))?$this->input->post('resume_alert_id', TRUE):'';
        $this->_data['title_send_resume_alert'] = ($this->input->post('title_send_resume_alert', TRUE))?$this->input->post('title_send_resume_alert', TRUE):'';
        $this->_data['content_send_resume_alert'] = ($this->input->post('content_send_resume_alert', TRUE))?$this->input->post('content_send_resume_alert', TRUE):'';
        //Intialize values for library and helpers
        $this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
        if ($this->input->post('submitSendResumeAlert')) {
            //Set rules
            $this->form_validation->set_rules('title_send_resume_alert', 'lang:Subject line', 'required|xss_clean');
            $this->form_validation->set_rules('content_send_resume_alert', 'lang:Contents of letter', 'required|xss_clean');
            $this->form_validation->set_message('required', '%s ' . $this->lang->line('required'));
            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'employer_id' => $users_id,
                    'jobseeker_id' => $getUserApplies->row()->worker_id,
                    'apply_id' => $idApply,
                    'resume_alert_id'=> $this->input->post('resume_alert_id', true),
                    'title_send_resume_alert' => $this->input->post('title_send_resume_alert', true),
                    'content_send_resume_alert' => $this->input->post('content_send_resume_alert', true)
                );
                $toEmail = $getUserWorker->row()->email;
                $paramSubject = array(
                    "!title" => $this->input->post('title_send_resume_alert', true)
                );
                $paramBody = array(
                    "!content" => $this->input->post('content_send_resume_alert', true)
                );
                $this->email->mailFrom      = $this->config->item('site_admin_mail');
                $this->email->mailTo        = $toEmail;
                $this->email->templateType  = 'send_resume_alert';
                $this->email->paramSubject  = $paramSubject;
                $this->email->paramBody     = $paramBody;
                //var_dump($this->email);die;
                $this->email->sendMail();
                $this->m_jobs->addSendResumeAlert($data);
                $this->session->set_flashdata('flash_message', setMessage('success', $this->lang->line('You have to provide written notice to recruit successful candidates')));
                redirect(URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_view_resume').'/job_id/'.$this->_data['getUserApplies']->job_id);
            }
        }
        $this->_data['template'] = 'employers/viewSendResumeAlerts';
        $this->load->view('index', $this->_data);
    }
    function viewMessages()
    {
        $this->_data['menuActive'] = 'Manage resume';
        $this->_data['menuActiveChild'] = 'viewMessages';
        if(!$this->session->userdata('user_id')){
            redirect(URL.$this->lang->line('l_sign_in').'/?next='.current_url_temp1());
        }
        if($this->session->userdata('role_id')==1){
            redirect(URL.'404');
        }
        $condition = array(
            'users.id' => $this->session->userdata('user_id')
        );
        $this->_data['userInfo'] = $user = $this->m_jobs->getUserEmployers($condition)->row();
        $this->load->helper('jobs');
        $params = (uri_to_assoc(2)) ? uri_to_assoc(2) : '';
        $page = isset($params['p']) ? $params['p'] : 1;
        $this->_data['params'] = $params;
        $page_rows = $this->config->item('listing_limit');
        $max = array($page_rows, ($page - 1) * $page_rows);
        $href = $this->lang->line('l_employers').'/'.$this->lang->line('l_messages');
        $uri = '';
        $href .= $uri;
        $conditions = array('status' => 1);
        $orderby = array('user_message_default.id', 'DESC');
        $this->_data['getUserMessagesDefault'] = $this->m_jobs->getUserMessagesDefault($conditions, NULL, null, $max, $orderby);
        $num_users = $this->m_jobs->getUserMessagesDefault($conditions, null, null, null, $orderby);
        //Pagination
        $this->load->library('pagination');
        $config['base_url'] = $href;
        $config['total_rows'] = $num_users->num_rows();
        $config['per_page'] = $page_rows;
        $config['cur_page'] = $page;
        $this->pagination->initialize($config);
        $this->_data['pagination'] = $this->pagination->create_links(false, 'job');
        $this->_data['template'] = 'employers/viewMessages';
        if(isset($params['tab'])){
            $this->_data['tab'] = $params['tab'];
        }
        $this->load->view('index', $this->_data);
    }
    function createMessages()
    {
        $this->_data['menuActive'] = 'Manage resume';
        $this->_data['menuActiveChild'] = 'viewMessages';
        if(!$this->session->userdata('user_id')){
            redirect(URL.$this->lang->line('l_sign_in').'/?next='.current_url_temp1());
        }
        if($this->session->userdata('role_id')==1){
            redirect(URL.'404');
        }
        $users_id = $this->session->userdata('user_id');
        $condition = array(
            'users.id' => $users_id
        );
        $this->_data['userInfo'] = $user = $this->m_jobs->getUserEmployers($condition)->row();
        //Intialize values for library and helpers
        $this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
        if ($this->input->post('submitCreateMessage')) {
            //Set rules
            $this->form_validation->set_rules('name', 'lang:Name', 'required|xss_clean');
            $this->form_validation->set_rules('title', 'lang:Title', 'required|xss_clean');
            $this->form_validation->set_rules('content', 'lang:Content', 'required|xss_clean');
            $this->form_validation->set_message('required', '%s ' . $this->lang->line('required'));
            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'user_id' => $users_id,
                    'name' => $this->input->post('name', true),
                    'title' => $this->input->post('title', true),
                    'content'=> $this->input->post('content', true),
                    'status' => 1,
                );
                $this->m_jobs->addMessagesDefault($data);
                $this->session->set_flashdata('flash_message', setMessage('success', $this->lang->line('Message saved message')));
                redirect(URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_messages'));
            }
        }
        $this->_data['template'] = 'employers/createMessage';
        $this->load->view('index', $this->_data);
    }
    function editMessages()
    {
        $this->_data['menuActive'] = 'Manage resume';
        $this->_data['menuActiveChild'] = 'viewMessages';
        if(!$this->session->userdata('user_id')){
            redirect(URL.$this->lang->line('l_sign_in').'/?next='.current_url_temp1());
        }
        if($this->session->userdata('role_id')==1){
            redirect(URL.'404');
        }
        $id = $this->uri->segment(4);
        $users_id = $this->session->userdata('user_id');
        $getUserMessagesDefault = $this->m_jobs->getUserMessagesDefault(array('user_id' => $users_id,'user_message_default.id' => $id));
        if($getUserMessagesDefault->num_rows() == 0){
            redirect(URL.'404');
        }
        $this->_data['getUserMessagesDefault'] = $getUserMessagesDefault->row();
        $condition = array(
            'users.id' => $users_id
        );
        $this->_data['userInfo'] = $user = $this->m_jobs->getUserEmployers($condition)->row();
        //Intialize values for library and helpers
        $this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
        if ($this->input->post('submitEditMessage')) {
            //Set rules
            $this->form_validation->set_rules('name', 'lang:Name', 'required|xss_clean');
            $this->form_validation->set_rules('title', 'lang:Title', 'required|xss_clean');
            $this->form_validation->set_rules('content', 'lang:Content', 'required|xss_clean');
            $this->form_validation->set_message('required', '%s ' . $this->lang->line('required'));
            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'user_id' => $users_id,
                    'name' => $this->input->post('name', true),
                    'title' => $this->input->post('title', true),
                    'content'=> $this->input->post('content', true),
                    'status' => 1,
                );
                $this->m_jobs->updateMessagesDefault(array('user_message_default.id' => $id), $data);
                $this->session->set_flashdata('flash_message', setMessage('success', $this->lang->line('Message update message')));
                redirect(current_url_temp1());
            }
        }
        $this->_data['template'] = 'employers/editMessage';
        $this->load->view('index', $this->_data);
    }
    function viewResume()
    {
        if (!$this->session->userdata('user_id') && !$this->session->userdata('__gidAdmin__')) {
            redirect(URL.'404');
        }
        else{
            if($this->session->userdata('role_id') == 1 && !$this->session->userdata('__gidAdmin__')){
                redirect(URL.'404');
            }
            else{
                $users_id = $this->session->userdata('user_id');
                //Load model
                $this->load->model('m_resume_projects');
                $this->load->model('m_resume');
                //library
                $this->load->library('email');
                $this->load->library('form_validation');
                //helper
                $this->load->helper('form');
                $params = get_params();
                $this->_data['params'] = $params;
                if(isset($params['idResume'])){
                    $id = $this->encrypt->decode($params['idResume']);
                    $conditions=array('resume.id'=>$id);
                    $getResume=$this->m_resume->getResume($conditions);
                    if($getResume->num_rows()==0){
                        redirect(URL.'404');
                    }
                }
                $condition_resume_view = array(
                    'resume_id' => $id,
                    'user_id' => $users_id
                );
                $resume_views = $this->m_resume->getResumeViewEmployers($condition_resume_view);
                if($resume_views->num_rows() > 0){
                    $resume_view = $resume_views->row();
                    $this->m_resume->updateResumeViewEmployer($condition_resume_view, array('views' => $resume_view->views + 1));
                }else{
                    $data_insert = array(
                        'resume_id' => $id,
                        'user_id' => $users_id,
                        'views' => 1,
                        'date_created' => time()
                    );
                    $this->m_resume->addResumeViewEmployer($data_insert);
                }
                if ($this->input->post('saveResume')) {
                    $data_insert = array(
                        'resume_id' => $id,
                        'user_id' => $users_id,
                        'created_at' => time()
                    );
                    $this->m_resume_favourites->insert($data_insert);
                    $this->session->set_flashdata('flash_message', setMessage('success', $this->lang->line('Message saved resume')));
                    redirect(current_url_temp1());
                }
                $condition_resume_favourites = array(
                    'resume_favourites.resume_id' => $id,
                    'resume_favourites.user_id' => $users_id
                );
                $resume_favourites = $this->m_resume_favourites->getResumeFavourites($condition_resume_favourites);
                if($resume_favourites->num_rows() > 0 ){
                    $this->_data['resume_favourites'] = $resume_favourites->row();
                }
                $this->_data['getResume'] = $getResume->row();
                $this->_data['template'] = 'employers/viewResume';
                $this->load->view('index', $this->_data);
            }
        }
    }
    function viewMyResumesApplyJob()
    {
        $this->_data['menuActive'] = 'Manage resume';
        $this->_data['menuActiveChild'] = $this->lang->line('Jobs are posted');
        $this->load->helper('jobs');
        $params = (uri_to_assoc(2)) ? uri_to_assoc(2) : '';
        $this->_data['params'] = $params;
        $getJob = $this->m_job->getJobs(array('jobs.id'=>$params['job_id']));
        if($getJob->num_rows() == 0)
        {
            redirect(URL.'404');
        }
        $this->_data['getJob'] = $getJob->row();
        if(!$this->session->userdata('user_id')){
            $message = $this->lang->line('Please login account employer');
            $this->session->set_flashdata('flash_message', setMessage('error', $message));
            redirect('users/login/?next='.site_url('employers/applies'));
        }
        else{
            if($this->session->userdata('role_id') == 1){
                redirect(URL.'404');
            }
        }
        $default_status_resume_applied = $this->config->item('default_status_resume_applied');
        $this->_data['default_status_resume_applied'] = $default_status_resume_applied;
        $users_id = $this->session->userdata('user_id');
        $condition = array(
            'users.id' => $users_id
        );
        $this->_data['userInfo'] = $user = $this->m_jobs->getUserEmployers($condition)->row();
        $page = isset($params['p']) ? $params['p'] : 1;
        $page_rows = $this->config->item('listing_limit');
        $max = array($page_rows, ($page - 1) * $page_rows);
        $limit1[0] = $page_rows;
        $limit1[1] = '0';
        $order = array('job_apply.date_created', 'desc');
        $conditions = array(
            'jobs.user_id' => $users_id,
            'users.role_id' => 1
        );
        if(isset($params['job_id']) && $params['job_id'] > 0){
            $conditions['job_apply.job_id'] = $params['job_id'];
        }
        if(isset($params['status']) && $params['status'] != ''){
            $conditions['job_apply.status'] = $params['status'];
        }
        $this->_data['resumeApply'] = $this->m_jobs->getUserApplies($conditions, NULL, NULL, $max, $order);
        //echo $this->db->last_query(); die;
        $num_users = $this->m_jobs->getUserApplies($conditions);
        $uri = '';
        if($params != ''){
            unset($params['p']);
            $uri = '/'.build_url($params);
        }
        $href = '/employers/applies'.$uri;
        //Pagination
        $this->load->library('pagination');
        $config['base_url'] = $href;
        $config['total_rows'] = $num_users->num_rows();
        $config['per_page'] = $page_rows;
        $config['cur_page'] = $page;
        $this->pagination->initialize($config);
        $this->_data['pagination'] = $this->pagination->create_links(false, 'job');
        $this->_data['template'] = 'employers/applies';
        $this->load->view('index', $this->_data);
    }
    function viewMyResumesSave()
    {
        $this->_data['menuActive'] = 'Manage resume';
        $this->_data['menuActiveChild']= 'viewMyResumesSave';
        if(!$this->session->userdata('user_id')){
            redirect(URL.$this->lang->line('l_sign_in').'/?next='.current_url_temp1());
        }
        else{
            if($this->session->userdata('role_id')==1){
                redirect(URL.'404');
            }
            else{
                if($this->session->userdata('user_id')){
                    if($this->session->userdata('role_id')==2){
                        $condition = array(
                            'users.id' => $this->session->userdata('user_id')
                        );
                        $this->_data['userInfo'] = $user = $this->m_jobs->getUserEmployers($condition)->row();
                    }
                }
                $users_id = $this->session->userdata('user_id');
                //Load model
                $condition_resume_favourites = array(
                    'resume_favourites.user_id' => $users_id
                );
                $getResumeFavourites = $this->m_resume_favourites->getResumeFavourites($condition_resume_favourites);
                if($getResumeFavourites->num_rows() > 0 ){
                    $this->_data['getResumeFavourites'] = $getResumeFavourites;
                }
                $this->_data['template'] = 'employers/myResumesSave';
                $this->load->view('index', $this->_data);
            }
        }
    }
    function resumeApply()
    {
        $this->load->helper('jobs');
        $this->load->model('m_cities');
        $this->load->model('country_model');
        $this->load->model('m_district');
        $this->load->model('language_model');
        $this->load->model('language_level_model');
        $this->load->model('skills_model');
        $this->load->model('job_model');
        $this->load->model('resume_language_model');
        $this->load->model('resume_experience_model');
        $this->load->model('resume_education_model');
        $this->load->model('resume_model');
        $this->load->library('email');
        $params = (uri_to_assoc(2)) ? uri_to_assoc(2) : '';
        $this->_data['params'] = $params;
        $id = $this->uri->segment(3, 0);
        $apply_id = $this->uri->segment(4, 0);
        if(!isEmployer()){
            $message = $this->lang->line('Please login account employer');
            $this->session->set_flashdata('flash_message', setMessage('error', $message));
            redirect(URL.'users/login/?next='.site_url('employers/resumeDetail/'.$id));
        }
        $this->_data['menuActive']['search_menuActive'] = 'active';
        $this->_data['cities'] = $this->m_cities->getCities();
        $this->_data['countries'] = $this->country_model->getCountry();
        $this->_data['district'] = $this->m_district->getDistrict();
        $this->_data['getLanguage'] = $this->language_model->getLanguage();
        $this->_data['getLanguageLevel'] = $this->language_level_model->getLanguageLevel();
        $this->_data['getCategories'] = $this->skills_model->getCategories();
        $this->_data['default_education'] = $this->config->item('default_education');
        $this->_data['default_language'] = $this->config->item('default_language');
        $this->_data['default_language_level'] = $this->config->item('default_language_level');
        $this->_data['default_currentJobLevel'] = $this->config->item('default_currentJobLevel');
        if($id > 0){
            $conditions = array(
                'resume.id' => $id,
                'users.role_id' => 1
            );
            $fields = 'users.id, users.user_name, users.email, users.display_name, users.logo, resume.*';
            $this->_data['users'] = $user = $this->m_jobs->getUserResumes($conditions, $fields)->row();
            // check user apply
            $condition_apply = array(
                'resume.id' => $id,
                'job_apply.worker_id' => $user->user_id,
            );
            $resumes = $this->m_jobs->getUserApplies($condition_apply, 'resume.id');
            if($resumes->num_rows() == 0){
                redirect(URL.'employers/resumeDetail/'.$id);
            }
            //get resume_language
            $conditions=array('resume_languages.resume_id'=>$id);
            $this->_data['getResumeLanguage']=$this->resume_language_model->getResumeLanguage($conditions);
            //get resume_experience
            $conditions=array('resume_experiences.resume_id'=>$id);
            $this->_data['getResumeExperience']=$this->resume_experience_model->getResumeExperience($conditions);
            //get resume_education
            $conditions=array('resume_educations.resume_id'=>$id);
            $this->_data['getResumeEducation']=$this->resume_education_model->getResumeEducation($conditions);
            // update view resume
            $condition_update = array(
                'id' => $id
            );
            $this->resume_model->updateResume($condition_update, array('views' => $user->views + 1));
            $condition_resume_view = array(
                'resume_id' => $id,
                'user_id' => $this->session->userdata('user_id')
            );
            $resume_views = $this->resume_model->getResumeViewEmployers($condition_resume_view);
            if($resume_views->num_rows() > 0){
                $resume_view = $resume_views->row();
                $this->resume_model->updateResumeViewEmployer($condition_resume_view, array('views' => $resume_view->views + 1));
            }else{
                $data_insert = array(
                    'resume_id' => $id,
                    'user_id' => $this->session->userdata('user_id'),
                    'views' => 1,
                    'date_created' => time()
                );
                $this->resume_model->addResumeViewEmployer($data_insert);
            }
            // update status apply
            if($apply_id > 0) {
                $condition = array(
                    'id' => $apply_id
                );
                $data = array(
                    'status' => 1
                );
                if ($this->m_jobs->updateApply($condition, $data)) {
                    //add notify or send mail
                    /*$fields = 'users.email, users.user_name, jobs.title';
                    $user = $this->m_jobs->getUserApplies(array('job_apply.id' => $apply_id), $fields)->row();
                    $employer = getUserInfo($this->session->userdata('user_id'), 'users.email, users.user_name');
                    $paramSubject = array(
                        '!user_name' => $employer->user_name,
                    );
                    $paramBody = array(
                        '!user_name' => $user->user_name,
                        '!employer' => $employer->user_name,
                        '!job' => $user->title,
                    );
                    $this->email->templateType = 'accept_apply';
                    $this->email->mailFrom = "no-reply@applancer.net";
                    $this->email->mailTo = $user->email;
                    $this->email->paramSubject = $paramSubject;
                    $this->email->paramBody = $paramBody;
                    $this->email->sendMail();*/
                }
            }
        }
        $this->load->view('employers/resumeApply', $this->_data);
    }
    // update status job
    function changeStatus(){
        $this->load->helper('jobs');
        $params = (uri_to_assoc(2)) ? uri_to_assoc(2) : '';;
        $date_cur = date('Y-m-d', time());
        if(!isEmployer()){
            $message = $this->lang->line('Please login account employer');
            $this->session->set_flashdata('flash_message', setMessage('error', $message));
            redirect(URL.'users/login/?next='.site_url('employers/jobs'));
        }
        if($params['job_id'] > 0) {
            $fields = 'jobs.date_expiration, jobs.status';
            $condition = array(
                'jobs.id' => $params['job_id'],
                'jobs.user_id' => $this->session->userdata('user_id')
            );
            $jobs = $this->m_jobs->getJobs($condition, $fields);
            if($jobs->num_rows() > 0) {
                $job = $jobs->row();
                $date_expiration = date('Y-m-d', strtotime($job->date_expiration));
                if (strtotime($date_cur) > strtotime($date_expiration)) {
                    redirect(URL.'employers/jobPack');
                } else {
                    $this->m_jobs->updateJob(array('jobs.id' => $params['job_id']), array('jobs.status' => $params['status']));
                }
            }
        }
        redirect(URL.'employers/jobs');
    }
    function _check_salary($salary)
    {
        if($this->input->post('salary_min', TRUE)) {
            $salary_min = $this->input->post('salary_min', TRUE);
            if ($salary_min > 0 && $salary > $salary_min) {
                return true;
            } else {
                $this->form_validation->set_message('_check_salary', $this->lang->line('salary_max_validate'));
                return false;
            }
        }
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
                $this->form_validation->set_message('_check_logo', $this->lang->line('This file is required'));
                return false;
            }
        return false;
    }
    // --------------------------------------------------------------------
    // --------------------------------------------------------------------
    /**
     * Check for buyer mail id
     *
     * @access    public
     * @param    nil
     * @return    void
     */
    function _check_user_email($mail)
    {
        //Conditions
        $conditions = array('users.email' => $mail);
        $result = $this->m_user->getUsers($conditions);
        if ($result->num_rows() == 0) {
            return true;
        } else {
            $this->form_validation->set_message('_check_user_email', $this->lang->line('users_email_check'));
            return false;
        }
        //If end
    }//Function _check_buyer_email End
    // --------------------------------------------------------------------
    function attachment_file_check()
    {
        if (isset($_FILES['attach_file']) == TRUE  and $_FILES['attach_file']['name'] == ''){
            $this->form_validation->set_message('attachment_file_check',$this->lang->line('attach_file_required'));
            return false;
        }
        $file = upload_image($_FILES, 'message_attachment', 'attach_file');
        if (isset($file['file_name']) == TRUE) {
            $this->_data['file'] = $file;
            return true;
        } else {
            $this->form_validation->set_message('attachment_file_check', $this->lang->line($file));
            return false;
        }
        //If end
    }
    // --------------------------------------------------------------------
    /**
     * Loads _check_activation_key for buyer
     *
     * @access    public
     * @param    nil
     * @return    void
     */
    function _check_activation_key($activation_key = 0)
    {
        //Conditions
        $conditions = array('users.activation_key' => $activation_key);
        $query = $this->m_user->getUsers($conditions);
        if ($query->num_rows == 1) {
            return true;
        } else {
            $this->form_validation->set_message('_check_activation_key', $this->lang->line('activation_key_validation'));
            return false;
        }
    }//Function _check_activation_key End
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
        $sitekey = "6LfwEQcTAAAAAH6yVhgkQ5Ir4KZRdv3iJ4my27Bt";
        $secret='6LfwEQcTAAAAACADHA0TsNDCZNPZxo-yLZRhmKlt';
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
    /**
     * deleteJobsSaved
     *
     * @access    public
     * @param    nil
     * @return    json_encode
     */
    public function deleteResumesSaved(){
        if($this->session->userdata('user_id')){
            if($this->session->userdata('role_id') == 2){
                $users_id = $this->session->userdata('user_id');
                if($this->input->post("btnDelete",TRUE))
                {
                    $listIdSaved=$this->input->post("resume",TRUE);
                    foreach($listIdSaved as $id)
                    {
                        $id=$this->encrypt->decode($id);
                        $this->m_resume_favourites->delete(array('resume_favourites.user_id'=>$users_id,'resume_favourites.id'=>$id));
                    }
                    $this->session->set_flashdata('flash_message', setMessage('success',$this->lang->line('Delete resume saved successfully')));
                    redirect(URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_resumes_save'));
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
     * deleteJobs
     * @access    public
     * @param    nil
     * @return    json_encode
     */
    public function deleteJobs(){
        if($this->session->userdata('user_id')){
            if($this->session->userdata('role_id') == 2){
                $users_id = $this->session->userdata('user_id');
                if($this->input->post("btnDelete",TRUE))
                {
                    $listIdJob=$this->input->post("job",TRUE);
                    foreach($listIdJob as $id)
                    {
                        $id=$this->encrypt->decode($id);
                        $this->m_jobs->updateJob(array('jobs.user_id'=>$users_id,'jobs.id'=>$id), array('jobs.is_deleted' => 1));
                    }
                    $this->session->set_flashdata('flash_message', setMessage('success',$this->lang->line('Delete job successfully')));
                    redirect($_SERVER['HTTP_REFERER']);
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
     * restoreJobs
     * @access    public
     * @param    nil
     * @return    json_encode
     */
    public function restoreJobs(){
        if($this->session->userdata('user_id')){
            if($this->session->userdata('role_id') == 2){
                $users_id = $this->session->userdata('user_id');
                if($this->input->post("btnRestore",TRUE))
                {
                    $listIdJob=$this->input->post("job",TRUE);
                    foreach($listIdJob as $id)
                    {
                        $id=$this->encrypt->decode($id);
                        $this->m_jobs->updateJob(array('jobs.user_id'=>$users_id,'jobs.id'=>$id), array('jobs.is_deleted' => 0));
                    }
                    $this->session->set_flashdata('flash_message', setMessage('success',$this->lang->line('Restore job successfully')));
                    redirect($_SERVER['HTTP_REFERER']);
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
     * changeStatusApply
     * @access    public
     * @param    nil
     * @return    json_encode
     */
    public function changeStatusApply(){
        if($this->session->userdata('user_id')){
            if($this->session->userdata('role_id') == 2){
                $users_id = $this->session->userdata('user_id');
                $params = get_params();
                if(isset($params['idApply']) && isset($params['status'])){
                    $idApply=$this->encrypt->decode($params['idApply']);
                    $this->m_jobs->updateApply(array('job_apply.id'=>$idApply), array('job_apply.status' => $params['status']));
                    $this->session->set_flashdata('flash_message', setMessage('success',$this->lang->line('Changed apply successfully')));
                    redirect($_SERVER['HTTP_REFERER']);
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
     * restoreJob
     * @access    public
     * @param    nil
     * @return    json_encode
     */
    public function restoreJob($id){
        if($this->session->userdata('user_id')){
            if($this->session->userdata('role_id') == 2){
                $users_id = $this->session->userdata('user_id');
                if(is_numeric($id)){
                    $this->m_jobs->updateJob(array('jobs.user_id'=>$users_id,'jobs.id'=>$id), array('jobs.is_deleted' => 0));
                    $this->session->set_flashdata('flash_message', setMessage('success',$this->lang->line('Restore job successfully')));
                    redirect($_SERVER['HTTP_REFERER']);
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
     * deleteMessage
     *
     * @access    public
     * @param    nil
     * @return    json_encode
     */
    public function deleteMessage(){
        if($this->session->userdata('user_id')){
            if($this->session->userdata('role_id') == 2){
                $users_id = $this->session->userdata('user_id');
                if($this->input->post("btnDelete",TRUE))
                {
                    $listIdMessage=$this->input->post("message",TRUE);
                    foreach($listIdMessage as $id)
                    {
                        $id=$this->encrypt->decode($id);
                        $this->m_jobs->deleteMessagesDefault(null, array('user_message_default.user_id'=>$users_id,'user_message_default.id'=>$id));
                    }
                    $this->session->set_flashdata('flash_message', setMessage('success', $this->lang->line('Delete message successfully')));
                    redirect(URL.$this->lang->line('l_employers').'/'.$this->lang->line('l_messages'));
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
    function findResumeAlert()
    {
        $this->load->helper('jobs');
        $page = isset($params['p']) ? $params['p'] : 1;
        $this->_data['menuActive'] = 'Manage resume';
        $this->_data['menuActiveChild'] = 'viewMyResumeAlerts';
        $params = (my_uri_to_assoc())?my_uri_to_assoc():'';
         if($this->input->post('value',TRUE)){
            $value = $this->input->post('value',TRUE);
            $url = current_url_temp1();
            if(isset($params['value'])){
                $url = redirect_page_temp1($_POST);
                echo json_encode(array('url'=>$url));die;
            }
            else{
                echo json_encode(array('url'=>$url.'/value/'.$value));die;
            }
        }
        $params = array();
        $getResumeAlert = $this->m_skills->getResumeAlert();
        if($getResumeAlert->num_rows() == 0){
            redirect();
        }
        $getResumeAlert = $getResumeAlert->row();
        $page_rows = $this->config->item('listing_limit');
        $max = array($page_rows, ($page - 1) * $page_rows);
        $limit1[0] = $page_rows;
        $limit1[1] = '0';
        $order = array('resume.date_updated', 'DESC');
        $conditions = array(
            'users.role_id' => 1,
            'resume.visible_to_employer' => 1
        );
        $orderby = array('resume.date_created','DESC');
        //fillter nganh nghe
        $stringCategories="";
        if($getResumeAlert->category_ids != 0){
            $stringCategories = $getResumeAlert->category_ids;
            $stringCategories = explode(',', $stringCategories);
            $stringCategories = implode('-', $stringCategories);
            $params['category'] = $stringCategories;
        }
        //fillter dia diem
        $stringCities="";
        if($getResumeAlert->city_ids != 0){
            $stringCities = $getResumeAlert->city_ids;
            $stringCities = explode(',', $stringCities);
            $stringCities = implode('-', $stringCities);
            $params['city'] = $stringCities;
        }
        $exp = $getResumeAlert->year_exp;
        if($exp != ''){
            $conditions["resume.yearOfExperience"] = $exp;
            $params['year_exp'] = $exp;
        }
        $gender = $getResumeAlert->sex;
        if($gender != ''){
            $conditions["resume.gender"] = $gender;
            $params['gender'] = $gender;
        }
        $marital = $getResumeAlert->marital;
        if($marital != ''){
            $conditions["resume.marital"] = $marital;
            $params['marital'] = $marital;
        }
        $country = $getResumeAlert->country;
        if($country != ''){
            $conditions["resume.country"] = $country;
            $params['country'] = $country;
        }
        $language = $getResumeAlert->language;
        if($language != ''){
            $conditions["resume_languages.language_id"] = $language;
            $params['language'] = $language;
        }
        $language_level = $getResumeAlert->language_level;
        if($language_level != ''){
            $conditions["resume_languages.language_level_id"] = $language_level;
            $params['language_level'] = $language_level;
        }
        $education = $getResumeAlert->education;
        if($education != ''){
            $conditions["resume.education"] = $education;
            $params['education'] = $education;
        }
        $type = $getResumeAlert->type;
        if($type != ''){
            $conditions["resume.type"] = $type;
            $params['type'] = $type;
        }
        $level = $getResumeAlert->level;
        if($level != ''){
            $conditions["resume.expectedJobLevel"] = $level;
            $params['level'] = $level;
        }
        $salary = $getResumeAlert->salary;
        if($salary != ''){
            $conditions["resume.expected_salary "] = $salary;
            $params['salary'] = $salary;
        }
        $like = '';
        // keyword search
        $keywords = $getResumeAlert->keywords;
        if($keywords != ''){
            $keywords = urldecode($keywords);
            $like = array('resume.title'=>$keywords);
        }
        $params['keywords'] = $keywords;
        $this->_data['params'] = $params;
        $or_like = '';
        $or_where = null;
        $href = '/employers/search';
        $uri = '';
        $href .= $uri;
        $this->_data['resumes'] = $this->m_jobs->getUserResumes($conditions, NULL, $like, $max, $orderby, $or_like, $or_where,$stringCategories,$stringCities);
        $num_users = $this->m_jobs->getUserResumes($conditions, null, $like, null, $orderby, $or_like, $or_where,$stringCategories,$stringCities);
        //Pagination
        $this->load->library('pagination');
        $config['base_url'] = $href;
        $config['total_rows'] = $num_users->num_rows();
        $config['per_page'] = $page_rows;
        $config['cur_page'] = $page;
        $this->pagination->initialize($config);
        $this->_data['pagination'] = $this->pagination->create_links(false, 'job');
        $this->_data['template'] = 'employers/findResume';
        $this->load->view('index', $this->_data);
    }
} //End  Buyer Class
/* End of file Employers.php */
/* Location: ./app/controllers/Employers.php */
?>
