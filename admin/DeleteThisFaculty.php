<?php
	include_once("../classes/Faculty.php");
	
	$facultyId = $_GET['id'];
	Faculty::deleteFaculty($facultyId);
	Header("Location: DeleteFaculty.php");
?>