<?php
	$id = $_REQUEST['id'];
	include_once('classes/ExpectedTeachingCommitmentRateLookup.php');
	$expectedTeachingCommitmentRateLookupObj = ExpectedTeachingCommitmentRateLookup::getExpectedTeachingCommitmentRateLookup($id);
	print(trim($expectedTeachingCommitmentRateLookupObj->percentage));
?>