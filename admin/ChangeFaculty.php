<?php
	$facultyId = $_REQUEST['facultyId'];
	include_once('../classes/Faculty.php');
	$facultyName = Faculty::getFacultyNameWithFacultyId($facultyId);
	print($facultyName);
?>