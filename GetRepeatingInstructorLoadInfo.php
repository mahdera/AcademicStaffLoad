<?php
	include_once('classes/DBConnection.php');
	include_once('classes/CourseOffering.php');
	$instructorId = $_SESSION['rptId'];
	@session_start();
	$academicUnitId = $_SESSION['deptId'];
	//first i need to identify all the courses this instructor is teaching at this moment
	$query = "SELECT * FROM tblInstructorLoad WHERE instructor_id = '$instructorId' AND academic_unit_id = '$academicUnitId'";
	$resultInstructorLoad = DBConnection::readFromDatabase($query);
	print("<table border='0' width='100%'>");
	print("<caption style='background: lightblue'><font size='2'>Assigned Course/s</font></caption>");
	print("<tr style='background: lightblue'>");
		print("<th><font size='2'>Course Number</font></th>");
		print("<th><font size='2'>Credit Hour</font></th>");
		print("<th><font size='2'>Lecture Hour</font></th>");
		print("<th><font size='2'>Lab Hour</font></th>");
		print("<th><font size='2'>Tutorial Hour</font></th>");
		print("<th><font size='2'>Number of sections</font></th>");
		print("<th><font size='2'>Number of students</font></th>");
		print("<th><font size='2'>Category</font></th>");
		print("<th><font size='2'>Type</font></th>");
		print("<th><font size='2'>Edit</font></th>");
	print("</tr>");
	$ctr = 1;
	while($resultInstructorLoadRow = mysql_fetch_object($resultInstructorLoad))
	{
		$instId = $resultInstructorLoadRow->instructor_id;
		$courseNumber = $resultInstructorLoadRow->course_number;
		$courseDetailRow = CourseOffering::getCourseDetail($courseNumber);
		$creditHour = $courseDetailRow->credit_hour;
		$lectureHour = $courseDetailRow->lecture_hour;
		$labHour = $courseDetailRow->lab_hour;
		$tutorialHour = $courseDetailRow->tutorial_hour;
		$numberOfSections = $resultInstructorLoadRow->number_of_sections;
		$numberOfStudents = $resultInstructorLoadRow->number_of_students;
		$category = $resultInstructorLoadRow->category;
		$type = $resultInstructorLoadRow->type;
		$remark = $resultInstructorLoadRow->remark;
		
		if($ctr % 2 == 0)
		{
		  print("<tr style='background:#ded7fe'>");
		}
		else
		{
		  print("<tr style='background:#ecfdfe'>");
		}				
			
			print("<td align='center'><font size='2'>$courseNumber</font><input type='hidden' name='$instructorId' value='$instructorId'/></td>");
			print("<td align='center'><font size='2'>$creditHour</font></td>");
			print("<td align='center'><font size='2'>$lectureHour</font></td>");
			print("<td align='center'><font size='2'>$labHour</font></td>");
			print("<td align='center'><font size='2'>$tutorialHour</font></td>");
			print("<td align='center'><font size='2'>$numberOfSections</font></td>");
			print("<td align='center'><font size='2'>$numberOfStudents</font></td>");
			print("<td align='center'><font size='2'>$category</font></td>");
			print("<td align='center'><font size='2'>$type</font></td>");
			?>
				<td align='center'>
					<a href="#.php" onClick="showLoadEditionDiv('<?php echo $courseNumber;?>','<?php echo $instId;?>','<?php echo $divId;?>','<?php echo $type;?>');">
						<img src="images/update.gif" border="0" align="absmiddle"/>
					</a>
				</td>
			<?php
		print("</tr>");
		$ctr++;
	}//end while...loop
 print("</table>");
 
?>