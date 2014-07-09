<?php
	include_once("../classes/User.php");
	//get the values...
	
	$instructorId = $_POST['txtinstructorid'];
	$firstName = $_POST['txtfirstname'];
	$lastName = $_POST['txtlastname'];
	$email = $_POST['txtemail'];
	$mobilePhone = $_POST['txtmobilephone'];
	$administrativePosition = $_POST['slctadministrativeposition'];
	$academicUnitId = $_POST['slctacademicunit'];
	
	User::updateUser($instructorId,$firstName,$lastName,$email,$mobilePhone,$academicUnitId,$administrativePosition);
	Header("Location: EditUser.php");
?>