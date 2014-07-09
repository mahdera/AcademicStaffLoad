<?php
	include_once("../classes/AcademicUnit.php");
   
   //now get the passed information from the caller page
   $facultyId = trim($_POST['slctfaculty']);
   $academicUnitId = trim($_POST['txtacademicunitid']);
   $academicUnitName = trim($_POST['txtacademicunitname']);
   
   $academicUnitObj = new AcademicUnit($academicUnitId,$facultyId,$academicUnitName);
   $academicUnitObj->addAcademicUnit();
   Header("Location: AddAcademicUnit.php");   
?>