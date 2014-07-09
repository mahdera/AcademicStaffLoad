<?php
	$instructorId = $_REQUEST['instructorId'];
	include_once('../classes/CollegeUser.php');
	include_once('../classes/AdminPosition.php');
	include_once('../classes/Faculty.php');
	
	$collegeUserObj = CollegeUser::getCollegeUser($instructorId);
	print("<table border='0' width='80%'>");
		print("<tr>");
			print("<td>Instructor Id</td>");
			print("<td>");
				print($collegeUserObj->instructor_id);
				print("<input type='hidden' name='hiddeninstructorid' id='hiddeninstructorid' value='$collegeUserObj->instructor_id'/>");
			print("</td>");
			print("<td></td>");
		print("</tr>");
		print("<tr>");
			print("<td>First Name</td>");
			print("<td>");
				print("<input type='text' name='txtfirstname' id='txtfirstname' value='$collegeUserObj->first_name'/>");
			print("</td>");
			print("<td></td>");
		print("</tr>");
		print("<tr>");
			print("<td>Last Name</td>");
			print("<td>");
				print("<input type='text' name='txtlastname' id='txtlastname' value='$collegeUserObj->last_name'/>");
			print("</td>");
			print("<td></td>");
		print("</tr>");
		print("<tr>");
			print("<td>Email</td>");
			print("<td>");
				print("<input type='text' name='txtemail' id='txtemail' value='$collegeUserObj->email'/>");
			print("</td>");
			print("<td></td>");
		print("</tr>");
		print("<tr>");
			print("<td>Mobile Phone</td>");
			print("<td>");
				print("<input type='text' name='txtmobilephone' id='txtmobilephone' value='$collegeUserObj->mobile_phone'/>");
			print("</td>");
			print("<td></td>");
		print("</tr>");
		print("<tr>");
			print("<td>Faculty</td>");
			print("<td>");
				//now get the name of the faculty
				$facultyName = Faculty::getFacultyNameWithFacultyId($collegeUserObj->faculty_id);
				print("<input type='text' name='txtfaculty' id='txtfaculty' value='$facultyName'/>");
			print("</td>");
			print("<td>");
				//now get all faculties so that the admin can choose among the list of faculties
				$facultyList = Faculty::getAllFaculties();
				print("<select name='slctfaculty' id='slctfaculty' style='width:50%' onchange='changeFaculty(this.value);'>");
					print("<option value='' selected='selected'>--Select--</option>");
					while($facultyListRow = mysql_fetch_object($facultyList)){
						print("<option value='$facultyListRow->id'>$facultyListRow->faculty_name</option>");
					}
				print("</select>");
				print("<input type='hidden' name='hiddenfacultyid' id='hiddenfacultyid' value='$collegeUserObj->faculty_id'/>");
			print("</td>");
		print("</tr>");
		print("<tr>");
			print("<td>Administrative Position</td>");
			print("<td>");
				//now get the name of the admin position
				$adminPositionName = AdminPosition::getPositionNameFor($collegeUserObj->administrative_position);
				print("<input type='text' name='txtadminposition' id='txtadminposition' value='$adminPositionName'/>");
			print("</td>");
			print("<td>");
				//now get all admin positions from the database
				$adminPositionList = AdminPosition::getAllAdminPositions();
				print("<select name='slctadminposition' id='slctadminposition' onchange='changeAdminPosition(this.value);'>");
					print("<option value='' selected='selected'>--Select--</option>");
					while($adminPositionListRow = mysql_fetch_object($adminPositionList)){
						print("<option value='$adminPositionListRow->id'>$adminPositionListRow->admin_position_name</option>");
					}
				print("</select>");
				print("<input type='hidden' name='hiddenadminpositionid' id='hiddenadminpositionid' value='$collegeUserObj->administrative_position'/>");
			print("</td>");
		print("</tr>");
		print("<tr>");
			print("<td colspan='3' align='center'>");
				?>
					<input type="button" value="Update" class="button" onclick="updateCollegeUser(document.getElementById('hiddeninstructorid').value,
					document.getElementById('txtfirstname').value,document.getElementById('txtlastname').value,
					document.getElementById('txtemail').value,document.getElementById('txtmobilephone').value,
					document.getElementById('hiddenfacultyid').value,document.getElementById('hiddenadminpositionid').value);"/>
					<input type="reset" value="Reset to default values" class="button"/>
				<?php
			print("</td>");
		print("</tr>");
	print("</table>");
?>