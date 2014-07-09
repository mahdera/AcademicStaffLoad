<?php
	include_once("../classes/RateLookUp.php");
   
   //now get the passed information from the caller page
   $category = trim($_POST['slctcategory']);
   $delivery = trim($_POST['slctdelivery']);
   $rate = trim($_POST['txtrate']);
   $calculatingMechanism = trim($_POST['slctcalculatingmechanism']);
   
   //now create the RateLookUp object
   
   $rateLookUpObj = new RateLookUp($category,$delivery,$rate,$calculatingMechanism);
   $rateLookUpObj->addRateLookUp();   
   Header("Location: AddDeliveryRate.php");
?>