<?php
	include_once("../classes/Course.php");
   
   //now get the passed information from the caller page
   $academicUnitId = trim($_POST['slctacademicunit']);
   $courseNumber = trim($_POST['txtcoursenumber']);
   $courseTitle = trim($_POST['txtcoursetitle']);
   $creditHour = trim($_POST['txtcredithour']);
   $lectureHour = trim($_POST['txtlecturehour']); 
   $labHour = trim($_POST['txtlabhour']);
   $tutorialHour = trim($_POST['txttutorialhour']);
   $category = trim($_POST['slctcategory']);
   $totalNumberOfStudents = trim($_POST['txttotalnumberofstudents']);
   
   
   $courseObj = new Course($courseNumber,$courseTitle,$creditHour,$lectureHour,$labHour,$tutorialHour,$category,$academicUnitId,$totalNumberOfStudents);
   $courseObj->addCourse();  
    
   Header("Location: AddCourse.php");   
?>