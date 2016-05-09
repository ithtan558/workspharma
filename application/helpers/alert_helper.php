<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: nhson219
 * Date: 8/15/14
 * Time: 11:09 AM
 */
function cutString($string, $lenght = 100, $char = ''){
    if($string == ''){
        return '';
    }
    if($lenght > strlen($string)){
        return $string;
    }

    $string = strip_tags($string);
    $string = substr($string,0,$lenght);
    $string = strrev($string);
    $pos = strpos($string,' ');
    $string= substr($string,($pos + 1));
    $string=strrev($string);

    return $string.$char;
}
function getProjectFavourites(){
    $CI     =& get_instance();
    if($CI->session->userdata('user_id')){
        $favourites = $CI->m_common->getTableData('project_favourites',array('user_id' => $CI->session->userdata('user_id')),array('values'));
        if($favourites->num_rows() > 0){
            $array_favourites = unserialize(stripslashes($favourites->row()->values));
            return $array_favourites;
        }else{
            return false;
        }
    }else{
        return false;
    }
}
function showMessage($type = '', $msg = '')
{

    $CI = &get_instance();
    $data['msg'] = $msg;
    $data['type'] = $type;
    $CI->load->view('common/alert', $data);
}

 function showMessage2($data)
{
    if ($data['type'] == 'error') {
        $result = '<div class="alert alert-danger">
                    <button data-dismiss="alert" class="close"></button>
                    <span class="glyphicon glyphicon-remove-circle" aria-hidden="true" style="float: left"></span>
                    <strong></strong>
                    <ul>' . $data["message"] . '</ul></div>';
    } elseif ($data['type'] == 'success') {
        $result = '<div class="alert alert-success">
                    <button data-dismiss="alert" class="close"></button>
                    <span class="glyphicon glyphicon-ok-circle" aria-hidden="true" style="float: left"></span>
                    <strong></strong>
                    <ul>' . $data["message"] . '</ul></div>';
    } elseif ($data['type'] == 'warning') {
        $result = '<div class="alert alert-warning">
                    <button data-dismiss="alert" class="close"></button>
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true" style="float: left"></span>
                    <strong></strong>
                    <ul>' . $data["message"] . '</ul></div>';
    }elseif ($data['type'] == 'warning2') {
        $result = '<div class="alert alert-warning2">
                    <button data-dismiss="alert" class="close"></button>
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true" style="float: left"></span>
                    <strong></strong>
                    <ul>' . $data["message"] . '</ul></div>';
    }

    echo $result;
}

function setMessage($type, $message)
{
    $data['message'] = $message;
    $data['type'] = $type;

    return $data;
}


if ( ! function_exists('uri_to_assoc')) {
    function uri_to_assoc($n=1){
        $CI =& get_instance();
        $strUri = $CI->uri->uri_string();

        $uri_arr = explode('/', $strUri);

        $segments = array_slice($uri_arr, $n + 1);

        $i = 0;
        $lastval = '';
        $retval  = array();
        foreach ($segments as $seg)
        {
            if ($i % 2)
            {
                $retval[$lastval] = $seg;
            }
            else
            {
                $retval[$seg] = FALSE;
                $lastval = $seg;
            }

            $i++;
        }
//var_dump($retval);exit;
        return $retval;
    }
}

if ( ! function_exists('site_url_none_suffix')) {
    function site_url_none_suffix($uri = ''){
        $CI =& get_instance();
        $url = base_url().$uri;

        return $url;
    }
}

if ( ! function_exists('current_url_none_suffix')) {
    function current_url_none_suffix(){
        $CI =& get_instance();

        return $CI->uri->uri_string();
    }
}

function Canonical(){
    $CI = &get_instance();
    $controller = ($CI->uri->segment (1))?$CI->uri->segment (1):'';
    $action = ($CI->uri->segment (2))?$CI->uri->segment (2):'';

    if( ($controller == 'home' && ($action == '')) || $controller == ''){
        $canonical = "<link rel='canonical' href='".site_url(current_url_none_suffix())."'>";
        return $canonical;
    }elseif($controller == 'all-apps'){
        $canonical = "<link rel='canonical' href='".site_url(current_url_none_suffix())."'>";
        return $canonical;
    }elseif($controller == 'how-it-works'){
        $canonical = "<link rel='canonical' href='".site_url(current_url_none_suffix())."'>";
        return $canonical;
    }elseif($controller == 'about-us'){
        $canonical = "<link rel='canonical' href='".site_url(current_url_none_suffix())."'>";
        return $canonical;
    }elseif($controller == 'contact'){
        $canonical = "<link rel='canonical' href='".site_url(current_url_none_suffix())."'>";
        return $canonical;
    }elseif($controller == 'project'){
        $canonical = "<link rel='canonical' href='".site_url(current_url_none_suffix())."'>";
        return $canonical;
    }
    else{
        return false;
    }
}

