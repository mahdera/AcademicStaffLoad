<?php
	include_once("../classes/CourseCategory.php");
   
   //now get the passed information from the caller page
   $courseCategoryName = trim($_POST['txtcoursecategoryname']);
   
   $courseCategoryObj = new CourseCategory($courseCategoryName);
   $courseCategoryObj->addCourseCategory();
   Header("Location: AddCourseCategory.php");
?>