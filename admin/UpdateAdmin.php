<?php
	$id = $_REQUEST['id'];
	$firstName = $_REQUEST['firstName'];
	$lastName = $_REQUEST['lastName'];
	$email = $_REQUEST['email'];
	
	include_once('../classes/Administrator.php');
	Administrator::updateAdministrator($id,$firstName,$lastName,$email);
	
	print("<strong><font color='green' size='+1'>Administrator updated successfully!</font></strong>");	
?>