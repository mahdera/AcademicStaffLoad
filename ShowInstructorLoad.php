<?php
	include_once("classes/DBConnection.php");
	
	$academicUnitId = $_SESSION['deptId'];
	$query = "SELECT * FROM tblInstructor WHERE academic_unit_id = '$academicUnitId' ORDER BY first_name ASC";
	$result = DBConnection::readFromDatabase($query);
	//$resultRow = mysql_fetch_object($result);
	
	print("<table width='100%' border='0'>");
	print("<caption style='background: lightblue'>List of Course Assigned Instructors</caption>"); 
	print("<tr style='background:lightblue'>");					
		print("<th><font size='2'>Instructor</font></th>");									
		print("<th><font size='2'>Course Name</font></th>");
		print("<th><font size='2'>Num of Sec.</font></th>");
		print("<th><font size='2'>Studs/Sec.</font></th>");
		print("<th><font size='2'>Total Studs.</font></th>");
		print("<th><font size='2'>Type</font></th>");
		print("<th><font size='2'>Category</font></th>");
		print("<th><font size='2'>Sem</font></th>");
		print("<th><font size='2'>ACY</font></th>");					
	print("</tr>");
	
	$ctr=1;
	while($resultRow = mysql_fetch_object($result))//this outerloop is used to iterate through all instructors of the department
	{ 	//now check if this particular instructor on this iteration has got a course assigned to him/her!!!
		$query = "SELECT * FROM tblInstructorLoad WHERE instructor_id = '$resultRow->instructor_id'  AND academic_unit_id = $academicUnitId";
		//print($query);		
		$loadResult = DBConnection::readFromDatabase($query);	
		//$nameResultRow = mysql_fetch_object($loadResult);
		//$nameHolder = $nameResultRow->first_name." ".$nameResultRow->last_name;
		//print("b4:".$ctr."<br/>");
		$wasInsideInnerLoop = "false";
		while($loadResultRow = mysql_fetch_object($loadResult))//this loop is used to loop thru all the assigned courses for a single instructor with the give id number
		{							
					$query = "SELECT * FROM tblCourseOfferings WHERE course_number = '$loadResultRow->course_number'";
					//print($query);					
					$courseTitleResult = DBConnection::readFromDatabase($query);
					$courseTitleResultRow = mysql_fetch_object($courseTitleResult);
					//print("b:".$ctr."<br/>");
					if($ctr % 2 == 0)
				   {
					  print("<tr style='background:#ded7fe'>");
					}
					else
					{
					  print("<tr style='background:#ecfdfe'>");
					}
						print("<td>");				
								print("<font size='2'>".$resultRow->first_name." ".$resultRow->last_name."</font>");
						print("</td>");						
										
						print("<td>");
							print("<font size='2'>".$loadResultRow->course_number.":&nbsp;&nbsp;&nbsp;&nbsp;".$courseTitleResultRow->course_title."</font>");
						print("</td>");
						
						print("<td align='center'>");
							print("<font size='2'>".$loadResultRow->number_of_sections."</font>");
						print("</td>");
						
						print("<td align='center'>");
							print("<font size='2'>".$loadResultRow->number_of_students_per_section."</font>");
						print("</td>");
						
						print("<td align='center'>");
							print("<font size='2'>".$loadResultRow->number_of_students."</font>");
						print("</td>");
						
						print("<td align='center'>");
							print("<font size='2'>".$loadResultRow->type."</font>");
						print("</td>");
						
						print("<td align='center'>");
							print("<font size='2'>".$loadResultRow->category."</font>");
						print("</td>");
						
						print("<td align='center'>");
							print("<font size='2'>".$loadResultRow->semister."</font>");
						print("</td>");
						
						print("<td align='center'>");
							print("<font size='2'>".$loadResultRow->year."</font>");
						print("</td>");
					print("</tr>");					
				$wasInsideInnerLoop = "true";
		}//end inner while...loop
		if($wasInsideInnerLoop=="true")
			$ctr++;
	}//end outer while...loop	
	print("<tr style='background: lightblue'>");
		print("<td colspan='9' align='center'>Parttimer Instructors</td>");
	print("</tr>");
	$academicUnitId = $_SESSION['deptId'];
	$query = "SELECT * FROM tblParttimer WHERE academic_unit_id = '$academicUnitId' ORDER BY first_name ASC";
	$result = DBConnection::readFromDatabase($query);
	/////////////////////////now comes the display for the parttimers
	$ctr=1;
	while($resultRow = mysql_fetch_object($result))//this outerloop is used to iterate through all instructors of the department
	{ 	//now check if this particular instructor on this iteration has got a course assigned to him/her!!!
		$query = "SELECT * FROM tblInstructorLoad WHERE instructor_id = '$resultRow->parttimer_id' AND academic_unit_id = '$academicUnitId'";		
		$loadResult = DBConnection::readFromDatabase($query);	
		//$nameResultRow = mysql_fetch_object($loadResult);
		//$nameHolder = $nameResultRow->first_name." ".$nameResultRow->last_name;
		//print("b4:".$ctr."<br/>");
		$wasInsideInnerLoop = "false";
		while($loadResultRow = mysql_fetch_object($loadResult))//this loop is used to loop thru all the assigned courses for a single instructor with the give id number
		{							
					$query = "SELECT * FROM tblCourseOfferings WHERE course_number = '$loadResultRow->course_number'";
					//print($query);					
					$courseTitleResult = DBConnection::readFromDatabase($query);
					$courseTitleResultRow = mysql_fetch_object($courseTitleResult);
					//print("b:".$ctr."<br/>");
					if($ctr % 2 == 0)
				   {
					  print("<tr style='background:#ded7fe'>");
					}
					else
					{
					  print("<tr style='background:#ecfdfe'>");
					}
						print("<td>");				
								print("<font size='2'>".$resultRow->first_name." ".$resultRow->last_name."</font>");
						print("</td>");						
										
						print("<td>");
							print("<font size='2'>".$loadResultRow->course_number.":&nbsp;&nbsp;&nbsp;&nbsp;".$courseTitleResultRow->course_title."</font>");
						print("</td>");
						
						print("<td align='center'>");
							print("<font size='2'>".$loadResultRow->number_of_sections."</font>");
						print("</td>");
						
						print("<td align='center'>");
							print("<font size='2'>".$loadResultRow->number_of_students_per_section."</font>");
						print("</td>");
						
						print("<td align='center'>");
							print("<font size='2'>".$loadResultRow->number_of_students."</font>");
						print("</td>");
						
						print("<td align='center'>");
							print("<font size='2'>".$loadResultRow->type."</font>");
						print("</td>");
						
						print("<td align='center'>");
							print("<font size='2'>".$loadResultRow->category."</font>");
						print("</td>");
						
						print("<td align='center'>");
							print("<font size='2'>".$loadResultRow->semister."</font>");
						print("</td>");
						
						print("<td align='center'>");
							print("<font size='2'>".$loadResultRow->year."</font>");
						print("</td>");
					print("</tr>");					
				$wasInsideInnerLoop = "true";
		}//end inner while...loop
		if($wasInsideInnerLoop=="true")
			$ctr++;
	}//end outer while...loop	
	print("</table>");		
?>