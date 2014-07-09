<?php
	//get the passed id
	include_once("classes/DBConnection.php");
	include_once("classes/AdminPosition.php");
	$id = $_GET['q'];
	@session_start();
	$academicUnitId = $_SESSION['deptId'];
	
	$query = "SELECT * FROM tblInstructor WHERE instructor_id = '$id'";
	$instructorType = "PT";
	$result = DBConnection::readFromDatabase($query);
	$resultRow = mysql_fetch_object($result);
	if($resultRow)
	{
		$instructorType = "AAU";
		//now show the result using a table
		print("<table border='0' width='100%' rules='cols,rows' style='background:#eee'>");
			print("<tr>");
				print("<td align='left'>");
					print("<font size='2' color='blue'>Full Name</font>");
					print("<div class='separater'></div>");			
				print("</td>");
				
				$firstName = $resultRow->first_name;
				$lastName = $resultRow->last_name;
				
				print("<td align='left'>");
					print("<font size='2' color='brown'>".$firstName." ".$lastName."</font>");
					print("<div class='separater'></div>");
				print("</td>");
				
				print("<td align='left'>");
					print("<font size='2' color='blue'>Mobile Phone</font>");
					print("<div class='separater'></div>");
				print("</td>");
				
				print("<td align='left'>");
					print("<font size='2' color='brown'>".$resultRow->mobile_phone."</font>");
					print("<div class='separater'></div>");
				print("</td>");	
				
				print("<td align='left'>");
					print("<font size='2' color='blue'>Instructor Level</font>");
					print("<div class='separater'></div>");
				print("</td>");
				
				print("<td align='left'>");
					print("<font size='2' color='brown'>".$resultRow->instructor_level."</font>");
					print("<div class='separater'></div>");
				print("</td>");						
			print("</tr>");
				
			print("<tr>");		
				print("<td align='left'>");
					print("<font size='2' color='blue'>Email</font>");
					print("<div class='separater'></div>");
				print("</td>");
				
				print("<td align='left'>");
					print("<font size='2' color='brown'>".$resultRow->email."</font>");
					print("<div class='separater'></div>");
				print("</td>");					
			
				print("<td align='left'>");
					print("<font size='2' color='blue'>Administrative Position</font>");
					print("<div class='separater'></div>");
				print("</td>");
				
				print("<td align='left'>");
					if($resultRow->other_responsibilities=="")
						$adminPosName = "--None--";
					else
					{
						$adminPos = $resultRow->other_responsibilities;
						$result = AdminPosition::getPositionName($adminPos);
						$resultRow = mysql_fetch_object($result);
						$adminPosName = $resultRow->admin_position_name;
					}	
					print("<font size='2' color='brown'>".$adminPosName."</font>");
					print("<div class='separater'></div>");
				print("</td>");			
			print("</tr>");			
		print("</table>");
	}
	else
	{
		$query = "SELECT * FROM tblParttimer WHERE parttimer_id = '$id'";			
		$resultParttimer = DBConnection::readFromDatabase($query);
		$resultParttimerRow = mysql_fetch_object($resultParttimer);
		$instructorType = "Parttimer";
		print("<table border='0' width='100%' rules='cols,rows'>");
			print("<tr>");
				print("<td align='center'>");
					print("<font size='2' color='blue'>Full Name</font>");
					print("<div class='separater'></div>");			
				print("</td>");
				
				print("<td align='center'>");
					print("<font size='2' color='brown'>".$resultParttimerRow->first_name." ".$resultParttimerRow->last_name."</font>");
					print("<div class='separater'></div>");
				print("</td>");
				
				print("<td align='center'>");
					print("<font size='2' color='blue'>Mobile Phone</font>");
					print("<div class='separater'></div>");
				print("</td>");
				
				print("<td align='center'>");
					print("<font size='2' color='brown'>".$resultParttimerRow->mobile_phone."</font>");
					print("<div class='separater'></div>");
				print("</td>");	
				
				print("<td align='center'>");
					print("<font size='2' color='blue'>Instructor Level</font>");
					print("<div class='separater'></div>");
				print("</td>");
				
				print("<td align='center'>");
					print("<font size='2' color='brown'>".$resultParttimerRow->instructor_level."</font>");
					print("<div class='separater'></div>");
				print("</td>");						
			print("</tr>");
				
			print("<tr>");		
				print("<td align='center'>");
					print("<font size='2' color='blue'>Email</font>");
					print("<div class='separater'></div>");
				print("</td>");
				
				print("<td align='center'>");
					print("<font size='2' color='brown'>".$resultParttimerRow->email."</font>");
					print("<div class='separater'></div>");
				print("</td>");			
						
			print("</tr>");			
		print("</table>");
	}
	
	$query = "SELECT COUNT(*) AS numberOfCoursesAssigned FROM tblInstructorLoad WHERE instructor_id = '$id' AND academic_unit_id = '$academicUnitId'";
	//print($query);
	$loadResult = DBConnection::readFromDatabase($query);	
	$loadResultRow = mysql_fetch_object($loadResult);
	$numberOfCoursesAssigned = $loadResultRow->numberOfCoursesAssigned;
	//print("<br/>numb cour: $numberOfCoursesAssigned");
	
	if($instructorType == "AAU")
	{	
		if($numberOfCoursesAssigned != 0)
			print("<font size='2' color='black'><b>$firstName $lastName is currently assigned the following course/s</b></font>");
		else
			print("<font size='2' color='black'><b>$firstName $lastName is assigned no course/s</b></font>");
	}
	else
	{
		if($numberOfCoursesAssigned != 0)
			print("<font size='2' color='black'><b>$resultParttimerRow->first_name $resultParttimerRow->last_name is currently assigned the following course/s</b></font>");
		else
			print("<font size='2' color='black'><b>$resultParttimerRow->first_name $resultParttimerRow->last_name is assigned no course/s</b></font>");
	}	
	
	print("<table width='100%' border='0'>");
		print("<tr style='background:lightblue'>");
			if($loadResultRow)
			{					
				print("<td align='center'><font size='2'><b>Course Name</b></font></td>");
				print("<td align='center'><font size='2'><b>Number of Sections</b></font></td>");
				print("<td align='center'><font size='2'><b>Type</b></font></td>");
				print("<td align='center'><font size='2'><b>Category</b></font></td>");			
			}						
		print("</tr>");
		
		$query = "SELECT * FROM tblInstructorLoad WHERE instructor_id = '$id' AND academic_unit_id = '$academicUnitId'";
		$resultLoad = DBConnection::readFromDatabase($query);
		
		$ctr=1;
		while($resultLoadRow = mysql_fetch_object($resultLoad))
		{
			$query = "SELECT * FROM tblCourseOfferings WHERE course_number = '$resultLoadRow->course_number'";
			//print($query);
			$courseTitleResult = DBConnection::readFromDatabase($query);
			$courseTitleResultRow = mysql_fetch_object($courseTitleResult);
			if($ctr % 2 == 0)
		   {
			  print("<tr style='background:#ded7fe'>");
			}
			else
			{
			  print("<tr style='background:#ecfdfe'>");
			}				
				print("<td align='left'>");
					print("<font size='2'>".$resultLoadRow->course_number.":&nbsp;&nbsp;&nbsp;&nbsp;".$courseTitleResultRow->course_title."</font>");
				print("</td>");
				
				print("<td align='center'>");
					print("<font size='2'>".$resultLoadRow->number_of_sections."</font>");
				print("</td>");
				
				print("<td align='center'>");
					print("<font size='2'>".$resultLoadRow->type."</font>");
				print("</td>");
				
				print("<td align='center'>");
					print("<font size='2'>".$resultLoadRow->category."</font>");
				print("</td>");
			print("</tr>");
			$ctr++;
		}
	print("</table>");	
			
?>