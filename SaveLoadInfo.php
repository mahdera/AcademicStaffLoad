<?php
	session_start();
	include_once("classes/DBConnection.php");
	include_once("classes/InstructorLoad.php");
	include_once("classes/Semester.php");
	
	
	$instructorId = trim($_POST['txtinstructorid']);
	$numberOfCourses = trim($_POST['txtnumberofcourses']);
	$academicUnitId = $_SESSION['deptId'];
	
	$semesterObj = Semester::getCurrentSemester();//getting the current academic year and semester
	$year = $semesterObj->academic_year;
	$semester = $semesterObj->semester;
	
	//now you need to get the values of the course grid
	for($i=0;$i<$numberOfCourses;$i++)
	{
		$selectCourse = "slctcourse".($i+1);		
		$textNumberOfSections = "txtnumberofsections".($i+1);
		$textNumberOfStudentsPerSection = "txtnumberofstudentspersection".($i+1);
		$textNumberOfStudents = "txtnumberofstudents".($i+1);		
		$selectType = "slcttype".($i+1);		
		$textAreaRemark = "textarearemark".($i+1);	
		
				
		$courseNumber = trim($_POST["$selectCourse"]);
		$numberOfSections = trim($_POST["$textNumberOfSections"]);
		$numberOfStudentsPerSection = trim($_POST["$textNumberOfStudentsPerSection"]);
		$numberOfStudents = trim($_POST["$textNumberOfStudents"]);
		//check if the three values are empty or not
		$numberOfSections = ($numberOfSections != "" ? $numberOfSections : 0.0);
		$numberOfStudentsPerSection = ($numberOfStudentsPerSection != "" ? $numberOfStudentsPerSection : 0.0);
		$numberOfStudents = ($numberOfStudents != "" ? $numberOfStudents : 0.0);
		$type = trim($_POST["$selectType"]);
		$remark = trim($_POST["$textAreaRemark"]);
		$query = "SELECT * FROM tblCourse WHERE course_number = '$courseNumber'";	
		$result = DBConnection::readFromDatabase($query);
		$resultRow = mysql_fetch_object($result);		
		$category = $resultRow->category;
		//now i need to create the instructorLoad object and save the info accordingly
		
		$instructorLoadObj = new InstructorLoad($instructorId,$courseNumber,$numberOfSections,$numberOfStudentsPerSection,$numberOfStudents,$type,$category,$semester,$year,$academicUnitId,$remark);
		$instructorLoadObj->addInstructorLoad();	
		///////
		///////////
		////////////here is the best loacation to save the info of AcademicLoad table
		
			
	}//end for loop
	//when doen, go back to the EnterLoadInfo.php
	Header("Location: EnterLoadInfo.php");
?>