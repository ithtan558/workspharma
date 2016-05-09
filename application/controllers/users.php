<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION))@session_start();
require_once(APPPATH . 'controllers/application.php');
class Users extends Application
{
    /**
     * Constructor
     *
     * Loads language files and models needed for this controller
     */
    public function __construct(){
        parent::__construct();
        //language file
        $this->lang->load('enduser/common', $this->config->item('language_code'));
    } //Controller End
    // --------------------------------------------------------------------

    /**
     * Loads Home page of the site.
     *
     * @access    public
     * @param    nil
     * @return    void
     */
    function login()
    {
        //Load Models - for this function
        $this->load->model('m_user');

        //load validation libraray
        $this->load->library('form_validation');

        //Load cookie
        $this->load->helper('cookie');

        //Load Alert Helper
        $this->load->helper('alert');

        //Load Form Helper
        $this->load->helper('form');

        //Load Library File
        $this->load->library('encrypt');

        if($this->session->userdata('user_id')){
            redirect();
        }
        // check the login for remember user
        if ($this->m_auth->getUserCookie('email') != '' and $this->m_auth->getUserCookie('user_password') != '') {
            $conditions = array('email' => $this->m_auth->getUserCookie('email'), 'password' => md5($this->m_auth->getUserCookie('user_password')), 'users.user_status' => '1');
            $query = $this->m_user->getUsers($conditions);
            if ($query->num_rows() > 0) {
                $this->session->set_flashdata('flash_message', $this->m_common->flash_message('success',$this->lang->line('Login successful')));

            }
            redirect();
        }

        //Intialize values for library and helpers
        $this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
        //pr($_POST);
        //Get Form Data
        if ($this->input->post('usersLogin')) {
            //Set rules
            //$this->form_validation->set_rules('email', 'lang:email', 'required|trim|min_length[5]|valid_email|xss_clean');
            $this->form_validation->set_rules('email', 'lang:email', 'required|trim|min_length[5]|xss_clean');
            $this->form_validation->set_rules('password', 'lang:password', 'required|trim|xss_clean');

            $this->form_validation->set_message('required', '%s ' . $this->lang->line('required'));
            $this->form_validation->set_message('min_length', '%s ' . $this->lang->line('min_length'));
            $this->form_validation->set_message('valid_email', '%s ' . $this->lang->line('valid_email'));

            if ($this->form_validation->run()) {
                $email = $this->input->post('email', TRUE);
                $pwd = $this->input->post('password', TRUE);

                // get params
                $parsedParams = get_params();

                // Puhal Changes Removed the role Id from the conditions, inorder to remove the buyer and programmer radio button (Sep 17 Issue 4)
                $conditions = "(users.email = '".$email."' or users.user_name = '".$email."') and users.password = '".md5($pwd)."' and users.user_status = 1";
                

                $query = $this->m_user->getUsers($conditions, null, null, null, null, null);
                if ($query->num_rows() > 0 || $userAdmin = isLoginAdmin($email, $pwd)) {


                    if($query->num_rows() > 0){
                        $row = $query->row();
                    }else{
                        $row = $userAdmin;
                    }
                    if (1) {
                        //Set Session For User
                        $this->m_auth->setUserSession($row);
                        //updatePercentProfile();
                        // Puhal Changes for the Remember me button (Sep 17 Issue 3)
                        if ($this->input->post('remember')) {
                            $insertData = array();
                            $insertData['email'] = $this->input->post('email',TRUE);
                            $insertData['password'] = $this->input->post('password',TRUE);
                            $expire = 60 * 60 * 24 * 100;
                            if ($this->m_auth->getUserCookie('uname') == '') {
                                $this->m_user->addRemerberme($insertData, $expire);
                            }
                        } else {
                            $this->m_user->removeRemeberme();
                        }
                        //Notification message
                        //$this->session->set_flashdata('flash_message', $this->m_common->flash_message('success', $this->lang->line('Login successful')));
                        if ($this->session->userdata('job_id') != '') {
                            $jobid = $this->session->userdata('job_id');
                            $this->session->unset_userdata('job');
                            $this->session->unset_userdata('view');
                            $this->session->unset_userdata('job_id');
                            redirect(URL.'project/view/' . $jobid);
                        }
                        if(isset($parsedParams['r'])){
                            redirect($parsedParams['r']);
                        }

                        if(isset($parsedParams['next'])){
                            if(isset($parsedParams['idJob'])){
                                redirect($parsedParams['next'].'/?idJob='.$parsedParams['idJob']);
                            }
                            else{
                                redirect($parsedParams['next']);
                            }
                        }

                        if($row->role_id == 1){
                            redirect();
                        }else{
                            redirect($this->lang->line('l_employers').'/'.$this->lang->line('l_index'));
                        }

                        // check for private project user login
                    } else {
                        //Notification message
                        $this->session->set_flashdata('flash_message', $this->m_common->flash_message('error', $this->lang->line('Incorrect username or password')));
                        if(isset($parsedParams['next'])) {
                            if(isset($parsedParams['idJob'])){
                                redirect(URL.'users/login/?next='.$parsedParams['next'].'/?idJob='.$parsedParams['idJob']);
                            }
                            else{
                                redirect(URL.'users/login/?next='.$parsedParams['next']);
                            }
                            
                        }else{
                            redirect(URL.'users/login');
                        }
                    }

                } else {
                    //Notification message
                    $this->session->set_flashdata('error_login', $this->m_common->flash_message('error', $this->lang->line('Incorrect username or password')));
                    if(isset($parsedParams['next'])) {
                        if(isset($parsedParams['idJob'])){
                            redirect(URL.'users/login/?next='.$parsedParams['next'].'/?idJob='.$parsedParams['idJob']);
                        }
                        else{
                            redirect(URL.'users/login/?next='.$parsedParams['next']);
                        }
                    }else{
                        redirect(URL.$this->lang->line('l_sign_in'));
                    }
                } //If username exists
            }else{
                $this->session->set_flashdata('error_login', $this->m_common->flash_message('error', validation_errors()));

            }
            //If End - Check For Validation
        } //If End - Check For Form Submission
        $this->_data['template']='users/loginUsers';
        $this->load->view('index',$this->_data);
    } //Function login End

