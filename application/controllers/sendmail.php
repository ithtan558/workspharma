<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION))@session_start();
require_once(APPPATH . 'controllers/application.php');
class Sendmail extends Application
{
    /**
     * Constructor
     *
     * Loads language files and models needed for this controller
     */
    public function __construct(){
        
        parent::__construct();
    } //Controller End
    function testCronJob()
    {
        $this->load->library('email');
        $this->email->mailFrom      = $this->config->item('site_admin_mail');
        $this->email->mailTo        = 'ithtan558@gmail.com';
        $this->email->templateType  = 'active_account';
        $this->email->paramSubject  = 'test mail';
        $this->email->paramBody     = 'test mail';
        $this->email->sendMail();
    }

    function testCronJobUpdate()
    {
        $this->load->Model("m_resume");
        $updateKey=array('resume.id'=>4);
        $updateData=array('resume.display_name_resume'=>'testCronJob');
        $this->m_resume->updateResume($updateKey,$updateData);
    }
} //End  Buyer Class
/* End of file Employers.php */
/* Location: ./app/controllers/Employers.php */
?>
