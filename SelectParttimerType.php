<?php
	print("<table border='0'>");
		print("<tr>");
			print("<td>");
				print("Select Parttimer Type:");
			print("</td>");
			print("<td>");
				print("<select name='slctparttimertype' id='slctparttimertype' onchange='showSpecificParttimerDataEntry(this.value);'>");
					print("<option value='' selected='selected'>--Select--</option>");
					print("<option value='AAU Parttimer'>AAU Parttimer</option>");
					print("<option value='External Parttimer'>External Parttimer</option>");
				print("</select>");	
			print("</td>");
		print("</tr>");
	print("</table>");
?>