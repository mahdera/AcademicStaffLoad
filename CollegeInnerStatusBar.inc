<?php
	include_once("classes/DBConnection.php");
	include_once("classes/AdminPosition.php");
	
	$emailAddress = $_SESSION['email_address'];
	$query = "SELECT * FROM tblCollegeUser WHERE email = '$emailAddress'";
	$result = DBConnection::readFromDatabase($query);
	$resultRow = mysql_fetch_object($result);
	$facultyId = $resultRow->faculty_id;
	//here I need to get the position name for the logged in user	 
	$adminPosition = $resultRow->administrative_position;
	$positionName =AdminPosition::getPositionNameFor($adminPosition);
	$_SESSION['facultyId'] = $facultyId;
	//now get the name of the department using the academicUnitId you got from the database
	$query = "SELECT * FROM tblFaculty WHERE id = '$facultyId'";
	$resultFaculty = DBConnection::readFromDatabase($query);
	$resultFacultyRow = mysql_fetch_object($resultFaculty);
	$facultyName = $resultFacultyRow->faculty_name;
?>
<div align="right" style="background:#CCCCCC">	
  		<?php print("<strong><font color='blue' size='2'>".$sessName.",</font>");?> <?php print("<font size='2'>".$positionName." of ".$facultyName." logged in</font></strong>");?>  	   
</div>