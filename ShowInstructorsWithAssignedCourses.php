<?php
	include_once("classes/DBConnection.php");
	
	$academicUnitId;// = $_GET['$deptId'];
	$query = "SELECT * FROM tblInstructor WHERE academic_unit_id = $academicUnitId ORDER BY first_name ASC";
	$result = DBConnection::readFromDatabase($query);
	//$resultRow = mysql_fetch_object($result);
	
	print("<table width='100%' border='0'>");
	print("<tr style='background:lightblue'>");					
		print("<th>Instructor</th>");									
		print("<th>Course Name</th>");
		print("<th>Num of Sec.</th>");
		print("<th>Studs per Sec.</th>");
		print("<th>Total Studs.</th>");
		print("<th>Type</th>");
		print("<th>Category</th>");					
	print("</tr>");
	
	$ctr=1;
	while($resultRow = mysql_fetch_object($result))//this outerloop is used to iterate through all instructors of the department
	{ 	//now check if this particular instructor on this iteration has got a course assigned to him/her!!!
		$query = "SELECT * FROM tblInstructorLoad WHERE instructor_id = '$resultRow->instructor_id'";		
		$loadResult = DBConnection::readFromDatabase($query);	
		
		while($loadResultRow = mysql_fetch_object($loadResult))//this loop is used to loop thru all the assigned courses for a single instructor with the give id number
		{				
							
					$query = "SELECT * FROM tblCourseOfferings WHERE course_number = '$resultLoadRow->course_number'";					
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
						print("<td>");
							print($resultRow->first_name." ".$resultRow->last_name);
						print("</td>");						
										
						print("<td>");
							print($resultLoadRow->course_number.":&nbsp;&nbsp;&nbsp;&nbsp;".$courseTitleResultRow->course_title);
						print("</td>");
						
						print("<td align='center'>");
							print($resultLoadRow->number_of_sections);
						print("</td>");
						
						print("<td align='center'>");
							print($resultLoadRow->number_of_students_per_section);
						print("</td>");
						
						print("<td align='center'>");
							print($resultLoadRow->number_of_students);
						print("</td>");
						
						print("<td align='center'>");
							print($resultLoadRow->type);
						print("</td>");
						
						print("<td align='center'>");
							print($resultLoadRow->category);
						print("</td>");
					print("</tr>");
					
		}//end inner while...loop
	}//end outer while...loop
	$ctr++;
	print("</table>");	
?>