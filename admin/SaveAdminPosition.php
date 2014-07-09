<?php
	include_once("../classes/AdminPosition.php");
   
   //now get the passed information from the caller page
   $adminPositionName = trim($_POST['txtadminpositionname']);
   $equivalentCredit = trim($_POST['txtequivalentcredit']);
   
   $adminPositionObj = new AdminPosition($adminPositionName,$equivalentCredit);
   $adminPositionObj->addAdminPosition();
   Header("Location: AddAdminPosition.php");
?>