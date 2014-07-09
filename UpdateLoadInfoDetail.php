<?php
	include_once('classes/InstructorLoad.php');
	
	
	//try to get the values and check if all is fine
	$instructorId = $_POST['instructorId'];
	$courseNumber = $_POST['courseNumber'];	
	$numberOfSections = $_POST['numberOfSections'];
	$numberOfStudents = $_POST['numberOfStudents'];
	$numberOfStudentsPerSection = $_POST['numberOfStudentsPerSection'];
	$oldCourseNumber = $_POST['oldCourseNumber'];
	$oldDeliveryType = $_POST['oldDeliveryType'];
	
	$numberOfSections = ($numberOfSections != "" ? $numberOfSections : 0);
	$numberOfStudents = ($numberOfStudents != "" ? $numberOfStudents : 0);
	$numberOfStudentsPerSection = ($numberOfStudentsPerSection != "" ? $numberOfStudentsPerSection : 0);
	
	$category = $_POST['category'];
	$type = $_POST['deliveryType'];
	$remark = $_POST['remark'];
	
	//now do the necessary modification if the case is advising
	if($numberOfSections == "")
		$numberOfSections = 0;
	if($numberOfStudentsPerSection == "")
		$numberOfStudentsPerSection = 0;
	
	//now call the method that does the updating
	InstructorLoad::updateInstructorLoad($instructorId,$oldCourseNumber,$oldDeliveryType,$courseNumber,$numberOfSections,$numberOfStudentsPerSection,$numberOfStudents,$category,$type,$remark);	
?>
<p class="msg done">
	Instructor load information updated successfully!
</p>