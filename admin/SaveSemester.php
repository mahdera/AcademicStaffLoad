<?php
	include_once("../classes/Semester.php");
   
   //now get the passed information from the caller page
   $semester = trim($_POST['slctsemester']);
   $academicYear = trim($_POST['txtacademicyear']);
   
   $semesterObj = new Semester($semester,$academicYear);
   $semesterObj->addSemester();
   Header("Location: AddSemester.php");   
?>