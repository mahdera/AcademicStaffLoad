<?php
	//first identify which courses are selected and the give the admin the chance to edit this list accordingly
	include_once('../classes/DBConnection.php');
	include_once('../classes/Course.php');
	include_once('../classes/CourseOffering.php');
	
	$courseCtr = 1;
	
	//$allCourses = Course::getAllCourses();
	
	$valueOfCourseCounter = trim($_POST['txthowmanycourse']);
	
	//print("how many course: $valueOfCourseCounter<br/>");
	
	for($i=1; $i<=$valueOfCourseCounter; $i++)
	{
		$courseCheckBox = "chk".$i;		
		$courseCheckBox = trim($courseCheckBox);
		
		if(isset($_POST[$courseCheckBox]))
		{
			$selectedCourseNumber = trim($_POST[$courseCheckBox]);
			//print($selectedCourseNumber."<br/>");//passed
			//now get the course details of the selected course
			//print("selected course number: $selectedCourseNumber<br/>");
			$result = Course::getThisCourse($selectedCourseNumber);
			$resultRow = mysql_fetch_object($result);
			//now save this information to the tblCourseOffering table
			$courseNumber = $resultRow->course_number;
			$courseTitle = $resultRow->course_title;
			$creditHour = $resultRow->credit_hour;
			$lectureHour = $resultRow->lecture_hour;
			$labHour = $resultRow->lab_hour;
			$tutorialHour = $resultRow->tutorial_hour;
			$category = $resultRow->category;
			$academicUnitId = $resultRow->academic_unit_id;
			$totalNumberOfStudents = $resultRow->total_number_of_students;
			//now create the respective CourseOffering object
			$courseOfferingObj = new CourseOffering($selectedCourseNumber,$courseTitle,$creditHour,$lectureHour,$labHour,$tutorialHour,$category,$academicUnitId,$totalNumberOfStudents);
			$courseOfferingObj->addCourseOffering();			
		}//end if...condition
	}//end for...loop
	Header("Location: ChooseCoursesToBeOffered.php");
?>