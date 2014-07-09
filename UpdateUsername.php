<?php
	include_once('classes/User.php');
	//first get all the passed form variables to this specific file
	$email = $_POST['txtemail'];
	$currentUsername = $_POST['txtcurrentusername'];
	$newUsername = $_POST['txtnewusername'];	
	User::updateUsername($email,$currentUsername,$newUsername);
	//now call the update method of class User
	Header("Location: UserArea.php");
?>