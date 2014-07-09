<?php
	include_once("../classes/AcademicUnit.php");
	
	$academicUnitId = $_GET['id'];
	AcademicUnit::deleteAcademicUnit($academicUnitId);
	Header("Location: DeleteAcademicUnit.php");
?>