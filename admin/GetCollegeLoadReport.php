<?php	
	include_once('../classes/SemesterLoadSummeryCalculator.php');
	include_once('../classes/AcademicUnit.php');
	//get the id of the department
	@session_start();
	$academicUnitId = $_REQUEST['academicUnitId'];
	$academicYear = $_REQUEST['academicYear'];
	$semester = $_REQUEST['semester'];
	
	$_SESSION['selectedAcademicUnitid'] = $academicUnitId;
	
	//now determine which report table to consult...if 
	$query = "SELECT COUNT(*) AS recFound FROM tblSemesterLoadSummery WHERE academic_unit_id = '$academicUnitId' AND year = '$academicYear' AND semester = '$semester'";
	//print($query."<br/>"); 	
	$mainResult = DBConnection::readFromDatabase($query);
	$mainResultRow = mysql_fetch_object($mainResult);
	$recFound = $mainResultRow->recFound;
	if($recFound != 0)
	{////meaning the data is very current and look for it in the current semester value....
		//print($recFound." rec found in the tblSemesterLoadSummery table");	
				//here get the academic unit name for the passed academic unit id
				$academicUnitNameResult = AcademicUnit::getAcademicUnitNameFor($academicUnitId);
				$academicUnitNameRow = mysql_fetch_object($academicUnitNameResult);
				$academicUnitName = $academicUnitNameRow->academic_unit_name;
				SemesterLoadSummeryCalculator::calculateSemesterLoadForFullTimerInstructor($academicUnitId);				
				SemesterLoadSummeryCalculator::calculateSemesterLoadForPartTimerInstructor($academicUnitId);
				//Header("Location: ShowLoadReport.php");
				//to stick with the old reporting format....you may need to get back here in case things are not working 
				//as planned
				//Header("Location: ShowLoadReportFinal.php");
			
					//include('GetLoadReport.php');
					include_once('../classes/DBConnection.php');
					include_once('../classes/InstructorLoad.php');
					//$academicUnitId = $_SESSION['deptId'];
					$query = "SELECT * FROM tblInstructor WHERE academic_unit_id = '$academicUnitId' ORDER BY first_name,last_name ASC";
					//print($query."<br/>");
					$resultInstructors = DBConnection::readFromDatabase($query);
					
				include_once('../classes/DBConnection.php');
				include_once('../classes/InstructorLoad.php');
				include_once('../classes/SemesterLoadSummery.php');
				include_once('../classes/AcademicUnit.php');
				include_once('../classes/CourseOffering.php');
				//now get the semester and year information
				$semesterAndYearRow = SemesterLoadSummery::getSemesterAndYearForAcademicUnit($academicUnitId);
				$semesterAndYearInfo = "Semester ".$semesterAndYearRow->semester.": ".$semesterAndYearRow->year; 
				//first read all instructors in this specific academic unit				
								
				//print("the academic unit id is : $academicUnitId<br/>");
				$query = "SELECT * FROM tblInstructor WHERE academic_unit_id = '$academicUnitId' ORDER BY first_name,last_name ASC";
				$result = DBConnection::readFromDatabase($query);
				
				print("<table width='100%' border='1'>");
					print("<caption style='background:lightblue'>Load Report of $academicUnitName, $semesterAndYearInfo<br/>Fulltimer Instructor Load Report</caption>");		
					print("<tr style='background: lightblue'>");
						print("<th><font size='1'>Id</font></th>");
						print("<th><font size='1'>Name</font></th>");
						//print("<th><font size='1'>Acad Unit</font></th>");
						//print("<th><font size='1'>Norm Course Load</font></th>");
						//print("<th><font size='1'>Resp Wavier</font></th>");
						print("<th><font size='1'>Expected Semester Load</font></th>");
						print("<th><font size='1'>Undergrad Course Load</font></th>");
						print("<th><font size='1'>Postgrad Course Load</font></th>");
						print("<th><font size='1'>Undergrad Advising Load</font></th>");
						print("<th><font size='1'>Postgrad Project Advising Load</font></th>");
						print("<th><font size='1'>Thesis Advising Load</font></th>");
						print("<th><font size='1'>Total Advising Load</font></th>");
						print("<th><font size='1'>Total Semester Load</font></th>");
						print("<th><font size='1'>Semester Excess Load</font></th>");
						print("<th><font size='1'>Advising Excess Load (AEL)</font></th>");
						print("<th><font size='1'>Course Excess Load (CEL)</font></th>");
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
							//i can compute the additional computation wondisho brought in here
							
							$TAL = $totalAdvisingLoad;
							//print("tal : $TAL");
							$TEL = $semesterExcessLoad;
							$TCL = $postgradCourseLoad + $undergradCourseLoad;
							$AEL = 0;
							$CEL = 0;				
							//do logic for senario A
							if($TEL > 0 && $TAL == 0)
							{
								$AEL = 0;
								$CEL = $TEL;
							}
							
							//do logic for senario B
							if($TEL > 0 && $TCL)
							{
								$AEL = $TEL;
								$CEL = 0;
							}
							
							//do logic for senario C
							if($TEL > 0 && $TAL >= $TEL)
							{
								$AEL = $TEL;
								$CEL = 0;
							}
							
							//do logic for senario D
							if($TEL > 0 && $TAL < $TEL)
							{
								$AEL = $TAL;
								$CEL = $TEL - $TAL;
							}
							
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
								
								
								print("<td rowspan='$howMany' align='center'>");
									print("<font size='2'>$expectedSemesterLoad</font>");
								print("</td>");				
							
								
							//now do the logic for displaying the next segment of the non-repeating fields...but calculated.
							
							
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
								
								print("<td rowspan='$howMany' align='center'>");
									if($AEL == 0)
										print("<font size='2'>---</font>");
									else
										print("<font size='2'><b>$AEL</b></font>");
								print("</td>");
								
								print("<td rowspan='$howMany' align='center'>");
									if($CEL == 0)
										print("<font size='2'>---</font>");
									else
										print("<font size='2'><b>$CEL</b></font>");
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
				
				//do the same for parttimer instructor below///////////////////--------------------63545874
				$query = "SELECT * FROM tblParttimer WHERE academic_unit_id = '$academicUnitId' ORDER BY first_name,last_name ASC";
				//print($query);
				$result = DBConnection::readFromDatabase($query);
				
				print("<table width='100%' border='1'>");
					print("<caption style='background:lightblue'>Load Report of $academicUnitName, $semesterAndYearInfo<br/>Parttimer Instructor's Load Report</caption>");
					print("<tr style='background: lightblue'>");
						print("<th><font size='1'>Id</font></th>");
						print("<th><font size='1'>Name</font></th>");
						print("<th><font size='1'>Academic Unit</font></th>");
						//print("<th><font size='1'>Norm Course Load</font></th>");
						//print("<th><font size='1'>Resp Wavier</font></th>");
						//print("<th><font size='1'>Exp Sem Load</font></th>");
						print("<th><font size='1'>Undergrad Course Load</font></th>");
						print("<th><font size='1'>Postgrad Course Load</font></th>");
						print("<th><font size='1'>Undergrad Advising Load</font></th>");
						print("<th><font size='1'>Postgrad Project Advising Load</font></th>");
						print("<th><font size='1'>Thesis Advising Load</font></th>");
						print("<th><font size='1'>Total Advising Load</font></th>");
						print("<th><font size='1'>Total Semester Load</font></th>");
						//print("<th><font size='1'>Seme Excess Load</font></th>");
						print("<th><font size='1'>Advising Excess Load (AEL)</font></th>");
						print("<th><font size='1'>Course Excess Load (CEL)</font></th>");
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
							
							$TAL = $totalAdvisingLoad;
							//print("tal : $TAL");
							$TEL = $semesterExcessLoad;
							$TCL = $postgradCourseLoad + $undergradCourseLoad;
							$AEL = 0;
							$CEL = 0;				
							//do logic for senario A
							if($TEL > 0 && $TAL == 0)
							{
								$AEL = 0;
								$CEL = $TEL;
							}
							
							//do logic for senario B
							if($TEL > 0 && $TCL)
							{
								$AEL = $TEL;
								$CEL = 0;
							}
							
							//do logic for senario C
							if($TEL > 0 && $TAL >= $TEL)
							{
								$AEL = $TEL;
								$CEL = 0;
							}
							
							//do logic for senario D
							if($TEL > 0 && $TAL < $TEL)
							{
								$AEL = $TAL;
								$CEL = $TEL - $TAL;
							}
							
							
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
								
								/*print("<td rowspan='$howMany' align='center'>");
									print("<font size='2'><b>$totalSemesterLoad</b></font>");
								print("</td>");*/
								
								print("<td rowspan='$howMany' align='center'>");
									//the code below is used to check if there are negatives...and avoid them totaly
									if($semesterExcessLoad <= 0)
									{
										$semesterExcessLoad = "---";
										print("<font size='2'>$totalSemesterLoad</font>");
									}
									else//meaning the staff has got an excess
									{
										print("<font size='2' color='green'><b>$semesterExcessLoad</b></font>");
									}
								print("</td>");								
								print("<td rowspan='$howMany' align='center'>");
									if($AEL == 0)
										print("<font size='2'>---</font>");
									else
										print("<font size='2'><b>$AEL</b></font>");
								print("</td>");
								
								print("<td rowspan='$howMany' align='center'>");
									if($CEL == 0)
										print("<font size='2'>---</font>");
									else
										print("<font size='2'><b>$CEL</b></font>");
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
				include_once('CurrentSemesterLoadReportExportToExcelInnerMenu.inc');
		}//end if....the above logic works for the current data not in the repository
		else//otherwise the data is located in the repository table
		{
			//print("go to the repository logic");
			//here get the academic unit name for the passed academic unit id
				//check if the passed parameters are still accessable
				//print("mahder : Acad UID : $academicUnitId<br/>Sem : $semester<br/>Year : $academicYear");
				$academicUnitNameResult = AcademicUnit::getAcademicUnitNameFor($academicUnitId);
				$academicUnitNameRow = mysql_fetch_object($academicUnitNameResult);
				$academicUnitName = $academicUnitNameRow->academic_unit_name;				
				//to stick with the old reporting format....you may need to get back here in case things are not working 
				//as planned		
					
					include_once('../classes/DBConnection.php');				
					$query = "SELECT * FROM tblInstructor WHERE academic_unit_id = '$academicUnitId' ORDER BY first_name ASC";
					//print($query."<br/>");
					$resultInstructors = DBConnection::readFromDatabase($query);
					
				include_once('../classes/DBConnection.php');
				include_once('../classes/InstructorLoadRepository.php');
				include_once('../classes/LoadSummaryRepository.php');
				include_once('../classes/AcademicUnit.php');
				include_once('../classes/CourseOffering.php');
				//now get the semester and year information
				$semesterAndYearInfo = $semester." : ".$academicYear;				 
				//first read all instructors in this specific academic unit				
								
				//print("the academic unit id is : $academicUnitId<br/>");
				//$query = "SELECT * FROM tblInstructor WHERE academic_unit_id = '$academicUnitId'";
				//print($query);passed
				//$result = DBConnection::readFromDatabase($query);
				
				print("<table width='100%' border='1'>");
					print("<caption style='background:lightblue'>Load Report of $academicUnitName, $semesterAndYearInfo<br/>Fulltimer Instructor Load Report</caption>");		
					print("<tr style='background: lightblue'>");
						print("<th><font size='1'>Id</font></th>");
						print("<th><font size='1'>Name</font></th>");
						//print("<th><font size='1'>Acad Unit</font></th>");
						//print("<th><font size='1'>Norm Course Load</font></th>");
						//print("<th><font size='1'>Resp Wavier</font></th>");
						print("<th><font size='1'>Expected Semester Load</font></th>");
						print("<th><font size='1'>Undergrad Course Load</font></th>");
						print("<th><font size='1'>Postgrad Course Load</font></th>");
						print("<th><font size='1'>Undergrad Advising Load</font></th>");
						print("<th><font size='1'>Postgrad Project Advising Load</font></th>");
						print("<th><font size='1'>Thesis Advising Load</font></th>");
						print("<th><font size='1'>Total Advising Load</font></th>");
						print("<th><font size='1'>Total Semester Load</font></th>");
						print("<th><font size='1'>Semester Excess Load</font></th>");
						print("<th><font size='1'>Advising Excess Load (AEL)</font></th>");
						print("<th><font size='1'>Course Excess Load (CEL)</font></th>");
						print("<th><font size='1'>Co #</font></th>");
						print("<th><font size='1'>Crhr</font></th>");
						print("<th><font size='1'>LEH</font></th>");
						print("<th><font size='1'>LAH</font></th>");
						print("<th><font size='1'>Tut Hr</font></th>");
						print("<th><font size='1'># of sec</font></th>");
						print("<th><font size='1'># of studs</font></th>");
						print("<th><font size='1'>Cat</font></th>");
						print("<th><font size='1'>Type</font></th>");			
					print("</tr>");
					$ctr = 1;
					while($resultRow = mysql_fetch_object($resultInstructors))//iterate thru all the instrcutors to check that if they have a load or not!
					{
						$instructorId = $resultRow->instructor_id;
						//now check if this instructor is available in the tblInstructorLoad
						$ans = InstructorLoadRepository::doesThisInstructorHasALoad($instructorId,$academicUnitId,$semester,$academicYear);
						if($ans == "Yes")
						{
							//print("$instructorId has a load<br/>");passed
							//now get the # of courses given by this particular instructor
							$howMany = InstructorLoadRepository::howManyCoursesDoesThisInstructorTeach($instructorId,$academicUnitId,$semester,$academicYear);
							$howMany = $howMany + 1;
							//print("$instructorId is teaching $howMany courses<br/>");
							//then comes the need to get all the info from tblLoadSummaryRepository to get the non-repeating info
							
							//$resultSemesterLoadRow = SemesterLoadSummery::getAllLoadInfoForInstructor($instructorId);
							$query = "SELECT * FROM tblLoadSummaryRepository WHERE inst_id = '$instructorId' AND academic_unit_id = '$academicUnitId' AND semester = '$semester' AND year = '$academicYear'";
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
							//i can compute the additional computation wondisho brought in here
							
							$TAL = $totalAdvisingLoad;
							//print("tal : $TAL");
							$TEL = $semesterExcessLoad;
							$TCL = $postgradCourseLoad + $undergradCourseLoad;
							$AEL = 0;
							$CEL = 0;				
							//do logic for senario A
							if($TEL > 0 && $TAL == 0)
							{
								$AEL = 0;
								$CEL = $TEL;
							}
							
							//do logic for senario B
							if($TEL > 0 && $TCL)
							{
								$AEL = $TEL;
								$CEL = 0;
							}
							
							//do logic for senario C
							if($TEL > 0 && $TAL >= $TEL)
							{
								$AEL = $TEL;
								$CEL = 0;
							}
							
							//do logic for senario D
							if($TEL > 0 && $TAL < $TEL)
							{
								$AEL = $TAL;
								$CEL = $TEL - $TAL;
							}
							
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
								
								
								print("<td rowspan='$howMany' align='center'>");
									print("<font size='2'>$expectedSemesterLoad</font>");
								print("</td>");				
							
								
							//now do the logic for displaying the next segment of the non-repeating fields...but calculated.
							
							
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
								
								print("<td rowspan='$howMany' align='center'>");
									print("<font size='2'><b>$AEL</b></font>");
								print("</td>");
								
								print("<td rowspan='$howMany' align='center'>");
									print("<font size='2'><b>$CEL</b></font>");
								print("</td>");
							print("</tr>");
							
							//now begin displaying the repeating fields here
							//here i need to get all the courses this particular instructor is teaching 
							
							$query = "SELECT * FROM tblInstructorLoadRepository WHERE instructor_id = '$instructorId' AND academic_unit_id = '$academicUnitId' AND semister = '$semester' AND year = '$academicYear'";
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
								print("</tr>");
							}//end while...loop...this will loop thru all the courses this instructor is currently teaching
									
								
						}//end if...condition
						$ctr++;
					}//end while...loop...this loop will iterate thru all instructor in the academic unit
				print("</table>");
				
				//do the same for parttimer instructor below///////////////////--------------------63545874
				$query = "SELECT * FROM tblParttimer WHERE academic_unit_id = '$academicUnitId'";
				//print($query);
				$result = DBConnection::readFromDatabase($query);
				
				print("<table width='100%' border='1'>");
					print("<caption style='background:lightblue'>Load Report of $academicUnitName, $semesterAndYearInfo<br/>Parttimer Instructor's Load Report</caption>");
					print("<tr style='background: lightblue'>");
						print("<th><font size='1'>Id</font></th>");
						print("<th><font size='1'>Name</font></th>");
						print("<th><font size='1'>Academic Unit</font></th>");
						//print("<th><font size='1'>Norm Course Load</font></th>");
						//print("<th><font size='1'>Resp Wavier</font></th>");
						//print("<th><font size='1'>Exp Sem Load</font></th>");
						print("<th><font size='1'>Undergrad Course Load</font></th>");
						print("<th><font size='1'>Postgrad Course Load</font></th>");
						print("<th><font size='1'>Undergrad Advising Load</font></th>");
						print("<th><font size='1'>Postgrad Project Advising Load</font></th>");
						print("<th><font size='1'>Thesis Advising Load</font></th>");
						print("<th><font size='1'>Total Advising Load</font></th>");
						print("<th><font size='1'>Total Semester Load</font></th>");
						print("<th><font size='1'>Seme Excess Load</font></th>");
						print("<th><font size='1'>Advising Excess Load (AEL)</font></th>");
						print("<th><font size='1'>Course Excess Load (CEL)</font></th>");
						print("<th><font size='1'>Co #</font></th>");
						print("<th><font size='1'>Crhr</font></th>");
						print("<th><font size='1'>LEH</font></th>");
						print("<th><font size='1'>LAH</font></th>");
						print("<th><font size='1'>Tut Hr</font></th>");
						print("<th><font size='1'># of sec</font></th>");
						print("<th><font size='1'># of studs</font></th>");
						print("<th><font size='1'>Cat</font></th>");
						print("<th><font size='1'>Type</font></th>");
					print("</tr>");
					$ctr = 1;
					while($resultRow = mysql_fetch_object($result))//iterate thru all the instrcutors to check that if they have a load or not!
					{
						$instructorId = $resultRow->parttimer_id;
						//now check if this instructor is available in the tblInstructorLoad
						$ans = InstructorLoadRepository::doesThisInstructorHasALoad($instructorId,$academicUnitId,$semester,$academicYear);
						if($ans == "Yes")
						{
							//print("$instructorId has a load<br/>");//passed
							//now get the # of courses given by this particular instructor
							$howMany = InstructorLoadRepository::howManyCoursesDoesThisInstructorTeach($instructorId,$academicUnitId,$semester,$academicYear);
							$howMany = $howMany + 1;
							//print("$instructorId is teaching $howMany courses<br/>");
							//then comes the need to get all the info from tblSemesterLoadSummery to get the non-repeating info
							
							
							$query = "SELECT * FROM tblLoadSummaryRepository WHERE inst_id = '$instructorId' AND academic_unit_id = '$academicUnitId' AND semester = '$semester' AND year = '$academicYear'";
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
							
							$TAL = $totalAdvisingLoad;
							//print("tal : $TAL");
							$TEL = $semesterExcessLoad;
							$TCL = $postgradCourseLoad + $undergradCourseLoad;
							$AEL = 0;
							$CEL = 0;				
							//do logic for senario A
							if($TEL > 0 && $TAL == 0)
							{
								$AEL = 0;
								$CEL = $TEL;
							}
							
							//do logic for senario B
							if($TEL > 0 && $TCL)
							{
								$AEL = $TEL;
								$CEL = 0;
							}
							
							//do logic for senario C
							if($TEL > 0 && $TAL >= $TEL)
							{
								$AEL = $TEL;
								$CEL = 0;
							}
							
							//do logic for senario D
							if($TEL > 0 && $TAL < $TEL)
							{
								$AEL = $TAL;
								$CEL = $TEL - $TAL;
							}
							
							
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
									print("<font size='2'><b><font color='green'>$totalSemesterLoad</font></b></font>");
								print("</td>");
								
								print("<td rowspan='$howMany' align='center'>");
									//the code below is used to check if there are negatives...and avoid them totaly
									if($totalSemesterLoad <= 0)
									{
										$totalSemesterLoad = "---";
										print("<font size='2'>$totalSemesterLoad</font>");
									}
									else//meaning the staff has got an excess
									{
										print("<font size='2' color='green'><b>$totalSemesterLoad</b></font>");
									}
								print("</td>");
								
								print("<td rowspan='$howMany' align='center'>");
									print("<font size='2'><b>$AEL</b></font>");
								print("</td>");
								
								print("<td rowspan='$howMany' align='center'>");
									print("<font size='2'><b>$CEL</b></font>");
								print("</td>");
							print("</tr>");
							
							//now begin displaying the repeating fields here
							//here i need to get all the courses this particular instructor is teaching 
							
							$query = "SELECT * FROM tblInstructorLoadRepository WHERE instructor_id = '$instructorId' AND academic_unit_id = '$academicUnitId' AND semister = '$semester' AND year = '$academicYear'";
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
								$type=$resultLoadRow->remark;
								
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
								print("</tr>");
							}//end while...loop...this will loop thru all the courses this instructor is currently teaching
									
								
						}//end if...condition
						$ctr++;
					}//end while...loop...this loop will iterate thru all instructor in the academic unit
					
				print("</table>");
		}
?>