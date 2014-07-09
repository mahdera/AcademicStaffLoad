<?php
	include_once("../classes/RateLookUp.php");
	$category = $_POST['txtcategoryhidden'];
	$delivery = $_POST['txtdeliverytypehidden'];
	$rate = $_POST['txtrate'];
	$calculatingMechanism = $_POST['slctcalculatingmechanism'];
	
	RateLookUp::updateRateLookUp($category,$delivery,$rate,$calculatingMechanism);
	Header("Location: EditDeliveryRate.php");
?>