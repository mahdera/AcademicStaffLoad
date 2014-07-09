<?php
	include_once("../classes/Parttimer.php");
	//get the values...
	
	$instructorId = $_POST['hiddeninstructorid'];
	$firstName = $_POST['txtfirstname'];
	$lastName = $_POST['txtlastname'];
	$email = $_POST['txtemail'];
	$mobilePhone = $_POST['txtmobilephone'];
	$instructorLevel = $_POST['txtacademicrank'];
	$academicUnitId = $_POST['hiddenacademicunitid'];
	$specialization = $_POST['txtspecialization'];  
   $organization = $_POST['txtorganization'];
   
	Parttimer::updateParttimer($instructorId,$firstName,$lastName,$email,$mobilePhone,$instructorLevel,$specialization,$organization,$academicUnitId);
	//Instructor::updateInstructor($instructorId,$firstName,$lastName,$email,$mobilePhone,$instructorLevel,$serviceYear,$specialization,$academicUnitId,$otherRespoId,$sex,$status,$nationality,$qualification);
	Header("Location: EditInstructor.php");
?>