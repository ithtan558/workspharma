<?php 
if(!isset($_SESSION))@session_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class M_application_admin extends CI_Model{
	
	var $_parent_name = '';
	var $searchFields = '';
	var $sortFields = '';
	var $denyFields = array();
	
	public $languages="";
    function __construct(){
        parent::__construct();
		$this->load->database();
    }
	/*check connect ftp*/
		public function connect(){
			$this->load->library("ftp");
			$config['hostname'] = 'localhost';
			$config['username'] = 'fredton';
			$config['password'] = 'kncu3569zgfs';
			//$config['username'] = 'root';
			//$config['password'] = '';
			$config['port']     = 21;
			$config['passive']  = FALSE;
			$config['debug']    = TRUE;
			$this->ftp->connect($config);
		}
	/*end connect ftp*/
	/**
	 * build SQL when search and sort
	 * @param unknown $params
	 */
	 public function createSQL($params) {
		$whereAnd = array ();
		$whereOr = array ();
		if($params != '' && is_array($params)){
			foreach ( $params as $field => $value ) {
				if ($field != 'keyword') {
					if (isset ( $this->searchFields [$field] )) {
						if($params [$field] != ''){
							$whereAnd [] = str_replace ( '{{param}}', $params [$field], $this->searchFields [$field] );
						}
					} elseif (isset ( $this->sortFields [$field] )) {
						$this->db->order_by ( str_replace ( '{{param}}', $params [$field], $this->sortFields [$field] ) );
					}
				} else {
					foreach ( $this->searchFields as $key => $value ) {
						//var_dump($this->denyFields);die;
						if($params [$field] != '' && !in_array($key, $this->denyFields)){
							$whereOr [] = str_replace ( '{{param}}', rawurldecode(urldecode($params [$field])), $this->searchFields [$key] );
						}
					}
				}
			}
		}
		if (count ( $whereAnd )) {
			$this->db->where ( implode ( ' AND ', $whereAnd ) );
		}
		if (count ( $whereOr )) {
			$condition = '('.implode ( ' OR ', $whereOr ) . ')';
			$this->db->where ( $condition );
		}
		return $this->db;
	}
}
?>