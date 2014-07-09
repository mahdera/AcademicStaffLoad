<?php
	include_once("../classes/CourseDelivery.php");
	$courseDeliveryId = $_POST['txtcoursedeliveryid'];
	$courseDeliveryName = $_POST['txtcoursedeliveryname'];
	
	CourseDelivery::updateCourseDelivery($courseDeliveryId,$courseDeliveryName);
	Header("Location: EditCourseDelivery.php");
?>