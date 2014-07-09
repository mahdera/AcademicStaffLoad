<?php
	include_once("../classes/AcademicRank.php");
   
   //now get the passed information from the caller page
   $rankName = trim($_POST['txtacademicrank']);   
   
   $rankObj = new AcademicRank($rankName);
   $rankObj->addAcademicRank();
   Header("Location: AddAcademicRank.php"); 
?>