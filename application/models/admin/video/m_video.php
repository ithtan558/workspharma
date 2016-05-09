<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Jorge Torres

 * Description: Login model class

 */

class M_video extends CI_Model{

    function __construct(){

        parent::__construct();

		$this->load->database();
		
		$this->_gallery_path = realpath(APPPATH. "../public/images/videos/".date("m_Y"));

    }

	//upload images

		public function do_upload(){
			
			$path = "./public/images/video/".date("m_Y");
			
			$in = array("jpg", "png", "gif", "bmp");

			$name=$_FILES['thumb_video']['name'];

			$out = array("php", "php4", "php5", "exe","psd");

			if(in_array(end(explode('.',$name)),$in) && !in_array(end(explode('.',$name)),$out))

			{
				$name=getAlias($name);
				$filename=encrypt_name($name);
				$config = array('upload_path'   => $this->_gallery_path,

							'allowed_types' => 'gif|jpg|png',

							'max_size'      => '200000',

							'file_name'      => $filename);

				$this->load->library("upload");
				$this->upload->initialize($config);

				if(!$this->upload->do_upload("thumb_video")){

					$error = array($this->upload->display_errors());

				}else{

					$image_data = $this->upload->data();    

				}

				//kết thúc công đoạn upload hình ảnh

				$config = array("source_image" => $image_data['full_path'],

							"new_image" => $this->_gallery_path . "",

							"maintain_ration" => true);

				$this->load->library("image_lib",$config);

				$this->image_lib->resize();

			}

			else

			{

				return false;

			}

		}

	/*get list video categories*/

		public function listVideoCategories(){

			$queryvideo_categories=$this->db->query('select * from '.PREFIX.'video_categories order by name_video_categories');

			$listvideoCategories=$queryvideo_categories->result();

			return $listvideoCategories;

		}

	/*end get list video categories*/

	

    /*get list video*/