    // --------------------------------------------------------------------

    function checkUserInputField(){
        //load validation libraray
        $this->load->library('form_validation');
        $this->form_validation->set_rules('inputfield', 'lang:email', 'trim|required|valid_email|min_length[5]|max_length[50]|xss_clean');
        // kiểm tra input field là email hoặc username
        $inputField = $this->input->post("inputfield",TRUE);
        if ($this->form_validation->run() == TRUE) {
            // input field là email
            $result = $this->m_user->checkEmailExists($inputField);
            if(count($result->row_array()) == 0){
                echo "false";
            }else{
                echo "true";
            }
        }else{
            // input field là username
            $result = $this->m_user->checkUsernameExists($inputField);
            if(count($result->row_array()) == 0){
                echo "false";
            }else{
                echo "true";
            }
        }
    }

    function checkUserPasswordField(){
        //load validation libraray
        $this->load->library('form_validation');
        $this->form_validation->set_rules('inputfield', 'lang:email', 'trim|required|valid_email|min_length[5]|max_length[50]|xss_clean');
        // kiểm tra input field là email hoặc username
        $inputField = $this->input->post("inputfield",TRUE);
        if ($this->form_validation->run() == TRUE) {
            // input field là email
            $result = $this->m_user->checkEmailExists($inputField);
            if(count($result->row_array()) == 0){
                echo "false";
            }else{
                // có input field kiểm tra password
            }
        }else{
            // input field là username
            $result = $this->m_user->checkUsernameExists($inputField);
            if(count($result->row_array()) == 0){
                echo "false";
            }else{
                echo "true";
            }
        }
    }

