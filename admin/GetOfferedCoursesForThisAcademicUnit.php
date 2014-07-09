<?php
	/*This file is used to display a list of all courses offered in each academic unit*/
	include_once('../classes/DBConnection.php');
	include_once('../classes/CourseOffering.php');
	
	//$query = "SELECT * FROM tblAcademicUnit ORDER BY academic_unit_name ASC";	
	//$result = DBConnection::readFromDatabase($query);
	$academicUnitIdPara = $_REQUEST['academicUnitId'];
	print("<form name='frmcourseselection' method='post' action='RemoveCourseOfferings.php'>");
   print("<table border='0' width='80%' align='right'>");
   print("<caption style='background:lightblue'>List of Offered Courses</caption>");
   $courseCtr = 1;	
	//while($resultRow = mysql_fetch_object($result))
	//{		
		print("<tr style='background: #CCCCCC'>");
			print("<td colspan='5' align='center'>");
				print("$resultRow->academic_unit_name");				
			print("</td>");
		print("</tr>");
		//now i need to get all the courses in this department
		$allCoursesResult = CourseOffering::getAllOfferedCoursesInThisAcademicUnit($academicUnitIdPara);
			$ctr = 1;
			while($allCoursesResultRow = mysql_fetch_object($allCoursesResult))
			{	
				print("<input type='hidden' value='$courseCtr' name='txthowmanycourse'");			
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
						$name = "chkrem".$courseCtr;
						$txtname = "txt".$courseCtr;
						$courseNumber = $allCoursesResultRow->course_number;
						//print("<input type='text' name='$txtname' value='$courseNumber'/>");
						$courseNumber = trim($courseNumber);
						?>						
							<input type="checkbox" name="<?php print($name);?>" id="<?php print($name);?>" value="<?php print($courseNumber);?>"/>							
						<?php				
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
			$exactNumberOfCourses = --$courseCtr;									
	print("<tr>");			
				print("<td colspan='2' align='center'>");
				print("<hr/>");
					?>					
						<input type="checkbox" name="<?php print($exactNumberOfCourses);?>" id="chkcheckall" onclick="checkAllCheckBoxesForRemove(this.name);"/>
						Check All
					<?php
				print("</td>");				
				print("<td></td>");
				print("<td></td>");
				print("<td></td>");
			print("</tr>");	
	print("<tr>");
		print("<td colspan='5' align='center'>");
			print("<input type='submit' class='button' value='Remove Selected Couses from Course Offerings'/>");
		print("</td>");
	print("</tr>");	
	
	print("</table>");
	print("</form>");
	
	//the table below lists all the course to be offered in this or the current semester and academic year
	
?>