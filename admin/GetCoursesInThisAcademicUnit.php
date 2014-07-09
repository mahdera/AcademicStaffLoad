<?php
						include_once("../classes/DBConnection.php");
						$academicUnitId = $_GET['q'];
						@session_start();
						$_SESSION['selectedAcademicUnitId'] = $academicUnitId;
						$query = "SELECT * FROM tblCourse WHERE academic_unit_id = $academicUnitId ORDER BY course_number ASC";
						$result = DBConnection::readFromDatabase($query);
						$ctr = 1;						
						print("<div align='center'>");						
						print("<table width='80%' align='center'>");
						print("<caption>List of Course</caption>");
						print("<tr style='background:lightblue'>");
							print("<th><font size='2'>Course Number</font></th>");
							print("<th><font size='2'>Course Title</font></th>");
							print("<th><font size='2'>Credit Hour</font></th>");
							print("<th><font size='2'>Lecture Hour</font></th>");
							print("<th><font size='2'>Lab Hour</font></th>");
							print("<th><font size='2'>Tutorial Hour</font></th>");
							print("<th><font size='2'>Category</font></th>");
							print("<th><font size='2'>Total Number of students</font></th>");
						print("</tr>");
						while($resultRow = mysql_fetch_object($result))
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
									print("<font size='2'>$resultRow->course_number</font>");
								print("</td>");								
								print("<td align='center'>");
									print("<font size='2'>$resultRow->course_title</font>");
								print("</td>");								
								print("<td align='center'>");
									print("<font size='2'>$resultRow->credit_hour</font>");
								print("</td>");	
								print("<td align='center'>");
									print("<font size='2'>$resultRow->lecture_hour</font>");
								print("</td>");
								print("<td align='center'>");
									print("<font size='2'>$resultRow->lab_hour</font>");
								print("</td>");
								print("<td align='center'>");
									print("<font size='2'>$resultRow->tutorial_hour</font>");
								print("</td>");
								print("<td align='center'>");
									print("<font size='2'>$resultRow->category</font>");
								print("</td>");	
								print("<td align='center'>");
									print("<font size='2'>$resultRow->total_number_of_students</font>");
								print("</td>");							
							print("</tr>");
							$ctr++;
						}//end while loop
						print("</table>");
						print("</div>");
					?>
					<div>
						<?php
							include_once("ExportToExcelCourseReportInnerMenu.inc");
						?>
					</div>
            </div><!----all forms in this div-->