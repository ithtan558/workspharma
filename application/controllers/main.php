<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION))@session_start();
require_once(APPPATH . 'controllers/application.php');
class Main extends Application{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
     public function __construct(){
        parent::__construct();
        /*data menu*/
        /*hepler*/
            $this->load->helper("url");
        /*session*/
            $this->load->library('session');
        /*Load model*/
        $this->_data['home']=1;
        $this->_data['nothome']=1;
        $this->load->Model("m_application");
        $this->load->Model("m_job");
        $this->load->Model("m_skills");
    }
    public function index()
    {
        $this->load->library('encrypt');
        echo $this->encrypt->encode('test_api');
        //danh sach san pham
        $this->_data['index']=true;
        if($this->siteoffline==1)
        {
            $this->_data['error']=$offlinemsg;
            $this->load->view('maintenance',$this->_data);
        }
        else
        {
            $this->load->Model("m_slideshow");
            $this->_data['listSlideshow']=$this->m_slideshow->listSlideshow();
            //list job hap dan
            $order=array('jobs.views','DESC');
            $limit=array(10);
            $condition=array('jobs.status'=>1, 'jobs.is_deleted' => 0);
            $jobs = $this->m_job->getJobs($condition,NULL,NULL,$limit,NULL,NULL,$order);
            $this->_data['jobs']=$jobs;
            $getEmployers = $this->m_skills->getEmployers();
            $this->_data['getEmployers']=$getEmployers;
            $this->_data['template_timviec']='index';
            $this->_data['template']='main';
            $this->load->view('index',$this->_data);
        }
        /*end check_maintenace*/
    }

    public function sitemap()
    {
        //danh sach san pham
        $this->_data['menuActive']='site map';
        $this->_data['template']='sitemap_main';
        $this->load->view('index',$this->_data);
    }

    public function articles()
    {
        $this->load->library('encrypt');
        $this->load->library('pagination');
        $this->_data['params'] = $params  = (my_uri_to_assoc())?my_uri_to_assoc():'';
        $page = isset($params['p'])?$params['p']:1;
        $page_rows = 10;
        $limit[0] = $page_rows;
        if($page > 0)
            $limit[1] = ($page-1) * $page_rows;
        else
            $limit[1] = $page * $page_rows;
        $this->_data['menuActive']='Carrer tool';
        // if($this->uri->segment(1) == $this->lang->line('l_career_tool')){
        //     $alias_articles_categories = 'cam-nang-tuyen-dung';
            
        // }
        // else{
            $alias_articles_categories = $this->uri->segment(1);
        //}
        $condition = array(
            'pt_articles.enable_articles' => 1,
            'pt_articles_categories.alias'.$this->languages.'_articles_categories' => $alias_articles_categories
        );
        $count_articles = $this->m_skills->getArticles($condition,null);
        $articles = $this->m_skills->getArticles($condition, null, null, $limit);
        $getArticlesCategories = $this->m_skills->getArticlesCategories(array('alias'.$this->languages.'_articles_categories' => $alias_articles_categories));
        $this->_data['getArticlesCategories']=$getArticlesCategories->row();
        //echo $this->db->last_query();
        $href = URL.$this->lang->line('l_career_tool').'/';
        if($params != ''){
            unset($params['p']);
            $href .= '/'.build_url($params);
        }
        $config['base_url'] = $href;
        $config['total_rows'] = $count_articles->num_rows();
        $config['per_page'] = $page_rows;
        $config['cur_page'] = $page;
        $config['num_links'] = 2;
        $this->pagination->initialize($config);
        $this->_data['pagination'] = $this->pagination->create_links(false, 'job');
        $this->_data['articles'] = $articles;
        $this->_data['total_jobs'] = $config['total_rows'];
        //list job hap dan
        $order=array('jobs.views','DESC');
        $limit=array(10);
        $condition=array('jobs.status'=>1, 'jobs.is_deleted' => 0);
        $jobs = $this->m_job->getJobs($condition,NULL,NULL,$limit,NULL,NULL,$order);
        if($jobs->num_rows() > 0){
            $this->_data['jobs']=$jobs;
        }
        $this->_data['template']='articles';
        $this->load->view('index',$this->_data);
    }

