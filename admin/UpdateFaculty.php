<?php
	include_once("../classes/Faculty.php");
	//get the values...
	$facultyId = $_POST['txtfacultyid'];
	$facultyName = $_POST['txtfacultyname'];
	$campusId = $_POST['slctcampus'];
	
	Faculty::updateFaculty($facultyId,$campusId,$facultyName);
	Header("Location: EditFaculty.php");
?>