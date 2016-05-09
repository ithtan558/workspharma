<?php


class Resume extends Controller
{

    //Global variable
    public $outputData; //Holds the output data for each view
    public $loggedInUser;

    /**
     * Constructor
     *
     * Loads language files and models needed for this controller
     */
    function Resume()
    {
        parent::Controller();

        //Get Config Details From Db
        $this->config->db_config_fetch();
        //Manage site Status
        if ($this->config->item('site_status') == 1)
            redirect(URL.'offline');
        $this->load->model('skills_model');
        $this->load->model('cities_model');
        $this->load->model('district_model');
        $this->load->model('resume_language_model');
        $this->load->model('resume_experience_model');
        $this->load->model('resume_education_model');
        $this->load->model('common_model');
        $this->load->model('job_model');
        $this->load->model('resume_model');
        $this->load->model('user_model');
        $this->load->library('encrypt');
        //Get Logged In user
        $this->loggedInUser = $this->common_model->getLoggedInUser();
        //var_dump($this->loggedInUser);die;
        $this->outputData['loggedInUser'] = $this->loggedInUser;
        //Page Title and Meta Tags
        $this->outputData = $this->common_model->getPageTitleAndMetaData();
        //load all skills
        $getCategories = $this->skills_model->getCategories();
        $this->outputData['getCategories'] = $getCategories;
        $this->outputData['idChild'] = 0;
        //load all location
        $getCities = $this->cities_model->getCities();
        $this->outputData['getCities'] = $getCities;
        //load all exp
        $this->outputData['default_exp'] = $this->config->item('default_exp_en');
        $this->lang->load('enduser/common', $this->config->item('language_code'));
        $this->lang->load('enduser/job', $this->config->item('language_code'));
        $this->lang->load('enduser/formValidation',$this->config->item('language_code'));

    } //Controller End
    
