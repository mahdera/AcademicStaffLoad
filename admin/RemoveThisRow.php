<?php
	include_once('../classes/CourseOffering.php');
	include_once('../classes/DBConnection.php');
	$courseNumber = $_GET['id'];
	$academicUnitId = $_REQUEST['academicUnitId'];
	CourseOffering::deleteCourseOffering($courseNumber);
	Header("Location: ChooseCoursesToBeOffered.php");
?>