<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    session_start();
    include_once('classes/DBConnection.php');//one step up in the directory
    //get the sent data from the form
    $email = $_POST['txtemail'];
    $username=$_POST['txtusername'];
    $password=$_POST['txtpassword'];
    ////now compare the passed values with the result stored in the database
    $query = "SELECT * FROM tblCollegeUser WHERE email='".$email."' AND pass_word='".MD5($password)."' AND userName='".$username."'";
    //print($query);    
    $result = DBConnection::readFromDatabase($query);
    $row = mysql_fetch_object($result);

    $fullName = $row->first_name." ".$row->last_name;
    $emailAddress = $row->email;
    $facultyId = $row->faculty_id;    

    $_SESSION['full_name'] = $fullName;
    $_SESSION['email_address'] = $emailAddress; 
    $_SESSION['facultyId'] = $facultyId;   

    if($row)
    {
        header("location: CollegeUserArea.php");
    }
    else
    {
        header("location: index.php");
    }

?>
