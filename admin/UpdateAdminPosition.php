<?php
	include_once("../classes/AdminPosition.php");
	$adminPositionId = $_POST['txtadminpositionid'];
	$adminPositionName = $_POST['txtadminpositionname'];
        $creditEquivalent = $_POST['txtcreditequivalent'];
	
	AdminPosition::updateAdminPosition($adminPositionId,$adminPositionName,$creditEquivalent);
	Header("Location: EditAdminPosition.php");
?>