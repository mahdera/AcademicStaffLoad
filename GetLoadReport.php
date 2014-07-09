<?php
	include_once('classes/SemesterLoadSummery.php');
	include_once('classes/AcademicUnit.php');
	include_once('classes/InstructorLoad.php');
	include_once('classes/CourseOffering.php');
	
	//get the semester and year info from the machine...do the logic with wondisho
	$semester = "I";
	$year = "2010";
	
	$result = SemesterLoadSummery::getSemesterLoadInfoFor($year,$semester);
	
	print("<table width='100%' border='1'>");
		print("<caption style='background:lightblue'>Current Semester Load Info</caption>");
		print("<tr style='background:lightblue'>");
			print("<th><font size='2'>ID.</font></th>");
			print("<th><font size='2'>Full Name</font></th>");
			print("<th><font size='2'>Academic Unit</font></th>");
			print("<th><font size='2'>Normal Course Load</font></th>");
			print("<th><font size='2'>Resp Waiver</font></th>");
			print("<th><font size='2'>Expe Sem Load</font></th>");
			print("<th><font size='2'>Courses</font></th>");
			print("<th><font size='2'>Undergrad Course Load</font></th>");
			print("<th><font size='2'>Postgrad Course Load</font></th>");
			print("<th><font size='2'>Undergra Advising Load</font></th>");
			print("<th><font size='2'>Postgrad Project Advising</font></th>");
			print("<th><font size='2'>Thesis Advising Load</font></th>");
			print("<th><font size='2'>Total Advising Load</font></th>");
			print("<th><font size='2'>Total Semester Load</font></th>");
			print("<th><font size='2'>Semester Excess Load</font></th>");
		print("</tr>");
		$ctr = 1;
		while($resultRow = mysql_fetch_object($result))
		{
			$instructorId = $resultRow->inst_id;
			$fullName = $resultRow->full_name;
			$academicUnitId = $resultRow->academic_unit_id;
			$academicUnitResult = AcademicUnit::getAcademicUnitNameFor($academicUnitId);
			$academicUnitResultRow = mysql_fetch_object($academicUnitResult);
			$academicUnitName = $academicUnitResultRow->academic_unit_name;
			$normalCourseLoad = $resultRow->normal_course_load;
			$additionalResponsibilityWaiver = $resultRow->additional_responsibility_weaver;
			$expectedSemesterLoad = $resultRow->expected_semester_load;
			$undergraduateCourseLoad = $resultRow->undergrad_course_load;
			$postgraduateCourseLoad = $resultRow->post_grad_course_load; 
			$undergraduateAdvisingLoad = $resultRow->undergrad_advising_load;
			$postgraduateProjectAdvisingLoad = $resultRow->post_grad_project_advising_load;
			$thesisAdvisingLoad = $resultRow->thesis_advising_load;
			$totalAdvisingLoad = $resultRow->total_advising_load;
			$totalSemesterLoad = $resultRow->total_semester_load;
			$semesterExcessLoad = $resultRow->semester_excess_load;
			
			//Mahder, you got everything you need for the report....ya i know not everything...but something!!
			//i need to know how many course are given by this particular instructor
			$countCoursesResult = InstructorLoad::getNumberOfCoursesGivenByThisInstructor($instructorId);
			$countCoursesResultRow = mysql_fetch_object($countCoursesResult);
			$howMany = $countCoursesResultRow->numberOfCourses;
			
			if($ctr % 2 == 0)
		   {
			  print("<tr style='background:#ded7fe' >");
			}
			else
			{
			  print("<tr style='background:#ecfdfe' >");
			}		
				print("<td rowspan='$howMany'>");
					print("<font size='2'>".$instructorId."</font>");
				print("</td>");
				
				print("<td>");
					print("<font size='2'>".$fullName."</font>");
				print("</td>");
				
				print("<td align='center'>");
					print("<font size='2'>".$academicUnitName."</font>");
				print("</td>");
				
				print("<td align='center'>");
					print("<font size='2'>".$normalCourseLoad."</font>");
				print("</td>");
				
				print("<td align='center'>");
					print("<font size='2'>".$additionalResponsibilityWaiver."</font>");
				print("</td>");
				
				print("<td align='center'>");
					print("<font size='2'>".$expectedSemesterLoad."</font>");
				print("</td>");
				
				print("<td>");
				//now get the course info like course number, crhr, lechr, labhr, tut hr, numofsec, tot numof stud, category, delv type
				$courseInfoResult = InstructorLoad::getCoursesGivenByThisInstructor($instructorId);
				//now at this point i know about how many courses are being given by this particular instructor
				while($courseInfoResultRow = mysql_fetch_object($courseInfoResult))
				{					
					$courseNumber = $courseInfoResultRow->course_number;
					$numberOfSections = $courseInfoResultRow->number_of_sections;
					$totalNumberOfStudents = $courseInfoResultRow->number_of_students;
					$category = $courseInfoResultRow->category;
					$type = $courseInfoResultRow->type;
					$courseDetailResult = CourseOffering::getCourseDetail($courseNumber);
					$courseDetailResultRow = mysql_fetch_object($courseDetailResult);
					$creditHour = $courseDetailResultRow->credit_hour;
					$lecHour = $courseDetailResultRow->lecture_hour;
					$labHour = $courseDetailResultRow->lab_hour;
					$tutorialHour = $courseDetailResultRow->tutorial_hour;
					
						
							print($courseNumber."<br/>");
						
					
				}
				print("</td>");
				
				
				print("<td align='center'>");
					print("<font size='2'>".$undergraduateCourseLoad."</font>");
				print("</td>");
				
				print("<td align='center'>");
					print("<font size='2'>".$postgraduateCourseLoad."</font>");
				print("</td>");
				
				print("<td align='center'>");
					print("<font size='2'>".$undergraduateAdvisingLoad."</font>");
				print("</td>");
				
				print("<td align='center'>");
					print("<font size='2'>".$postgraduateProjectAdvisingLoad."</font>");
				print("</td>");
				
				print("<td align='center'>");
					print("<font size='2'>".$thesisAdvisingLoad."</font>");
				print("</td>");
				
				print("<td align='center'>");
					print("<font size='2'>".$totalAdvisingLoad."</font>");
				print("</td>");
				
				print("<td align='center'>");
					print("<font size='2'>".$totalSemesterLoad."</font>");
				print("</td>");
				
				print("<td align='center'>");
					print("<font size='2'>".$semesterExcessLoad."</font>");
				print("</td>");
			print("</tr>");
			$ctr++;
		}//end while...loop
		
	print("</table>");
?>