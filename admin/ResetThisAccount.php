<?php
	include_once('../classes/User.php');
	$instId = $_REQUEST['instId'];
	$username = $_REQUEST['username'];
	$password = $_REQUEST['newPassword'];
	//now reset the account
	User::resetThisAccount($instId,$username,$password);
	print("<strong><font color='green' size='+1'>Account resetted successfully!</font></strong>");
?>