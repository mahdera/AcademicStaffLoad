<?php
	$instructorId = $_REQUEST['instructorId'];
	include_once('../classes/CollegeUser.php');
	CollegeUser::deleteUser($instructorId);
	print("<strong><font color='green' size='+1'>College user deleted successfully!</font></strong>");
?>