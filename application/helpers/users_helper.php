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
function getUserInfo($userId = NULL, $fields = array())
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

/* sang 19-09-2014*/
function getNameSkillByString($string = null)
{
    //get total messages
    $CI = &get_instance();
    $CI->load->model('m_user');
    if (isset($CI->loggedInUser->id) == TRUE) {
        return $CI->m_user->getNameSkillByString($string);
    }
}

function getUserScore($userId)
{
    $CI = &get_instance();
    $CI->load->model('m_user');
    if (isset($CI->loggedInUser->id) == TRUE) {
        return $CI->m_user->getUserScore($userId);
    }

}


function file_get_contents_curl($url)
{

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.

    curl_setopt($ch, CURLOPT_URL, $url);

    $data = curl_exec($ch);

    curl_close($ch);

    return $data;
}

function getNumProjectByUser($userID = null)
{
    $CI = &get_instance();
    $CI->load->model('skills_model');
    $conditions = array('projects.creator_id' => $userID);
    $fields = array('projects.id');
    return $CI->skills_model->getProjects($conditions, $fields)->num_rows();
}

function getCountry($country_id = null)
{
    $CI = &get_instance();
    $CI->load->model('common_model');
    $conditions = array('id' => $country_id);
    return $CI->common_model->getCountries($conditions);
}

