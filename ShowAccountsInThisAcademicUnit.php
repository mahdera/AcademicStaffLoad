<?php
	$academicUnitId = $_REQUEST['academicUnitId'];
	include_once('../classes/AcademicUnit.php');
	include_once('../classes/User.php');
	$academicUnitObj = AcademicUnit::getAcademicUnit($academicUnitId);
	//now get all users registered in this AcademicUnit
	$userResult = User::getAllUsersInThisAcademicUnit($academicUnitId);
	print("<table border='1' width='80%'>");
		print("<tr style='background:lightblue'>");
			print("<th>Instructor Id</th>");
			print("<th>First Name</th>");
			print("<th>Last Name</th>");
			print("<th>Email</th>");
			print("<th>Mobile Phone</th>");	
			print("<th>Username</th>");					
		print("</tr>");
	print("</table>");
?>