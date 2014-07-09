<?php
	include_once("../classes/Faculty.php");
   
   //now get the passed information from the caller page
   $campusId = trim($_POST['slctcampus']);
   $facultyId = trim($_POST['txtfacultyid']);
   $facultyName = trim($_POST['txtfacultyname']);
   
   $facultyObj = new Faculty($campusId,$facultyId,$facultyName);
   $facultyObj->addFaculty();
   Header("Location: AddFaculty.php");
?>