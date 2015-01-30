<?php
	include_once('classes/SemesterLoadSummeryCalculator.php');
	//get the id of the department
	@session_start();
	$academicUnitId = $_REQUEST['id'];
	SemesterLoadSummeryCalculator::calculateSemesterLoadForFullTimerInstructor($academicUnitId);
	//print("Done");
	//now do the same for parttimer instructor
	SemesterLoadSummeryCalculator::calculateSemesterLoadForPartTimerInstructor($academicUnitId);
	//Header("Location: ShowLoadReport.php");
	//to stick with the old reporting format....you may need to get back here in case things are not working
	//as planned
	//Header("Location: ShowLoadReportFinal.php");

		//include('GetLoadReport.php');
		include_once('classes/DBConnection.php');
		include_once('classes/InstructorLoad.php');
		//$academicUnitId = $_SESSION['deptId'];
		$query = "SELECT * FROM tblInstructor WHERE academic_unit_id = '$academicUnitId' ORDER BY first_name ASC";
		//print($query."<br/>");
		$resultInstructors = DBConnection::readFromDatabase($query);

		include_once('classes/DBConnection.php');
	include_once('classes/InstructorLoad.php');
	include_once('classes/SemesterLoadSummery.php');
	include_once('classes/AcademicUnit.php');
	include_once('classes/CourseOffering.php');

	//first read all instructors in this specific academic unit
	session_start();
	$academicUnitId = $_REQUEST['id'];
	//print("the academic unit id is : $academicUnitId<br/>");
	$query = "SELECT * FROM tblInstructor WHERE academic_unit_id = '$academicUnitId'";
	$result = DBConnection::readFromDatabase($query);
	print("<div align='right'>");
	print("<table width='80%' border='1'>");
		print("<caption style='background:lightblue'>Academic Unit: $academicUnitName<br/>Fulltimer Instructor Load Report</caption>");
		print("<tr style='background: lightblue'>");
			print("<th><font size='1'>Id</font></th>");
			print("<th><font size='1'>Name</font></th>");
			print("<th><font size='1'>Acad Unit</font></th>");
			//print("<th><font size='1'>Norm Course Load</font></th>");
			print("<th><font size='1'>Resp Wavier</font></th>");
			print("<th><font size='1'>Ex Se Load</font></th>");
			print("<th><font size='1'>UG Co Load</font></th>");
			print("<th><font size='1'>PG Co Load</font></th>");
			print("<th><font size='1'>UG Adv Load</font></th>");
			print("<th><font size='1'>PG Prj Adv Load</font></th>");
			print("<th><font size='1'>Thesis Adv Load</font></th>");
			print("<th><font size='1'>Tot Adv Load</font></th>");
			print("<th><font size='1'>Tot Sem Load</font></th>");
			print("<th><font size='1'>Sem Exc Load</font></th>");
			print("<th><font size='1'>Co #</font></th>");
			print("<th><font size='1'>Crhr</font></th>");
			print("<th><font size='1'>LEH</font></th>");
			print("<th><font size='1'>LAH</font></th>");
			print("<th><font size='1'>Tut Hr</font></th>");
			print("<th><font size='1'># of sec</font></th>");
			print("<th><font size='1'># of studs</font></th>");
			print("<th><font size='1'>Cat</font></th>");
			print("<th><font size='1'>Type</font></th>");
			print("<th><font size='1'>Remark</font></th>");
		print("</tr>");
		$ctr = 1;
		while($resultRow = mysql_fetch_object($result))//iterate thru all the instrcutors to check that if they have a load or not!
		{
			$instructorId = $resultRow->instructor_id;
			//now check if this instructor is available in the tblInstructorLoad
			$ans = InstructorLoad::doesThisInstructorHasALoad($instructorId,$academicUnitId);
			if($ans == "Yes")
			{
				//print("$instructorId has a load<br/>");passed
				//now get the # of courses given by this particular instructor
				$howMany = InstructorLoad::howManyCoursesDoesThisInstructorTeach($instructorId,$academicUnitId);
				$howMany = $howMany + 1;
				//print("inst $instructorId is teaching : $howMany courses<br/>");
				//print("$instructorId is teaching $howMany courses<br/>");
				//then comes the need to get all the info from tblSemesterLoadSummery to get the non-repeating info

				//$resultSemesterLoadRow = SemesterLoadSummery::getAllLoadInfoForInstructor($instructorId);
				$query = "SELECT * FROM tblSemesterLoadSummery WHERE inst_id = '$instructorId' AND academic_unit_id = '$academicUnitId'";
				//print("$query<br>");
				$resultSemesterLoad = DBConnection::readFromDatabase($query);
				$resultSemesterLoadRow = mysql_fetch_object($resultSemesterLoad);

				$fullName = $resultSemesterLoadRow->full_name;
				$normalCourseLoad = $resultSemesterLoadRow->normal_course_load;
				$expectedSemesterLoad = $resultSemesterLoadRow->expected_semester_load;
				$postgradCourseLoad = $resultSemesterLoadRow->post_grad_course_load;
				$additionalResponsibilityWaiver = $resultSemesterLoadRow->additional_responsibility_weaver;
				$undergradCourseLoad = $resultSemesterLoadRow->undergrad_course_load;
				$undergradAdvisingLoad = $resultSemesterLoadRow->undergrad_advising_load;
				$postgradProjectAdvising = $resultSemesterLoadRow->post_grad_project_advising_load;
				$thesisAdvisingLoad = $resultSemesterLoadRow->thesis_advising_load;
				$totalAdvisingLoad = $resultSemesterLoadRow->total_advising_load;
				$totalSemesterLoad = $resultSemesterLoadRow->total_semester_load;
				$semesterExcessLoad = $resultSemesterLoadRow->semester_excess_load;


				//print("fn $fullName<br/>");passed

				if($ctr % 2 == 0)
			   {
				  print("<tr style='background:#ded7fe'>");
				}
				else
				{
				  print("<tr style='background:#ecfdfe'>");
				}
					print("<td rowspan='$howMany' width='1%'>");
						print("<font size='2'>$instructorId</font>");
					print("</td>");

					print("<td rowspan='$howMany' width='2%'>");
						print("<font size='2'>$fullName</font>");
					print("</td>");

					//get the academicunitname
					$academicUnitNameResult = AcademicUnit::getAcademicUnitNameFor($resultSemesterLoadRow->academic_unit_id);
					$academicUnitNameResultRow = mysql_fetch_object($academicUnitNameResult);
					$academicUnitName = $academicUnitNameResultRow->academic_unit_name;
					//print("the academic unit name is : $academicUnitName<br/>");

					print("<td rowspan='$howMany' width='2%'>");
						print("<font size='2'>$academicUnitName</font>");
					print("</td>");

					/*print("<td rowspan='$howMany' align='center'>");
						print("<font size='2'>$normalCourseLoad</font>");
					print("</td>");*/

					print("<td rowspan='$howMany' align='center'>");
						print("<font size='2'>$additionalResponsibilityWaiver</font>");
					print("</td>");

					print("<td rowspan='$howMany' align='center'>");
						print("<font size='2'>$expectedSemesterLoad</font>");
					print("</td>");
				//print("</tr>");

				//now do the logic for displaying the next segment of the non-repeating fields...but calculated.

				//print("<tr>");
					print("<td rowspan='$howMany' align='center'>");
						print("<font size='2'>$undergradCourseLoad</font>");
					print("</td>");

					print("<td rowspan='$howMany' align='center'>");
						print("<font size='2'>$postgradCourseLoad</font>");
					print("</td>");

					print("<td rowspan='$howMany' align='center'>");
						print("<font size='2'>$undergradAdvisingLoad</font>");
					print("</td>");

					print("<td rowspan='$howMany' align='center'>");
						print("<font size='2'>$postgradProjectAdvising</font>");
					print("</td>");

					print("<td rowspan='$howMany' align='center'>");
						print("<font size='2'>$thesisAdvisingLoad</font>");
					print("</td>");

					print("<td rowspan='$howMany' align='center'>");
						print("<font size='2'>$totalAdvisingLoad</font>");
					print("</td>");

					print("<td rowspan='$howMany' align='center'>");
						print("<font size='2'><b>$totalSemesterLoad</b></font>");
					print("</td>");

					print("<td rowspan='$howMany' align='center'>");
						//the code below is used to check if there are negatives...and avoid them totaly
						if($semesterExcessLoad <= 0)
						{
							$semesterExcessLoad = "---";
							print("<font size='2'>$semesterExcessLoad</font>");
						}
						else//meaning the staff has got an excess
						{
							print("<font size='2' color='green'><b>$semesterExcessLoad</b></font>");
						}
					print("</td>");
				print("</tr>");

				//now begin displaying the repeating fields here
				//here i need to get all the courses this particular instructor is teaching

				$query = "SELECT * FROM tblInstructorLoad WHERE instructor_id = '$instructorId' AND academic_unit_id = '$academicUnitId'";
				$resultLoad = DBConnection::readFromDatabase($query);

				while($resultLoadRow = mysql_fetch_object($resultLoad))
				{
					$courseNumber = $resultLoadRow->course_number;
					$courseDetailRow = CourseOffering::getCourseDetail($courseNumber);
					$creditHour = $courseDetailRow->credit_hour;
					$lectureHour = $courseDetailRow->lecture_hour;
					$labHour = $courseDetailRow->lab_hour;
					$tutorialHour = $courseDetailRow->tutorial_hour;
					$numberOfSections = $resultLoadRow->number_of_sections;
					$category = $resultLoadRow->category;
					$numberOfStudents = $resultLoadRow->number_of_students;
					$type = $resultLoadRow->type;
					$remark = $resultLoadRow->remark;

					if($ctr % 2 == 0)
				   {
					  print("<tr style='background:#ded7fe'>");
					}
					else
					{
					  print("<tr style='background:#ecfdfe'>");
					}
						print("<td align='center'><font size='2'><strong>$courseNumber</strong></font></td>");
						print("<td align='center'><font size='2'>$creditHour</font></td>");
						print("<td align='center'><font size='2'>$lectureHour</font></td>");
						print("<td align='center'><font size='2'>$labHour</font></td>");
						print("<td align='center'><font size='2'>$tutorialHour</font></td>");
						print("<td align='center'><font size='2'>$numberOfSections</font></td>");
						print("<td align='center'><font size='2'>$numberOfStudents</font></td>");
						print("<td align='center'><font size='2'>$category</font></td>");
						print("<td align='center'><font size='2'>$type</font></td>");
						print("<td align='center'><font size='2'>$remark</font></td>");
					print("</tr>");
				}//end while...loop...this will loop thru all the courses this instructor is currently teaching


			}//end if...condition
			$ctr++;
		}//end while...loop...this loop will iterate thru all instructor in the academic unit
	print("</table>");

	//do the same for parttimer instructor below////////////////////****************--------------------63545874
	$query = "SELECT * FROM tblParttimer WHERE academic_unit_id = '$academicUnitId'  ORDER BY first_name, last_name ASC";
	//print($query);
	$result = DBConnection::readFromDatabase($query);

	print("<table width='80%' border='1'>");
		print("<caption style='background:lightblue'>Parttimer Instructor's Load Report</caption>");
		print("<tr style='background: lightblue'>");
			print("<th><font size='1'>Id</font></th>");
			print("<th><font size='1'>Name</font></th>");
			print("<th><font size='1'>Acad Unit</font></th>");
			//print("<th><font size='1'>Norm Course Load</font></th>");
			print("<th><font size='1'>Resp Wavier</font></th>");
			print("<th><font size='1'>Exp Sem Load</font></th>");
			print("<th><font size='1'>UG Co Load</font></th>");
			print("<th><font size='1'>PG Co Load</font></th>");
			print("<th><font size='1'>UG Adv Load</font></th>");
			print("<th><font size='1'>PG Prj Adv Load</font></th>");
			print("<th><font size='1'>Thesis Adv Load</font></th>");
			print("<th><font size='1'>Tot Adv Load</font></th>");
			print("<th><font size='1'>Tot Sem Load</font></th>");
			print("<th><font size='1'>Sem Ex Load</font></th>");
			print("<th><font size='1'>Co #</font></th>");
			print("<th><font size='1'>Crhr</font></th>");
			print("<th><font size='1'>LEH</font></th>");
			print("<th><font size='1'>LAH</font></th>");
			print("<th><font size='1'>Tut Hr</font></th>");
			print("<th><font size='1'># of sec</font></th>");
			print("<th><font size='1'># of studs</font></th>");
			print("<th><font size='1'>Cat</font></th>");
			print("<th><font size='1'>Type</font></th>");
			print("<th><font size='1'>Remark</font></th>");
		print("</tr>");
		$ctr = 1;
		while($resultRow = mysql_fetch_object($result))//iterate thru all the instrcutors to check that if they have a load or not!
		{
			$instructorId = $resultRow->parttimer_id;
			//now check if this instructor is available in the tblInstructorLoad
			$ans = InstructorLoad::doesThisInstructorHasALoad($instructorId,$academicUnitId);
			if($ans == "Yes")
			{
				//print("$instructorId has a load<br/>");//passed
				//now get the # of courses given by this particular instructor
				$howMany = InstructorLoad::howManyCoursesDoesThisInstructorTeach($instructorId,$academicUnitId);
				$howMany = $howMany + 1;
				//print("$instructorId is teaching $howMany courses<br/>");
				//then comes the need to get all the info from tblSemesterLoadSummery to get the non-repeating info

				//$resultSemesterLoadRow = SemesterLoadSummery::getAllLoadInfoForInstructor($instructorId);
				$query = "SELECT * FROM tblSemesterLoadSummery WHERE inst_id = '$instructorId' AND academic_unit_id = '$academicUnitId'";
				//print("$query<br>");
				$resultSemesterLoad = DBConnection::readFromDatabase($query);
				$resultSemesterLoadRow = mysql_fetch_object($resultSemesterLoad);

				$fullName = $resultSemesterLoadRow->full_name;
				$normalCourseLoad = $resultSemesterLoadRow->normal_course_load;
				$expectedSemesterLoad = $resultSemesterLoadRow->expected_semester_load;
				$postgradCourseLoad = $resultSemesterLoadRow->post_grad_course_load;
				$additionalResponsibilityWaiver = $resultSemesterLoadRow->additional_responsibility_weaver;
				$undergradCourseLoad = $resultSemesterLoadRow->undergrad_course_load;
				$undergradAdvisingLoad = $resultSemesterLoadRow->undergrad_advising_load;
				$postgradProjectAdvising = $resultSemesterLoadRow->post_grad_project_advising_load;
				$thesisAdvisingLoad = $resultSemesterLoadRow->thesis_advising_load;
				$totalAdvisingLoad = $resultSemesterLoadRow->total_advising_load;
				$totalSemesterLoad = $resultSemesterLoadRow->total_semester_load;
				$semesterExcessLoad = $resultSemesterLoadRow->semester_excess_load;


				//print("fn $fullName<br/>");passed

				if($ctr % 2 == 0)
			   {
				  print("<tr style='background:#ded7fe'>");
				}
				else
				{
				  print("<tr style='background:#ecfdfe'>");
				}
					print("<td rowspan='$howMany' width='1%'>");
						print("<font size='2'>$instructorId</font>");
					print("</td>");

					print("<td rowspan='$howMany' width='2%'>");
						print("<font size='2'>$fullName</font>");
					print("</td>");

					//get the academicunitname
					$academicUnitNameResult = AcademicUnit::getAcademicUnitNameFor($resultSemesterLoadRow->academic_unit_id);
					$academicUnitNameResultRow = mysql_fetch_object($academicUnitNameResult);
					$academicUnitName = $academicUnitNameResultRow->academic_unit_name;

					print("<td rowspan='$howMany' width='2%'>");
						print("<font size='2'>$academicUnitName</font>");
					print("</td>");

					/*print("<td rowspan='$howMany' align='center'>");
						print("<font size='2'>$normalCourseLoad</font>");
					print("</td>");*/

					print("<td rowspan='$howMany' align='center'>");
						print("<font size='2'>$additionalResponsibilityWaiver</font>");
					print("</td>");

					print("<td rowspan='$howMany' align='center'>");
						print("<font size='2'>$expectedSemesterLoad</font>");
					print("</td>");
				//print("</tr>");

				//now do the logic for displaying the next segment of the non-repeating fields...but calculated.

				//print("<tr>");
					print("<td rowspan='$howMany' align='center'>");
						print("<font size='2'>$undergradCourseLoad</font>");
					print("</td>");

					print("<td rowspan='$howMany' align='center'>");
						print("<font size='2'>$postgradCourseLoad</font>");
					print("</td>");

					print("<td rowspan='$howMany' align='center'>");
						print("<font size='2'>$undergradAdvisingLoad</font>");
					print("</td>");

					print("<td rowspan='$howMany' align='center'>");
						print("<font size='2'>$postgradProjectAdvising</font>");
					print("</td>");

					print("<td rowspan='$howMany' align='center'>");
						print("<font size='2'>$thesisAdvisingLoad</font>");
					print("</td>");

					print("<td rowspan='$howMany' align='center'>");
						print("<font size='2'>$totalAdvisingLoad</font>");
					print("</td>");

					print("<td rowspan='$howMany' align='center'>");
						print("<font size='2'><b>$totalSemesterLoad</b></font>");
					print("</td>");

					print("<td rowspan='$howMany' align='center'>");
						//the code below is used to check if there are negatives...and avoid them totaly
						if($semesterExcessLoad <= 0)
						{
							$semesterExcessLoad = "---";
							print("<font size='2'>$semesterExcessLoad</font>");
						}
						else//meaning the staff has got an excess
						{
							$semesterExcessLoad = "---";
							print("<font size='2' color='green'><b>$semesterExcessLoad</b></font>");
						}
					print("</td>");
				print("</tr>");

				//now begin displaying the repeating fields here
				//here i need to get all the courses this particular instructor is teaching

				$query = "SELECT * FROM tblInstructorLoad WHERE instructor_id = '$instructorId' AND academic_unit_id = '$academicUnitId'";
				$resultLoad = DBConnection::readFromDatabase($query);

				while($resultLoadRow = mysql_fetch_object($resultLoad))
				{
					$courseNumber = $resultLoadRow->course_number;
					$courseDetailRow = CourseOffering::getCourseDetail($courseNumber);
					$creditHour = $courseDetailRow->credit_hour; 
					$lectureHour = $courseDetailRow->lecture_hour;
					$labHour = $courseDetailRow->lab_hour;
					$tutorialHour = $courseDetailRow->tutorial_hour;
					$numberOfSections = $resultLoadRow->number_of_sections;
					$category = $resultLoadRow->category;
					$numberOfStudents = $resultLoadRow->number_of_students;
					$type = $resultLoadRow->type;
					$remark = $resultLoadRow->remark;

					if($ctr % 2 == 0)
				   {
					  print("<tr style='background:#ded7fe'>");
					}
					else
					{
					  print("<tr style='background:#ecfdfe'>");
					}
						print("<td align='center'><font size='2'><strong>$courseNumber</strong></font></td>");
						print("<td align='center'><font size='2'>$creditHour</font></td>");
						print("<td align='center'><font size='2'>$lectureHour</font></td>");
						print("<td align='center'><font size='2'>$labHour</font></td>");
						print("<td align='center'><font size='2'>$tutorialHour</font></td>");
						print("<td align='center'><font size='2'>$numberOfSections</font></td>");
						print("<td align='center'><font size='2'>$numberOfStudents</font></td>");
						print("<td align='center'><font size='2'>$category</font></td>");
						print("<td align='center'><font size='2'>$type</font></td>");
						print("<td align='center'><font size='2'>$remark</font></td>");
					print("</tr>");
				}//end while...loop...this will loop thru all the courses this instructor is currently teaching


			}//end if...condition
			$ctr++;
		}//end while...loop...this loop will iterate thru all instructor in the academic unit
	print("</table>");
	print("</div>");
?>
