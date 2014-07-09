<?php
	include_once("../classes/AcademicUnit.php");
	//get the values...
	$academicUnitId = $_POST['txtacademicunitid'];
	$academicUnitName = $_POST['txtacademicunitname'];
	$facultyId = $_POST['slctfaculty'];
	
	AcademicUnit::updateAcademicUnit($academicUnitId,$facultyId,$academicUnitName);
	Header("Location: EditAcademicUnit.php");
?>