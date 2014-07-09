<?php
	include_once('classes/DBConnection.php');
	//first get the course number from tblInstructor
	$query = "select * from tblInstructorLoad";
	$result = DBConnection::readFromDatabase($query);
	while($resultRow = mysql_fetch_object($result))
	{
		$courseNumber = $resultRow->course_number;
		//now get this course with the above course number
		$courseQuery = "select * from tblCourse where course_number = '$courseNumber'";
		//print($courseQuery);
		$courseResult = DBConnection::readFromDatabase($courseQuery);
		
		$courseResultRow = mysql_fetch_object($courseResult);
		$academicUnitId = $courseResultRow->academic_unit_id;
		//now update the tblInstructorLoad table via the course number obtained from the above computation
		$updateStmt = "update tblInstructorLoad set academic_unit_id = '$academicUnitId' where course_number = '$courseNumber'";
		print($updateStmt."<br/>");
		DBConnection::executeQuery($updateStmt);
	}//end while loop
	print("Finished modifying the tblInstructorLoad table!");
?>