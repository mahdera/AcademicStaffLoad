<?php
	include_once('../classes/BackupTaker.php');
	$host = "localhost";
	$user = "root";
	$pass = "root";
	$dbname = "dbstaffld";	
	//now call the backuping function from the BackupTaker.php class
	BackupTaker::backupTables($host,$user,$pass,$dbname);	
?>