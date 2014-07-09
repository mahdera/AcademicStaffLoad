<?php
	include_once("../classes/CourseDelivery.php");
   
   //now get the passed information from the caller page
   $courseDeliveryName = trim($_POST['txtcoursedeliveryname']);
   
   $courseDeliveryObj = new CourseDelivery($courseDeliveryName);
   $courseDeliveryObj->addCourseDelivery();
   Header("Location: AddCourseDelivery.php");
?>