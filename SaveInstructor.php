<?php
	include_once("classes/Instructor.php");
	include_once("classes/ExpectedTeachingCommitment.php");
   
   //now get the passed information from the caller page
   $academicUnitId = trim($_POST['slctacademicunit']);
   $instructorId = trim($_POST['txtinstructorid']);
   $firstName = trim($_POST['txtfirstname']);
   $lastName = trim($_POST['txtlastname']);
   $email = trim($_POST['txtemail']);
   $mobilePhone = trim($_POST['txtmobilephone']);
   $instructorLevel = trim($_POST['slctinstructorlevel']);
   $serviceYear = trim($_POST['txtserviceyear']);
   $specialization = trim($_POST['txtspecialization']);
   $otherResponsibility = trim($_POST['slctadminposition']);
   //now get the additionals
   $sex = trim($_POST['slctsex']);
   $qualification = trim($_POST['txtqualification']);
   $status = trim($_POST['slctstatus']);
   $nationality = trim($_POST['txtnationality']);
   $expectedTeachingCommitmentId = $_POST['slctexpectedteachingcommitmentratelookup'];
   
   
   $instructorObj = new Instructor($instructorId,$firstName,$lastName,$email,$mobilePhone,$instructorLevel,$serviceYear,$specialization,$academicUnitId,$otherResponsibility,$sex,$status,$nationality,$qualification);
   $instructorObj->addInstructor(); 
   
   $expectedTeachingCommitment = new ExpectedTeachingCommitment($instructorId,$academicUnitId,$expectedTeachingCommitmentId);
   $expectedTeachingCommitment->addExpectedTeachingCommitment();
  
   Header("Location: AddInstructor.php");   
?>