    public function articlesDetail($alias_articles, $idArticles)
    {

        $this->_data['menuActive']='Carrer tool';
        $this->load->library('encrypt');
        if(is_numeric($idArticles))
        {
            $condition = array(
                'pt_articles.enable_articles' => 1,
                'pt_articles.idArticles' => $idArticles
            );
            $articlesDetail = $this->m_skills->getArticles($condition);
            if($articlesDetail->num_rows() > 0){
                $this->_data['articlesDetail']=$articlesDetail->row();
                 if($this->uri->segment(1) == 'career-tool'){
                    $alias_articles_categories = 'cam-nang-tuyen-dung';
                }
                else{
                    $alias_articles_categories = $this->uri->segment(1);
                }
                $condition_articles = array(
                    'pt_articles.enable_articles' => 1,
                    'pt_articles_categories.alias_articles_categories' => $alias_articles_categories
                );
                $articles = $this->m_skills->getArticles($condition_articles);
                $this->_data['articles']=$articles;
                //list job hap dan
                $order=array('jobs.views','DESC');
                $limit=array(10);
                $condition=array('jobs.status'=>1, 'jobs.is_deleted' => 0);
                $jobs = $this->m_job->getJobs($condition,NULL,NULL,$limit,NULL,NULL,$order);
                if($jobs->num_rows() > 0){
                    $this->_data['jobs']=$jobs;
                }
                $this->_data['template']='articlesDetail';
                $this->load->view('index',$this->_data);
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
            // $getCategories = $this->skills_model->getCategories(NULL,NULL,NULL,NULL,$order);
            // $this->outputData['getCategories1'] = $getCategories;
            $this->load->library('encrypt');
            $this->load->library('pagination');
            $this->load->model('cities_model');
            $this->outputData['params'] = $params  = (uri_to_assoc())?uri_to_assoc():'';
            //var_dump($params);die;
            //$limit = $this->uri->segment(3, 10);
            //list jobs hot
            $conditions_jobs_hot=array('job_service_extension.service_id'=>5,'jobs.status'=>1);
            $this->outputData['getJobsHot']=$getJobsHot=$this->job_model->getJobsHot($conditions_jobs_hot);
            $stringIdHot='';
            foreach ($this->outputData['getJobsHot']->result() as $item) {
                if(!empty($stringIdHot)){
                    $stringIdHot.=','.$item->id;
                }
                else{
                    $stringIdHot.=$item->id;
                }
            }
            $this->outputData['cities'] = $this->cities_model->getCities();
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
            $stringCategories="";
            $stringEmployers='';
            if(isset($params['keywords'])){
                $keyword = urldecode($params['keywords']);
                $keywords = explode(',', $keyword);
                foreach($keywords as $key=>$value){
                    $like=array('category_name'=>$value);
                    $listCategoriesKeyword=$this->skills_model->getCategory(NULL,NULL,$like);
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
                    $getUsers=$this->user_model->getUsers(NULL,NULL,NULL,NULL,$like);
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
                $getCategories=$this->skills_model->getCategories(array('categories.id'=>$value,'categories.is_active'=>1));
                if($getCategories->num_rows()>0) {
                    $this->skills_model->updateCategory($value, array('categories.view_search' => $getCategories->row()->view_search + 1));
                }
            }
            //echo $stringCategories;die;
            // location search
            $stringCities="";
            if(isset($params['location'])){
                $condition_cities=array('cities.id'=>$params['location']);
                $listCitiesKeyword=$this->cities_model->getCities($condition_cities,NULL);
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
            $count_job = $this->job_model->getJobs($condition,null,null,null,$stringCategories,$stringCities,NULL,NULL,$stringEmployers,$where_not_in);
            $jobs = $this->job_model->getJobs($condition, null, null, $limit,$stringCategories,$stringCities,NULL,NULL,$stringEmployers,$where_not_in);
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
                $getApply=$this->job_model->getApply($conditionsApply);
                $this->outputData['getApply']=$getApply;
            }
            $this->load->view('job/jobs', $this->outputData);
        }

        /* Test Api */
        function testApi(){
            // header('Access-Control-Allow-Origin: *');
            // header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
            // header('Access-Control-Max-Age: 1000');
            // header('Access-Control-Allow-Headers: Content-Type');
            //list job hap dan
            // Check secure the server with an app_id and app_key
            $arrayPost = $_POST;
            $enc_app_key = $arrayPost['enc_app_key'];
            $app_id = $arrayPost['app_id'];
            // get List user api
            $listAppId = $this->congif->item('list_api');
            if ()
            $order=array('jobs.views','DESC');
            $limit=array(10);
            $condition=array('jobs.status'=>1, 'jobs.is_deleted' => 0);
            $jobs = $this->m_job->getJobs($condition,NULL,NULL,$limit,NULL,NULL,$order);
            $result = array(
                'status' => 'SUCCESS',
                'jobs' => $jobs->result()
            );
            echo json_encode($result);
        }
}
