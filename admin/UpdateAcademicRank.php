<?php
	include_once("../classes/AcademicRank.php");
	$rankId = $_POST['txtrankid'];
	$rankName = $_POST['txtrankname'];
	
	AcademicRank::updateAcademicRank($rankId,$rankName);	
	Header("Location: EditAcademicRank.php");
?>