function checkResponsive(){
    $CI = &get_instance();
    $controllerArr = array(
        'home',
        'joblist',
        'users',
        'programmer',
        'project',
        'buyer',
        'ux'
    );
    $actionArr = array(
        'home',
        'viewJobWhenUnregister',
        'viewAlljoblistsUpdate',
        'findFreelancer',
        'viewProfile',
        'signup',
        'signUp',
        'forgotPassword',
        'resetPassword',
        'login',
        'term',
        'term1',
        'view',
        'term2',
        'policy',
        'aboutus',
        'index',
        'search',
        'tag'
    );
//    $controller = ($CI->uri->segment (1))?$CI->uri->segment (1):'';
//    $action = ($CI->uri->segment (2))?$CI->uri->segment (2):'';

    $controller = $CI->router->fetch_class();
    $action = $CI->router->fetch_method();
    //echo $action;

    if((in_array($controller, $controllerArr) && in_array($action, $actionArr))
        || ($controller == 'home' && $action == '') || ($controller == 'ux' && $action == '')
        || $controller == '' || $controller == 'about-us' || $controller == 'policy'
        ){
        return true;
    }else{
        return false;
    }

}
//convert content after sql injection
function convertContent($content){
  if($content){
   // $array = array('\n');
   // $array_convert = array('<br/>');
   // $content = str_replace($array,$array_convert,$content);
   $content = stripslashes($content);
   return $content;
  }else{
   return FALSE;
  }
 }

function check_verify_studio($is_verify_studio = null,$type = 1){
    if($is_verify_studio != null){
        if($is_verify_studio == 1){
            if($type == 1){
                return "<div class='ribbon-wrapper-green'>
                            <div class='ribbon-green'>
                                Verified
                            </div>
                        </div>";
            }elseif($type == 2){
                return "<div class='ribbon-wrapper-green ribbon-wrapper-green-small'>
                        <div class='ribbon-green ribbon-green-small'>
                            Verified
                        </div>
                    </div>";
            }
        }else{
            return FALSE;
        }
    }else{
        return FALSE;
    }
}

if ( ! function_exists('get_job_status')){
    function get_job_status ($id)
    {
        $CI = &get_instance();
        $CI->lang->load('enduser/common', $CI->config->item('language_code'));

        $result = '';
        if($id == 1){
            $result = '<span class="span-danger">'.$CI->lang->line('Active').'</span>';
        }elseif($id == 2){
            $result = '<span class="span-success">'.$CI->lang->line('Disable').'</span>';
        }

        return $result;
    }
}

if ( ! function_exists('get_job_apply_status')){
    function get_job_apply_status ($id)
    {
        $CI = &get_instance();
        $CI->lang->load('enduser/common', $CI->config->item('language_code'));

        $result = '';
        if($id == 1){
            $result = '<span class="span-danger">'.$CI->lang->line('Accept').'</span>';
        }elseif($id == 2){
            $result = '<span class="span-success">'.$CI->lang->line('Decline').'</span>';
        }

        return $result;
    }
}

if ( ! function_exists('get_city')){
    function get_city ($ids)
    {
        $CI = &get_instance();
        $CI->load->model('m_cities');
        $CI->lang->load('enduser/common', $CI->config->item('language_code'));
        $result = '';

        if($ids == ''){
            return null;
        }

        $condition = array(
            "cities.id IN ({$ids}) !=" => 0
        );

        $cities = $CI->m_cities->getCities($condition);
        if($cities->num_rows() > 0) {
            foreach ($cities->result() as $item){
                if($result == ''){
                    $result = $item->city_name;
                }else{
                    $result .= ', '.$item->city_name;
                }
            }
        }

        return $result;
    }
}
if ( ! function_exists('get_city_li')){
    function get_city_li ($ids)
    {
        $CI = &get_instance();
        $CI->load->model('m_cities');
        $CI->lang->load('enduser/common', $CI->config->item('language_code'));
        $result = '';

        if($ids == ''){
            return null;
        }

        $condition = array(
            "cities.id IN ({$ids}) !=" => 0
        );

        $cities = $CI->m_cities->getCities($condition);
        if($cities->num_rows() > 0) {
            foreach ($cities->result() as $item){
                $result .= '<li>'.$item->city_name.'</li>';
            }
        }

        return $result;
    }
}

