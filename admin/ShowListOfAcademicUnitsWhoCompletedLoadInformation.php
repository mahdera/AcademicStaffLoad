<?php	
	include_once('../classes/CompletedLoadInformation.php');
	include_once('../classes/AcademicUnit.php');
	$result = CompletedLoadInformation::getAllCompetedLoadInformationForTheCurrentAcademicYear();
	print("<table border='0' width='80%'>");
		print("<tr style='background:lightblue'>");
			print("<th>Academic Unit</th>");				
			print("<th>Academi Year</th>");
			print("<th>Semester</th>");
			print("<th>Date Completed</th>");
		print("</tr>");
		$ctr = 1;		 				
			while($resultRow = mysql_fetch_object($result)){				
				$academicUnitObj = AcademicUnit::getAcademicUnit($resultRow->academic_unit_id);
				if($ctr % 2 == 0)
				   print("<tr style='background:#ded7fe'>");				
				else				
					print("<tr style='background:#ecfdfe'>");									
				print("<td>$academicUnitObj->academic_unit_name</td>");
				print("<td>$resultRow->academic_year</td>");
				print("<td>$resultRow->semester</td>");
				$datetime = strtotime($resultRow->date_completed);
				//$mysqldate = date("m/d/y g:i A", $datetime);....for የኔታlearningPlatform!
				$mysqldate = date("D dS M,Y h:i a",$datetime);
				print("<td>$mysqldate</td>");
				print("</tr>");
				$ctr++;
			}
		
	print("</table>");
?>