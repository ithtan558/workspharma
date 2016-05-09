<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION))@session_start();
class Application extends CI_Controller{
   public $_data = array();
   public $siteoffline="";
   public $offlinemsg="";
   public $google_analytic="";
   public $languages = "";
   function __construct(){
        parent::__construct();
		/*library*/
			$this->load->library('cart');
		/*hepler*/
			$this->load->helper("getalias");
			$this->load->helper("url");
			$this->load->Model("m_application");
			$this->load->driver('cache');
			$this->load->Model("m_common");
			$this->my_config->db_config_fetch();
			$this->lang->load('enduser/common', $this->config->item('language_code'));
			if($this->session->userdata('languages')){
				if($this->session->userdata('languages') == 'vietnamese'){
		            $this->languages= '';
		        }
		        else{
		            $this->languages = '_en';
		        }
		    }
	        else{
	        	if($this->config->item('language_code') == 'vietnamese'){
		            $this->languages= '';
		        }
		        else{
		            $this->languages = '_en';
		        }
	        }
			$this->_data = $this->m_common->getPageTitleAndMetaData();
			//load all skills
	        $condition_categories=array('categories.is_active'=>1,'categories.is_deleted'=>0);
	        $getCategories = $this->m_application->getCategories($condition_categories,NULL,NULL,NULL);
	        $this->_data['getCategories'] = $getCategories;
	        //load all location
	        $getCities = $this->m_application->getCities();
	        $this->_data['getCities'] = $getCities;
	        //load all education
	        $this->_data['getEducation'] = $this->config->item('default_education');
	        //load all default_currentJobLevel
	        $this->_data['getCurrentJobLevel'] = $this->config->item('default_currentJobLevel');
	        //load all default_cbPositionType
	        $this->_data['default_cbPositionType'] = $this->config->item('default_cbPositionType');
	        //load all default_currentJobLevel
	        $this->_data['default_currentJobLevel'] = $this->config->item('default_currentJobLevel');
	        //load all default_salary
	        $this->_data['default_salary'] = $this->config->item('default_salary');
	        //load all default_exp
	        $this->_data['default_exp'] = $this->config->item('default_exp');
	        //load all default_skills
	        $this->_data['default_skills'] = $this->config->item('default_skills');
	        //load all default_number_staff
	        $this->_data['default_number_staff'] = $this->config->item('default_number_staff');
	        //load all default_accept_new
	        $this->_data['default_accept_new'] = $this->config->item('default_accept_new');
	        //load all default_sex
	        $this->_data['default_sex'] = $this->config->item('default_sex');
	        //load all default_type_contact
	        $this->_data['default_type_contact'] = $this->config->item('default_type_contact');
			
			/*save cache */
				$cacheConfig = $this->cache->get('getConfig');
				if($cacheConfig)
				{
				   $getConfig = $this->cache->get('getConfig');
				}
				else
				{
				   $getConfig = $this->m_application->getConfig();
				   $this->cache->save('getConfig', $getConfig, NULL, 300);
				}
				/*check website online or offline*/
					foreach($getConfig as $config)
					{
					 if($config->name=='siteoffline'){
						 $this->siteoffline=$config->value;
					 }
					 if($config->name=='offlinemsg'){
						 $offlinemsg=$config->value;
					 }
					 if($config->name=='google analytic'){
						 $google_analytic=$config->value;
						 //google analytic
							$this->_data['google_analytic']=$google_analytic;
						//end google analytic
					 }
					 if($config->name=='google_remarketing'){
						 $google_remarketing=$config->value;
						//google analytic
							$this->_data['google_remarketing']=$google_remarketing;
						//end google analytic
					 }
					}
					$listBlocks=$this->m_application->listBlocks();
					$this->_data['listBlocks']=$listBlocks;
					foreach($listBlocks as $blocks)
					{
						if($blocks->name_blocks=='block_copyright')
						{
							$this->_data['block_copyright']=$blocks;
						}
						if($blocks->name_blocks=='block_countvisitor')
						{
							$this->_data['block_countvisitor']=$blocks;
						}
						if($blocks->name_blocks=='code_facebook')
						{
							$this->_data['code_facebook']=$blocks;
						}
						if($blocks->name_blocks=='block_addthis')
						{
							$this->_data['block_addthis']=$blocks;
						}
						if($blocks->name_blocks=='block_support_online')
						{
							$this->_data['block_support_online']=$blocks;
						}
						if($blocks->name_blocks=='block_new_articles')
						{
							if($blocks->enable_blocks==1)
							{
								$listBlocksNewArticles=$this->m_application->listBlocksNewArticles();
								$this->_data['listBlocksNewArticles']=$listBlocksNewArticles;
							}
							$this->_data['block_new_articles']=$blocks;
						}
						if($blocks->name_blocks=='block_top_news')
						{
							if($blocks->enable_blocks==1)
							{
								$listBlocksTopNews=$this->m_application->listBlocksTopNews();
								$this->_data['listBlocksTopNews']=$listBlocksTopNews;
							}
							$this->_data['block_top_news']=$blocks;
						}
						if($blocks->name_blocks=='block_ads_left')
						{
							$this->_data['block_ads_left']=$blocks;
						}
						if($blocks->name_blocks=='block_ads_right')
						{
							$this->_data['block_ads_right']=$blocks;
						}
						if($blocks->name_blocks=='block_search')
						{
							$this->_data['block_search']=$blocks;
						}
						if($blocks->name_blocks=='block_testimonials')
						{
							$this->_data['block_testimonials']=$blocks;
						}
						if($blocks->name_blocks=='block_fanpage')
						{
							$this->_data['block_fanpage']=$blocks;
						}
						if($blocks->name_blocks=='block_related_website')
						{
							$this->_data['block_related_website']=$blocks;
						}
						if($blocks->name_blocks=='block_hotline')
						{
							$this->_data['block_hotline']=$blocks;
						}
						if($blocks->name_blocks=='block_call_top')
						{
							$this->_data['block_call_top']=$blocks;
						}
						if($blocks->name_blocks=='block_email_top')
						{
							$this->_data['block_email_top']=$blocks;
						}
					}
				//end google analytic
				//get title, meta, description
					foreach($getConfig as $config)
					{
						if($config->name=='site_meta_keywords')
						{
							$this->_data['keywords']=$config->value;
						}
						if($config->name=='site_meta_description')
						{
							$this->_data['description']=$config->value;
						}
						if($config->name=='site_title')
						{
							$this->_data['title']=$config->value;
						}
						if($config->name=='author')
						{
							$this->_data['author']=$config->value;
						}
						if($config->name=='contact')
						{
							$this->_data['contact']=$config->value;
						}
						if($config->name=='copyright')
						{
							$this->_data['copyright']=$config->value;
						}
						if($config->name=='slogan')
						{
							$this->_data['slogan']=$config->value;
						}
						if($config->name=='keywords')
						{
							$this->_data['keywords']=$config->value;
						}
					}
					$this->_data['thumb_images']=IMAGES.'logo_share_200_200.png';
				//end get title, meta, description
				/*end check website online or offline*/
			/*end save cache*/
				$listBanner=$this->m_application->listBanner();
				$this->_data['listBanner']=$listBanner;
			/*end banner-top, right*/
			/*support online*/
				$cacheSupportOnline = $this->cache->get('listSupportOnline');
				if($cacheSupportOnline)
				{
				   $listSupportOnline = $this->cache->get('listSupportOnline');
				}
				else
				{
				   $listSupportOnline=$this->m_application->listSupportOnline();
				   $this->cache->save('listSupportOnline', $listSupportOnline, NULL, 300);
				}
				$this->_data['listSupportOnline']=$listSupportOnline;
			/*end support online*/
     }
}
?>