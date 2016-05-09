<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------
/**
 * getUserInfo
 *
 * Create a admin URL based on the admin folder path mentioned in config file. Segments can be passed via the
 * first parameter either as a string or an array.
 *
 * @access    public
 * @param    string
 * @return    string
 */
function getUserInfo($userId = NULL, $  = array())
{
    $CI =& get_instance();
    $mod = $CI->load->model('m_user');
    $conditions = array('users.id' => $userId);
    if (!empty($fields))
        $result = $CI->m_user->getUsers($conditions, $fields);
    else
        $result = $CI->m_user->getUsers($conditions);
    if ($result->num_rows() > 0) {
        $data = $result->row();
    } else {
        return false;
    }
    return $data;
}
function getTotalMessages()
{
    //get total messages
    $CI = &get_instance();
    $CI->load->model('messages_model');
    if (isset($CI->loggedInUser->id) == TRUE) {
        $conditions_m = array('to_id' => $CI->loggedInUser->id);
        return $CI->messages_model->getTotalMessages($conditions_m);
    }
}
function checkEmail($email){
    if( (preg_match('/(@.*@)|(\.\.)|(@\.)|(\.@)|(^\.)/', $email)) ||
        (preg_match('/^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,3}|[0-9]{1,3})(\]?)$/',$email)) ) {
        $host = explode('@', $email);
        if(checkdnsrr($host[1].'.', 'MX') ) return true;
        if(checkdnsrr($host[1].'.', 'A') ) return true;
        if(checkdnsrr($host[1].'.', 'CNAME') ) return true;
    }
    return false;
}
/* End of file users_helper.php */
/* Location: ./app/helpers/users_helper.php */
?>