<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Email extends CI_Email {

    public $mailTo = '';
    public $mailFrom = '';
    public $mailCC = '';
    public $templateType = "";
    public $priority = 0;
    public $paramSubject = array();
    public $paramBody = array();
    private $ci;
    public $namefile;
    public $tmp_name;
    public function __construct() {
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.evolableasia.vn',
            'smtp_port' => 25,
            'smtp_user' => 'deliverysystem@evolableasia.vn', // change it to yours
            'smtp_pass' => '2tg8vCKb', // change it to yours
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'wordwrap' => TRUE,
            'validation' => TRUE
        );

        parent::__construct($config);
        $this->ci = & get_instance();
        $this->ci->load->model('m_email');
    }
    public function addMailQueue(){
        $condition = array('email_templates.type' => $this->templateType);
        $template = $this->ci->m_email->getEmailSettings($condition)->row();

        $mailSubject = strtr($template->mail_subject, $this->paramSubject);
        $mailContent = strtr($template->mail_body, $this->paramBody);

        $dataQueue = array(
            "subject"   => $mailSubject,
            "body"      => $mailContent,
            "from"      => $this->mailFrom,
            "to"        => $this->mailTo,
            "cc"        => $this->mailCC,
            "priority"  => $this->priority
        );
        return $this->ci->m_email->addMailQueue($dataQueue);
    }



    function sendMail(){
        if($this->templateType != '') {
            $condition = array('email_templates.type' => $this->templateType);
            $template = $this->ci->m_email->getEmailSettings($condition)->row();
            $mailSubject = strtr($template->mail_subject, $this->paramSubject);
            $mailContent = strtr($template->mail_body, $this->paramBody);
            $namefile = $this->namefile;
        }else{
            $mailSubject = $this->paramSubject;
            $mailContent = $this->paramBody;
        }

        $tmp_name=$this->tmp_name;
        if(SENDGRIP == 1){
            $url = 'https://api.sendgrid.com/';
            $request =  $url.'api/mail.send.json';
            $user = 'ithtan558';
            $pass = 'htans2ntmtran';

            $params['api_user'] = $user;
            $params['api_key']  = $pass;
            $params['from']     = $this->mailFrom;
            $params['fromname'] = "Workspharma";
            $params['to']       = $this->mailTo;
            $params['subject']  = $mailSubject;
            $params['html']     = $mailContent;
            //$params['files['.$this->namefile.']']     = '@'.$files;
            //$params['files'] = new CurlFile($_FILES[''.$tmp_name.'']['tmp_name'],'file/exgpd',$files);
            // Generate curl request
            $session = curl_init($request);
            // Tell curl to use HTTP POST
            if($this->namefile!=''){
                $files=$this->files;
                // Create a CURLFile object
                $files=curl_file_create( $files);
                // Assign POST data
                $params['files['.$this->namefile.']']=$files;
            }
            curl_setopt ($session, CURLOPT_POST, true);
            // Tell curl that this is the body of the POST
            curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
            // Tell curl not to return headers, but do return the response
            curl_setopt($session, CURLOPT_HEADER, false);
            // Tell PHP not to use SSLv3 (instead opting for TLS)
            //curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
            curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

            // obtain response
            $response = curl_exec($session);
            //var_dump($response);die;
            curl_close($session);

            $res = json_decode($response);

            if($res->message === 'success'){
                return true;
            }else{
                return false;
            }
        }else {
            $this->set_newline("\r\n");
            $this->to($this->mailTo);
            $this->from($this->mailFrom, 'Workspharma');
            $this->cc($this->mailCC);
            $this->subject($mailSubject);
            $this->message($mailContent);
            if($namefile != ''){
                $this->attach($namefile);
            }
            if ($this->send()) {
                return true;
            } else {
                var_dump($this->print_debugger());
                die;
                return false;
            }
        }
    }

}
