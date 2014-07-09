<hr/>
<?php
	$instId = $_REQUEST['instructorId'];
	include_once('../classes/User.php');
	$userObj = User::getUser($instId);
	print("<form>");
		print("<table border='0' width='80%'>");
			print("<tr>");
				print("<td align='right'>Instructor Id</td>");
				print("<td></td>");
				print("<td>$userObj->instructor_id</td>");
			print("</tr>");
			print("<tr>");
				print("<td align='right'>First Name</td>");
				print("<td></td>");
				print("<td>$userObj->first_name</td>");
			print("</tr>");
			print("<tr>");
				print("<td align='right'>Last Name</td>");
				print("<td></td>");
				print("<td>$userObj->last_name</td>");
			print("</tr>");			
			print("<tr>");
				print("<td align='right'>Email</td>");
				print("<td></td>");
				print("<td>$userObj->email</td>");
			print("</tr>");			
			print("<tr>");
				print("<td align='right'>Mobile Phone</td>");
				print("<td></td>");
				print("<td>$userObj->mobile_phone</td>");
			print("</tr>");			
			print("<tr>");
				print("<td align='right'>Username</td>");
				print("<td></td>");
				print("<td><input type='text' name='txtusername' id='txtusername' value='$userObj->username'/></td>");
			print("</tr>");
			print("<tr>");
				print("<td align='right'>New Password</td>");
				print("<td></td>");
				print("<td><input type='password' name='txtnewpassword' id='txtnewpassword' /></td>");
			print("</tr>");
			print("<tr>");
				print("<td align='right'>Confirm Password</td>");
				print("<td></td>");
				print("<td><input type='password' name='txtconfirmpassword' id='txtconfirmpassword' /></td>");
			print("</tr>");
			print("<tr>");
				print("<td colspan='3'>");
					print("<div id='errorDiv'></div>");
				print("</td>");
			print("</tr>");
			print("<tr>");
				print("<td colspan='3' align='center'>");
				?>
					<input type="button" value="Reset Account" class="button" onclick="resetThisAccount(<?php print($instId);?>,document.getElementById('txtusername').value,
					document.getElementById('txtnewpassword').value,document.getElementById('txtconfirmpassword').value);"/>
				<?php
					print("<input type='reset' value='Clear All' class='button'/>");
				print("</td>");
			print("</tr>");
		print("</table>");
	print("</form>");
?>