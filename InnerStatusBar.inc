<?php
	include_once("classes/DBConnection.php");
	include_once("classes/AdminPosition.php");
	
	$emailAddress = $_SESSION['email_address'];
	$query = "SELECT * FROM tblUser WHERE email = '$emailAddress'";
	$result = DBConnection::readFromDatabase($query);
	$resultRow = mysql_fetch_object($result);
	$academicUnitId = $resultRow->academic_unit_id;
	//here I need to get the position name for the logged in user	 
	$adminPosition = $resultRow->administrative_position;
	$positionName =AdminPosition::getPositionNameFor($adminPosition);
	$_SESSION['deptId'] = $academicUnitId;
	//now get the name of the department using the academicUnitId you got from the database
	$query = "SELECT * FROM tblAcademicUnit WHERE id = '$academicUnitId'";
	$resultAcademicUnit = DBConnection::readFromDatabase($query);
	$resultAcademicUnitRow = mysql_fetch_object($resultAcademicUnit);
	$academicUnitName = $resultAcademicUnitRow->academic_unit_name;
?>
<div align="right" style="background:#CCCCCC">	
  		<?php print("<strong><font color='blue' size='2'>".$sessName.",</font>");?> <?php print("<font size='2'>".$positionName." of ".$academicUnitName." logged in</font></strong>");?>  	   
</div>