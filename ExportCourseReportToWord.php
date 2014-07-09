<?php
	@session_start();
	require_once('msdocgenerator/clsMsDocGenerator.php');
	require_once('classes/DBConnection.php');
	//include_once('classes/Instructor.php');
	$deptId = $_SESSION['deptId'];	
	
		
	$doc = new clsMsDocGenerator();
	
	$doc->setFontFamily('Times New Roman');
	$doc->setFontSize('14');	
	
	$doc->startTable(NULL, 'tableGrid');
	//now i need to set the table header. the headers are
	$header = array('Course Number', 'Course Title', 'Credit Hour', 'Lecture Hour', 'Lab Hour', 'Tutorial Hour', 'Category', 'Total Number of Students');
	$aligns = array('center', 'center', 'center', 'center', 'center', 'center', 'center', 'center');
	$valigns = array('middle', 'middle', 'middle', 'middle', 'middle', 'middle', 'middle', 'middle');
	$doc->addTableRow($header, $aligns, $valigns, array('font-weight' => 'bold', 'font-size' => '12pt',
						'height' => '80pt', 'background-color' => 'lightblue'));
	
	//$allInstructorResult = Instructor::getAllInstructorsInThisAcademicUnit($deptId);
	$query = "SELECT * FROM tblCourse WHERE academic_unit_id = $deptId";	
	$courseResult = 	DBConnection::readFromDatabase($query);					
	//now its time to display the contents of the database to the word document	
	
	while($courseResultRow = mysql_fetch_object($courseResult))
	{			
			//now get the value from the database into php variables
			$courseNumber =  $courseResultRow->course_number;
			$courseTitle = $courseResultRow->course_title;
			$creditHour = $courseResultRow->credit_hour;
			$lectureHour = $courseResultRow->lecture_hour;
			$labHour = $courseResultRow->lab_hour;
			$tutorialHour = $courseResultRow->tutorial_hour;
			$category = $courseResultRow->category;
			$totalNumberOfStudents = $courseResultRow->total_number_of_students;
			
			//$doc->addTableRow($instructorId,NULL,NULL,NULL,NULL,NULL,NULL,NULL,array('font-size' => '10pt'));
			$varHolder = array($courseNumber,$courseTitle,$creditHour,$lectureHour,$labHour,$tutorialHour,$category,$totalNumberOfStudents);
			$doc->addTableRow($varHolder,$aligns,$valigns, array('font-weight' => 'normal', 'font-size' => '12pt',
									'height' => '80pt', 'background-color' => 'yellow'));						
	}//end while loop
		
	
	$doc->endTable();

	$doc->output();
?>