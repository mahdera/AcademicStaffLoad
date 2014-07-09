<?php
	include_once("../classes/AdminPosition.php");
	
	$adminPosId = $_GET['id'];
	AdminPosition::deleteAdminPosition($adminPosId);
	Header("Location: DeleteAdminPosition.php");
?>