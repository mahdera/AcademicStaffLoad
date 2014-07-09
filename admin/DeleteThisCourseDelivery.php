<?php
	include_once("../classes/CourseDelivery.php");
	
	$courseDeliveryId = $_GET['id'];
	CourseDelivery::deleteCourseDelivery($courseDeliveryId);
	Header("Location: DeleteCourseDelivery.php");
?>