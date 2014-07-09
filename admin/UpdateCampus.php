<?php
	include_once("../classes/Campus.php");
	//get the values...
	$campusId = $_POST['txtcampusid'];
	$campusName = $_POST['txtcampusname'];
	
	Campus::updateCampus($campusId,$campusName);
	Header("Location: EditCampus.php");
?>