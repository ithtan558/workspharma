<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class M_tools extends CI_Model{
    function __construct(){
        parent::__construct();
		$this->load->database();
			$this->load->helper("url");
    }
	
	/*get record next ordering*/
		public function export_sql(){
			//ENTER THE RELEVANT INFO BELOW
			$mysqlDatabaseName ='fredton';
			$mysqlUserName ='root';
			$mysqlPassword ='';
			$mysqlExportPath ='chooseFilenameForBackup.sql';
			
			//DO NOT EDIT BELOW THIS LINE
			$mysqlHostName ='localhost';
			//Export the database and output the status to the page
			$command='mysqldump -u' .$mysqlUserName .' -S /kunden/tmp/mysql5.sock -p' .$mysqlPassword .' ' .$mysqlDatabaseName .' > ~/' .$mysqlExportPath;
			exec($command,$output=array(),$worked);
			switch($worked){
				case 0:
					echo 'Database <b>' .$mysqlDatabaseName .'</b> successfully exported to <b>~/' .$mysqlExportPath .'</b>';
					break;
				case 1:
					echo 'There was a warning during the export of <b>' .$mysqlDatabaseName .'</b> to <b>~/' .$mysqlExportPath .'</b>';
					break;
				case 2:
					echo 'There was an error during export. Please check your values:<br/><br/><table><tr><td>MySQL Database Name:</td><td><b>' .$mysqlDatabaseName .'</b></td></tr><tr><td>MySQL User Name:</td><td><b>' .$mysqlUserName .'</b></td></tr><tr><td>MySQL Password:</td><td><b>NOTSHOWN</b></td></tr><tr><td>MySQL Host Name:</td><td><b>' .$mysqlHostName .'</b></td></tr></table>';
					break;
			}
		}
	/*end get record next ordering*/
}
?>
