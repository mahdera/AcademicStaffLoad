<?php
	include_once("classes/DBConnection.php");
	$courseNumber = $_REQUEST["courseNumber"];
	//now read from the database so that i could return to the caller php file
	$query = "SELECT * FROM tblCourseOfferings WHERE course_number = '$courseNumber'";
	$result = DBConnection::readFromDatabase($query);
	$resultRow = mysql_fetch_object($result);
	print($resultRow->category); 
?>