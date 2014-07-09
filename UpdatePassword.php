<?php
	include_once('classes/User.php');
	//now get the form variables
	$email = $_POST['txtemail'];
	$username = $_POST['txtusername'];
	$currentPassword = $_POST['txtcurrentpassword'];
	$newPassword = $_POST['txtnewpassword'];
	//now call the gadame method that does the updating
	User::updatePassword($email,$username,$currentPassword,$newPassword);
	Header("Location: UserArea.php");
?>