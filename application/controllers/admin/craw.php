<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION))@session_start();
require_once(APPPATH . 'controllers/admin/admin_application.php');
class Craw extends Admin_application{
	//Global variable
    public $_data;		//Holds the output data for each view
    public $_params = '';
	/**
	 * Constructor
	 *
	 * Loads language files and models needed for this controller
	 */
	function __construct()
	{
	   parent::__construct();
		// get params
		$this->_params = ($this->uri->uri_to_assoc())?$this->uri->uri_to_assoc():'';
		$this->_data['params'] = $this->_params;
		$this->_data['craw_job'] = true;
        $this->load->helper('simple_html_dom');
        $this->load->helper('file');
        $this->load->helper('url');
        $this->load->helper('users');
        $this->load->model('admin/m_category');
        $this->load->model('admin/m_cities');
        $this->load->model('admin/m_job');
        $this->load->model('admin/m_jobs');
        $this->load->model('admin/m_users');
	} //Controller End
	function viewCraw()
	{
		$this->_data['template'] = 'admin/bodyright/craw/viewCraw';
		$this->load->view('admin/main',$this->_data);
	}//End of addBans Function
	function getDataWebsiteItViec(){
        ini_set('max_execution_time', 300);
        $this->load->helper('simple_html_dom');
        $this->load->helper('file');
		$this->load->helper('users');
		$this->load->model('m_job');
		$this->load->model('m_jobs');
		$this->load->model('m_cities');
        // Create DOM from URL or file
        $link=$this->input->post('link',TRUE);
		$quantity=$this->input->post('quantity',TRUE);
        $html = file_get_html($link);
        // Find all links
        //foreach($html->find('#footer .tags li.tag a') as $elementCategories)
        //{
        //$htmlCategories = file_get_html('http://itviec.com'.$elementCategories->href);
		$like=array('users.user_name'=>'employer');
		$order=array('id','DESC');
		$getUsers=$this->m_users->getUsers(NULL,NULL,$like,$order);
		if($getUsers->num_rows()>0){
			$arrayI=get_numerics($getUsers->row()->user_name);
			$i=$arrayI[0]+1;
		}
		else{
			$i=1;
		};
        $stt=0;
        foreach($html->find('.first-group .job .title a') as $elementItems)
        {
            $items = file_get_html('http://itviec.com'.$elementItems->href);
            //get id job other
            $idJobOther=$items->find('.show_content',0)->id;
            $idJobOther=explode('_',$idJobOther);
            $idJobOther=$idJobOther[1];
            //check elxit idJobOther
            $getJobs=$this->m_job->getJobs(array('jobs.idJobOther'=>$idJobOther));
            if($getJobs->num_rows()>0)echo $idJobOther;
            else{
                $dataJob=array();
                $dataJob['idJobOther']=$idJobOther;
                //get name employer
                $name=$items->find('.side_bar div.inside .name',0)->plaintext;

                //get title
                $title=$items->find('.job-detail .header h1.job_title',0)->plaintext;
                //check emplpyer elxit
                $getUsers=$this->m_users->getUsers(array('user_employers.company'=>$name));
                if($getUsers->num_rows()>0){
                    $id=$getUsers->row()->id;
                }
                else{
                    //create users
                    $dataUsers['user_name']='employer'.$i;
                    $i++;
                    $dataUsers['email']='donoreply@topdev.vn';
                    $dataUsers['password']=md5('123123123');
                    $dataUsers['role_id']=2;
                    $dataUsers['active_email']=1;
                    $id=$this->m_users->createUser($dataUsers);

                }

                $alias=standardURL($title);
                //get address
                $stringCitys='';
                $address=$items->find('.job-detail .header div.address',0)->plaintext;

                $listAddress=explode(',',$address);
                $listCities = $this->m_cities->getCities();
                foreach ($listAddress as $key=>$value) {
                    foreach ($listCities->result() as $item) {
                        if(strcasecmp(standardURL($item->city_name),standardURL(trim($value)))==0){
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
                $listCategories=$this->m_category->getCategory();
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
                $dataJob['type']=1;
                $dataJob['salary_min']=$salary_min;
                $dataJob['salary_max']=$salary_max;
                $dataJob['description']=$stringDescription;
                $dataJob['status']=3;
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
                    $output_dir_photo = ROOT_PATH_FONTEND. "/files/employers/".date("Y").'/'.date("m").'/'.date("d");
                    //echo $output_dir_photo;die;
                    $output_dir_logo = ROOT_PATH_FONTEND. "/files/logos";
                    $pathPhotos = ROOT_PATH_FONTEND."/files/employers/".date("Y").'/'.date("m").'/'.date("d");
                    $pathLogo = ROOT_PATH_FONTEND."/files/logos/";
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
                    $nameLogo=explode('?',$nameLogo[6]);
                    $nameSaveLogo=encrypt_name($nameLogo[0]);
                    $nameSaveLogo=$nameSaveLogo;
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
				$stt++;
				if($stt==$quantity) {
					break;
				}
            }

            //}
        }
		$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success',$this->lang->line('crown_job_success')));
		redirect_admin('skills/crownJobs');
    }

    function getDataWebsiteVietNamWorks(){
		ini_set('max_execution_time', 300);
		$this->load->helper('simple_html_dom');
		$this->load->helper('file');
		$this->load->helper('users');
		$this->load->model('admin/m_job');
		$this->load->model('admin/m_jobs');
		// Create DOM from URL or file
		$link=$this->input->post('link',TRUE);
		$quantity=$this->input->post('quantity',TRUE);
		$html = file_get_html($link);
        // Find all links
        //foreach($html->find('#footer .tags li.tag a') as $elementCategories)
        //{
        //$htmlCategories = file_get_html('http://itviec.com'.$elementCategories->href);
		$like=array('users.user_name'=>'employer');
		$order=array('id','DESC');
		$getUsers=$this->m_users->getUsers(NULL,NULL,$like,$order);
		if($getUsers->num_rows()>0){
			$arrayI=get_numerics($getUsers->row()->user_name);
			$i=$arrayI[0]+1;
		}
		else{
			$i=1;
		};
		$stt=0;
        foreach($html->find('#job-list table tr.job-post a.job-title') as $elementItems)
        {
            $items = file_get_html($elementItems->href);
            //get id job other
            $idJobOther=$items->find('#jobId',0)->value;
            //check elxit idJobOther
            $getJobs=$this->m_job->getJobs(array('jobs.idJobOther'=>$idJobOther));
            if($getJobs->num_rows()>0){
            	echo $idJobOther;
            }
            else{
                $dataJob=array();
                $dataJob['idJobOther']=$idJobOther;
                //get name employer
                $name=$items->find('.job-header-info span.company-name strong',0)->plaintext;

                //get title
                $title=$items->find('.job-header-info h1.job-title',0)->plaintext;
                //check emplpyer elxit
                $getUsers=$this->m_users->getUsers(array('user_employers.company'=>$name));
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
                    $id=$this->m_users->createUser($dataUsers);
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
                        if(strcasecmp(standardURL($item->city_name),standardURL(trim($value)))==0){
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
                $listCategories=$this->m_category->getCategory();
                foreach ($items->find('.job-tag-add-skill1 span.addable') as $tag) {
                    $nameSkill = $tag->title;
                    $flag_skill=0;
                    foreach ($listCategories->result() as $item) {
                        if(strcasecmp($item->category_name,$nameSkill)==0){
                            $flag_skill=1;
                            break;
                        }
                    }
                    if($flag_skill==1){
                        $idSkill=$item->id;
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
                        $idSkill=$this->m_category->addCategory($insertDataSkill);
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
                $stringDescription1=preg_replace('#<p class="push-top">(.*?)</p>#', ' ', $stringDescription1);
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
                $dataJob['type']=1;
                $dataJob['salary_min']=$salary_min;
                $dataJob['salary_max']=$salary_max;
                $dataJob['description']=$stringDescription;
                $dataJob['status']=3;
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
                    foreach ($items->find('.multi-carousel-wrapper ul li ') as $itemPhoto){
                        $itemPhotoChild = $itemPhoto->find('.img-responsive',0)->src;
                        //echo $itemPhotoChild;die;
                        $photo=$itemPhotoChild;
                        $namePhoto=explode('/',$photo);
                        //var_dump($namePhoto);die;
                        $nameSavePhoto=encrypt_name($namePhoto[4]);
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
                $stt++;
				if($stt==$quantity) {
					break;
				}
            }
            
            //}
        }
		$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success',$this->lang->line('crown_job_success')));
		redirect_admin('skills/crownJobs');

    }

    function getDataWebsiteTimViecNhanh(){
        ini_set('max_execution_time', 300);
        // Create DOM from URL or file
        $link=$this->input->post('link',TRUE);
        $quantity=$this->input->post('quantity',TRUE);
        $html = file_get_html($link);
        // Find all links
        //foreach($html->find('#footer .tags li.tag a') as $elementCategories)
        //{
        //$htmlCategories = file_get_html('http://itviec.com'.$elementCategories->href);
        $like=array('users.user_name'=>'employer');
        $order=array('users.id','DESC');
        $getUsers=$this->m_users->getUsers(NULL,NULL,$like,$order);
        if($getUsers->num_rows()>0){
            $arrayI=get_numerics($getUsers->row()->user_name);
            $i=$arrayI[0]+1;
        }
        else{
            $i=1;
        };
        $stt=0;
        foreach($html->find('td[class=block-item w55] a.item') as $elementItems)
        {
            $items = file_get_html($elementItems->href);
            //get id job other
            $stringIdJobOther=$items->find('title',0)->plaintext;
            $listIdJobOther = explode('-',$stringIdJobOther);
            $idJobOther = $listIdJobOther[count($listIdJobOther) - 1];
            //check elxit idJobOther
            $getJobs=$this->m_job->getJobs(array('jobs.idJobOther'=>$idJobOther));
            if($getJobs->num_rows()>0){
            }
            else{
                $dataJob=array();
                $dataJob['idJobOther']=$idJobOther;
                //get name employer
                $name=$items->find('div.detail-content div[class=col-xs-6 p-r-10 offset10] h3',0)->plaintext;
                $name = trim($name);
                //get title
                $title=$items->find('div.detail-content h1.title span',0)->plaintext;
                //check emplpyer elxit
                $getUsers=$this->m_users->getUsers(array('user_employers.company'=>$name));
                if($getUsers->num_rows()>0){
                    $id=$getUsers->row()->user_id;
                }
                else{
                    //die;
                    //create users
                    $dataUsers=array();
                    $dataUsers['user_name']='employer'.$i;
                    $i++;
                    $dataUsers['email']='jobs@workspharma.net';
                    $dataUsers['password']=md5('123123123');
                    $dataUsers['role_id']=2;
                    $dataUsers['user_status']=1;
                    $dataUsers['active_email']=1;
                    $id=$this->m_users->createUser($dataUsers);
                }

                $alias=standardURL($title);
                $gender=$items->find('div.detail-content div[class=col-xs-4 offset20 push-right-20] ul li',1)->plaintext;
                $gender=str_replace('- Giới tính:', '',$gender);
                foreach ($this->config->item('default_sex') as $key=>$value) {
                    if(strcasecmp(standardURL(str_replace(' ', '',$value)),standardURL(trim(str_replace(' ', '',$gender))))==0){
                        $gender = $key;
                        break;
                    }
                }
                if(!is_numeric($gender)){
                    $gender = 1;
                }
                $year_exp=$items->find('div.detail-content div[class=col-xs-4 offset20] ul li',1)->plaintext;
                $year_exp=str_replace('- Kinh nghiệm:', '',$year_exp);
                foreach ($this->config->item('default_exp') as $key=>$value) {
                    if(strcasecmp(standardURL(str_replace(' ', '',$value)),standardURL(trim(str_replace(' ', '',$year_exp))))==0){
                        $year_exp = $key;
                        break;
                    }
                }
                if(!is_numeric($year_exp)){
                    $year_exp = 1;
                }
                $qty=$items->find('div.detail-content div[class=col-xs-4 offset20 push-right-20] ul li',0)->plaintext;
                $qty=str_replace('- Số lượng tuyển dụng:', '',$qty);
                if(!is_numeric($qty)){
                    $qty = 1;
                }

                $education_id=$items->find('div.detail-content div[class=col-xs-4 offset20] ul li',0)->plaintext;
                $education_id=str_replace('- Trình độ:', '',$education_id);
                foreach ($this->config->item('default_education') as $key=>$value) {
                    if(strcasecmp(standardURL(str_replace(' ', '',$value)),standardURL(trim(str_replace(' ', '',$education_id))))==0){
                        $education_id = $key;
                        break;
                    }
                }
                if(!is_numeric($education_id)){
                    $education_id = 1;
                }
                //get address
                $stringCitys='';
                $address=$items->find('div.detail-content div[class=col-xs-4 offset20] ul li a');
                $listAddress='';
                foreach ($address as $itemCity) {
                    if(!empty($listAddress)){
                        $listAddress=','.str_replace('Việc làm', '',$itemCity->title);
                    }
                    else{
                        $listAddress=str_replace('Việc làm', '',$itemCity->title);
                    }
                }
                $listAddress=explode(',',$listAddress);
                $listCities = $this->m_cities->getCities();
                foreach ($listAddress as $key=>$value) {
                    foreach ($listCities->result() as $item) {
                        if(strcasecmp(standardURL($item->city_name),standardURL(trim($value)))==0){
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
                $category = preg_replace("/[^0-9]/","",$link);
                if($category == Y_TE) $stringSkills = Y_TE_W;
                if($category == DUOC_HOA_CHAT) $stringSkills = DUOC_HOA_CHAT_W;
                if($category == LAM_DEP_THE_LUC) $stringSkills = LAM_DEP_THE_LUC_W;
                if($category == NONG_LAM_NGU_NGHIEP) $stringSkills = NONG_LAM_NGU_NGHIEP_W;
                // $category=$items->find('div.detail-content div[class=col-xs-4 offset20 push-right-20] ul li a');
                
                // $listCategoriesTemp='';
                // foreach ($category as $itemCity) {
                //     if($listCategoriesTemp!=''){
                //         $listCategoriesTemp.=','.$itemCity->title;
                //     }
                //     else{
                //         $listCategoriesTemp.=$itemCity->title;
                //     }
                // }
                // $listCategoriesTemp=explode(',',$listCategoriesTemp);
                // $listCategories=$this->m_category->getCategory();
                // foreach ($listCategoriesTemp as $key=>$value) {
                //     foreach ($listCategories->result() as $item) {
                //         if(strcasecmp(standardURL($item->category_name),standardURL(trim($value)))==0){
                //             $idSkill=$item->id;
                //             break;
                //         }
                //     }
                //     if(!isset($idSkill)){
                //         $idSkill='';
                //     }
                //     if(empty($stringSkills)){
                //         $stringSkills.=$idSkill;
                //     }
                //     else{
                //         $stringSkills.=','.$idSkill;
                //     }
                // }
                //get salary
                $salary=$items->find('div.detail-content div[class=col-xs-4 offset20] ul li',2)->plaintext;
                $salary = str_replace('- Mức lương:', '',$salary);
                //echo $salary;die;

                $listSalary = $this->config->item('default_salary');
                foreach ($listSalary as $key => $value) {
                    if(strcasecmp(standardURL(str_replace(' ', '',$value)),standardURL(trim(str_replace(' ', '',$salary))))==0){
                        $salary=$key;
                        break;
                    }
                }
                $salary_min='';
                $salary_max='';
                //get description
                $description=$items->find('div.detail-content article.block-content table tbody tr td',1)->innertext;
                //gete skill
                $experience_skill=$items->find('div.detail-content article.block-content table tbody tr',1)->innertext;
                $experience_skill = str_replace('<b>Yêu cầu</b>', '',$experience_skill);

                $experience_skill = str_replace('<td class="width-13">', '',$experience_skill);
                $experience_skill = str_replace('<td>', '',$experience_skill);

                $experience_skill = str_replace('</td>', '',$experience_skill);
                //han 
                $date_expiration=$items->find('div.detail-content article.block-content table tbody tr td b.text-danger',0)->innertext;
                $date_expiration = date('Y-m-d',strtotime(trim($date_expiration)));

                //info contact
                $name_contact=$items->find('div.detail-content .block-info-company table.width-100 tbody tr td',1)->plaintext;
                $name_contact = trim($name_contact);

                $email_contact=$items->find('div.detail-content .block-info-company table.width-100 tbody tr',1)->plaintext;
                $email_contact = str_replace('Email', '',$email_contact);
                $email_contact = trim($email_contact);

                $address_contact=$items->find('div.detail-content .block-info-company table.width-100 tbody tr',2)->plaintext;
                $address_contact = str_replace('Địa chỉ', '',$address_contact);
                $address_contact = trim($address_contact);

                $phone_contact=$items->find('div.detail-content .block-info-company table.width-100 tbody tr',3)->plaintext;
                $phone_contact = str_replace('Điện thoại', '',$phone_contact);
                $phone_contact = trim($phone_contact);
                //insert job

                $dataJob['user_id']=$id;
                $dataJob['category_ids']=$stringSkills;
                $dataJob['city_ids']=$stringCitys;
                $dataJob['title']=$title;
                $dataJob['alias']=$alias;
                $dataJob['gender']=$gender;
                $dataJob['age']=25;
                $dataJob['year_exp']=$year_exp;
                $dataJob['qty']=$qty;
                $dataJob['type']=1;
                $dataJob['level_id']=$education_id;
                $dataJob['salary']=$salary;
                $dataJob['salary_min']=$salary_min;
                $dataJob['salary_max']=$salary_max;
                $dataJob['description']=$description;
                $dataJob['status']=1;
                $dataJob['date_expiration']=date('Y-m-d H:i:s',time()+(30*86400));
                $dataJob['date_created']=date('Y-m-d H:i:s',time());
                $dataJob['update_at']=date('Y-m-d H:i:s',time());
                $dataJob['favourites']=1;
                $dataJob['views']=1;


                $dataJob['experience_skill']=$experience_skill;
                $dataJob['date_expiration']=$date_expiration;
                $dataJob['name_contact']=$name_contact;
                $dataJob['address_contact']=$address_contact;
                $dataJob['phone_contact']=$phone_contact;
                $dataJob['email_contact']=$email_contact;
                $dataJob['type_contact']=1;
                $dataJob['language_contact']=1;
                $this->m_jobs->addJob($dataJob);
                //check emplpyer elxit
                if($getUsers->num_rows()>0){

                }
                else{
                    //get info employer
                    $description=$items->find('div.detail-content .block-info-company table.no-border tbody tr',1)->outertext;
                    $description = str_replace('<b>Khái quát</b>', '',$description);

                    $num_of_staff=$items->find('div.detail-content .block-info-company table.no-border tbody tr',2)->outertext;
                    $num_of_staff = str_replace('<b>Quy mô</b>', '',$num_of_staff);
                    foreach ($this->config->item('default_number_staff') as $key=>$value) {
                        if(strcasecmp(standardURL($value),standardURL(trim($num_of_staff)))==0){
                            $num_of_staff = $key;
                            break;
                        }
                    }
                    if(!is_numeric($num_of_staff)){
                        $num_of_staff = 1;
                    }
                    //echo $output_dir_photo;die;
                    $output_dir_logo = realpath(APPPATH. "../public/images/logo/".date("Y").'/'.date("m").'/'.date("d"));
                    $pathPhotos = "./public/images/logo/".date("Y").'/'.date("m").'/'.date("d");
                    $pathLogo = "./public/images/logo/";
                    if(!is_dir($pathPhotos)) //create the folder if it's not already exists
                    {
                        @mkdir($pathPhotos,0777,TRUE);
                    }
                    //gete images
                    $logo=$items->find('div.detail-content .block-info-company table.no-border tbody tr img',0)->src;
                    $nameLogo=explode('/',$logo);
                    $nameSaveLogo=encrypt_name($nameLogo[7]);
                    copy($logo,$output_dir_logo.'/'.$nameSaveLogo);
                    //create employers
                    $dataUserEmployer=array();
                    $dataUserEmployer['logo']=$nameSaveLogo;
                    $dataUserEmployer['user_id']=$id;
                    $dataUserEmployer['company']=$name;
                    $dataUserEmployer['address']='';
                    $dataUserEmployer['num_of_staff']=$num_of_staff;
                    $dataUserEmployer['description']=$description;
                    $dataUserEmployer['created_at']=date('Y-m-d H:i:s',time());
                    $dataUserEmployer['updated_at']=date('Y-m-d H:i:s',time());
                    $idUserEmployer=$this->m_jobs->addEmployer($dataUserEmployer);
                }
                $stt++;
                if($stt==$quantity) {
                    break;
                }
            }
            
        }
        $this->session->set_flashdata('flash_message', 'Craw data success');
        redirect(URL.'admin/craw/viewCraw');

    }
}
//End  SiteSettings Class
/* End of file siteSettings.php */
/* Location: ./app/controllers/siteSettings.php */
?>