<?php
	$fieldName = $_REQUEST['fieldName'];
	if($fieldName == "Course Number"){
		include_once('AcceptCourseNumberOCourseForSearch.inc');
	}else if($fieldName == "Course Title"){
		include_once('AcceptCourseTitleOfCourseForSearch.inc');
	}	
?>