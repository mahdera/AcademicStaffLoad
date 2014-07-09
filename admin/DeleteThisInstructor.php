<?php
	include_once("../classes/Instructor.php");
	
	$instructorId = $_GET['id'];
	Instructor::deleteInstructor($instructorId);
	Header("Location: DeleteInstructor.php");
?>