		public function listVideo(){
			$where="";
			if(isset($_SESSION['__enable_video__']) )
			{
				if($_SESSION['__enable_video__']!=-1)
				{
					$where.=" and enable_video=".$_SESSION['__enable_video__']." ";
				}
			}
			if(isset($_SESSION['__idVideoCategories__']) )
			{
				if($_SESSION['__idVideoCategories__']!=0)
				{
					$where.=" and catid in (".$_SESSION['__idVideoCategories__'].") ";
				}
			}

			$queryvideo=$this->db->query("select a.* 
			from ".PREFIX."video a
			order by ordering_video");

			$listVideo=$queryvideo->result();
			
			/*$queryvideo1=$this->db->query("select * from ".PREFIX."video where catid=12");

			$listVideo1=$queryvideo1->result();
			foreach($listVideo1 as $video)
			{
				//$fulltext=str_replace('images/stories/kien-thuc/2014/','public/images/video/kien-thuc/2014/07/',$video->fulltext_video);
						$fulltext=str_replace('images/stories/tin-tuc/2013/','public/images/video/tin-tuc/2013/07/',$video->fulltext_video);
				
					$queryvideo=$this->db->query("update ".PREFIX."video set fulltext_video='".$fulltext."' where idVideo=".$video->idVideo."");
					//$listVideo=$queryvideo->result();
				
			}*/

			return $listVideo;

		}

	/*end get list video*/
	
	/*get list video*/

		public function listVideoRelated($idVideo){
			$getvideo=$this->getVideo($idVideo);
			$queryvideo=$this->db->query('select * from '.PREFIX.'video where idVideo in ('.$getvideo[0]->related_video.')');

			$listVideoRelated=$queryvideo->result();

			return $listVideoRelated;

		}

	/*end get list video*/

	

	/*get list video temp*/

		public function listVideoTemp($idVideoCategories){

			$queryvideo=$this->db->query('select a.* 
			from '.PREFIX.'video a
			where enable_video=1 order by ordering_video asc');

			$listVideo=$queryvideo->result();

			return $listVideo;

		}

	/*end get list video temp*/

	

	/*Lấy get video*/

		public function getVideo($idVideo){

			$queryvideo=$this->db->query(

			'select *

			from '.PREFIX.'video

			where idVideo='.$idVideo.'');

			$getVideo=$queryvideo->result();
			

			return $getVideo;

		}

	/*end get video*/

	

	/*add video*/

		public function addVideo($data){

			$this->db->insert(''.PREFIX.'video', $data);

		}

	/*end add video*/

	/*edit video*/

		public function editVideo($idVideo,$data){

			$this->db->where("idVideo",$idVideo);

			$this->db->update(''.PREFIX.'video', $data);

		}

	/*end edit video*/
	
	
	/*insert_related*/

		public function insert_related($string,$number){
			
			
			if (($key = array_search('on', $string)) !== false) {
				unset($string[$key]);
			}
			
			$string = implode(",", $string);
			
			if($number)
			{
				$number = implode(",", $number);
			}
			else
			{
				$number = 0;
			}
			$queryvideo = $this->db->query("select * from ".PREFIX."video where idVideo not in (".$number.") and idVideo in (".$string.")");

			$insert_related=$queryvideo->result();

			

			return $insert_related;

		}

	/*end insert_related*/

	

	/*remove video*/

		public function removevideo($idVideo)

		{

			$this->db->where("idVideo",$idVideo);

			$this->db->delete("".PREFIX."video");

		}

	/*end remove video*/

	/*enable video*/

		public function enable($enable,$id){

			if($enable==0)

			$enable=1;

			else

			$enable=0;

			$qr = $this->db->query("UPDATE ".PREFIX."video SET enable_video=".$enable." WHERE idVideo=".$id."" );

		}

	/*end enable video*/

	/*check_ordering*/

		public function check_ordering($idVideo,$data){

			$this->db->where("idVideo",$idVideo);

			$this->db->update(''.PREFIX.'video', $data);

		}

	/*end check_ordering*/

	/*get record next ordering*/

		public function getOrderingPrevious($ordering_video){

			$queryOrderingPrevious=$this->db->query(

			'select *

			from '.PREFIX.'video

			where ordering_video='.($ordering_video+1).'');

			$getOrderingPrevious=$queryOrderingPrevious->result();

			return $getOrderingPrevious;

		}

	/*end get record next ordering*/

	

	/*get record next ordering*/

		public function getOrderingNext($ordering_video){

			$queryOrderingNext=$this->db->query(

			'select *

			from '.PREFIX.'video

			where ordering_video='.($ordering_video-1).'');

			$getOrderingNext=$queryOrderingNext->result();

			return $getOrderingNext;

		}

	/*end get record next ordering*/
	
	/*list string video categories sub*/
	function stringidVideoCategories($idVideoCategories){
        $this->db->order_by('parentid','asc')->group_by('parentid,idVideoCategories');
        $q=$this->db->where('enable_video_categories',1);
		$this->db->select('idVideoCategories,parentid');
        $q=$this->db->get(''.PREFIX.'video_categories');
        foreach($q->result() as $r){
            $data[$r->parentid][] = $r;
        }
        $menu=$this->getStringidVideoCategories($data,$idVideoCategories);
        return $menu;
    } 
	/*end list string video categories sub*/
	
	/*list string video categories nhưng không lấy sub*/
	function listvideoCategoriesSubNotSub($idVideoCategories){
        $this->db->order_by('ordering_video_categories','asc');
        $q=$this->db->where('parentid',$idVideoCategories);
        $q=$this->db->where('enable_video_categories',1);
        $q=$this->db->get(''.PREFIX.'video_categories');
        $menu=$q->result();
        return $menu;
    } 
	/*end list string video categories nhưng không lấy sub*/
	
	
	function getStringidVideoCategories($category,$parent){
        static $i = 1;
        if (array_key_exists($parent, $category)){
            $menu = '';
            $i++;
				$menu.=$parent.',';
            foreach ($category[$parent] as $r) {
                $child = $this->getStringidVideoCategories($category, $r->idVideoCategories);
				$menu.=$r->idVideoCategories.',';
                if ($child) {
                    $i--;
                    $menu .= $child;
                }
            }		
            return $menu;
        } else {
            return false;
        }
    } 
	/*list video_categories*/

	

}

?>