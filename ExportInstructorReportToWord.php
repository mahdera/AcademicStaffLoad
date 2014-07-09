<?php
	require_once('msdocgenerator/clsMsDocGenerator.php');
	require_once('classes/DBConnection.php');
	//include_once('classes/Instructor.php');
	$deptId = $_SESSION['deptId'];	
	
		
	$doc = new clsMsDocGenerator();
	
	$doc->setFontFamily('Times New Roman');
	$doc->setFontSize('14');
	

	//$doc->addParagraph('Sample V');
	//$doc->addParagraph('');
	//$doc->newSession('LANDSCAPE');//changing the page setup layout of the document
	//$doc->addParagraph('table without grid borders and font changes');
	
	$doc->startTable(NULL, 'tableGrid');
	//now i need to set the table header. the headers are
	$header = array('Instructor Id', 'Full Name', 'Email', 'Mobile Phone', 'Academic Rank', 'Service Year', 'Specialization', 'Other Resp.');
	$aligns = array('center', 'center', 'center', 'center', 'center', 'center', 'center', 'center');
	$valigns = array('middle', 'middle', 'middle', 'middle', 'middle', 'middle', 'middle', 'middle');
	$doc->addTableRow($header, $aligns, $valigns, array('font-weight' => 'bold', 'font-size' => '12pt',
						'height' => '80pt', 'background-color' => 'lightblue'));
	
	//$allInstructorResult = Instructor::getAllInstructorsInThisAcademicUnit($deptId);
	$query = "SELECT * FROM tblInstructor WHERE academic_unit_id = $deptId";	
	$instructorResult = 	DBConnection::readFromDatabase($query);					
	//now its time to display the contents of the database to the word document	
	
	while($instructorResultRow = mysql_fetch_object($instructorResult))
	{			
			//now get the value from the database into php variables
			$instructorId =  $instructorResultRow->instructor_id;
			$fullName = $instructorResultRow->first_name." ".$instructorResultRow->last_name;
			$email = $instructorResultRow->email;
			$mobilePhone = $instructorResultRow->mobile_phone;
			$academicRank = $instructorResultRow->instructor_level;
			$serviceYear = $instructorResultRow->service_year;
			$specialization = $instructorResultRow->specialization;
			$otherResp = $instructorResultRow->other_responsibilities;
			//$doc->addTableRow($instructorId,NULL,NULL,NULL,NULL,NULL,NULL,NULL,array('font-size' => '10pt'));
			$varHolder = array($instructorId,$fullName,$email,$mobilePhone,$academicRank,$serviceYear,$specialization,$otherResp);
			$doc->addTableRow($varHolder,$aligns,$valigns, array('font-weight' => 'normal', 'font-size' => '12pt',
									'height' => '80pt', 'background-color' => 'yellow'));
			//$fullRow = $instructorId." ".$fullName." ".$email." ".$mobilePhone." ".$academicRank." ".$serviceYear." ".$specialization." ".$otherResp;
			//$varHolder = $fullRow;
			//$doc->addTableRow($varHolder, NULL, NULL, array('font-size' => '10pt'));
			//print($varHolder);
			//unset($varHolder);					
	}//end while loop
						
	/*for($row = 1; $row <= 3; $row++)
	{
		$cols = array();
		for($col = 1; $col <= 4; $col++)
		{
			$cols[] = "column $col; row $row";
		}
		$doc->addTableRow($cols, NULL, NULL, array('font-size' => '10pt'));
		unset($cols);
	}*/
	
	$doc->endTable();

	$doc->output();
?>