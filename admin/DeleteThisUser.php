<?php
	include_once("../classes/User.php");
	
	$instructorId = $_GET['id'];
	User::deleteUser($instructorId);
	Header("Location: DeleteUser.php");
?>