<?php
	include_once("../classes/CollegeUser.php");   
   //now get the passed information from the caller page
   $facultyId = trim($_POST['slctfaculty']);
   $instructorId = trim($_POST['txtinstructorid']);
   $firstName = trim($_POST['txtfirstname']);
   $lastName = trim($_POST['txtlastname']);
   $email = trim($_POST['txtemail']);
   $mobilePhone = trim($_POST['txtmobilephone']);
   $administrativePosition = trim($_POST['slctadministrativeposition']);
   $username = trim($_POST['txtusername']);
   $password = trim($_POST['txtpassword']);
   
   $collegeUserObj = new CollegeUser($instructorId,$firstName,$lastName,$email,$mobilePhone,$facultyId,$administrativePosition,$username,$password);
   $collegeUserObj->addUser();   
   
   Header("Location: AddCollegeUser.php");   
?>