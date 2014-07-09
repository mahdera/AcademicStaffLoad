<?php
	include_once("../classes/Course.php");
	include_once("../classes/CourseOffering.php");
	@session_start();
	$academicUnitId = $_SESSION['selectedAcademicUnitId'];
	$courseNumber = $_REQUEST['id'];
	Course::deleteCourse($courseNumber);
	CourseOffering::deleteCourseOffering($courseNumber,$academicUnitId);
	Header("Location: DeleteCourse.php");
?>