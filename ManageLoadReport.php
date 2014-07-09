<?php
	include_once('classes/SemesterLoadSummeryCalculator.php');
	//get the id of the department
	@session_start();
	$academicUnitId = $_SESSION['deptId'];
	SemesterLoadSummeryCalculator::calculateSemesterLoadForFullTimerInstructor($academicUnitId);
	//print("Done");
	//now do the same for parttimer instructor
	SemesterLoadSummeryCalculator::calculateSemesterLoadForPartTimerInstructor($academicUnitId);
	//Header("Location: ShowLoadReport.php");
	//to stick with the old reporting format....you may need to get back here in case things are not working 
	//as planned	
	Header("Location: ShowLoadReportFinal.php");
?>