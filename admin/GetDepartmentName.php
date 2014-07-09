<?php
	include_once('../classes/AcademicUnit.php');
	$id = $_GET['id'];
	$academicUnitNameResult = AcademicUnit::getAcademicUnitNameFor($id);
	$academicUnitNameResultRow = mysql_fetch_object($academicUnitNameResult);
	print($academicUnitNameResultRow->academic_unit_name);
?>