<?php
	include_once("classes/DBConnection.php");
	$courseNumber = $_GET['courseNumber'];
	$query = "SELECT * FROM tblCourseOfferings WHERE course_number = '$courseNumber'";
	$result = DBConnection::readFromDatabase($query);
	$resultRow = mysql_fetch_object($result);
	print($resultRow->course_number.": ".$resultRow->course_title);
?>