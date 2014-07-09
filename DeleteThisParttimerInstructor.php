<?php
	include_once("classes/Parttimer.php");
	
	$instructorId = $_GET['id'];
	Parttimer::deleteParttimer($instructorId);
	Header("Location: DeleteInstructor.php");
?>