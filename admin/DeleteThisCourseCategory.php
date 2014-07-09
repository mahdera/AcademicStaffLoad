<?php
	include_once("../classes/CourseCategory.php");
	
	$courseCategoryId = $_GET['id'];
	CourseCategory::deleteCourseCategory($courseCategoryId);
	Header("Location: DeleteCourseCategory.php");
?>