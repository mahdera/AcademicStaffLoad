<?php
	include_once("../classes/Course.php");
	include_once("../classes/CourseOffering.php");
	//get the values...
	
	$courseNumber = $_POST['txtcoursenumber'];
	$courseTitle = $_POST['txtcoursetitle'];
	$creditHour = $_POST['txtcredithour'];	
	$lectureHour = $_POST['txtlecturehour'];
	$labHour = $_POST['txtlabhour'];
	$tutorialHour = $_POST['txttutorialhour'];
	$category = $_POST['slctcategory'];
	$academicUnitId = $_POST['hiddenacademicunitid'];
	$totalNumberOfStudents = $_POST['txttotalnumberofstudents'];
	
	Course::updateCourse($courseNumber,$courseTitle,$creditHour,$lectureHour,$labHour,$tutorialHour,$category,$academicUnitId,$totalNumberOfStudents);
	CourseOffering::updateCourseOffering($courseNumber,$courseTitle,$creditHour,$lectureHour,$labHour,$tutorialHour,$category,$academicUnitId,$totalNumberOfStudents);
	Header("Location: EditCourse.php");
?>