<div id="accountsInThisAcademicUnitDiv">
<?php
	$academicUnitId = $_REQUEST['academicUnitId'];
	include_once('../classes/AcademicUnit.php');
	include_once('../classes/User.php');
	$academicUnitObj = AcademicUnit::getAcademicUnit($academicUnitId);
	//now get all users registered in this AcademicUnit
	$userResult = User::getAllUsersInThisAcademicUnit($academicUnitId);
	print("<table border='0' width='80%'>");
		print("<tr style='background:lightblue'>");
			print("<th>Instructor Id</th>");
			print("<th>First Name</th>");
			print("<th>Last Name</th>");			
			print("<th>Email</th>");	
			print("<th>Username</th>");					
			print("<th>Edit</th>");
		print("</tr>");
		$index = 1;
		while($userResultRow = mysql_fetch_object($userResult)){
				if($index % 2 == 0)
						print("<tr style='background:#ded7fe'>");				
				else				
						print("<tr style='background:#ecfdfe'>");		
				print("<td>$userResultRow->instructor_id</td>");
				print("<td>$userResultRow->first_name</td>");
				print("<td>$userResultRow->last_name</td>");
				print("<td>$userResultRow->email</td>");
				print("<td>$userResultRow->username</td>");
				print("<td align='center'><a href='#.php' onclick='showEditFieldsOfUser($userResultRow->instructor_id);'><img src='images/edit.gif' border='0' align='absmiddle'/></a></td>");
			print("</tr>");
			$index++;
		}
	print("</table>");
?>
<div id="editAccountsDiv"></div>
</div>
