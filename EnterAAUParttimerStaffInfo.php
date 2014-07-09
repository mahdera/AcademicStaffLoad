<?php
	@session_start();
	include_once("classes/DBConnection.php");
	include_once("classes/Parttimer.php");
	include_once("classes/AcademicRank.php");
	
	print("<form name='frmregisterparttimer' method='post' action='SaveAAUParttimer.php'>");
	
	print("<table border='0' width='100%'>");
	print("<caption style='background:lightblue'>AAU Parttimer Information</caption>");
		print("<tr>");
			print("<td>");
				print("First Name");
			print("</td>");			
			print("<td>");
				print("<input type='text' name='txtfirstname' size='12'/>");
			print("</td>");
			
			print("<td>");
				print("Email");
			print("</td>");			
			print("<td>");
				print("<input type='text' name='txtemail' size='12'/>");
			print("</td>");
			
			print("<td>");
				print("Academic Rank");
			print("</td>");			
			print("<td>");
					$resultRank = AcademicRank::getAllAcademicRanks();
					print("<select name='slctinstructorlevel' onChange='checkAndChangeColor(this.value,id)'>");
					print("<option value='' selected='selected'>--Select--</option>");
					while($resultRankRow = mysql_fetch_object($resultRank))
					{
						print("<option value='$resultRankRow->rank_name'>$resultRankRow->rank_name</option>");
					}//end while
					print("</select>");
			print("</td>");
			print("</tr>");
			print("<tr>");
				print("<td>");
					print("Last Name");
				print("</td>");			
				print("<td>");
					print("<input type='text' name='txtlastname' size='12'/>");
				print("</td>");
				
				print("<td>");
					print("Mobile Phone");
				print("</td>");			
				print("<td>");
					print("<input type='text' name='txtmobilephone' size='12'/>");
				print("</td>");
				
				print("<td>");
					print("Specialization");
				print("</td>");			
				print("<td>");
					print("<input type='text' name='txtspecialization' size='12'/>");
				print("</td>");
			print("</tr>");
			print("<tr>");
				print("<td>");
					print("Id Number");
				print("</td>");
				print("<td>");
					print("<input type='text' name='txtidnumber' size='12'/>");
				print("</td>");
			print("</tr>");
			print("<tr>");
				print("<td colspan='6' align='right'>");
					print("<input type='submit' value='Add' class='button'/>");
				print("</td>");
			print("</tr>");			
		print("</table>");
	print("</form>");
	//now display only parttimers that belong to this academic unit or department
	//get the academic unit from the session variable
	$academicUnitId = $_SESSION['deptId'];
	$query = "SELECT * FROM tblParttimer WHERE academic_unit_id = '$academicUnitId'";
	$result = DBConnection::readFromDatabase($query);
	
	
	print("<table border='0' width='100%'>");
	print("<caption style='background: lightblue'>List of Registered Parttmers</caption>");
	print("<tr style='background:lightblue'>");
			print("<td align='center'>");
				print("<font size='2'><strong>Parttimer Id</strong></font>");
			print("</td>");
			
			print("<td align='center'>");
				print("<font size='2'><strong>Full Name</strong></font>");
			print("</td>");
			
			print("<td align='center'>");
				print("<font size='2'><strong>Email</strong></font>");
			print("</td>");
			
			print("<td align='center'>");
				print("<font size='2'><strong>Academic Rank</strong></font>");
			print("</td>");
			
			print("<td align='center'>");
				print("<font size='2'><strong>Mobile Phone</strong></font>");
			print("</td>");
			
			print("<td align='center'>");
				print("<font size='2'><strong>Specialization</strong></font>");
			print("</td>");
			
			print("<td align='center'>");
				print("<font size='2'><strong>Organization</strong></font>");
			print("</td>");
		print("</tr>");
	$ctr = 1;
	while($resultRow = mysql_fetch_object($result))
	{
		   if($ctr % 2 == 0)
		   {
			  print("<tr style='background:#ded7fe'>");
			}
			else
			{
			  print("<tr style='background:#ecfdfe'>");
			}
			print("<td>");
				print("<font size='2'>".$resultRow->parttimer_id."</font>");
			print("</td>");
								
			print("<td>");
				print("<font size='2'>".$resultRow->first_name." ".$resultRow->last_name."</font>");			
			print("</td>");
			
			print("<td>");
				print("<font size='2'>".$resultRow->email."</font>");
			print("</td>");
			
			print("<td>");
				print("<font size='2'>".$resultRow->instructor_level."</font>");
			print("</td>");
			
			print("<td>");
				print("<font size='2'>".$resultRow->mobile_phone."</font>");
			print("</td>");
			
			print("<td>");
				print("<font size='2'>".$resultRow->specialization."</font>");
			print("</td>");
			
			print("<td>");
				print("<font size='2'>".$resultRow->organization."</font>");
			print("</td>");		
		print("</tr>");
		$ctr++;
	}
	print("</table>");
?>