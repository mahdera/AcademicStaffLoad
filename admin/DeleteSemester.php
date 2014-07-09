<?php
	include_once("../classes/Semester.php");
	
	$semester = $_GET['semester'];
	$academicYear = $_GET['year'];
	
	Semester::deleteSemester($semester,$academicYear);
	Header("Location: ViewSemester.php");
?>