<?php
	include_once("classes/Parttimer.php");
	//get the values...
	
	$parttimerId = $_POST['txtinstructorid'];
	$firstName = $_POST['txtfirstname'];
	$lastName = $_POST['txtlastname'];
	$email = $_POST['txtemail'];
	$mobilePhone = $_POST['txtmobilephone'];
	$instructorLevel = $_POST['slctinstructorlevel'];	
	$specialization = $_POST['txtspecialization'];	
	$academicUnitId = $_SESSION['deptId'];	
	
	Parttimer::updateParttimer($parttimerId,$firstName,$lastName,$email,$mobilePhone,$instructorLevel,$spcialization,$organization,$academicUnitId);
	Header("Location: EditInstructor.php");
?>