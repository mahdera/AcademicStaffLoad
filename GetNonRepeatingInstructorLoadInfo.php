<?php
	include_once('classes/DBConnection.php');
	$instructorId = $_SESSION['rptId'];
	$query = "SELECT * FROM tblSemesterLoadSummery WHERE inst_id = '$instructorId'";
	$resultSemesterLoadSummery = DBConnection::readFromDatabase($query);
	$resultSemesterLoadSummeryRow = mysql_fetch_object($resultSemesterLoadSummery);
	
	$fullName = $resultSemesterLoadSummeryRow->full_name;
	$normalCourseLoad = $resultSemesterLoadSummeryRow->normal_course_load;
	$expectedSemesterLoad = $resultSemesterLoadSummeryRow->expected_semester_load;
	$postgradCourseLoad = $resultSemesterLoadSummeryRow->post_grad_course_load;
	$additionalResponsibilityWaiver = $resultSemesterLoadSummeryRow->additional_responsibility_weaver;
	$undergradCourseLoad = $resultSemesterLoadSummeryRow->undergrad_course_load;
	$postgradProjectAdvisingLoad = $resultSemesterLoadSummeryRow->post_grad_project_advising_load;
	$thesisAdvisingLoad = $resultSemesterLoadSummeryRow->thesis_advising_load;
	$totalAdvisingLoad = $resultSemesterLoadSummeryRow->total_advising_load;
	$totalSemesterLoad = $resultSemesterLoadSummeryRow->total_semester_load;
	$semesterExcessLoad = $resultSemesterLoadSummeryRow->semester_excess_load;
	//now design the table
	print("<table border='0' width='60%'>");
		print("<tr>");
			print("<td width='40%' align='center'>");
				print("<font size='2' color='blue'>Instructor Id:</font> <font color='brown'><u>$instructorId</u></font>");
				print("<div class='separater'></div>");
			print("</td>");
			
			print("<td align='left'>");
				//print("<font size='2' color='blue'>Normal Course Load:</font> <font color='brown'> <u>$normalCourseLoad</u></font>");
				print("<font size='2' color='blue'>Full Name:</font> <font color='brown'> <u>$fullName</u></font>");
				print("<div class='separater'></div>");
			print("</td>");
	print("</tr>");		
	print("</table>");
?>