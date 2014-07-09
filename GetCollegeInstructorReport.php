<div>
<?php
			//include('InnerStatusBar.inc');
			include_once('classes/DBConnection.php');
			//get the passed parameter and then look for that dept's instructors
			$academicUnitId = $_REQUEST['id'];
			$query = "SELECT * FROM tblInstructor WHERE academic_unit_id = '$academicUnitId' ORDER BY first_name ASC";
			//print($query."<br/>");
			$resultInstructors = DBConnection::readFromDatabase($query);
			
			print("<table width='80%' border='0'>");
			print("<caption>Full Timer Instructors</caption>");
				print("<tr style='background:lightblue'>");
					print("<th><font size='2'>Instructor Id</font></th>");
					print("<th><font size='2'>Full Name</font></th>");
					print("<th><font size='2'>Email</font></th>");
					print("<th><font size='2'>Mobile Phone</font></th>");
					print("<th><font size='2'>Instructor Level</font></th>");
					print("<th><font size='2'>Service Year</font></th>");
					print("<th><font size='2'>Specialization</font></th>");
					print("<th><font size='2'>Other Responsibilities</font></th>");
				print("</tr>");
				$ctr = 1;
				while($resultInstructorsRow = mysql_fetch_object($resultInstructors))
				{
					if($ctr % 2 == 0)
				   {
					  print("<tr style='background:#ded7fe'>");
					}
					else
					{
					  print("<tr style='background:#ecfdfe'>");
					}	
						print("<td><font size='2'>$resultInstructorsRow->instructor_id</font></td>");
						print("<td><font size='2'>$resultInstructorsRow->first_name $resultInstructorsRow->last_name</font></td>");
						print("<td><font size='2'>$resultInstructorsRow->email</font></td>");
						print("<td><font size='2'>$resultInstructorsRow->mobile_phone</font></td>");
						print("<td><font size='2'>$resultInstructorsRow->instructor_level</font></td>");
						print("<td align='center'><font size='2'>$resultInstructorsRow->service_year</font></td>");
						print("<td><font size='2'>$resultInstructorsRow->specialization</font></td>");
						print("<td align='center'><font size='2'>$resultInstructorsRow->other_responsibilities</font></td>");
					print("</tr>");
					$ctr++;
				}//end while loop
				//print("</table>");
				print("<tr>");
					print("<td colspan='8' align='center'><strong>Parttimer Instructors</strong></td>");
				print("</tr>");
				$query = "SELECT * FROM tblParttimer WHERE academic_unit_id = '$academicUnitId' ORDER BY first_name ASC";
				//print($query);
				$parttimerResult = DBConnection::readFromDatabase($query);
				//print("<table width='80%' border='1'>");
				print("<tr style='background:lightblue'>");
					print("<th><font size='2'>Instructor Id</font></th>");
					print("<th><font size='2'>Full Name</font></th>");
					print("<th><font size='2'>Email</font></th>");
					print("<th><font size='2'>Mobile Phone</font></th>");
					print("<th><font size='2'>Instructor Level</font></th>");
					print("<th><font size='2'>Service Year</font></th>");
					print("<th><font size='2'>Specialization</font></th>");
					print("<th><font size='2'>Other Responsibilities</font></th>");
				print("</tr>");
				$ctr = 1;
				while($resultParttimersRow = mysql_fetch_object($parttimerResult))
				{
					if($ctr % 2 == 0)
				   {
					  print("<tr style='background:#ded7fe'>");
					}
					else
					{
					  print("<tr style='background:#ecfdfe'>");
					}	
						print("<td><font size='2'>$resultParttimersRow->parttimer_id</font></td>");
						print("<td><font size='2'>$resultParttimersRow->first_name $resultParttimersRow->last_name</font></td>");
						print("<td><font size='2'>$resultParttimersRow->email</font></td>");
						print("<td><font size='2'>$resultParttimersRow->mobile_phone</font></td>");
						print("<td><font size='2'>$resultParttimersRow->instructor_level</font></td>");
						print("<td align='center'><font size='2'>NA</font></td>");
						print("<td><font size='2'>$resultParttimersRow->specialization</font></td>");
						print("<td align='center'><font size='2'>NA</font></td>");
					print("</tr>");
					$ctr++;
				}//end while loop
				print("</table>");
				//include('CollegeReportInstructorInnerExportMenu.inc');
		?>
	</div>