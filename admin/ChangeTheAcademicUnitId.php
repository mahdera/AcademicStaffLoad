<?php
	include_once('../classes/AcademicUnit.php');
	$academicUnitId = $_REQUEST['academicUnitId'];
	$academicUnitObj = AcademicUnit::getAcademicUnit($academicUnitId);
	print($academicUnitObj->academic_unit_name);
?>