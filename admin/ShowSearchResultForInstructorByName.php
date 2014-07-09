<?php
	$firstName = $_REQUEST['firstName'];
	$lastName = $_REQUEST['lastName'];
	include_once('../classes/Instructor.php');
	include_once('../classes/AcademicUnit.php');
	$instructorResult = Instructor::searchInstructorByName($firstName,$lastName);
	print("<table border='0' width='80%'>");		
		if(isset($instructorResult)){
			print("<tr style='background:lightblue'>");
			print("<th>Id Number</th>");
			print("<th>Full Name</th>");			
			print("<th>Sex</th>");
			print("<th>Academic Rank</th>");
			print("<th>Academic Unit</th>");					
		print("</tr>");
			$ctr=1;
			while($resultRow = mysql_fetch_object($instructorResult)){
				if($ctr % 2 == 0)
				   print("<tr style='background:#ded7fe'>");				
				else				
					print("<tr style='background:#ecfdfe'>");	
					print("<td>$resultRow->instructor_id</td>");
					print("<td>$resultRow->first_name $resultRow->last_name</td>");
					print("<td>$resultRow->sex</td>");
					print("<td>$resultRow->instructor_level</td>");
					$academicUnit = AcademicUnit::getAcademicUnit($resultRow->academic_unit_id);
					print("<td>$academicUnit->academic_unit_name</td>");
				print("</tr>");
				$ctr++;
			}//end while loop
		}else{
			print("<tr>");
				print("<td colspan='4'>No instructor found with id number: $instructorId</td>");
			print("</tr>");
		}
	print("</table>");
?>