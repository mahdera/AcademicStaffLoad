<?php
	$academicUnitId = $_REQUEST['academicUnitId'];
	$academicYear = $_REQUEST['academicYear'];
	$semester = $_REQUEST['semester'];
	//now save this information in tblCompletedLoadInformation
	include_once('classes/CompletedLoadInformation.php');
	$completedObj = new CompletedLoadInformation($academicUnitId,$academicYear,$semester);
	$completedObj->addCompletedLoadInformation();
	print("<strong><font color='green' size='+1'>You have successfully submitted your academic unit's load information!</font></strong>");
?>