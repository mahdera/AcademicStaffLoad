<?php
	include_once('../classes/SemesterLoadSummeryCalculator.php');
	include_once('../classes/AcademicUnit.php');
	//get the id of the department
	@session_start();
	$academicUnitId = $_GET['academicUnitId'];
	$academicYear = $_REQUEST['academicYear'];
	$semesterP = $_REQUEST['semesterP'];
	//put this values to the session variable Mahder
	$_SESSION['academicYearSession'] = $academicYear;
	$_SESSION['semesterSession'] = $semesterP;


	//now determine which report table to consult...if
	if($academicUnitId != 'All')
		$query = "SELECT COUNT(*) AS recFound FROM tblSemesterLoadSummery WHERE academic_unit_id = '$academicUnitId' AND year = '$academicYear' AND semester = '$semesterP'";
	else if($academicUnitId == 'All')
		$query = "SELECT COUNT(*) AS recFound FROM tblSemesterLoadSummery WHERE year = '$academicYear' AND semester = '$semesterP'";
	//print($query."<br/>");
	$mainResult = DBConnection::readFromDatabase($query);
	$mainResultRow = mysql_fetch_object($mainResult);
	$recFound = $mainResultRow->recFound;
	if($recFound != 0)
	{
				//print($recFound." rec found in the tblSemesterLoadSummery table");
				//now determine if the report is for all departments or just for a specific dept???
				if($academicUnitId == 'All'){
					include_once('ShowCollegeTotalLoadReportForAllAcademicUnits.inc');
				}
				else{
									//here get the academic unit name for the passed academic unit id
									$academicUnitNameResult = AcademicUnit::getAcademicUnitNameFor($academicUnitId);
									$academicUnitNameRow = mysql_fetch_object($academicUnitNameResult);
									$academicUnitName = $academicUnitNameRow->academic_unit_name;
									SemesterLoadSummeryCalculator::calculateSemesterLoadForFullTimerInstructor($academicUnitId);
									//print("Done");
									//now do the same for parttimer instructor
									SemesterLoadSummeryCalculator::calculateSemesterLoadForPartTimerInstructor($academicUnitId);
									//Header("Location: ShowLoadReport.php");
									//to stick with the old reporting format....you may need to get back here in case things are not working
									//as planned
									//Header("Location: ShowLoadReportFinal.php");

										//include('GetLoadReport.php');
										include_once('../classes/DBConnection.php');
										include_once('../classes/InstructorLoad.php');
										//$academicUnitId = $_SESSION['deptId'];
										$query = "SELECT * FROM tblInstructor WHERE academic_unit_id = '$academicUnitId' ORDER BY first_name, last_name ASC";
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
									$query = "SELECT * FROM tblInstructor WHERE academic_unit_id = '$academicUnitId' ORDER BY first_name, last_name ASC";
									$result = DBConnection::readFromDatabase($query);

									print("<table width='100%' border='1'>");
										print("<caption style='background:lightblue'>Load Report of $academicUnitName, $semesterAndYearInfo<br/>Fulltimer Instructor Load Report</caption>");
										print("<tr style='background: lightblue'>");
											print("<th width='12%'><font size='1'>Id</font></th>");
											print("<th width='28%'><font size='1'>Name</font></th>");
											print("<th width='12%'><font size='1'>Academic Rank</font></th>");
											print("<th width='12%'><font size='1'>Semester Course Load</font></th>");
											print("<th width='12%'><font size='1'>Semester Advising Load</font></th>");
											print("<th width='12%'><font size='1'>Total Semester Load</font></th>");
											print("<th width='12%'><font size='1'>Remark</font></th>");
										print("</tr>");
										$ctr = 1;
										while($resultRow = mysql_fetch_object($result))//iterate thru all the instrcutors to check that if they have a load or not!
										{
											$instructorId = $resultRow->instructor_id;
											$instuctorAcademicRank = $resultRow->instructor_level;
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
													print("<td>");
														print("<font size='2'>$instructorId</font>");
													print("</td>");

													print("<td>");
														print("<font size='2'>$fullName</font>");
													print("</td>");

													//get the academicunitname
													$academicUnitNameResult = AcademicUnit::getAcademicUnitNameFor($resultSemesterLoadRow->academic_unit_id);
													$academicUnitNameResultRow = mysql_fetch_object($academicUnitNameResult);
													$academicUnitName = $academicUnitNameResultRow->academic_unit_name;

													print("<td>");
														print("<font size='2'>$instuctorAcademicRank</font>");
													print("</td>");

													//now get the course load
													$totalCourseLoad = $postgradCourseLoad + $undergradCourseLoad;
													print("<td>");
														print("<font size='2'><b>$totalCourseLoad</b></font>");
													print("</td>");

													print("<td>");
														print("<font size='2'><b>$totalAdvisingLoad</b></font>");
													print("</td>");

													print("<td>");
														print("<font size='2'><b>$totalSemesterLoad</b></font>");
													print("</td>");

													print("<td>");
														print("<font size='2'><b>Full Timer</b></font>");
													print("</td>");
												print("</tr>");

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
											print("<th width='12%'><font size='1'>Id</font></th>");
											print("<th width='28%'><font size='1'>Name</font></th>");
											print("<th width='12%'><font size='1'>Academic Rank</font></th>");
											print("<th width='12%'><font size='1'>Semester Course Load</font></th>");
											print("<th width='12%'><font size='1'>Semester Advising Load</font></th>");
											print("<th width='12%'><font size='1'>Total Semester Load</font></th>");
											print("<th width='12%'><font size='1'>Remark</font></th>");
										print("</tr>");
										$ctr = 1;
										while($resultRow = mysql_fetch_object($result))//iterate thru all the instrcutors to check that if they have a load or not!
										{
											$instructorId = $resultRow->parttimer_id;
											$instuctorAcademicRank = $resultRow->instructor_level;
											//now store the value read from the organization column of the parttimer table
											$organizationInfo = $resultRow->organization;
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
													print("<td>");
														print("<font size='2'>$instructorId</font>");
													print("</td>");

													print("<td>");
														print("<font size='2'>$fullName</font>");
													print("</td>");

													//get the academicunitname
													$academicUnitNameResult = AcademicUnit::getAcademicUnitNameFor($resultSemesterLoadRow->academic_unit_id);
													$academicUnitNameResultRow = mysql_fetch_object($academicUnitNameResult);
													$academicUnitName = $academicUnitNameResultRow->academic_unit_name;

													print("<td>");
														print("<font size='2'>$instuctorAcademicRank</font>");
													print("</td>");

													//now get the course load
													$totalCourseLoad = $postgradCourseLoad + $undergradCourseLoad;
													print("<td>");
														print("<font size='2'><b>$totalCourseLoad</b></font>");
													print("</td>");

													print("<td>");
														print("<font size='2'><b>$totalAdvisingLoad</b></font>");
													print("</td>");

													print("<td>");
														print("<font size='2'><b>$totalSemesterLoad</b></font>");
													print("</td>");
													$typeOfParttimer;
													if($organizationInfo == "AAU")
														$typeOfParttimer = "AAU Parttimer";
													else if($organizationInfo != "AAU")
														$typeOfParttimer = "External Parttimer";
													print("<td>");
														print("<font size='2'><b>$typeOfParttimer</b></font>");
													print("</td>");
												print("</tr>");
											}//end if...condition
											$ctr++;
										}//end while...loop...this loop will iterate thru all instructor in the academic unit
									print("</table>");
					}//end else case!!!
		}//end if....the above logic works for the current data not in the repository
		else//otherwise the data is located in the repository table
		{
			//print("go to the repository logic");
			if($academicUnitId == 'All'){
					include_once('ShowCollegeTotalLoadReportForAllAcademicUnitsFromRepositoryTable.inc');
			}
			else{
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
											$semesterAndYearInfo = $semesterP." : ".$academicYear;
											//first read all instructors in this specific academic unit

											//print("the academic unit id is : $academicUnitId<br/>");
											//$query = "SELECT * FROM tblInstructor WHERE academic_unit_id = '$academicUnitId'";
											//print($query);passed
											//$result = DBConnection::readFromDatabase($query);

											print("<table width='100%' border='1'>");
												print("<caption style='background:lightblue'>Load Report of $academicUnitName, $semesterAndYearInfo<br/>Fulltimer Instructor Load Report</caption>");
												print("<tr style='background: lightblue'>");
													print("<th width='12%'><font size='1'>Id</font></th>");
													print("<th width='28%'><font size='1'>Name</font></th>");
													print("<th width='12%'><font size='1'>Academic Rank</font></th>");
													print("<th width='12%'><font size='1'>Semester Course Load</font></th>");
													print("<th width='12%'><font size='1'>Semester Advising Load</font></th>");
													print("<th width='12%'><font size='1'>Total Semester Load</font></th>");
													print("<th width='12%'><font size='1'>Remark</font></th>");
												print("</tr>");
												$ctr = 1;
												while($resultRow = mysql_fetch_object($resultInstructors))//iterate thru all the instrcutors to check that if they have a load or not!
												{
													$instructorId = $resultRow->instructor_id;
													$instuctorAcademicRank = $resultRow->instructor_level;
													//$organizationInfo = $resultRow->organization;
													//now check if this instructor is available in the tblInstructorLoad
													$ans = InstructorLoadRepository::doesThisInstructorHasALoad($instructorId,$academicUnitId,$semesterP,$academicYear);
													if($ans == "Yes")
													{
														//print("$instructorId has a load<br/>");passed
														//now get the # of courses given by this particular instructor
														$howMany = InstructorLoadRepository::howManyCoursesDoesThisInstructorTeach($instructorId,$academicUnitId,$semesterP,$academicYear);
														$howMany = $howMany + 1;
														//print("$instructorId is teaching $howMany courses<br/>");
														//then comes the need to get all the info from tblLoadSummaryRepository to get the non-repeating info

														//$resultSemesterLoadRow = SemesterLoadSummery::getAllLoadInfoForInstructor($instructorId);
														$query = "SELECT * FROM tblLoadSummaryRepository WHERE inst_id = '$instructorId' AND academic_unit_id = '$academicUnitId' AND semester = '$semesterP' AND year = '$academicYear'";
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
														$postgradProjectAdvising = $resultSemesterLoadRow->post_grad_project_advising;
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
															print("<td>");
																print("<font size='2'>$instructorId</font>");
															print("</td>");

															print("<td>");
																print("<font size='2'>$fullName</font>");
															print("</td>");

															//get the academicunitname
															$academicUnitNameResult = AcademicUnit::getAcademicUnitNameFor($resultSemesterLoadRow->academic_unit_id);
															$academicUnitNameResultRow = mysql_fetch_object($academicUnitNameResult);
															$academicUnitName = $academicUnitNameResultRow->academic_unit_name;

															print("<td>");
														print("<font size='2'>$instuctorAcademicRank</font>");
													print("</td>");

													//now get the course load
													$totalCourseLoad = $postgradCourseLoad + $undergradCourseLoad;
													print("<td>");
														print("<font size='2'><b>$totalCourseLoad</b></font>");
													print("</td>");

													print("<td>");
														print("<font size='2'><b>$totalAdvisingLoad</b></font>");
													print("</td>");

													print("<td>");
														print("<font size='2'><b>$totalSemesterLoad</b></font>");
													print("</td>");

													print("<td>");
														print("<font size='2'><b>Full Timer</b></font>");
													print("</td>");
													print("</tr>");

														//now begin displaying the repeating fields here
														//here i need to get all the courses this particular instructor is teaching
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
													print("<th width='12%'><font size='1'>Id</font></th>");
													print("<th width='28%'><font size='1'>Name</font></th>");
													print("<th width='12%'><font size='1'>Academic Rank</font></th>");
													print("<th width='12%'><font size='1'>Semester Course Load</font></th>");
													print("<th width='12%'><font size='1'>Semester Advising Load</font></th>");
												   print("<th width='12%'><font size='1'>Total Semester Load</font></th>");
													print("<th width='12%'><font size='1'>Remark</font></th>");
												print("</tr>");
												$ctr = 1;
												while($resultRow = mysql_fetch_object($result))//iterate thru all the instrcutors to check that if they have a load or not!
												{
													$instructorId = $resultRow->parttimer_id;
													$instuctorAcademicRank = $resultRow->instructor_level;
													$organizationInfo = $resultRow->organization;
													//now check if this instructor is available in the tblInstructorLoad
													$ans = InstructorLoadRepository::doesThisInstructorHasALoad($instructorId,$academicUnitId,$semesterP,$academicYear);
													if($ans == "Yes")
													{
														//print("$instructorId has a load<br/>");//passed
														//now get the # of courses given by this particular instructor
														$howMany = InstructorLoadRepository::howManyCoursesDoesThisInstructorTeach($instructorId,$academicUnitId,$semesterP,$academicYear);
														$howMany = $howMany + 1;
														//print("$instructorId is teaching $howMany courses<br/>");
														//then comes the need to get all the info from tblSemesterLoadSummery to get the non-repeating info

														$query = "SELECT * FROM tblLoadSummaryRepository WHERE inst_id = '$instructorId' AND academic_unit_id = '$academicUnitId' AND semester = '$semesterP' AND year = '$academicYear'";
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
															print("<td>");
																print("<font size='2'>$instructorId</font>");
															print("</td>");

															print("<td>");
																print("<font size='2'>$fullName</font>");
															print("</td>");

															//get the academicunitname
															$academicUnitNameResult = AcademicUnit::getAcademicUnitNameFor($resultSemesterLoadRow->academic_unit_id);
															$academicUnitNameResultRow = mysql_fetch_object($academicUnitNameResult);
															$academicUnitName = $academicUnitNameResultRow->academic_unit_name;

															print("<td>");
														print("<font size='2'>$instuctorAcademicRank</font>");
													print("</td>");

													//now get the course load
													$totalCourseLoad = $postgradCourseLoad + $undergradCourseLoad;
													print("<td>");
														print("<font size='2'><b>$totalCourseLoad</b></font>");
													print("</td>");

													print("<td>");
														print("<font size='2'><b>$totalAdvisingLoad</b></font>");
													print("</td>");

													print("<td>");
														print("<font size='2'><b>$totalSemesterLoad</b></font>");
													print("</td>");

													$typeOfParttimer;
													if($organizationInfo == "AAU")
														$typeOfParttimer = "AAU Parttimer";
													else if($organizationInfo != "AAU")
														$typeOfParttimer = "External Parttimer";
													print("<td>");
														print("<font size='2'><b>$typeOfParttimer</b></font>");
													print("</td>");

														print("</tr>");

														//now begin displaying the repeating fields here
														//here i need to get all the courses this particular instructor is teaching

													}//end if...condition
													$ctr++;
												}//end while...loop...this loop will iterate thru all instructor in the academic unit

											print("</table>");
					}//end else case
		}

?>
