<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Jorge Torres

 * Description: Login model class

 */

class M_email extends CI_Model{

    function __construct(){

        parent::__construct();

		$this->load->database();

			$this->load->helper("url");

    }

    /*list email*/

		public function listEmail(){

		$email_list=$this->db->get(''.PREFIX.'email');

		$listEmail = $email_list->result();

		return $listEmail;

    }

	/*end list email*/

	

	/*remove email*/

	public function removeEmail($idEmail)



	{

		$this->db->where("idEmail",$idEmail);

		$this->db->delete("".PREFIX."email");

	}

	/*end remove email*/



	/*enable email */

		public function enable($status,$id){

			if($status==0)

			$status=1;

			else

			$status=0;

			$qr = $this->db->query("UPDATE ".PREFIX."email SET enable_email=".$status." WHERE idEmail=".$id."" );

		}

	/*end enable email */

	

	

}

?>

