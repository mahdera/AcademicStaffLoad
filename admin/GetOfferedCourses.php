<?php
	/*This file is used to display a list of all courses offered in each academic unit*/
	include_once('../classes/DBConnection.php');
	include_once('../classes/CourseOffering.php');
	
	$query = "SELECT * FROM tblAcademicUnit ORDER BY academic_unit_name ASC";	
	$result = DBConnection::readFromDatabase($query);
	
	print("<form name='frmcourseselection' method='post' action='RemoveCourseOfferings.php'>");
   print("<table border='0' width='80%' align='right'>");
   print("<caption style='background:lightblue'>List of Offered Courses</caption>");
   $courseCtr = 1;	
	while($resultRow = mysql_fetch_object($result))
	{		
		print("<tr style='background: #CCCCCC'>");
			print("<td colspan='5' align='center'>");
				print("$resultRow->academic_unit_name");				
			print("</td>");
		print("</tr>");
		//now i need to get all the courses in this department
		$allCoursesResult = CourseOffering::getAllOfferedCoursesInThisAcademicUnit($resultRow->id);
			$ctr = 1;
			while($allCoursesResultRow = mysql_fetch_object($allCoursesResult))
			{				
				if($ctr % 2 == 0)
			   {
				  print("<tr style='background:#ded7fe'>");
				}
				else
				{
				  print("<tr style='background:#ecfdfe'>");
				}				
					print("<td align='center'>");
						$courseNumber = $allCoursesResultRow->course_number;
						print("<a href='RemoveThisRow.php?id=$courseNumber'><img src='images/delete.png' align='absmiddle' border='0'/></a>");				
					print("</td>");
					
					print("<td align='center'>");						
						print("<font size='2'>$courseNumber</font>");
					print("</td>");
					
					print("<td>");
						print("<font size='2'>$allCoursesResultRow->course_title</font>");
					print("</td>");
					
					print("<td align='center'>");
						print("<font size='2'>$allCoursesResultRow->credit_hour</font>");
					print("</td>");
					
					print("<td align='center'>");
						print("<font size='2'>$allCoursesResultRow->category</font>");
					print("</td>");					
				print("</tr>");
				$ctr++;
				$courseCtr++;
			}//end while...loop for each courses in the department						
	}//end while...loop for each dept in the database	
	
	print("</table>");
	print("</form>");
	
	//the table below lists all the course to be offered in this or the current semester and academic year
	
?>