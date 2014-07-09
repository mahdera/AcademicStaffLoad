<?php
	$courseNumber = $_REQUEST['courseNumber'];
	include_once('../classes/Course.php');
	include_once('../classes/AcademicUnit.php');
	$courseResult = Course::searchCourseByCourseNumber($courseNumber);	
	print("<table border='0' width='80%'>");		
		if(isset($courseResult)){
			print("<tr style='background:lightblue'>");
			print("<th>Course Number</th>");
			print("<th>Course Title</th>");			
			print("<th>Credit Hour</th>");		
			print("<th>Category</th>");	
			print("<th>Academic Unit</th>");					
		print("</tr>");
			$ctr=1;
			while($resultRow = mysql_fetch_object($courseResult)){
				if($ctr % 2 == 0)
				   print("<tr style='background:#ded7fe'>");				
				else				
					print("<tr style='background:#ecfdfe'>");	
					print("<td>$resultRow->course_number</td>");
					print("<td>$resultRow->course_title</td>");
					print("<td>$resultRow->credit_hour</td>");
					print("<td>$resultRow->category</td>");					
					$academicUnit = AcademicUnit::getAcademicUnit($resultRow->academic_unit_id);
					print("<td>$academicUnit->academic_unit_name</td>");
				print("</tr>");
				$ctr++;
			}//end while loop
		}else{
			print("<tr>");
				print("<td colspan='4'>No course found with course number: $courseNumber</td>");
			print("</tr>");
		}
	print("</table>");
?>