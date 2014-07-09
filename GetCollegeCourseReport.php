<?php
						include_once('classes/DBConnection.php');
						@session_start();
						$academicUnitId = $_REQUEST['id'];
						$query = "SELECT * FROM tblCourse WHERE academic_unit_id = '$academicUnitId' ORDER BY course_number ASC";
						//print($query."<br/>");
						$resultCourses = DBConnection::readFromDatabase($query);
						
						print("<table width='80%' border='0'>");
						print("<caption>List of courses</caption>");
							print("<tr style='background:lightblue'>");
								print("<th><font size='2'>Course Number</font></th>");
								print("<th><font size='2'>Course Title</font></th>");
								print("<th><font size='2'>Credit Hour</font></th>");
								print("<th><font size='2'>Lecture Hour</font></th>");
								print("<th><font size='2'>Lab Hour</font></th>");
								print("<th><font size='2'>Tutorial Hour</font></th>");
								print("<th><font size='2'>Category</font></th>");
								print("<th><font size='2'>Number of Students</font></th>");
							print("</tr>");
							$ctr = 1;
							while($resultCoursesRow = mysql_fetch_object($resultCourses))
							{
								if($ctr % 2 == 0)
							   {
								  print("<tr style='background:#ded7fe'>");
								}
								else
								{
								  print("<tr style='background:#ecfdfe'>");
								}	
									print("<td><font size='2'>$resultCoursesRow->course_number</font></td>");
									print("<td><font size='2'>$resultCoursesRow->course_title</font></td>");
									print("<td align='center'><font size='2'>$resultCoursesRow->credit_hour</font></td>");
									print("<td align='center'><font size='2'>$resultCoursesRow->lecture_hour</font></td>");
									print("<td align='center'><font size='2'>$resultCoursesRow->lab_hour</font></td>");
									print("<td align='center'><font size='2'>$resultCoursesRow->tutorial_hour</font></td>");
									print("<td align='center'><font size='2'>$resultCoursesRow->category</font></td>");
									print("<td align='center'><font size='2'>$resultCoursesRow->total_number_of_students</font></td>");
								print("</tr>");
								$ctr++;
							}//end while loop
							print("</table>");
						   //include('CollegeCourseReportInnerExportMenu.inc');
					?>