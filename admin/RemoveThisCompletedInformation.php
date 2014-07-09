<?php
	$loadInformationId = $_REQUEST['loadInformationId'];
	include('../classes/CompletedLoadInformation.php');
	CompletedLoadInformation::deleteCompletedLoadInformation($loadInformationId);	
	include('ShowListOfAcademicUnitsWhoCompletedLoadInformationForEdit.php');
	print("<strong><font color='green' size='+1'>Information removed successfully!</font></strong>");
?>