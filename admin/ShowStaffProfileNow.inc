<?php
	//what are the tables i need and do i need to create a class???no i dont think so
	//the list should include all staffs in the database!
	include_once('../classes/DBConnection.php');
	include_once('../classes/Instructor.php');
	include_once('../classes/Faculty.php');
	include_once('../classes/AcademicUnit.php');
	
	//first i need to read all the academic units and get the faculties in there
	$allAcademicUnitsResult = AcademicUnit::getAllAcademicUnits();
	print("<table border='0' width='100%'>");		
	while($allAcademicUnitsResultRow = mysql_fetch_object($allAcademicUnitsResult))
	{
		//now i need to get the name of the faculty for this specific academic unit
		$facultyId = $allAcademicUnitsResultRow->faculty_id;
		//print("the fac id : $facultyId<br/>");
		$facultyName = Faculty::getFacultyNameWithFacultyId($facultyId);
		//now get the name of the academic unit
		$academicUnitId = $allAcademicUnitsResultRow->id;
		$academicUnitName = $allAcademicUnitsResultRow->academic_unit_name;
		//now i need to read all the instructors in this specific academic unit
		$allInstructorsResult = Instructor::getInstructorsOfThisAcademicUnit($academicUnitId);
		//now i need to display all the instructors to the user of this module
		print("<tr style='background: #d8dfea'>");
			print("<th colspan='9'>Faculty : <u>$facultyName</u> <br/>Academic Unit: <u>$academicUnitName</u></th>");			
		print("</tr>");
		print("<tr style='background: lightblue'>");
			//print("<th>Faculty</th>");
			//print("<th>Academic Unit</th>");
			//print("<th>Instructor Id</th>");
			print("<th>#</th>");
			print("<th>Full Name</th>");
			print("<th>Sex</th>");
			print("<th>Qualification</th>");
			print("<th>Academic Rank</th>");
			print("<th>Status</th>");
			print("<th>Service Year</th>");
			print("<th>Specialization</th>");
			print("<th>Nationality</th>");
			//print("<th>Email</th>");
		print("</tr>");
		$ctr = 1;
		while($allInsructorsResultRow = mysql_fetch_object($allInstructorsResult))
		{			
			//now get the details of each instructor			 
			$instructorId = $allInsructorsResultRow->instructor_id;
			$fullName = $allInsructorsResultRow->first_name." ".$allInsructorsResultRow->last_name;
			$academicRank = $allInsructorsResultRow->instructor_level;
			$serviceYear = $allInsructorsResultRow->service_year;
			$specialization = $allInsructorsResultRow->specialization;
			$email = $allInsructorsResultRow->email;
			$sex = $allInsructorsResultRow->sex;
			$qualification = $allInsructorsResultRow->educational_qualification;
			$status = $allInsructorsResultRow->status;
			$nationality = $allInsructorsResultRow->nationality;
			
			if($ctr % 2 == 0)
		   {
			  print("<tr style='background:#ded7fe'>");
			}
			else
			{
			  print("<tr style='background:#ecfdfe'>");
			}	
				//print("<td>$facultyName</td>");
				//print("<td>$academicUnitName</td>");
				//print("<td>$instructorId</td>");
				print("<td>$ctr</td>");
				print("<td>$fullName</td>");
				print("<td>$sex</td>");
				print("<td>$qualification</td>");
				print("<td>$academicRank</td>");
				print("<td>$status</td>");
				print("<td>$serviceYear</td>");
				print("<td>$specialization</td>");
				print("<td>$nationality</td>");
			print("</tr>");
			$ctr++;
		}//end all instructors while...loop
		
	}//end academic unit while loop
	print("</table>");
?>