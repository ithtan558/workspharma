<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Jorge Torres

 * Description: Login model class

 */

class M_slideshow extends CI_Model{

    function __construct(){

        parent::__construct();

		$this->load->database();

			$this->load->helper("url");

    }

	

	/*list slideshow_categories sub*/

		public function listSlideshow(){

			$querySlideshow=$this->db->query('select 
			image_slide_show, url_slide_show, text_slide_show
			from '.PREFIX.'slideshow where enable_slide_show=1 order by ordering_slide_show ');

			$listSlideshow=$querySlideshow->result();

			return $listSlideshow;

		}

	/*end list slideshow_categories sub*/

	

}

?>