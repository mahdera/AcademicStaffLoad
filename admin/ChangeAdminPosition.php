<?php
	$adminPositionId = $_REQUEST['adminPositionId'];
	include_once('../classes/AdminPosition.php');
	$adminPositionName = AdminPosition::getPositionNameFor($adminPositionId);
	print($adminPositionName);
?>