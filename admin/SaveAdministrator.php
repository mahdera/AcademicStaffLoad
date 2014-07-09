<?php
	include_once("../classes/Administrator.php");   
   //now get the passed information from the caller page  
   $firstName = trim($_POST['txtfirstname']);
   $lastName = trim($_POST['txtlastname']);
   $email = trim($_POST['txtemail']);  
   $username = trim($_POST['txtusername']);
   $password = trim($_POST['txtpassword']);
   
   $administratorObj = new Administrator($firstName,$lastName,$email,$username,$password);
   $administratorObj->addAdministrator();     
   
   Header("Location: AddAdministrator.php");   
?>