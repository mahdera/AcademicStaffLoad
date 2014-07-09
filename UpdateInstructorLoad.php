<?php
	include_once("classes/DBConnection.php");
	include_once("classes/InstructorLoad.php");
	
	$courseNumber = $_POST['txtselectedcoursenumber'];
	$numberOfSections = $_POST['txtnumberofsections'];
	$type = $_POST['txtselectedcoursetype'];
	//$category = $_POST['txtcategory'];
	$category = $_POST['hidcategory'];
	$instructorId = $_POST['txtinstructorid'];
	$oldCourseNumber = $_POST['txtoldcoursenumber'];
	$oldType = $_POST['txtoldtype'];
	$numberOfStudentsPerSection = $_POST['txtnumberofstudentspersection'];
	$numberOfStudents = $_POST['txtnumberofstudents'];
	//print("new course number : $courseNumber<br/>");
	//print("old course number : $oldCourseNumber<br/>");
	//print("new type : $type");
	//print("old type : $oldType");
	
	InstructorLoad::updateInstructorLoad($instructorId,$courseNumber,$numberOfSections,$numberOfStudentsPerSection,$numberOfStudents,$type,$category,$oldCourseNumber,$oldType);
	Header("Location: EditLoadInfo.php");
?>