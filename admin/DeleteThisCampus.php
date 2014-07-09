<?php
	include_once("../classes/Campus.php");
	
	$campusId = $_GET['id'];
	Campus::deleteCampus($campusId);
	Header("Location: DeleteCampus.php");
?>