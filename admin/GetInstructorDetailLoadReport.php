<?php
	include_once('../classes/Instructor.php');
	include_once('../classes/InstructorLoad.php');
	include_once('../classes/AcademicUnit.php');
	include_once('../classes/SemesterLoadSummeryCalculator.php');
	
	//first get the instructor id number	
	$instId = $_REQUEST['instId'];
	//print("the inst id is : $instId");
	//first get all the load info this instructor has in the full timer table
	$fullTimerResultRow = Instructor::getInstructorDetail($instId);
	if($fullTimerResultRow)
	{
		//now i need to get all instructorLoad records saved by the specific instructor id number...
		$instructorLoadResult = InstructorLoad::getAllInstructorLoadResultForInstructor($instId);
		print("<table width='100%'>");
		print("<tr style='background:lightblue'>");
			print("<th colspan='9' align='left'>Instructor Name: $fullTimerResultRow->first_name $fullTimerResultRow->last_name</th>");
		print("</tr>");
		print("<tr style='background:lightblue'>");						
			print("<th>Academic Unit</th>");
			print("<th>Course Number</th>");
			print("<th>Number of Sections</th>");
			print("<th>Type</th>");
			print("<th>Category</th>");
			print("<th>Semester</th>");
			print("<th>Academic Year</th>");
			print("<th>Total Hour</th>");
			print("<th>Remark</th>");
		print("</tr>");
		$ctr=1;
		$sumOfTotalHr = 0;
		while($instructorLoadResultRow = mysql_fetch_object($instructorLoadResult)){
			if($ctr % 2 == 0)
				   print("<tr style='background:#ded7fe'>");				
				else				
					print("<tr style='background:#ecfdfe'>");
				$academicUnit = AcademicUnit::getAcademicUnit($instructorLoadResultRow->academic_unit_id);
				print("<td>$academicUnit->academic_unit_name</td>");
				print("<td>$instructorLoadResultRow->course_number</td>");
				print("<td>$instructorLoadResultRow->number_of_sections</td>");
				print("<td>$instructorLoadResultRow->type</td>");
				print("<td>$instructorLoadResultRow->category</td>");
				print("<td>$instructorLoadResultRow->semister</td>");
				print("<td>$instructorLoadResultRow->year</td>");
				$totalHour = SemesterLoadSummeryCalculator::getTotalHourForThisCourse($instructorLoadResultRow->category,
				$instructorLoadResultRow->number_of_sections,$instructorLoadResultRow->type);
				print("<td>$totalHour</td>");
				print("<td>$instructorLoadResultRow->remark</td>");
				$sumOfTotalHr += $totalHour;
			print("</tr>");
			$ctr++;
		}//end while loop
			print("<tr style='background:lightblue'>");
				print("<td colspan='6'></td>");
				print("<td><strong>Total Hour:</strong></td>");
				print("<td colspan='2'><strong>$sumOfTotalHr</strong></td>");
			print("</tr>");
		print("</table>");
	}
?>