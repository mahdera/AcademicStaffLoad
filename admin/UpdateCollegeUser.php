<?php
	$instructorId = $_REQUEST['instructorId'];
	$firstName = $_REQUEST['firstName'];
	$lastName = $_REQUEST['lastName'];
	$email = $_REQUEST['email'];
	$mobilePhone = $_REQUEST['mobilePhone'];
	$facultyId = $_REQUEST['facultyId'];
	$adminPositionId = $_REQUEST['adminPositionId'];
	include_once('../classes/CollegeUser.php');
	CollegeUser::updateUser($instructorId,$firstName,$lastName,$email,$mobilePhone,$facultyId,$adminPositionId);
	print("<strong><font color='green' size='+1'>Colleger user updated successfully!</font></strong>");	
?>