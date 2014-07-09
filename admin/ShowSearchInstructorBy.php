<?php
	$fieldName = $_REQUEST['fieldName'];
	if($fieldName == "Id"){
		include_once('AcceptIdOfInstructorForSearch.inc');
	}else if($fieldName == "Name"){
		include_once('AcceptFirstAndLastNameOfInstructorForSearch.inc');
	}	
?>