if ( ! function_exists('get_type_job')){
    function get_type_job ($id)
    {
        $CI = &get_instance();
        $CI->load->model('m_cities');
        $CI->lang->load('enduser/common', $CI->config->item('language_code'));
        $result = '';

        if($id == ''){
            return null;
        }
        $default_cbPositionType = $CI->config->item('default_cbPositionType');
        foreach ($default_cbPositionType as $key=>$values){
            if($id==$key){
                $result = $values;
            }
        }

        return $result;
    }
}

if ( ! function_exists('get_education')){
    function get_education ($id)
    {
        $CI = &get_instance();
        $CI->load->model('m_cities');
        $CI->lang->load('enduser/common', $CI->config->item('language_code'));
        $result = '';
        if($id == ''){
            return null;
        }
        $getEducation = $CI->config->item('default_education');
        foreach ($getEducation as $key=>$values){
            if($id==$key){
                $result = $values;
            }
        }
        return $result;
    }
}

if ( ! function_exists('get_level')){
    function get_level ($id)
    {
        $CI = &get_instance();
        $CI->load->model('m_cities');
        $CI->lang->load('enduser/common', $CI->config->item('language_code'));
        $result = '';
        if($id == ''){
            return null;
        }
        $default_currentJobLevel = $CI->config->item('default_currentJobLevel');
        foreach ($default_currentJobLevel as $key=>$values){
            if($id==$key){
                $result = $values;
            }
        }
        return $result;
    }
}

if ( ! function_exists('get_type_contact')){
    function get_type_contact ($id)
    {
        $CI = &get_instance();
        $CI->load->model('m_cities');
        $CI->lang->load('enduser/common', $CI->config->item('language_code'));
        $result = '';
        if($id == ''){
            return null;
        }
        $default_type_contact = $CI->config->item('default_type_contact');
        foreach ($default_type_contact as $key=>$values){
            if($id==$key){
                $result = $values;
            }
        }
        return $result;
    }
}


if ( ! function_exists('getListCategoryName')) {
    function getListCategoryName($categories = NULL, $comma = ', ')
    {
        $CI =& get_instance();
        $mod = $CI->load->model('skills_model');
        $cat = explode(",", $categories);
        $fields = array('categories.id', 'categories.category_name');
        $condition = array('categories.is_deleted' => 0);
        $list_categories = $CI->skills_model->getCategories($condition, $fields);
        $cnt = count($cat);
        $i = 1;
        $links = "";
        if ($list_categories->num_rows() > 0) {
            foreach ($list_categories->result() as $item) {
                if (in_array($item->id, $cat)) {
                    if ($i != $cnt)
                        $comma = $comma;
                    else
                        $comma = "";
                    $links .= $item->category_name . $comma;
                    $i++;
                }
            }
        }
        return $links;
    }
}

if ( ! function_exists('getListCategoryName')) {
    function getLevel($categories = NULL, $comma = ', ')
    {
        $CI =& get_instance();
        $mod = $CI->load->model('skills_model');
        $cat = explode(",", $categories);
        $fields = array('categories.id', 'categories.category_name');
        $condition = array('categories.is_deleted' => 0);
        $list_categories = $CI->skills_model->getCategories($condition, $fields);
        $cnt = count($cat);
        $i = 1;
        $links = "";
        if ($list_categories->num_rows() > 0) {
            foreach ($list_categories->result() as $item) {
                if (in_array($item->id, $cat)) {
                    if ($i != $cnt)
                        $comma = $comma;
                    else
                        $comma = "";
                    $links .= $item->category_name . $comma;
                    $i++;
                }
            }
        }
        return $links;
    }
}

if ( ! function_exists('isFavouritesResume')) {
    function isFavouritesResume($user_id, $resume_id)
    {
        $CI =& get_instance();
        $CI->load->model('resume_favourites_model');
        $fields = array('resume_favourites.id');
        $condition = array(
            'resume_favourites.user_id' => $user_id,
            'resume_favourites.resume_id' => $resume_id
        );
        $resumeFavourites = $CI->resume_favourites_model->getResumeFavourites($condition, $fields);
        if($resumeFavourites->num_rows() > 0){
            return TRUE;
        }
        return FALSE;
    }
}