    function ajaxCreateResumeOnline(){
        
        $this->load->library('encrypt');
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('cities_model');
        $this->load->model('resume_projects_model');
        $updateData = array();
        if(!isLoggedIn()){
            echo json_encode(array('result'=>'error','msg'=>'not login'));die;
        }

        $updateData['user_id'] = $this->loggedInUser->id;

        $idResume=$this->resume_model->getResume(array('resume.user_id'=>$updateData['user_id']))->row()->id;
        //check role users
        $conditions_resume=array('resume.id'=>$idResume,'resume.user_id'=>$updateData['user_id']);
        $getResume=$this->resume_model->getResume($conditions_resume);
        if($getResume->num_rows()==0){
            echo json_encode(array('result'=>'error','msg'=>'not idResume'));die;
        }
        if($this->input->post('action',TRUE)){
            $action=$this->input->post('action',TRUE);
            if($action='delete-employment-history'){
                $idResumeExperiences=$this->encrypt->decode($this->input->post('idResumeExperiences',TRUE));
                $idResume=$this->encrypt->decode($this->input->post('idResume',TRUE));

                $conditions=array('resume_experiences.resume_id'=>$idResume,'resume_experiences.id'=>$idResumeExperiences);
                $this->resume_experience_model->deleteResumeExperience(null,$conditions);
            }
            if($action='delete-education-history'){
                $idResumeEducations=$this->encrypt->decode($this->input->post('idResumeEducations',TRUE));
                $idResume=$this->encrypt->decode($this->input->post('idResume',TRUE));

                $conditions=array('resume_educations.resume_id'=>$idResume,'resume_educations.id'=>$idResumeEducations);
                $this->resume_education_model->deleteResumeEducation(null,$conditions);
            }

            if($action='delete-resume-project'){
                $idResumeProject=$this->encrypt->decode($this->input->post('idResumeProject',TRUE));
                $idResume=$this->encrypt->decode($this->input->post('idResume',TRUE));

                $conditions=array('resume_projects.resume_id'=>$idResume,'resume_projects.id'=>$idResumeProject);
                $this->resume_projects_model->deleteResumeProjects(null,$conditions);
            }
            die;
        }

        if ($this->input->post('saveContactInforBtn',TRUE)) {
            $updateData['update_at'] = time();
            $arrayBirthday=explode('/', $this->input->post('birthday', TRUE));
            $updateData['birthday']=strtotime($arrayBirthday[2].'-'.$arrayBirthday[1].'-'.$arrayBirthday[0]);
            $updateData['gender'] = $this->input->post('gender', TRUE);
            $updateData['display_name_resume'] = $this->input->post('display_name_resume', TRUE);
            $updateData['marital'] = $this->input->post('marital', TRUE);
            $updateData['address'] = $this->input->post('address', TRUE);
            $updateData['country'] = $this->input->post('country', TRUE);
            $updateData['city'] = $this->input->post('city_infomation', TRUE);
            $updateData['district'] = $this->input->post('district', TRUE);
            $updateData['cellphone'] = $this->input->post('cellphone', TRUE);
            $updateData['visible_to_employer'] = $this->input->post('visible_to_employer', TRUE);
            
        }
        if ($this->input->post('saveSkillsInforBtn',TRUE)) {
            $updateData['update_at'] = time();
            $updateData['job'] = implode(',',$this->input->post('skills', TRUE));
        }
        
        if ($this->input->post('saveSummaryInforBtn',TRUE)) {
            $updateData['update_at'] = time();
            $updateData['yearOfExperience'] = $this->input->post('yearOfExperience', TRUE);
            $updateData['no_experience'] = $this->input->post('no-experience-check-box', TRUE);
            $updateData['education'] = $this->input->post('education', TRUE);
            $updateData['recentCompany'] = $this->input->post('recentCompany', TRUE);
            $updateData['recentPosition'] = $this->input->post('recentPosition', TRUE);
            $updateData['currentJobLevel'] = $this->input->post('currentJobLevel', TRUE);
            $updateData['expectedJobLevel'] = $this->input->post('expectedJobLevel', TRUE);
            $updateData['expectedPosition'] = $this->input->post('expectedPosition', TRUE);
            $updateData['location'] = implode(',',$this->input->post('city', TRUE));
            
            $updateData['expectedSalaryRange'] = $this->input->post('expectedSalaryRange', TRUE);
            $updateData['expected_salary'] = $this->input->post('expected_salary', TRUE);
            //delete before insert Language
            $deleteDataLanguage=array();
            $deleteDataLanguage['resume_languages.resume_id']=$idResume;
            $this->resume_language_model->deleteResumeLanguage(null,$deleteDataLanguage);
            //insert Language
            for($i=1;$i<=3;$i++){
                if($this->input->post('language'.$i.'', TRUE)!=''){
                    $insertDataLanguage=array();
                    $insertDataLanguage['resume_id']=$idResume;
                    $insertDataLanguage['language_id']=$this->input->post('language'.$i.'', TRUE);
                    $insertDataLanguage['language_level_id']=$this->input->post('language-level'.$i.'', TRUE);
                    $this->resume_language_model->addResumeLanguage($insertDataLanguage);
                }
            }
        }  
        if ($this->input->post('saveProfile',TRUE)) {
            $updateData['profile'] = $this->input->post('profile', TRUE);
        } 
        //EmploymentHistory
        if ($this->input->post('saveEmploymentHistory',TRUE)) {
            $updateData['update_at'] = time();
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
            $insertDataExperience['description_experiences'] = $this->input->post('description_experiences', TRUE);
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
            $this->resume_experience_model->addResumeExperience($insertDataExperience);
        }
        if ($this->input->post('updateSaveEmploymentHistory',TRUE)) {
            $updateData['update_at'] = time();
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
            $this->resume_experience_model->updateResumeExperience($updateDataExperienceKey,$updateDataExperience);
        }
        //end EmploymentHistory
        //EducationHistory
        if ($this->input->post('saveEducationHistory',TRUE)) {
            $updateData['update_at'] = time();
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
            $this->resume_education_model->addResumeEducation($insertDataEducation);
        }
        if ($this->input->post('updateSaveEducationHistory',TRUE)) {
            $updateData['update_at'] = time();
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
            $this->resume_education_model->updateResumeEducation($updateDataEducationKey,$updateDataEducation);
        }
        if ($this->input->post('publishResume',TRUE)) {
            $updateData['status'] = 1;
            $updateData['accept_search'] = $this->input->post('accept_search',TRUE);
        }
        //end educationHistory

        /**
         * Duy Thieu
         * updated: 12/06/2015
         */
        if ($this->input->post('saveResumeProject',TRUE)) {
            $updateData['update_at'] = time();
            $insertDataProject=array();
            $insertDataProject['resume_id'] = $idResume;
            $insertDataProject['title'] = $this->input->post('title', TRUE);
            $insertDataProject['link'] = $this->input->post('link', TRUE);
            $insertDataProject['skills'] = $this->input->post('skills', TRUE);
            $insertDataProject['role'] = $this->input->post('role', TRUE);
            $insertDataProject['created_at'] = date(DATETIME_FORMAT_DB, time());

            //check validation
            $arrayError=array('result'=>'error');
            $flagError=0;
            if($insertDataProject['title']==''){
                $arrayError['title']=1;
                $flagError=1;
            }
            if($insertDataProject['link']==''){
                $arrayError['link']=1;
                $flagError=1;
            }
            if($insertDataProject['skills']==''){
                $arrayError['skills']=1;
                $flagError=1;
            }
            if($insertDataProject['role']==''){
                $arrayError['role']=1;
                $flagError=1;
            }
            //check date
            if($flagError==1){
                echo json_encode($arrayError);die;
            }
            if($this->resume_projects_model->addResumeProjects($insertDataProject)){
                $insertDataProject['skills'] = getListCategoryName($insertDataProject['skills'], ', ');
                echo json_encode($insertDataProject);die;
            }
        }
        if ($this->input->post('updateResumeProject',TRUE)) {
            $updateData['update_at'] = time();
            $idResumeProject=array();
            $idResumeProject=$this->encrypt->decode($this->input->post('idResumeProject',TRUE));
            $updateDataProject['title'] = $this->input->post('title', TRUE);
            $updateDataProject['link'] = $this->input->post('link', TRUE);
            $updateDataProject['skills'] = $this->input->post('skills', TRUE);
            $updateDataProject['role'] = $this->input->post('role', TRUE);


            //check validation
            $arrayError=array('result'=>'error');
            $flagError=0;
            if($updateDataProject['title']==''){
                $arrayError['title']=1;
                $flagError=1;
            }
            if($updateDataProject['link']==''){
                $arrayError['link']=1;
                $flagError=1;
            }
            if($updateDataProject['skills']==''){
                $arrayError['skills']=1;
                $flagError=1;
            }
            if($updateDataProject['role']==''){
                $arrayError['role']=1;
                $flagError=1;
            }
            //check date
            if($flagError==1){
                echo json_encode($arrayError);die;
            }


            if($this->resume_projects_model->updateResumeProjects($idResumeProject,$updateDataProject)){
                $updateDataProject['skills'] = getListCategoryName($updateDataProject['skills'], ', ');
                echo json_encode($updateDataProject);die;
            }
        }
        //end

        $updateKey=array('resume.id'=>$idResume);
        $updateData['date_created'] = time();
        $this->resume_model->updateResume($updateKey,$updateData);
        $updateData['birthday'] = $this->input->post('birthday', TRUE);
        $updateData['fromDate_experiences'] = $this->input->post('fromDate_experiences', TRUE);
        $updateData['toDate_experiences'] = $this->input->post('toDate_experiences', TRUE);
        $updateData['fromDate_educations'] = $this->input->post('fromDate_educations', TRUE);
        $updateData['toDate_educations'] = $this->input->post('toDate_educations', TRUE);
        $updateData['school_educations'] = $this->input->post('school_educations', TRUE);
        $skills='';

        //get list category
        if($this->input->post('skills', TRUE) && (!$this->input->post('updateResumeProject',TRUE)) && (!$this->input->post('saveResumeProject',TRUE))){
            $getCategories = $this->skills_model->getCategories();
            foreach ($this->input->post('skills', TRUE) as $key=>$value) {
                foreach($getCategories->result() as $item){
                    if($value==$item->id){
                        if(!empty($skills)){
                            $skills.=', '.$item->category_name;
                        }
                        else{
                            $skills.=$item->category_name;
                        }
                    }
                }
                
            }
            $updateData['job']=$skills;
        }
        if($this->input->post('city', TRUE)){
            $location='';
            //get list category
            $getCities = $this->cities_model->getCities();
            foreach ($this->input->post('city', TRUE) as $key=>$value) {
                foreach($getCities->result() as $item){
                    if($value==$item->id){
                        if(!empty($location)){
                            $location.=', '.$item->city_name;
                        }
                        else{
                            $location.=$item->city_name;
                        }
                    }
                }
                
            }
            $updateData['location']=$location;
        }
        echo json_encode($updateData);
    }


