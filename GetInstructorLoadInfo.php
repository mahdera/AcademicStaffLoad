<?php
	include_once("classes/DBConnection.php");
	$courseNumber = $_GET["courseNumber"];
	$courseTitle = $_GET["courseTitle"];
	$instructorId = $_GET["instructorId"];
	$type = $_GET["type"];
	
	//print($courseNumber.":".$instructorId.":".$type);
	//very fine upto here...now i need to create a table to show the result back to the user
	$query = "SELECT * FROM tblCourseOfferings ORDER BY academic_unit_id ASC";
	$result = DBConnection::readFromDatabase($query);
	
	print("<form name='frmeditinstructorload' method='post' action='UpdateInstructorLoad.php'>");
	
	print("<table width='100%' border='0'>");	
	print("<caption>Edit Instructor Load Information</caption>");
		print("<tr style='background:#D8DFEA'>");
			print("<td align='right'>");
				print("Select New Course");
			print("</td>");
			print("<td align='center'>");	
				print("<input type='hidden' id='txtselectedcoursenumber' name='txtselectedcoursenumber' value='$courseNumber'>");			
				print("<select name='slctcoursenumber' id='slctcoursenumber' onchange='getCourseTitle(this.value),assignCourseNumberToHiddenValue(this.value);'");
							print("<option value='' selected='selected'>--Select Course--</option>");												
							while($resultRow = mysql_fetch_object($result))
							{						
							 print("<option value='$resultRow->course_number'>");
								print("$resultRow->course_number: $resultRow->course_title");
							 print("</option>");							
							}							
			   print("</select>");		
			print("</td>");
		print("</tr>");
			
			$query = "SELECT * FROM tblInstructorLoad WHERE course_number='$courseNumber' AND instructor_id='$instructorId' AND type='$type'";			
			$resultLoad = DBConnection::readFromDatabase($query);
			$resultLoadRow = mysql_fetch_object($resultLoad);
		print("<tr style='background:#D8DFEA'>");
			print("<td align='right'>");
				print("Current Course");
			print("</td>");
			print("<td align='center'>");
				print("<div id='courseTitleDiv'>$courseNumber: $courseTitle</div>");
			print("</td>");
		print("</tr>");
		
		print("<tr style='background:#D8DFEA'>");	
			print("<td align='right'>");
				print("Number of Sections");
			print("</td>");
			print("<td align='center'>");				
				print("<input type='text' name='txtnumberofsections' value='$resultLoadRow->number_of_sections' size='3'/>");
			print("</td>");
		print("</tr>");
		
		print("<tr style='background:#D8DFEA'>");	
			print("<td align='right'>");
				print("Number of Students per Sections");
			print("</td>");
			print("<td align='center'>");	 			
				print("<input type='text' name='txtnumberofstudentspersection' value='$resultLoadRow->number_of_students_per_section' size='3'/>");
			print("</td>");
		print("</tr>");
		
		print("<tr style='background:#D8DFEA'>");	
			print("<td align='right'>");
				print("Total Number of Students");
			print("</td>");
			print("<td align='center'>");				
				print("<input type='text' name='txtnumberofstudents' value='$resultLoadRow->number_of_students' size='3'/>");
			print("</td>");
		print("</tr>");		
		
		print("<tr style='background:#D8DFEA'>");
			print("<td align='right'>");
				print("Current Course Type");
			print("</td>");
			print("<td align='center'>");
				print("<div id='currentCourseTypeDiv'>$resultLoadRow->type</div>");
			print("</td>");
		print("</tr>");
		print("<tr style='background:#D8DFEA'>");
			print("<td align='right'>");
				print("Select Course Type");
			print("</td>");			
			print("<td align='center' ");	
				print("<input type='hidden' id='txtselectedcoursetype' name='txtselectedcoursetype' vlaue='$resultLoadRow->type'/>");			
				print("<select name='slcttype' onChange='changeCourseTypeToSelected(this.value);'>");
					print("<option value='' selected='selected'>--Select--</option>");
					print("<optoin value='Advising'>Advising</option>");
					print("<option value='Lab'>Lab</option>");
					print("<option value='Lecture'>Lecture</option>");					
				print("</select>");
			print("</td>");
		print("</tr>");
		print("<tr style='background:#D8DFEA'>");	
			print("<td align='right'>");
				print("Category");
			print("</td>");
			print("<td align='center'>");
				print("<input type='hidden' name='hidcategory' value='$resultLoadRow->category'/>");
				print("$resultLoadRow->category");
			print("</td>");
		print("</tr>");
		print("<tr style='background:#D8DFEA'>");
			print("<td></td>");
			print("<td>");
				print("<input type='submit' value='Update' class='button'/>");
			print("</td>");
		print("</tr>");
		print("<input type='hidden' name='txtoldcoursenumber' value='$courseNumber'/>");
		print("<input type='hidden' name='txtoldtype' value='$type'/>");
		print("<input type='hidden' name='txtinstructorid' value='$instructorId'/>");
		
	print("</table>");		
	print("</form>");
?>