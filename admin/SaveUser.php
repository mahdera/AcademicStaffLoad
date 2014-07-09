<?php
	include_once("../classes/User.php");
   
   //now get the passed information from the caller page
   $academicUnitId = trim($_POST['slctacademicunit']);
   $instructorId = trim($_POST['txtinstructorid']);
   $firstName = trim($_POST['txtfirstname']);
   $lastName = trim($_POST['txtlastname']);
   $email = trim($_POST['txtemail']);
   $mobilePhone = trim($_POST['txtmobilephone']);
   $administrativePosition = trim($_POST['slctadministrativeposition']);
   $username = trim($_POST['txtusername']);
   $password = trim($_POST['txtpassword']);
   
   $userObj = new User($instructorId,$firstName,$lastName,$email,$mobilePhone,$academicUnitId,$administrativePosition,$username,$password);
   $userObj->addUser();   
   
   Header("Location: AddUser.php");   
?>