if ( ! function_exists('check_profile_company')) {
    function check_profile_company($user_id)
    {
        $CI =& get_instance();
        $CI->load->model('jobs_model');
        $fields = array('user_employers.id');
        $condition = array(
            'user_employers.user_id' => $user_id
        );
        $resumeFavourites = $CI->jobs_model->getUserEmployers($condition, $fields);
        if($resumeFavourites->num_rows() > 0){
            return TRUE;
        }
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

if ( ! function_exists('get_gender')){
    function get_gender ($id)
    {
        $CI = &get_instance();
        $listGender = $CI->config->item('default_sex');
        foreach ($listGender as $key => $value){
            if($id == $key){
                $result = $value;
            }
        }
        return $result;
    }
}
if ( ! function_exists('get_marital')){
    function get_marital ($id)
    {
        $CI = &get_instance();
        $listMarital = $CI->config->item('default_marital');
        foreach ($listMarital as $key => $value){
            if($id == $key){
                $result = $value;
            }
        }
        return $result;
    }
}
if ( ! function_exists('get_exp')){
    function get_exp ($id)
    {
        $CI = &get_instance();
        $listExp = $CI->config->item('default_exp');
        foreach ($listExp as $key => $value){
            if($id == $key){
                $result = $value;
            }
        }
        return $result;
    }
}
if ( ! function_exists('get_salary')){
    function get_salary ($id)
    {
        $CI = &get_instance();
        $listSalary = $CI->config->item('default_salary');
        foreach ($listSalary as $key => $value){
            if($id == $key){
                $result = $value;
            }
        }
        return $result;
    }
}

if ( ! function_exists('get_num_staff')){
    function get_num_staff ($id)
    {
        $CI = &get_instance();
        $listNumStaff = $CI->config->item('default_number_staff');
        foreach ($listNumStaff as $key => $value){
            if($id == $key){
                $result = $value;
            }
        }
        return $result;
    }
}

if ( ! function_exists('get_category')){
    function get_category ($ids)
    {
        $CI = &get_instance();
        $CI->load->model('m_application');
        $CI->lang->load('enduser/common', $CI->config->item('language_code'));
        $result = '';

        if($ids == ''){
            return null;
        }

        $condition = array(
            "categories.id IN ({$ids}) !=" => 0
        );

        $getCategories=$CI->m_application->getCategories($condition);
        if($getCategories->num_rows() > 0) {
            foreach ($getCategories->result() as $item){
                if($result == ''){
                    $result = $item->category_name;
                }else{
                    $result .= ', '.$item->category_name;
                }
            }
        }

        return $result;
    }
}

if ( ! function_exists('get_language')){
    function get_language ($id)
    {
        $CI = &get_instance();
        $listlanguage = $CI->config->item('default_language');
        foreach ($listlanguage as $key => $value){
            if($id == $key){
                $result = $value;
            }
        }
        return $result;
    }
}
/**
     * getProjectStatus
     *
     * Returns status of the project
     *
     * @access  public
     * @param   string
     * @return  string
     */
    function getJobStatus($status=NULL, $role_id = 2)
    {
        $CI =& get_instance();
        $CI->lang->load('enduser/viewProject', $CI->config->item('language_code'));
        if($status == 1)
            $stat = '<span class="project-status-'.$status.'">Đang mở</span>';
        elseif($status == 0)
            $stat = '<span class="project-status-'.$status.'">Đã đóng</span>';

        return $stat;
    }

    /**
     * getProjectStatus
     *
     * Returns status of the project
     *
     * @access  public
     * @param   string
     * @return  string
     */
    function getJobApplyStatus($status=NULL, $role_id = 2)
    {
        $CI =& get_instance();
        $CI->lang->load('enduser/viewProject', $CI->config->item('language_code'));
        if($status == 0)
            $stat = '<span class="project-status-'.$status.'">'.$CI->lang->line("not View").'</span>';
        if($status == 1)
            $stat = '<span class="project-status-'.$status.'">'.$CI->lang->line("is View").'</span>';
        elseif($status == 2)
            $stat = '<span class="project-status-'.$status.'">Không được chọn</span>';

        return $stat;
    }


    function getJobFavourites(){
        $CI     =& get_instance();
        if($CI->session->userdata('user_id')){
            $favourites = $CI->m_common->getTableData('job_favourites',array('user_id' => $CI->session->userdata('user_id')),array('values'));
            if($favourites->num_rows() > 0){
                $array_favourites = unserialize(stripslashes($favourites->row()->values));
                return $array_favourites;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    if (!function_exists('curl_file_create')) {
        function curl_file_create($filename, $mimetype = '', $postname = '') {
            return "@$filename;filename="
            . ($postname ?: basename($filename))
            . ($mimetype ? ";type=$mimetype" : '');
        }
    }

    function get_numerics ($str) {
        preg_match_all('/\d+/', $str, $matches);
        return $matches[0];
    }

/*End developer Huynh An*/
?>