function getStatusWatchList($user_id = null, $dev_id = null)
{
    $CI = &get_instance();
    $CI->load->model('common_model');
    $conditions = array('user_watchlist.user_id' => $user_id, 'user_watchlist.dev_id' => $dev_id);
    $fields = array('user_watchlist.id');

    $result = $CI->m_user->getWatchList($conditions, $fields);
    if ($result->num_rows() > 0) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function randchar($string = 'abcdefghijklmnopqrstuvwxyz0123456789')
{
    return $string{rand(0, strlen($string) - 1)};
}

function randstring($minlength = 1, $maxlength = 10, $characters = 'abcdefghijklmnopqrstuvwxyz0123456789')
{
    $result = ' ';
    for ($i = 0; $i <= 8; $i++) {
        $result{$i} = randchar($characters);
    }
    return $result;
}

function randemail()
{
    $extensions = array('com', 'net', 'org', 'biz', 'gov');
    $afterAcong = array('gmail', 'yahoo', 'applancer');
    shuffle($extensions);
    return randstring(5, 15) . '@' . $afterAcong[mt_rand(0, sizeof($afterAcong) - 1)] . '.' . $extensions[mt_rand(0, sizeof($extensions) - 1)];
}

function generateRandomString($length = 8)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

function getPercentProfile()
{
    $CI = &get_instance();

    $user_id = $CI->session->userdata('user_id');

    if (isset($user_id) == TRUE) {
        $condition = array('users.id' => $user_id);
        $field = array('users.percentProfile');

        $result = $CI->m_user->getUsers($condition, $field);
        if ($result->num_rows() > 0)
            return $result->row()->percentProfile;
        else
            return false;
    } else
        return false;
}

function updatePercentProfile()
{
    $CI = &get_instance();

    $user_id = $CI->session->userdata('user_id');

    if (isset($user_id) == TRUE) {
        $condition = array('users.id' => $user_id);
        $field = array('users.percentProfile', 'users.logo', 'users.group_id', 'users.group_ids', 'users.num_reviews', 'users.resume', 'users.year_exp', 'users.employment_history', 'users.facebook', 'users.twitter', 'users.github', 'users.linkedin', 'users.google_plus', 'users.your_website', 'users.id', 'users.title', 'users.profile_desc','users.is_verify_studio', 'users.sector');

        $result = $CI->m_user->getUsers($condition, $field);
        if ($result->num_rows() > 0) {

            $result_namePercent = $CI->common_model->getTableData('user_percent', array('user_percent.user_id' => $user_id), array('user_percent.id'));
            $namePercent = $CI->common_model->getTableData('name_percent', null, array('name_percent.id', 'name_percent.value', 'name_percent.key'));

            if ($result_namePercent->num_rows() == 0) {
                $insert = '';

                if ($namePercent->num_rows() > 0) {
                    $dem = $namePercent->num_rows() - 1;
                    foreach ($namePercent->result() as $k => $v) {
                        if ($dem == $k)
                            $comma = "";
                        else
                            $comma = ",";

                        $insert .= "(" . $user_id . "," . $v->id . "," . 0 . ",'" . $v->key . "')" . $comma;
                    }
                }

                $query = "Insert into `user_percent` (`user_id`,`percent_id`,`status`,`key`) values  {$insert} ";
                $CI->db->query($query);
            }


            $percent = 0;
            $where_update = "";
            $where_no_update = "";
            $userInfo = $result->row();
            $arrayUpdate = array();
            $arrayNoUpdate = array();
            if ($userInfo->logo != "") {
                $percent += 20;
                $arrayUpdate[] = 'logo';
            } else {
                $percent += 0;
                $arrayNoUpdate[] = 'logo';
            }

            if (($userInfo->group_id != "") || ($userInfo->group_ids != "")) {
                $percent += 10;
                $arrayUpdate[] = 'skills';
            } else {
                $percent += 0;
                $arrayNoUpdate[] = 'skills';
            }

            if ($userInfo->profile_desc != "") {
                $percent += 5;
                $arrayUpdate[] = 'overview';
            } else {
                $percent += 0;
                $arrayNoUpdate[] = 'overview';
            }


            if ($userInfo->resume != "") {
                $arrayResume = serialize($userInfo->resume);
                if (count($arrayResume) > 0) {
                    $percent += 5;
                    $arrayUpdate[] = 'certificate';
                } else {
                    $percent += 0;
                    $arrayNoUpdate[] = 'certificate';
                }
            } else {
                $percent += 0;
                $arrayNoUpdate[] = 'certificate';
            }


            if ($userInfo->year_exp != 0) {
                $percent += 5;
                $arrayUpdate[] = 'year_experience';
            } else {
                $percent += 0;
                $arrayNoUpdate[] = 'year_experience';
            }

            if ($userInfo->employment_history != "") {
                $arrayEmpH = serialize($userInfo->employment_history);
                if (count($arrayEmpH) > 0) {
                    $percent += 5;
                    $arrayUpdate[] = 'employment_history';
                } else {
                    $percent += 0;
                    $arrayNoUpdate[] = 'employment_history';
                }
            } else {
                $percent += 0;
                $arrayNoUpdate[] = 'employment_history';
            }

            if (($userInfo->facebook != "") || ($userInfo->twitter != "") || ($userInfo->your_website != "") || ($userInfo->github != "") || ($userInfo->linkedin != "") || ($userInfo->google_plus != "")) {
                $percent += 5;
                $arrayUpdate[] = 'social';
            } else {
                $arrayNoUpdate[] = 'social';
                $percent += 0;
            }

            if ($userInfo->title != "") {
                $percent += 5;
                $arrayUpdate[] = 'title';
            } else {
                $percent += 0;
                $arrayNoUpdate[] = 'title';
            }

            /**
             * update sector
             */
            if($userInfo->sector != '' && $userInfo->sector != 0){
                $percent += 5;
                $arrayUpdate[] = 'sector';
            } else {
                $percent += 0;
                $arrayNoUpdate[] = 'sector';
            }

            $condition_portfolio = array('portfolio.user_id' => $userInfo->id);
            $field_portfolio = array('portfolio.user_id');
            $result_portfolio = $CI->m_user->getPortfolio($condition_portfolio, $field_portfolio);
            if ($result_portfolio->num_rows() > 0) {
                $percent += 10;
                $arrayUpdate[] = 'portfolio';
            } else {
                $arrayNoUpdate[] = 'portfolio';
                $percent += 0;
            }


            $dem = count($arrayUpdate);
            $where = "";
            $tmp = 0;
            if ($dem > 0) {
                foreach ($arrayUpdate as $k => $v) {
                    $tmp++;
                    if ($tmp == $dem)
                        $end = "";
                    else
                        $end = " OR ";

                    $where .= "`key` = '$v'" . $end;
                }
                $update = "UPDATE `user_percent` set `status` = 1 WHERE  ( {$where} ) AND `user_id` = {$CI->session->userdata('user_id')} ";
            }

            if(isset($update) == TRUE)
                $CI->db->query($update);


            $dem = count($arrayNoUpdate);
            $where = "";
            $tmp = 0;
            //$dem2 = count($arrayNoUpdate);
            if ($dem > 0) {
                foreach ($arrayNoUpdate as $k => $v) {
                    $tmp++;
                    if ($tmp == $dem)
                        $end = "";
                    else
                        $end = " OR ";

                    $where .= "`key` = '$v'" . $end;
                }
                $update = "UPDATE `user_percent` set `status` = 0 WHERE  ( {$where} ) AND `user_id` = {$CI->session->userdata('user_id')} ";
            }

            if(isset($update) == TRUE)
                $CI->db->query($update);

            if($userInfo->is_verify_studio == 1){
                $condition_verify_studio = array('user_percent.key' => 'verify_studio','user_percent.user_id' => $user_id);
                $fields = array('user_percent.user_id');
                $result_verify_studio = $CI->common_model->getTableData('user_percent',$condition_verify_studio,$fields);
                if($result_verify_studio->num_rows() > 0){
                    $updateDataUserPercent['status'] = 1;
                    $percent += 10;
                    $CI->common_model->updateTableData('user_percent',$user_id,$updateDataUserPercent,$condition_verify_studio);
                }else{
                    $percent += 10;
                    $insetDataUserPercent['status'] = 1;
                    $insetDataUserPercent['user_id'] = $user_id;
                    $insetDataUserPercent['percent_id'] = 10;
                    $insetDataUserPercent['key'] = 'verify_studio';
                    $CI->common_model->insertData('user_percent',$insetDataUserPercent);
                }
            }else{
                $condition_verify_studio = array('user_percent.key' => 'verify_studio','user_percent.user_id' => $user_id);
                $fields = array('user_percent.user_id');
                $result_verify_studio = $CI->common_model->getTableData('user_percent',$condition_verify_studio,$fields);
                if($result_verify_studio->num_rows() > 0){
                    $updateDataUserPercent['status'] = 0;
                    $CI->common_model->updateTableData('user_percent',$user_id,$updateDataUserPercent,$condition_verify_studio);
                }else{
                    $insetDataUserPercent['status'] = 0;
                    $insetDataUserPercent['user_id'] = $user_id;
                    $insetDataUserPercent['percent_id'] = 10;
                    $insetDataUserPercent['key'] = 'verify_studio';
                    $CI->common_model->insertData('user_percent',$insetDataUserPercent);
                }
            }

            if($userInfo->sector != '' && $userInfo->sector != 0){
                $condition_verify_studio = array('user_percent.key' => 'sector','user_percent.user_id' => $user_id);
                $fields = array('user_percent.user_id');
                $result_verify_studio = $CI->common_model->getTableData('user_percent',$condition_verify_studio,$fields);
                if($result_verify_studio->num_rows() > 0){
                    $updateDataUserPercent['status'] = 1;
                    $percent += 10;
                    $CI->common_model->updateTableData('user_percent',$user_id,$updateDataUserPercent,$condition_verify_studio);
                }else{
                    $percent += 10;
                    $insetDataUserPercent['status'] = 1;
                    $insetDataUserPercent['user_id'] = $user_id;
                    $insetDataUserPercent['percent_id'] = 11;
                    $insetDataUserPercent['key'] = 'sector';
                    $CI->common_model->insertData('user_percent',$insetDataUserPercent);
                }
            }else{
                $condition_verify_studio = array('user_percent.key' => 'sector','user_percent.user_id' => $user_id);
                $fields = array('user_percent.user_id');
                $result_verify_studio = $CI->common_model->getTableData('user_percent',$condition_verify_studio,$fields);
                if($result_verify_studio->num_rows() > 0){
                    $updateDataUserPercent['status'] = 0;
                    $CI->common_model->updateTableData('user_percent',$user_id,$updateDataUserPercent,$condition_verify_studio);
                }else{
                    $insetDataUserPercent['status'] = 0;
                    $insetDataUserPercent['user_id'] = $user_id;
                    $insetDataUserPercent['percent_id'] = 11;
                    $insetDataUserPercent['key'] = 'sector';
                    $CI->common_model->insertData('user_percent',$insetDataUserPercent);
                }
            }
//            kiem tra user verify_studio chua :
//                - neu chua :
//                    + kiem tra trong bang user_percent co ton tai du lieu verify_studio neu khong thi them vao
//                - neu da verify_studio :
//                    + kiem tra trong bang user_percent co ton tai du lieu verify_studio neu khong thi them vao update status = 1


            $updateData['percentProfile'] = $percent;

            $CI->m_user->updateUser($condition, $updateData);

            return true;

        } else
            return false;

    } else
        return false;
}

function updatePercentProfile2($user_id)
{
    $CI = &get_instance();

    //$user_id = $user_id;

    if (isset($user_id) == TRUE) {
        $condition = array('users.id' => $user_id);
        $field = array('users.percentProfile', 'users.logo', 'users.group_id', 'users.group_ids', 'users.num_reviews', 'users.resume', 'users.year_exp', 'users.employment_history', 'users.facebook', 'users.twitter', 'users.github', 'users.linkedin', 'users.google_plus', 'users.your_website', 'users.id', 'users.title', 'users.profile_desc','users.is_verify_studio', 'users.total_download', 'users.sector');

        $result = $CI->m_user->getUsers($condition, $field);
        if ($result->num_rows() > 0) {

            $result_namePercent = $CI->common_model->getTableData('user_percent', array('user_percent.user_id' => $user_id), array('user_percent.id'));
            $namePercent = $CI->common_model->getTableData('name_percent', null, array('name_percent.id', 'name_percent.value', 'name_percent.key'));

            if ($result_namePercent->num_rows() == 0) {
                $insert = '';

                if ($namePercent->num_rows() > 0) {
                    $dem = $namePercent->num_rows() - 1;
                    foreach ($namePercent->result() as $k => $v) {
                        if ($dem == $k)
                            $comma = "";
                        else
                            $comma = ",";

                        $insert .= "(" . $user_id . "," . $v->id . "," . 0 . ",'" . $v->key . "')" . $comma;
                    }
                }

                $query = "Insert into `user_percent` (`user_id`,`percent_id`,`status`,`key`) values  {$insert} ";
                $CI->db->query($query);
            }


            $percent = 0;
            $where_update = "";
            $where_no_update = "";
            $userInfo = $result->row();
            $arrayUpdate = array();
            $arrayNoUpdate = array();
            if ($userInfo->logo != "") {
                $percent += 20;
                $arrayUpdate[] = 'logo';
            } else {
                $percent += 0;
                $arrayNoUpdate[] = 'logo';
            }

            if (($userInfo->group_id != "") || ($userInfo->group_ids != "")) {
                $percent += 10;
                $arrayUpdate[] = 'skills';
            } else {
                $percent += 0;
                $arrayNoUpdate[] = 'skills';
            }

            if ($userInfo->profile_desc != "") {
                $percent += 5;
                $arrayUpdate[] = 'overview';
            } else {
                $percent += 0;
                $arrayNoUpdate[] = 'overview';
            }


            if ($userInfo->resume != "") {
                $arrayResume = serialize($userInfo->resume);
                if (count($arrayResume) > 0) {
                    $percent += 5;
                    $arrayUpdate[] = 'certificate';
                } else {
                    $percent += 0;
                    $arrayNoUpdate[] = 'certificate';
                }
            } else {
                $percent += 0;
                $arrayNoUpdate[] = 'certificate';
            }


            if ($userInfo->year_exp != 0) {
                $percent += 5;
                $arrayUpdate[] = 'year_experience';
            } else {
                $percent += 0;
                $arrayNoUpdate[] = 'year_experience';
            }

            if ($userInfo->employment_history != "") {
                $arrayEmpH = serialize($userInfo->employment_history);
                if (count($arrayEmpH) > 0) {
                    $percent += 5;
                    $arrayUpdate[] = 'employment_history';
                } else {
                    $percent += 0;
                    $arrayNoUpdate[] = 'employment_history';
                }
            } else {
                $percent += 0;
                $arrayNoUpdate[] = 'employment_history';
            }

            if (($userInfo->facebook != "") || ($userInfo->twitter != "") || ($userInfo->your_website != "") || ($userInfo->github != "") || ($userInfo->linkedin != "") || ($userInfo->google_plus != "")) {
                $percent += 5;
                $arrayUpdate[] = 'social';
            } else {
                $arrayNoUpdate[] = 'social';
                $percent += 0;
            }

            if ($userInfo->title != "") {
                $percent += 5;
                $arrayUpdate[] = 'title';
            } else {
                $percent += 0;
                $arrayNoUpdate[] = 'title';
            }

            /**
             * update sector
             */
            if ($userInfo->sector != "") {
                $percent += 5;
                $arrayUpdate[] = 'sector';
            } else {
                $percent += 0;
                $arrayNoUpdate[] = 'sector';
            }

            $condition_portfolio = array('portfolio.user_id' => $userInfo->id);
            $field_portfolio = array('portfolio.user_id');
            $result_portfolio = $CI->m_user->getPortfolio($condition_portfolio, $field_portfolio);
            if ($result_portfolio->num_rows() > 0) {
                $percent += 10;
                $arrayUpdate[] = 'portfolio';
            } else {
                $arrayNoUpdate[] = 'portfolio';
                $percent += 0;
            }


            $dem = count($arrayUpdate);
            $where = "";
            $tmp = 0;
            if ($dem > 0) {
                foreach ($arrayUpdate as $k => $v) {
                    $tmp++;
                    if ($tmp == $dem)
                        $end = "";
                    else
                        $end = " OR ";

                    $where .= "`key` = '$v'" . $end;
                }
                $update = "UPDATE `user_percent` set `status` = 1 WHERE  ( {$where} ) AND `user_id` = {$user_id} ";
            }

            if(isset($update) == TRUE)
                $CI->db->query($update);


            $dem = count($arrayNoUpdate);
            $where = "";
            $tmp = 0;
            //$dem2 = count($arrayNoUpdate);
            if ($dem > 0) {
                foreach ($arrayNoUpdate as $k => $v) {
                    $tmp++;
                    if ($tmp == $dem)
                        $end = "";
                    else
                        $end = " OR ";

                    $where .= "`key` = '$v'" . $end;
                }
                $update = "UPDATE `user_percent` set `status` = 0 WHERE  ( {$where} ) AND `user_id` = {$user_id} ";
            }

            if(isset($update) == TRUE)
                $CI->db->query($update);

            if($userInfo->is_verify_studio == 1){
                $condition_verify_studio = array('user_percent.key' => 'verify_studio','user_percent.user_id' => $user_id);
                $fields = array('user_percent.user_id');
                $result_verify_studio = $CI->common_model->getTableData('user_percent',$condition_verify_studio,$fields);
                if($result_verify_studio->num_rows() > 0){
                    $updateDataUserPercent['status'] = 1;
                    $percent += 10;
                    $CI->common_model->updateTableData('user_percent',$user_id,$updateDataUserPercent,$condition_verify_studio);
                }else{
                    $percent += 10;
                    $insetDataUserPercent['status'] = 1;
                    $insetDataUserPercent['user_id'] = $user_id;
                    $insetDataUserPercent['percent_id'] = 10;
                    $insetDataUserPercent['key'] = 'verify_studio';
                    $CI->common_model->insertData('user_percent',$insetDataUserPercent);
                }
            }else{
                $condition_verify_studio = array('user_percent.key' => 'verify_studio','user_percent.user_id' => $user_id);
                $fields = array('user_percent.user_id');
                $result_verify_studio = $CI->common_model->getTableData('user_percent',$condition_verify_studio,$fields);
                if($result_verify_studio->num_rows() > 0){
                    $updateDataUserPercent['status'] = 0;
                    $CI->common_model->updateTableData('user_percent',$user_id,$updateDataUserPercent,$condition_verify_studio);
                }else{
                    $insetDataUserPercent['status'] = 0;
                    $insetDataUserPercent['user_id'] = $user_id;
                    $insetDataUserPercent['percent_id'] = 10;
                    $insetDataUserPercent['key'] = 'verify_studio';
                    $CI->common_model->insertData('user_percent',$insetDataUserPercent);
                }
            }
//            kiem tra user verify_studio chua :
//                - neu chua :
//                    + kiem tra trong bang user_percent co ton tai du lieu verify_studio neu khong thi them vao
//                - neu da verify_studio :
//                    + kiem tra trong bang user_percent co ton tai du lieu verify_studio neu khong thi them vao update status = 1


            /**
             * update user appota
             * neu total_download >= 6000: 10%
             */
            if($userInfo->total_download >= 6000){
                $percent += 10;
            }else{
                $per = round($userInfo->total_download * 10 / 6000);
                $percent += $per;
            }

            $updateData['percentProfile'] = $percent;

            $CI->m_user->updateUser($condition, $updateData);

            return true;

        } else
            return false;

    } else
        return false;
}

/**
 * @return bool
 */
function getTotalMessage(){
    $CI = &get_instance();
    $CI->load->model('message_model');
    // count message
    if($CI->loggedInUser->id) {
        $condition_inbox = array('message.to_id' => $CI->loggedInUser->id, 'message.status' => 0);
        $group_inbox = '';//array('message.from_id', 'message.subject');
        $CI->outputData['count_message'] = $CI->message_model->getMessageInbox($condition_inbox, 'message.id', null, null, null, $group_inbox)->num_rows();
        return $CI->outputData['count_message'];
    }else{
        return false;
    }
}
function countSavedJobs(){
    $CI = &get_instance();
    // count saved project
    if($CI->loggedInUser->id) {
        $joblist_conditions = array('jobs.status' => '1', 'job_wishlist.user_id' => $CI->loggedInUser->id, 'job_wishlist.is_deleted' => 0);
        $CI->outputData['saved_job'] = $CI->skills_model->getJobWishlist($joblist_conditions)->num_rows();
        return $CI->outputData['saved_job'];
    }else{
        return false;
    }
}
function countSavedFreelancers(){
    // count saved project
    $CI = &get_instance();
    if($CI->loggedInUser->id) {
        $watchlist_conditions = array('user_watchlist.user_id' => $CI->loggedInUser->id);
        $CI->outputData['saved_freelancer'] = $CI->m_user->getFreelanceWatchlist($watchlist_conditions)->num_rows();
        return $CI->outputData['saved_freelancer'];
    }else{
        return false;
    }
}
function addLogDispute($id = 0,$dispute_id = 0,$description = ""){
    $CI = &get_instance();
    if($CI->loggedInUser->id){
        $CI->load->model('common_model');
        $insertData['user_id'] = $id;
        $insertData['dispute_id'] = $dispute_id;
        $insertData['description'] = $description;
        $insertData['time'] = time();

        $CI->common_model->insertData('dispute_log',$insertData);

    }
}
function countUxTools(){
    $CI = &get_instance();
    if($CI->loggedInUser->id){
        $CI->load->model('ux_model');
        $user_name = getUserInfo($CI->loggedInUser->id,array('users.user_name','users.display_name'));
        $condition = array('ux_users.username' => $user_name->user_name);
        $result = $CI->ux_model->getProjectUx($condition,array('ux_projects.id','ux_projects.owner'));
        if($result->num_rows() > 0) {
            $allProjectUx = $result->result_array();
            if(!empty($allProjectUx)) {

                $array2 = $CI->common_model->getTableData('ux_history', array('ux_history.viewer' => $allProjectUx[0]['owner']));
                // lay project history cua user

                if ($array2->num_rows() > 0) {
                    foreach ($array2->result() as $item) {
                        $listProjectHistoryByCode[] = $CI->ux_model->getProjectUx(array('ux_projects.code' => $item->projectCode))->result_array();
                    }
                } // lay project ux cua user theo projectCode
                if (!empty($listProjectHistoryByCode)) {
                    $dem = 0;
                    foreach ($listProjectHistoryByCode as $item) {
                        $allProjectUx[] = $item[0];
                        $dem++;
                    } // luu tat ca project vao
                }
                return count($allProjectUx);
            }
            return $result->num_rows();
        }else{
            return false;
        }
    }else{
        return false;
    }
}

function getInfoCountry($country_id, $fields = ''){
    $result = '';
    $CI =& get_instance();
    $CI->load->model('skills_model');
    $conditions = array('country.id' => $country_id);
    $countries = $CI->skills_model->getCountries($conditions, $fields);

    if($countries->num_rows() > 0){
        $result = $countries->row();
    }

    return $result;
}
function getRatingUser($tot_rating = 0,$user_rating){
    if($tot_rating != 0 && $user_rating != 0){
        return $rating = round($tot_rating / $user_rating);
    }else{
        return 0;
    }
}

function checkVerifyAccount($user_id){
    $CI = &get_instance();

    $condition = array('users.id' => $user_id, 'users.active_email' => '1');

    $result = $CI->m_user->getUsers($condition,'users.id');
    if ($result->num_rows() > 0)
        return true;
    else
        return false;
}

function checkVerifyPhone($user_id){
    $CI = &get_instance();

    $condition = array('users.id' => $user_id, 'users.phone !=' => '');

    $result = $CI->m_user->getUsers($condition,'users.id');
    if ($result->num_rows() > 0)
        return true;
    else
        return false;
}

function countProjectsWorked($id = 0){
    $CI = & get_instance();
    if($id != 0){
        $condition = array('projects.programmer_id' => $id);
        $result = $CI->common_model->getTableData('projects',$condition,array('projects.id'));
        if($result->num_rows() > 0){
            return $result->num_rows();
        }
    }
    return 0;
}
function countProjectsOpen($id = 0){
    $CI = & get_instance();
    if($id != 0){
        $condition = array('projects.creator_id' => $id);
        $result = $CI->common_model->getTableData('projects',$condition,array('projects.id'));
        if($result->num_rows() > 0){
            return $result->num_rows();
        }
    }
    return 0;
}
function getPercentReview($id = 0){
    $CI = & get_instance();
    if($id != 0){
        $CI->load->model('m_user');
        $condition_review = "reviews.provider_id = {$id} AND reviews.review_type = 1";
        $result = $CI->m_user->getReviewUser($condition_review);
        if($result->num_rows() > 0){
            return $result->row();
        }
    }
    return false;
}
function displayUserName($username = null,$displayname = null){
    if($displayname != null){
        return $displayname;
    }else{
        return $username;
    }
}

function displayAvatarUser($logo = null){
    if($logo != null){
        if(is_file_exists($logo,'thumbs_logos') == TRUE)
        {
            $url_image = thumb_uimage_url($logo);
        }elseif(is_file_exists($logo) == TRUE){
            $url_image = uimage_url($logo);
        }else{
            $url_image = image_default();
        }
        return $url_image;
    }else{
        return false;
    }
}

/**
 * @param null $user_id
 * @return bool
 */
function checkPostContest($user_id = null){
    if($user_id != null){
        $result = getUserInfo($user_id,array('users.is_post_contest'));
        if($result->is_post_contest == 1){
            return TRUE;
        }else{
            return FALSE;
        }
    }else{
        return FALSE;
    }
}



function countFavourites(){
    // count saved project
    $CI = &get_instance();
    if($CI->loggedInUser->id) {
        $favourites = $CI->common_model->getTableData('job_favourites',array('user_id' => $CI->loggedInUser->id),array('id','values'));
        if($favourites->num_rows()>0){
            $array_favourites = unserialize(stripslashes($favourites->row()->values));

            return count($array_favourites);
        }
        else{
            return false;
        }
    }else{
        return false;
    }
}

function countMyJobs(){
    // count saved project
    $CI = &get_instance();
    if($CI->loggedInUser->id) {
        $getJobsApply = $CI->common_model->getTableData('job_apply',array('job_apply.worker_id' => $CI->loggedInUser->id));
        return $getJobsApply->num_rows();
    }else{
        return false;
    }
}

function countMyResume(){
    // count saved project
    $CI = &get_instance();
    if($CI->loggedInUser->id) {
        $getResumes = $CI->common_model->getTableData('resume',array('resume.user_id' => $CI->loggedInUser->id,'resume.is_deleted'=>0));
        return $getResumes->num_rows();
    }else{
        return false;
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