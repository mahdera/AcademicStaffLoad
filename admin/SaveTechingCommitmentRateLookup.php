<?php
	include_once('../classes/ExpectedTeachingCommitmentRateLookup.php');   
   //now get the passed information from the caller page
   $percentage = trim($_POST['txtpercentage']);
   $expectedHour = trim($_POST['txtexpectedhour']);      
   $expectedTeachingCommitmentObj = new ExpectedTeachingCommitmentRateLookup($percentage,$expectedHour);
   $expectedTeachingCommitmentObj->addExpectedTeachingCommitmentRateLookup();   
   Header("Location: AddTeachingCommitmentRateLookup.php"); 
?>