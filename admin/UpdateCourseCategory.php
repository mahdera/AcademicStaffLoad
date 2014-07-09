<?php
	include_once("../classes/CourseCategory.php");
	$courseCategoryId = $_POST['txtcoursecategoryid'];
	$courseCategoryName = $_POST['txtcoursecategoryname'];
	
	CourseCategory::updateCourseCategory($courseCategoryId,$courseCategoryName);
	Header("Location: EditCourseCategory.php");
?>