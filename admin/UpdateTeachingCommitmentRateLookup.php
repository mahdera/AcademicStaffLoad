<?php
	$id = $_REQUEST['id'];
	$percentage = $_REQUEST['percentage'];
	$expectedHour = $_REQUEST['expectedHour'];
	include_once("../classes/ExpectedTeachingCommitmentRateLookup.php");
	ExpectedTeachingCommitmentRateLookup::updateExpectedTeachingCommitmentRateLookup($id,$percentage,$expectedHour);	
	//Header("Location: EditTeachingCommitmentRateLookup.php");
	print("<strong><font color='green'>Teaching Commitment Rate look up updated successfully!</font></strong>");
?>