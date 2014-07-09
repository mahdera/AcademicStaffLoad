<?php
	include_once("classes/InstructorLoad.php");
	$instructorId = $_GET['instructorId'];
	$courseNumber = $_GET['courseNumber'];
	$type = $_GET['type'];
	
	InstructorLoad::deleteInstructorLoad($instructorId,$courseNumber,$type);
	Header("Location: DeleteLoadInfo.php");
?>