    function changeSearchable(){
        $this->load->library('encrypt');
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('cities_model');
        $updateData = array();
        if(!$this->loggedInUser->id){
            echo json_encode(array('result'=>'error','msg'=>'not login'));die;
        }
        $params = get_params();
        if(isset($params['id'])) {
            $updateData=array();
            $updateDataOther=array();
            
            $idResume=$params['id'];
            $idResume=$this->encrypt->decode($idResume);
            $updateKey=array('resume.id'=>$idResume);
            $updateData['update_at'] = time();
            $updateData['visible_to_employer'] = $this->input->post('searchable',TRUE);
            $this->resume_model->updateResume($updateKey,$updateData);
            //update resume other
            // $updateKeyOther=array('resume.id !='=>$idResume);
            // $updateDataOther['update_at'] = time();
            // if($this->input->post('searchable',TRUE)==1){
            //     $visible_to_employer=0;
            // }
            // else{
            //     $visible_to_employer=1;
            // }
            // $updateDataOther['visible_to_employer'] = $visible_to_employer;
            // $this->resume_model->updateResume($updateKeyOther,$updateDataOther);
        }
    }


    function deleteResume(){
        $this->load->library('encrypt');
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('cities_model');
        $updateData = array();
        if(!$this->loggedInUser->id){
            echo json_encode(array('result'=>'error','msg'=>'not login'));die;
        }
        $params = get_params();
        if(isset($params['id'])) {
            $user_id=$this->loggedInUser->id;
            $updateData=array();
            $updateDataOther=array();
            
            $idResume=$params['id'];
            $idResume=$this->encrypt->decode($idResume);
            $deleteKey=array('resume.id'=>$idResume,'resume.user_id'=>$user_id);
            $this->resume_model->deleteResume(null,$deleteKey);
            echo json_encode(array('result'=>'success'));die;
        }
        else{
            echo json_encode(array('result'=>'error','msg'=>'not id'));die;
        }
    }

    /**
         * setPostSelectResume
         *
         * @access    public
         * @param    nil
         * @return    json_encode
         */

        function setPostSelectResume()
        {
            if($this->loggedInUser->id){
                $users_id = $this->loggedInUser->id;
                $getResume=$this->resume_model->getResume(array('resume.id > '=>1,'resume.status'=>2,'resume.user_id'=>$users_id));
                $array=array();
                foreach ($getResume->result() as $item) {
                    # code...
                    $array[$item->id]=$item->recentPosition;
                }
                echo json_encode($array);
            }
        }
    /*End developer Huynh An*/
}

/* End of file job.php */
/* Location: ./app/controllers/job.php */
?>
