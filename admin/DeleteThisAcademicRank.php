<?php
	include_once("../classes/AcademicRank.php");
	
	$rankId = $_REQUEST['rankId'];
	
	AcademicRank::deleteAcademicRank($rankId);	
	Header("Location: DeleteAcademicRank.php");
?>