    /**
     * Loads forgotPassword page of the site.
     *
     * @access    public
     * @param    nil
     * @return    void
     */
    function forgotPassword()
    {

        //Load Models - for this function
        $this->load->model('m_user');
        $this->load->model('m_email');

        //load validation libraray
        $this->load->library('form_validation');
        $this->load->library('email');
        //Load Form Helper
        $this->load->helper('form');
        //Intialize values for library and helpers
        $this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));

        //Get Form Data	- Forgot Password
        if ($this->input->post('forgotPassword', TRUE)) {
            //Set rules
            $this->form_validation->set_rules('email', 'lang:email_validation', 'required|valid_email|trim|min_length[5]|xss_clean');
           // if(RE_CAPTCHA == 1){
           //     $this->form_validation->set_rules('g-recaptcha-response','lang:captcha ','required|trim|xss_clean|callback_reCaptchaCheck');
           // }else{
           //     $this->form_validation->set_rules('captcha','lang:captcha','required|trim|xss_clean|callback_captchaCheck');
           // }
           $this->form_validation->set_message('required', '%s ' . $this->lang->line('required'));

            if ($this->form_validation->run()) {
                $email = $this->input->post('email', TRUE);
                $conditions = array('users.email' => $email);
                $query = $this->m_user->getUsers($conditions);
                $usersData = $query->row();

                if ($query->num_rows() > 0) {
                    // tạo biến random và update vào csdl
                    $rand_temp = md5(uniqid(rand(),TRUE));
                    // update vào csdl
                    $conditionUpdate = array("users.id" => $usersData->id);
                    $updateData = array("users.forgot_key" => $rand_temp, 'users.forgot_time' => time());
                    $this->m_user->updateKeyRand($conditionUpdate,$updateData);
                    $full_email=explode('@', $email);
                    $first_email=$full_email[0];
                    $last_email=$full_email[1];
                    $paramBody = array(
                        "!username" => $usersData->user_name,
                        "!forgot_url" => URL.'users/resetPassword/'.$first_email.'/'.$last_email.'/'.$rand_temp,
                        '!url_home' => site_url(),
                        '!images'=>base_url().'app/css/images/logo_new.png'
                    );
                    $this->email->mailFrom = 'deliverysystem@evolableasia.vn';
                    $this->email->mailTo = $usersData->email;
                    $this->email->templateType = 'forgot_password';
                    $this->email->paramBody = $paramBody;
                    $mailID = $this->email->addMailQueue();

                    $result_send = $this->email->sendMail();
                    if($result_send){
                        $this->session->set_flashdata('flash_message', setMessage('success', $this->lang->line('We emailed you a link and instructions for updating your password. It should be there momentarily. Please check your email and click the link in the message. After one hour, the link to update your password will expire.')));
                        redirect(URL.$this->lang->line('l_forgot_password'));
                    }else{

                    }
                }
            }
        }
        $this->_data['template'] = 'users/forgotPassword';
        $this->load->view('index', $this->_data);
    } //Function forgotPassword End
    // --------------------------------------------------------------------

    function resetPassword(){

        //load validation libraray
        $this->load->library('form_validation');
        //Load Form Helper
        $this->load->helper('form');

        //Intialize values for library and helpers
        $this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));

        if($this->uri->segment(3,'0') && $this->uri->segment(4,'0') && $this->uri->segment(5,'0')){
            $first_email = $this->uri->segment(3,'0');
            $last_email = $this->uri->segment(4,'0');
            $last_email = str_replace('_','.',$last_email);
            $email=$first_email.'@'.$last_email;
            $key = $this->uri->segment(5,'0');

            //kiểm tra key_rand trong csdl
            $users = $this->m_user->checkKeyRand(array('users.email' => $email, 'forgot_key' => $key));
            if($users->num_rows() > 0){
                $user = $users->row();
                $checkExpire = time() - ($user->forgot_time + 24*3600);

                if($checkExpire > 0){
                    $this->_data['expire'] = true;
                }else {
                    if ($this->input->post('resetPassword', TRUE)) {
                        $this->form_validation->set_rules('password', 'lang:password', 'required|trim|max_length[50]|xss_clean');
                        $this->form_validation->set_rules('confirm-password', 'lang:password_confirm_validation', 'required|trim|max_length[50]|xss_clean|matches[password]');
                        $this->_data['id'] = $user->id;
                        // update password mới vào csdl
                        if ($this->form_validation->run() == TRUE) {
                            $pwd = md5($this->input->post('password', TRUE));
                            //echo $pwd." || ".$this->_data['id'];
                            $condition = array(
                                "users.id" => $user->id
                            );
                            $updateData = array(
                                "users.password" => $pwd,
                                "users.forgot_key" => '',
                                "users.forgot_time" => time()
                            );
                            $result = $this->m_user->updatePassword($condition, $updateData);
                            $this->session->set_flashdata('flash_message',  setMessage('success', $this->lang->line('Change password success').' '.'<a href="'.URL.$this->lang->line('l_sign_in').'">'.$this->lang->line('Click here').'</a> '.$this->lang->line('for login')));
                            redirect(URL.'forgot-password');
                        }
                    }
                }
            }else{
                // không tồn tại key_rand trong csdl - hoặc do đã reset pass nên đã xóa đi
                $this->session->set_flashdata('flash_message',  setMessage('error', $this->lang->line('This link in valid. Please reload page try again.')));
                redirect(URL."forgot-password");
            }


        }

        $this->_data['template'] = 'users/resetPasswordForm';
        $this->load->view("index",$this->_data);
    }

    function active(){
        $this->lang->load('enduser/common', $this->config->item('language_code'));
        if($this->uri->segment(3,'0') && $this->uri->segment(4,'0') && $this->uri->segment(5,'0')){
            $first_email = $this->uri->segment(3,'0');
            $last_email = $this->uri->segment(4,'0');
            $last_email = str_replace('_', '.', $this->uri->segment(4,'0'));
            $key = $this->uri->segment(5,'0');
            $email=$first_email.'@'.$last_email;
            //kiểm tra key_rand trong csdl
            $kq = $this->m_user->checkActiveEmail(array('users.email' => $email, 'users.active_email' => $key));
            if($kq->num_rows() > 0){
                // update active_email field == 1
                $condition = array(
                        "users.id" => $kq->row()->id,
                );
                $updateData = array(
                    "users.active_email" => 1
                );
                $result = $this->m_user->updatePassword($condition,$updateData);

                redirect(URL.'users/activeSuccess');
            }else{
                $this->session->set_flashdata('flash_message', setMessage('error', $this->lang->line('This link has expired or bad code. Please refresh the page')));
                redirect(URL.'users/notice');
            }

        }

    }

    function activeSuccess(){
        $this->_data['template'] = 'users/activeSuccess';
        $this->load->view("index",$this->_data);
    }

    function notice(){
        $this->_data['template'] = 'notice';
        $this->load->view("index",$this->_data);
    }

    /**
     * Loads logout .
     *
     * @access    public
     * @param    nil
     * @return    void
     */
    function logout()
    {

        if($this->session->userdata('page_ux')){
            $this->session->unset_userdata('page_ux');
        }
        if($this->session->userdata('redirect_invite')){
            $this->session->unset_userdata('redirect_invite');
        }

        $this->m_auth->clearUserSession();
        //$this->session->set_flashdata('flash_message', $this->m_common->flash_message('success', $this->lang->line('Logout successful')));
        $this->m_auth->clearUserCookie(array('username', 'password'));
        $this->m_auth->clearUserCookie(array('user_name', 'user_password'));
        redirect(URL.'home');

    } //Function logout End

    function changePassword(){
        $this->lang->load('enduser/common', $this->config->item('language_code'));
        //Check Whether User Logged In Or Not
        if (!isLoggedIn()) {
            $message = $this->lang->line('Please login account employer');
            $this->session->set_flashdata('flash_message', setMessage('error', $message));
            redirect(URL.'users/login/?next='.site_url('users/changePassword'));
        }

        //load validation libraray
        $this->load->library('form_validation');

        //Load Form Helper
        $this->load->helper('form');

        if(isEmployer()){
            $this->_data['menuActive']['account_menuActive'] = 'active';
            $this->_data['menuActive']['change_pass_menuActive'] = 'active';
        }

        if ($this->input->post('action', TRUE)) {
            $this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));

            $this->form_validation->set_rules('old_password', 'old password', 'required|xss_clean|trim|callback__check_password');
            $this->form_validation->set_rules('password', 'password', 'required|matches[re_password]|xss_clean|trim');
            $this->form_validation->set_rules('re_password', 're-password', 'required|xss_clean|trim');

            if ($this->form_validation->run()) {
                $condition = array('users.id' => $this->loggedInUser->id);
                $updateData['password'] = md5($this->input->post('password',TRUE));
                $this->m_user->updateUser($condition, $updateData);
                $this->session->set_flashdata('flash_message', setMessage('success', $this->lang->line('Change password success')));

                redirect(URL.'users/changePassword');
            }
        }

        $this->load->view('users/changePassword',$this->_data);
    }

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

    function verifyAccount(){

        $this->lang->load('enduser/common', $this->config->item('language_code'));
        $this->load->model('m_user');
        $this->load->model('email_model');
        $this->load->library('email');
        $params = get_params();
        if (!isset($this->loggedInUser->id)) {
            redirect(URL.'users/login');
        }
        $user = getUserInfo($this->loggedInUser->id, 'users.display_name,user_name, users.email');

        $full_email=explode('@', $user->email);
        //echo $full_email[0];die;
        if($this->session->userdata('timeout_verify') && time() < $this->session->userdata('timeout_verify')){
            $this->session->set_flashdata('flash_message', setMessage('success', $this->lang->line('Please check your e-mail to activate your account')));
            if(isset($params['id'])){
                redirect($params['next'].'/?id='.$params['id']);
            }
            elseif(isset($params['next'])){
                redirect($params['next']);
            }elseif($this->session->userdata('role_id')==1){
                redirect(URL.'worker/accountManage');
            }
            elseif($this->session->userdata('role_id')==2){
                redirect(URL.'worker/accountManage');
            }
        }else{
            $this->session->set_userdata('timeout_verify', time() + 900);
        }


        $rand_temp = md5(uniqid(time(),TRUE));
        // update vào csdl
        $conditionUpdate = array('users.id' => $this->loggedInUser->id);
        $updateData = array("users.active_email" => $rand_temp);
        $this->m_user->updateKeyRand($conditionUpdate,$updateData);

        $paramSubject = array(
            "!site_title" => $this->config->item('site_title')
        );
        $full_email=explode('@', $user->email);
        $first_email=$full_email[0];
        $last_email=$full_email[1];
        $paramBody = array(
            "!username" => $user->first_email,
            "!email" => $user->email,
            "!activation_url" => site_url('users/active/'.$first_email.'/'.$last_email.'/'.$rand_temp),
        );

        $this->email->mailFrom = $this->config->item('site_admin_mail');
        $this->email->mailTo = $user->email;
        $this->email->templateType = 'active_account';
        $this->email->paramSubject = $paramSubject;
        $this->email->paramBody = $paramBody;

        if($this->email->sendMail()){
            $this->session->set_flashdata('flash_message', setMessage('success', $this->lang->line('Please check your e-mail to activate your account')));
            if(isset($params['id'])){
                redirect($params['next'].'/?id='.$params['id']);
            }
            elseif(isset($params['next'])){
                redirect($params['next']);
            }elseif($this->session->userdata('role_id')==1){
                redirect(URL.'worker/accountManage');
            }
            elseif($this->session->userdata('role_id')==2){
                redirect(URL.'employers/accountManage');
            }
        }else{
            //send mail failed
            $this->session->set_flashdata('flash_message', $this->m_common->flash_message('error', 'Send Email failed'));
        }
    }

    function captchaCheck(){
        // $this->load->model('captcha_model');

        // $captcha = $this->input->post('captcha');
        // $b_Check = $this->captcha_model->check($captcha);
        // if(!$b_Check)
        // {
        //     $this->form_validation->set_message('captchaCheck', "Captcha incorrect");
        //     return FALSE;
        // }else{
        //     return TRUE;
        // }
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

    function _check_password($password){
        $this->lang->load('enduser/common', $this->config->item('language_code'));

        $condition = array('users.id' => $this->loggedInUser->id);
        $fields = array('users.password');
        $userInfo = $this->m_user->getUsers($condition,$fields)->row();

        if($userInfo->password != md5($password)){
            $this->form_validation->set_message('_check_password', $this->lang->line('password_valid'));
            return false;
        }else{
            return true;
        }
    }
    /*Start developer Huynh An*/
    function checkEmailIsExists(){
        $email = $this->input->post("email_fp",TRUE);
        $result = $this->m_user->checkEmailExists($email);
        if(count($result->row_array()) == 0){
            echo "false";
        }else{
            echo "true";
        }
    }

    function checkUserEmailInfo(){
        if($this->input->post('email',TRUE)){
            $email = $this->input->post("email",TRUE);
        }
        elseif($this->input->post('email_register',TRUE)){
            $email = $this->input->post("email_register",TRUE);
        }
        $result = $this->m_user->checkEmailExists($email);
        if(count($result->row_array()) == 0){
            echo "true";
        }else{
            echo "false";
        }
    }

    function checkUserNameInfo(){
        $username = $this->input->post("username");
        $result = $this->m_user->checkUsernameExists($username);
        if(count($result->row_array()) == 0){
            echo "true";
        }else{
            echo "false";
        }
    }

    function checkUserPassExists(){
        if($this->uri->segment(3,'0')){
            $id = $this->uri->segment(3,'0');
            $pass = md5($this->input->post("pwd-new",TRUE));
            $condition = array(
                "users.id" => $id,
                "users.password" => $pass
                );
            $result = $this->m_user->checkPassExists($condition);
            if(count($result->row_array()) == 0){
                echo "true";
            }else{
                echo "false";
            }
        }

    }
    function addEmailSubscribe(){
        $email = $this->input->post('email',TRUE);
        if($this->input->post('category',TRUE)){
            $category = implode(',',$this->input->post('category',TRUE));
        }
        else{
            $category = '';
        }
        if($this->input->post('city',TRUE)){
            $city = implode(',',$this->input->post('city',TRUE));
        }
        else{
            $city = '';
        }
        if($this->input->post('level',TRUE)){
            $level = $this->input->post('level',TRUE);
        }
        else{
            $level = '';
        }
        if($email == ""){
            echo json_encode(array('status' => 'error','message' => $this->lang->line('subscribe_require')));exit;
        }

        if(checkEmail($this->input->post('email',TRUE)) == false){
            echo json_encode(array('status' => 'error','message' => $this->lang->line('subscribe_valid')));exit;
        }

        $result = $this->m_common->getTableData('user_email_subscribe',array('is_deleted' => 0,'email' => $this->input->post('email',TRUE)),array('id'));

        if($result->num_rows() ==  0){
            $insertData['email'] = $email;
            $insertData['categories_ids'] = $category;
            $insertData['city_ids'] = $city;
            $insertData['level_id'] = $level;
            $insertData['created'] = time();

            $this->m_common->insertData('user_email_subscribe',$insertData);

            echo json_encode(array('status' => 'success','message' => $this->lang->line('subscribe_success')));exit;
        }else{
            echo json_encode(array('status' => 'duplicate','message' => $this->lang->line('subscribe_duplicate')));exit;
        }
    }

    function editAccount()
    {
        if(!$this->session->userdata('user_id'))
            redirect();
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


} //End  Users Class

/* End of file Users.php */
/* Location: ./app/controllers/Users.php */
