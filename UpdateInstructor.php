<?php
	include_once("classes/Instructor.php");
	include_once("classes/ExpectedTeachingCommitment.php");
	//get the values...
	
	$instructorId = $_POST['txtinstructorid'];
	$firstName = $_POST['txtfirstname'];
	$lastName = $_POST['txtlastname'];
	$email = $_POST['txtemail'];
	$mobilePhone = $_POST['txtmobilephone'];
	$instructorLevel = $_POST['slctinstructorlevel'];
	$academicUnitId = $_POST['slctacademicunit'];
	$specialization = $_POST['txtspecialization'];
	$serviceYear = $_POST['txtserviceyear'];
	$otherRespoId = $_POST['slctadminposition'];	
	$sex = $_POST['slctsex'];
	$qualification = $_POST['txtqualification'];
	$status = $_POST['slctstatus'];
	$nationality = $_POST['txtnationality'];
	$teachingCommitmentRateLookupId = $_REQUEST['slctteachingcommitmentratelookup'];
	
	Instructor::updateInstructor($instructorId,$firstName,$lastName,$email,$mobilePhone,$instructorLevel,$serviceYear,$specialization,$academicUnitId,$otherRespoId,$sex,$status,$nationality,$qualification);
	//now update the teaching commitment for this particular instructor
	if(ExpectedTeachingCommitment::doesThisInstructorFromThisAcademicUnitHasTeachingCommitment($instructorId,$academicUnitId) == "true")
		ExpectedTeachingCommitment::updateExpectedTeachingCommitmentForThisInstructor($teachingCommitmentRateLookupId,$instructorId,$academicUnitId);
	else{
		//I need to insert a new record in the ExpectedTeachingCommitment table for this particular case...
		$expectedTeachingCommitment = new ExpectedTeachingCommitment($instructorId,$academicUnitId,$teachingCommitmentRateLookupId);
   	$expectedTeachingCommitment->addExpectedTeachingCommitment();
	}
		
	Header("Location: EditInstructor.php");
?>