<!--now i need to read all the campus saved in the database-->
					<?php
						include_once("../classes/DBConnection.php");
						$academicUnitId = $_GET['q'];
						$query = "SELECT * FROM tblInstructor WHERE academic_unit_id = $academicUnitId ORDER BY first_name, last_name ASC";						
						$result = DBConnection::readFromDatabase($query);
						$ctr = 1;						
						print("<div align='center'>");						
						print("<table width='80%' align='center'>");
						print("<caption>List of Instructor</caption>");
						print("<tr style='background:lightblue'>");
							print("<th><font size='2'>Inst Id</font></th>");
							print("<th><font size='2'>First Name</font></th>");
							print("<th><font size='2'>Last Name</font></th>");
							print("<th><font size='2'>Sex</font></th>");
							print("<th><font size='2'>Qualification</font></th>");
							print("<th><font size='2'>Status</font></th>");
							print("<th><font size='2'>Email</font></th>");
							print("<th><font size='2'>Mobile Phone</font></th>");
							print("<th><font size='2'>Academic Rank</font></th>");
							print("<th><font size='2'>Service Year</font></th>");
							print("<th><font size='2'>Specialization</font></th>");
							print("<th><font size='2'>Nationality</font></th>");
							print("<th><font size='2'>E</font></th>");
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
									print("<font size='2'>$resultRow->sex</font>");
								print("</td>");
								
								print("<td align='center'>");
									print("<font size='2'>$resultRow->educational_qualification</font>");
								print("</td>");
								
								print("<td align='center'>");
									print("<font size='2'>$resultRow->status</font>");
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
									print("<font size='2'>$resultRow->nationality</font>");
								print("</td>");
								
								print("<td align='center'>");
									print("<a href='EditThisInstructor.php?id=$resultRow->instructor_id'><img src='images/edit.gif' align='absmiddle' border='0'/></a>");
								print("</td>");
							print("</tr>");
							$ctr++;
						}//end while loop
						print("</table>");
						print("<table border='0' width='80%'>");
							print("<caption>List of Parttimers</caption>");
							$query = "SELECT * FROM tblParttimer WHERE academic_unit_id = $academicUnitId ORDER BY first_name, last_name ASC";						
							$result = DBConnection::readFromDatabase($query);
							print("<tr style='background:lightblue'>");
							print("<th><font size='2'>Parttimer Id</font></th>");
							print("<th><font size='2'>First Name</font></th>");
							print("<th><font size='2'>Last Name</font></th>");							
							print("<th><font size='2'>Email</font></th>");
							print("<th><font size='2'>Mobile Phone</font></th>");
							print("<th><font size='2'>Academic Rank</font></th>");							
							print("<th><font size='2'>Specialization</font></th>");
							print("<th><font size='2'>Organization</font></th>");
							print("<th><font size='2'>E</font></th>");
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
									print("<font size='2'>$resultRow->specialization</font>");
								print("</td>");
								
								print("<td align='center'>");
									print("<font size='2'>$resultRow->organization</font>");
								print("</td>");							
								
								print("<td align='center'>");
									print("<a href='EditThisParttimer.php?id=$resultRow->parttimer_id'><img src='images/edit.gif' align='absmiddle' border='0'/></a>");
								print("</td>");
							print("</tr>");
							$ctr++;
						}//end while loop
						print("</table>");
						print("</div>");
					?>