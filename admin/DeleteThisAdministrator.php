<?php
	$id = $_REQUEST['id'];
	include_once('../classes/Administrator.php');
	Administrator::deleteAdministrator($id);
	print("<strong><font color='green' size='+1'>Administrator deleted successfully!</font></strong>");
?>