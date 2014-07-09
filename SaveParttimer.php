<?php
	@session_start();
	include_once("classes/DBConnection.php");
	include_once("classes/Parttimer.php");
	
	$deptId = $_SESSION['deptId'];
	
	$parttimerId = trim($_POST['txtparttimerid']);
	$firstName = trim($_POST['txtfirstname']);
	$lastName = trim($_POST['txtlastname']);
	$email = trim($_POST['txtemail']);
	$instructorLevel = trim($_POST['slctinstructorlevel']);
	$mobilePhone = trim($_POST['txtmobilephone']);
	$specialization = trim($_POST['txtspecialization']);
	$organization = trim($_POST['txtorganization']);
	
	//now create the obj and save the data
	$parttimerObj = new Parttimer($parttimerId,$firstName,$lastName,$email,$mobilePhone,$instructorLevel,$specialization,$organization,$deptId);
	$parttimerObj->addParttimer();
	Header("Location: EnterLoadInfo.php");
?>