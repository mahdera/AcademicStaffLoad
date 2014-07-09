<?php
	//first identify which courses are selected and the give the admin the chance to edit this list accordingly
	include_once('../classes/DBConnection.php');
	include_once('../classes/Course.php');
	include_once('../classes/CourseOffering.php');
	include_once('../classes/AcademicUnit.php');
	@session_start();
	$academicUnitId = $_SESSION['selectedAcademicUnitId'];
	$courseCtr = 1;
	
	//$allCourses = Course::getAllCourses();
	
	$valueOfCourseCounter = $_POST['txthowmanycourse'];
	
	//print("how many course: $valueOfCourseCounter<br/>");
	
	for($i=1; $i<=$valueOfCourseCounter; $i++)
	{
		$courseCheckBox = "chkrem".$i;		
		$courseCheckBox = trim($courseCheckBox);
		
		if(isset($_POST[$courseCheckBox]))//checking if the check box is checked or not
		{
			$selectedCourseNumber = $_POST[$courseCheckBox];
			//print($selectedCourseNumber."<br/>");passed
			//now get the course details of the selected course
			//print("selected course number: $selectedCourseNumber<br/>");
			$result = CourseOffering::getThisCourse($selectedCourseNumber);
			$resultRow = mysql_fetch_object($result);
			//here i need to check if the course is used in the course load calculation
			if(CourseOffering::isThisCourseCurrentlyUsedInLoadCalculation($selectedCourseNumber) == "true"){
				$_SESSION['courseToBeRemoved'] = $selectedCourseNumber;
				include_once('CourseCanNotBeRemoved.inc');
			}else{
				CourseOffering::deleteCourseOffering($selectedCourseNumber,$academicUnitId);
				Header("Location: ChooseCoursesToBeOffered.php");
			}
			//$courseOfferingObj = new CourseOffering($courseNumber,$courseTitle,$creditHour,$lectureHour,$labHour,$tutorialHour,$category,$academicUnitId,$totalNumberOfStudents);
			//$courseOfferingObj->addCourseOffering();			
		}//end if...condition
	}//end for...loop
	
?>