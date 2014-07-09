<?php
	$id = $_REQUEST['id'];
	include_once('../classes/ExpectedTeachingCommitmentRateLookup.php');
	$teachingCommitmentObj = ExpectedTeachingCommitmentRateLookup::getExpectedTeachingCommitmentRateLookup($id);
?>
<form>
<table border="0" width="80%">
	<tr>
		<td align="right">Percentage</td>
		<td><input type="text" name="txteditpercentage" id="txteditpercentage" value="<?php print($teachingCommitmentObj->percentage);?>"/></td>
	</tr>
	<tr>
		<td align="right">Expected Hour</td>
		<td><input type="text" name="txteditexpectedhour" id="txteditexpectedhour" value="<?php print($teachingCommitmentObj->expected_hour);?>"/></td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<input type="button" value="Update" class="button" onclick="updateTeachingCommitmentRateLookup(<?php print($id);?>,document.getElementById('txteditpercentage').value,
			document.getElementById('txteditexpectedhour').value);"/>
			<input type="reset" value="Reset to default values" class="button"/>
		</td>		
	</tr>
</table>
</form>