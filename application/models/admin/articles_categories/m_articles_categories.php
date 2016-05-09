<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Author: Jorge Torres

 * Description: Login model class

 */

class M_articles_categories extends CI_Model{

    function __construct(){

        parent::__construct();

		$this->load->database();

			$this->load->helper("url");

    }

    /*Get list categories*/

		/*public function listArticlesCategories(){

			$queryArticlesCategories=$this->db->query('select * 

			from ".PREFIX."articles_categories order by ordering_articles_categories');

			$listArticlesCategories = array();

			foreach ($queryArticlesCategories->result() as $articlesCategories){

				$option_list = $this->db->get_where('".PREFIX."articles', array('catid'=>$articlesCategories->idArticlesCategories));

				$articlesCategories->idArticlesCategorie = $option_list->result();

				$listArticlesCategories[] = $articlesCategories;

			}

			return $listArticlesCategories;

		}*/
		public function listArticlesCategories($idArticlesCategories=false){
			$where="";
		if($idArticlesCategories!=false)
		{
			$where=" where parentid=".$idArticlesCategories." ";
		}
			$queryArticlesCategories=$this->db->query("select * 

			from ".PREFIX."articles_categories ".$where."  order by ordering_articles_categories");

			$listArticlesCategories=$queryArticlesCategories->result();

			return $listArticlesCategories;

		}
	/*end Get list categories*/

	

	/*Get categories*/

		public function getArticlesCategories($idArticlesCategories){

			$queryArticlesCategories=$this->db->query(

			'select *

			from '.PREFIX.'articles_categories

			where idArticlesCategories='.$idArticlesCategories.'');

			$getArticlesCategories=$queryArticlesCategories->result();
			$_SESSION['__idArticlesCategories__']=$getArticlesCategories[0]->parentid;
			

			return $getArticlesCategories;

		}

	/*end Get categories*/

	

	/*add categories*/

		public function addArticlesCategories($data){

			$this->db->insert(''.PREFIX.'articles_categories', $data);

		}

	/*end add categories*/

	/*edit categories*/

		public function eidtArticlesCategories($idArticlesCategories,$data){

			$this->db->where("idArticlesCategories",$idArticlesCategories);

			$this->db->update(''.PREFIX.'articles_categories', $data);

		}

	/*end edit categories*/

	

	/*remove categories*/

	public function removeArticlesCategories($idArticlesCategories)



	{

		$this->db->where("idArticlesCategories",$idArticlesCategories);

		$this->db->delete("".PREFIX."articles_categories");

	}

	/*end remove categories*/



	/*enable categories*/

		public function enable($status,$id){

			if($status==0)

			$status=1;

			else

			$status=0;

			$qr = $this->db->query("UPDATE ".PREFIX."articles_categories SET enable_articles_categories=".$status." WHERE idArticlesCategories=".$id."" );

		}

	/*end enable categories*/
	
	/*list articles_categories combobox*/
	public function listArticlesCategoriesCombobox()
	{
		$menu = $this->articlesCategories(0);
		$articles="";
		$selected="";
		if(isset($_SESSION['__idArticlesCategories__']))
		{
			$idArticlesCategories=$_SESSION['__idArticlesCategories__'];
		}
		else
		{
			$idArticlesCategories="";
		}
		foreach($menu as $k => $row)
		{
			
			if($idArticlesCategories==$row['idArticlesCategories']) 
			{
				$selected= "selected";
			}
			else
			{
				$selected="";
			}
			
			$articles.='<option '.$selected.' value="'.$row['idArticlesCategories'].'">'.$row['name_articles_categories'].'</option>';
		}
		return $articles;
	}
	public function ArticlesCategories($parentid = 0, $space = "", $trees = array())
    {
        if(!$trees) 
        {
            $trees = array();
        }
        $query =$this->db->query("SELECT * FROM ".PREFIX."articles_categories WHERE parentid = '".$parentid."' order by ordering_articles_categories asc");
		$listMenu=$query->result();
        foreach($listMenu as $rs)
		{
            $trees[] = array( 'idArticlesCategories' => $rs->idArticlesCategories,
                                'name_articles_categories'=>$space.$rs->name_articles_categories,
								'parentid' => $rs->parentid,
                                ); 
            $trees = $this->articlesCategories($rs->idArticlesCategories, $space.'&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;', $trees); 
        }
        return $trees;
    }
	
	/*end list articles_categories combobox*/



	

}

?>