<!--now i need to read all the campus saved in the database-->
					<?php
						include_once("classes/DBConnection.php");
						include_once("classes/AdminPosition.php");						
						
						$academicUnitId = $_SESSION['deptId'];
						$query = "SELECT * FROM tblInstructor WHERE academic_unit_id = $academicUnitId ORDER BY first_name, last_name ASC";
						$result = DBConnection::readFromDatabase($query);
						$ctr = 1;						
									
						//print("<div style='height:500px; overflow:scroll'>");						
						print("<table width='100%' align='center'>");
						print("<caption>Delete Instructor</caption>");
							print("<tr style='background:lightblue'>");
							print("<th><font size='2'>Inst Id</font></th>");
							print("<th><font size='2'>First Name</font></th>");
							print("<th><font size='2'>Last Name</font></th>");
							print("<th><font size='2'>Email</font></th>");
							print("<th><font size='2'>Mobile Phone</font></th>");
							print("<th><font size='2'>Academic Rank</font></th>");
							print("<th><font size='2'>Service Year</font></th>");
							print("<th><font size='2'>Specialization</font></th>");
							print("<th><font size='2'>Other Respo.</font></th>");
							print("<th><font size='2'>D</font></th>");
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
									print("<font size='2'>$resultRow->instructor_id</font>");
								print("</td>");
																
								print("<td align='center'>");
									print("<font size='2'>$resultRow->first_name</font>");
								print("</td>");
																
								print("<td align='center'>");
									print("<font size='2'>$resultRow->last_name</font>");
								print("</td>");
								
								print("<td align='center'>");
									print("<font size='2'>$resultRow->email</font>");
								print("</td>");
								
								print("<td align='center'>");
									print("<font size='2'>$resultRow->mobile_phone</font>");
								print("</td>");
								
								print("<td align='center'>");
									print("<font size='2'>$resultRow->instructor_level</font>");
								print("</td>");
								
								print("<td align='center'>");
									print("<font size='2'>$resultRow->service_year</font>");
								print("</td>");
								
								print("<td align='center'>");
									print("<font size='2'>$resultRow->specialization</font>");
								print("</td>");
								
								print("<td align='center'>");
									//dont just display the responsibility FK...rather translate it to its content
									$adminPositionResult = AdminPosition::getPositionName($resultRow->other_responsibilities);
									$adminPositionResultRow = mysql_fetch_object($adminPositionResult);
									$adminPositionName = $adminPositionResultRow->admin_position_name;
									print("<font size='2'>$adminPositionName</font>");
								print("</td>");	
								
								print("<td align='center'>");
									print("<a id='$resultRow->instructor_id' href='DeleteThisInstructor.php?id=$resultRow->instructor_id' onclick='return confirmInstructorDeletion(this.id);'><img src='images/ImgDelete.gif' align='absmiddle' border='0'/></a>");
								print("</td>");
							print("</tr>");
							$ctr++;
						}//end while loop
						
						print("<tr style='background:lightblue'><th colspan='10'>Parttimers</th></tr>");
						
						//when done with the instructors...continue with the parttimer instructors
						$query = "SELECT * FROM tblParttimer WHERE academic_unit_id = $academicUnitId ORDER BY first_name, last_name ASC";
						$result = DBConnection::readFromDatabase($query);
						$ctr = 1;
						
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
									print("<font size='2'>$resultRow->parttimer_id</font>");
								print("</td>");
																
								print("<td align='center'>");
									print("<font size='2'>$resultRow->first_name</font>");
								print("</td>");
																
								print("<td align='center'>");
									print("<font size='2'>$resultRow->last_name</font>");
								print("</td>");
								
								print("<td align='center'>");
									print("<font size='2'>$resultRow->email</font>");
								print("</td>");
								
								print("<td align='center'>");
									print("<font size='2'>$resultRow->mobile_phone</font>");
								print("</td>");
								
								print("<td align='center'>");
									print("<font size='2'>$resultRow->instructor_level</font>");
								print("</td>");
								
								print("<td align='center'>");
									print("<font size='2'>$resultRow->service_year</font>");
								print("</td>");
								
								print("<td align='center'>");
									print("<font size='2'>$resultRow->specialization</font>");
								print("</td>");
								
								print("<td align='center'>");
									print("<font size='2'>$resultRow->other_responsibilities</font>");
								print("</td>");	
								
								print("<td align='center'>");
									print("<a href='DeleteThisParttimerInstructor.php?id=$resultRow->parttimer_id'><img src='images/ImgDelete.gif' align='absmiddle' border='0'/></a>");
								print("</td>");
							print("</tr>");
							$ctr++;
						}//end while loop
						print("</table>");
						//print("</div>");
					?>