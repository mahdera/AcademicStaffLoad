<?php
	include_once("../classes/Campus.php");
   
   //now get the passed information from the caller page
   $campusId = trim($_POST['txtcampusid']);
   $campusName = trim($_POST['txtcampusname']);
   
   $campusObj = new Campus($campusId,$campusName);
   $campusObj->addCampus();
   Header("Location: AddCampus.php");
?>