<table border="0" width="80%">
	<tr>
		<td>First Name</td>
		<td><input type="text" name="txtfirstname" id="txtfirstname"/></td>
		<td>Last Name</td>
		<td><input type="text" name="txtlastname" id="txtlastname"/></td>
		<td><input type="button" value="Search" class="button" onclick="searchInstructorByName(document.getElementById('txtfirstname').value,
		document.getElementById('txtlastname').value);"/></td>
	</tr>
</table>