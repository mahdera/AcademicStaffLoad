<?php
	include_once("../classes/Instructor.php");
	//get the values...
	
	$instructorId = $_POST['txtinstructorid'];
	$firstName = $_POST['txtfirstname'];
	$lastName = $_POST['txtlastname'];
	$email = $_POST['txtemail'];
	$mobilePhone = $_POST['txtmobilephone'];
	$instructorLevel = $_POST['txtacademicrank'];
	$academicUnitId = $_POST['hiddenacademicunitid'];
	$specialization = $_POST['txtspecialization'];
	$serviceYear = $_POST['txtserviceyear'];
   $otherRespoId = $_POST['hiddenotherrespo'];
   ///here comes the additional elements
   $sex = $_POST['txtsex'];
   $qualification = $_POST['txtqualification'];
   $status = $_POST['txtstatus'];
   $nationality = $_POST['txtnationality'];
	
	Instructor::updateInstructor($instructorId,$firstName,$lastName,$email,$mobilePhone,$instructorLevel,$serviceYear,$specialization,$academicUnitId,$otherRespoId,$sex,$status,$nationality,$qualification);
	Header("Location: EditInstructor.php");
?>