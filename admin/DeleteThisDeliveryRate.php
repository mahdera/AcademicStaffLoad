<?php
	include_once("../classes/RateLookUp.php");
	
	$category = $_GET['category'];
	$delivery = $_GET['type'];
	RateLookUp::deleteRateLookUp($category,$delivery);	
	Header("Location: DeleteDeliveryRate.php");
?>