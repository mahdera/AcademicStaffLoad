<?php
	$id = $_REQUEST['id'];
	include_once('../classes/ExpectedTeachingCommitmentRateLookup.php');
	ExpectedTeachingCommitmentRateLookup::deleteExpectedTeachingCommitmentRateLookup($id);
	header("Location: DeleteTeachingCommitmentRateLookup.php");
?>