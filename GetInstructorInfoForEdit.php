<?php
	//get the passed id
	include_once("classes/DBConnection.php");
	$id = $_GET['q'];
	//first check if the instructor is a full timer or a parttimer
	$queryCount = "SELECT COUNT(*) AS instHere FROM tblInstructor WHERE instructor_id = '$id'";
	$resultCount = DBConnection::readFromDatabase($queryCount);
	$resultCountRow = mysql_fetch_object($resultCount);
	$countValue = $resultCountRow->instHere;	
	
	if($countValue != 0)
	{
		$query = "SELECT * FROM tblInstructor WHERE instructor_id = '$id'";
		//print($query);
		$result = DBConnection::readFromDatabase($query);
		$resultRow = mysql_fetch_object($result);
		//now show the result using a table
		print("<table border='1' width='100%'>");
			print("<tr>");
				print("<td align='center'>");
					print("<font size='2' color='blue'>Full Name</font>");
					print("<div class='separater'></div>");			
				print("</td>");
				
				print("<td align='center'>");
					print("<font size='2' color='brown'>".$resultRow->first_name." ".$resultRow->last_name."</font>");
					print("<div class='separater'></div>");
				print("</td>");
				
				print("<td align='center'>");
					print("<font size='2' color='blue'>Mobile Phone</font>");
					print("<div class='separater'></div>");
				print("</td>");
				
				print("<td align='center'>");
					print("<font size='2' color='brown'>".$resultRow->mobile_phone."</font>");
					print("<div class='separater'></div>");
				print("</td>");	
				
				print("<td align='center'>");
					print("<font size='2' color='blue'>Instructor Level</font>");
					print("<div class='separater'></div>");
				print("</td>");
				
				print("<td align='center'>");
					print("<font size='2' color='brown'>".$resultRow->instructor_level."</font>");
					print("<div class='separater'></div>");
				print("</td>");						
			print("</tr>");
				
			print("<tr>");		
				print("<td align='center'>");
					print("<font size='2' color='blue'>Email</font>");
					print("<div class='separater'></div>");
				print("</td>");
				
				print("<td align='center'>");
					print("<font size='2' color='brown'>".$resultRow->email."</font>");
					print("<div class='separater'></div>");
				print("</td>");					
			
				print("<td align='center'>");
					print("<font size='2' color='blue'>Administrative Position</font>");
					print("<div class='separater'></div>");
				print("</td>");
				
				print("<td align='center'>");
						if($resultRow->other_responsibilities=="")
							$adminPos = "--None--";
						else
							$adminPos = $resultRow->other_responsibilities;
						print("<font size='2' color='brown'>".$adminPos."</font>");
						print("<div class='separater'></div>");
					print("</td>");			
			print("</tr>");			
		print("</table>");
		
		$query = "SELECT COUNT(*) AS numberOfCoursesAssigned FROM tblInstructorLoad WHERE instructor_id = '$id'";
		//print($query);
		$loadResult = DBConnection::readFromDatabase($query);	
		$loadResultRow = mysql_fetch_object($loadResult);
		$numberOfCoursesAssigned = $loadResultRow->numberOfCoursesAssigned;
		
		if($numberOfCoursesAssigned != 0)
			print("<font size='2' color='black'><b>$resultRow->first_name $resultRow->last_name is currently assigned the following course/s</b></font>");
		else
			print("<font size='2' color='black'><b>$resultRow->first_name $resultRow->last_name is assigned no course/s</b></font>");
				
		
		print("<table width='100%' border='0'>");
			print("<tr style='background:lightblue'>");
				if($loadResultRow)
				{					
					print("<th><font size='2'>Course</font></th>");
					print("<th><font size='2'>Num of Sec.</font></th>");
					print("<th><font size='2'>Num of Stud per sec.</font></th>");
					print("<th><font size='2'>Total Num of Stud.</font></th>");
					print("<th><font size='2'>Type</font></th>");
					print("<th><font size='2'>Category</font></th>");
					print("<th><font size='2'>Edit</font></th>");			
				}					
			print("</tr>");
			
			$query = "SELECT * FROM tblInstructorLoad WHERE instructor_id = '$id'";
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
					print("<td>");
						print("<font size='2'>".$resultLoadRow->course_number.":&nbsp;&nbsp;&nbsp;&nbsp;".$courseTitleResultRow->course_title."</font>");
					print("</td>");
					
					print("<td align='center'>");
						print($resultLoadRow->number_of_sections."</font>");
					print("</td>");
					
					print("<td align='center'>");
						print("<font size='2'>".$resultLoadRow->number_of_students_per_section."</font>");
					print("</td>");
					
					print("<td align='center'>");
						print("<font size='2'>".$resultLoadRow->number_of_students."</font>");
					print("</td>");
					
					print("<td align='center'>");
						print("<font size='2'>".$resultLoadRow->type."</font>");
					print("</td>");
					
					print("<td align='center'>");
						print("<font size='2'>".$resultLoadRow->category."</font>");
					print("</td>");
					
					print("<td align='center'>");
						$courseNumber = $resultLoadRow->course_number;
						$courseTitle = $courseTitleResultRow->course_title; 
						$instructorId = $id;
						$type = $resultLoadRow->type;
						$numberOfSections = $resultLoadRow->number_of_sections;
						$numberOfStudentsPerSection = $resultLoadRow->number_of_students_per_section;
						$numberOfStudents = $resultLoadRow->number_of_students;
						//now create the dynamic id for the hidden items
						$courseNumberControlName = "hidcoursenumber".$ctr;
						$instructorIdControlName = "hidinstructorid".$ctr;
						$typeControlName = "hidtype".$ctr;
						$courseTitleControlName = "hidcoursetitle".$ctr;
						
						print("<input type='hidden' id='$courseNumberControlName' value='$courseNumber'/>");
						print("<input type='hidden' id='$instructorIdControlName' value='$instructorId'/>");
						print("<input type='hidden' id='$typeControlName' value='$type'/>");
						print("<input type='hidden' id='$courseTitleControlName' value='$courseTitle'/>");
						//print("<input type='hidden' id);
						print("<img src='images/update.gif' border='0' align='absmiddle' name='$ctr' onclick='showEditSection(this.name);'/>");
						//print("mahder!");
					print("</td>");
				print("</tr>");
				$ctr++;
			}
		print("</table>");	
	}
	else //i am dead sure that this is located in the parttimer table
	{
		$query = "SELECT * FROM tblParttimer WHERE parttimer_id = '$id'";
		//print($query);
		$result = DBConnection::readFromDatabase($query);
		$resultRow = mysql_fetch_object($result);
		//now show the result using a table
		print("<table border='0' width='100%' rules='cols,rows'>");
			print("<tr>");
				print("<td align='center'>");
					print("<font size='2' color='blue'>Full Name</font>");
					print("<div class='separater'></div>");			
				print("</td>");
				
				print("<td align='center'>");
					print("<font size='2' color='brown'>".$resultRow->first_name." ".$resultRow->last_name."</font>");
					print("<div class='separater'></div>");
				print("</td>");
				
				print("<td align='center'>");
					print("<font size='2' color='blue'>Mobile Phone</font>");
					print("<div class='separater'></div>");
				print("</td>");
				
				print("<td align='center'>");
					print("<font size='2' color='brown'>".$resultRow->mobile_phone."</font>");
					print("<div class='separater'></div>");
				print("</td>");	
				
				print("<td align='center'>");
					print("<font size='2' color='blue'>Instructor Level</font>");
					print("<div class='separater'></div>");
				print("</td>");
				
				print("<td align='center'>");
					print("<font size='2' color='brown'>".$resultRow->instructor_level."</font>");
					print("<div class='separater'></div>");
				print("</td>");						
			print("</tr>");
				
			print("<tr>");		
				print("<td align='center'>");
					print("<font size='2' color='blue'>Email</font>");
					print("<div class='separater'></div>");
				print("</td>");
				
				print("<td align='center'>");
					print("<font size='2' color='brown'>".$resultRow->email."</font>");
					print("<div class='separater'></div>");
				print("</td>");					
			
				print("<td align='center'>");
					print("<font size='2' color='blue'>Administrative Position</font>");
					print("<div class='separater'></div>");
				print("</td>");
				
				print("<td align='center'>");
						if($resultRow->other_responsibilities=="")
							$adminPos = "--None--";
						else
							$adminPos = $resultRow->other_responsibilities;
						print("<font size='2' color='brown'>".$adminPos."</font>");
						print("<div class='separater'></div>");
					print("</td>");			
			print("</tr>");			
		print("</table>");
		
		$query = "SELECT COUNT(*) AS numberOfCoursesAssigned FROM tblInstructorLoad WHERE instructor_id = '$id'";
		//print($query);
		$loadResult = DBConnection::readFromDatabase($query);	
		$loadResultRow = mysql_fetch_object($loadResult);
		$numberOfCoursesAssigned = $loadResultRow->numberOfCoursesAssigned;
		
		if($numberOfCoursesAssigned != 0)
			print("<font size='2' color='black'><b>$resultRow->first_name $resultRow->last_name is currently assigned the following course/s</b></font>");
		else
			print("<font size='2' color='black'><b>$resultRow->first_name $resultRow->last_name is assigned no course/s</b></font>");
				
		
		print("<table width='100%' border='0'>");
			print("<tr style='background:lightblue'>");
				if($loadResultRow)
				{					
					print("<th><font size='2'>Course</font></th>");
					print("<th><font size='2'>Num of Sec.</font></th>");
					print("<th><font size='2'>Number of Stud / sec</font></th>");
					print("<th><font size='2'>Total Num of Stud.</font></th>");
					print("<th><font size='2'>Type</font></th>");
					print("<th><font size='2'>Category</font></th>");
					print("<th><font size='2'>Edit</font></th>");			
				}		
					
			print("</tr>");
			
			$query = "SELECT * FROM tblInstructorLoad WHERE instructor_id = '$id'";
			$resultLoad = DBConnection::readFromDatabase($query);
			
			$ctr=1;
			while($resultLoadRow = mysql_fetch_object($resultLoad))
			{
				$query = "SELECT * FROM tblCourse WHERE course_number = '$resultLoadRow->course_number'";
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
					print("<td>");
						print("<font size='2'>".$resultLoadRow->course_number.":&nbsp;&nbsp;&nbsp;&nbsp;".$courseTitleResultRow->course_title."</font>");
					print("</td>");
					
					print("<td align='center'>");
						print("<font size='2'>".$resultLoadRow->number_of_sections."</font>");
					print("</td>");
					
					print("<td align='center'>");
						print("<font size='2'>".$resultLoadRow->number_of_students_per_section."</font>");
					print("</td>");
					
					print("<td align='center'>");
						print("<font size='2'>".$resultLoadRow->number_of_students."</font>");
					print("</td>");
					
					print("<td align='center'>");
						print("<font size='2'>".$resultLoadRow->type."</font>");
					print("</td>");
					
					print("<td align='center'>");
						print("<font size='2'>".$resultLoadRow->category."</font>");
					print("</td>");
					
					print("<td align='center'>");
						$courseNumber = $resultLoadRow->course_number;
						$courseTitle = $courseTitleResultRow->course_title; 
						$instructorId = $id;
						$type = $resultLoadRow->type;
						$numberOfSections = $resultLoadRow->number_of_sections;
						$numberOfStudentsPerSection = $resultLoadRow->number_of_students_per_section;
						$numberOfStudents = $resultLoadRow->number_of_students;
						//now create the dynamic id for the hidden items
						$courseNumberControlName = "hidcoursenumber".$ctr;
						$instructorIdControlName = "hidinstructorid".$ctr;
						$typeControlName = "hidtype".$ctr;
						$courseTitleControlName = "hidcoursetitle".$ctr;
						
						print("<input type='hidden' id='$courseNumberControlName' value='$courseNumber'/>");
						print("<input type='hidden' id='$instructorIdControlName' value='$instructorId'/>");
						print("<input type='hidden' id='$typeControlName' value='$type'/>");
						print("<input type='hidden' id='$courseTitleControlName' value='$courseTitle'/>");
						//print("<input type='hidden' id);
						print("<img src='images/update.gif' border='0' align='absmiddle' name='$ctr'onclick='showEditSection(this.name);'/>");
					print("</td>");
				print("</tr>");
				$ctr++;
			}
		print("</table>");	
	}	
?>