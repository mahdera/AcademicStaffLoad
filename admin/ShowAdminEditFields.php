<?php
	$id = $_REQUEST['id'];
	include_once('../classes/Administrator.php');	
	
	
	$adminObj = Administrator::getAdministrator($id);
	
	print("<table border='0' width='80%'>");
	print("<caption>Edit Admin Fields</caption>");		
		print("<tr>");
			print("<td align='right'>First Name</td>");
			print("<td>");
				print("<input type='hidden' name='hiddenid' id='hiddenid' value='$id'/>");
				print("<input type='text' name='txtfirstname' id='txtfirstname' value='$adminObj->firstName'/>");
			print("</td>");
			print("<td></td>");
		print("</tr>");
		print("<tr>");
			print("<td align='right'>Last Name</td>");
			print("<td>");
				print("<input type='text' name='txtlastname' id='txtlastname' value='$adminObj->lastName'/>");
			print("</td>");
			print("<td></td>");
		print("</tr>");
		print("<tr>");
			print("<td align='right'>Email</td>");
			print("<td>");
				print("<input type='text' name='txtemail' id='txtemail' value='$adminObj->email'/>");
			print("</td>");
			print("<td></td>");
		print("</tr>");		
		print("<tr>");
			print("<td colspan='3' align='center'>");
				?>
					<input type="button" value="Update" class="button" onclick="updateAdmin(document.getElementById('hiddenid').value,
					document.getElementById('txtfirstname').value,document.getElementById('txtlastname').value,
					document.getElementById('txtemail').value);"/>
					<input type="reset" value="Reset to default values" class="button"/>
				<?php
			print("</td>");
		print("</tr>");
	print("</table>");
?>