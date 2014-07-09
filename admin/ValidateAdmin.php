<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    @session_start();
    include_once('../classes/DBConnection.php');//one step up in the directory
    //get the sent data from the form
    $email = $_POST['txtemail'];
    $adminName=$_POST['txtadminname'];
    $password=$_POST['txtpassword'];
    ////now compare the passed values with the result stored in the database
    $query = "SELECT * FROM tblAdmin WHERE email='".$email."' AND pass_word='".MD5($password)."' AND userName='".$adminName."'";
    //print($query);
    $result = DBConnection::readFromDatabase($query);
    $row = mysql_fetch_object($result);

    $adminName = $row->firstName;
    $emailAddress = $row->email;    

    $_SESSION['admin_name'] = $adminName;
    $_SESSION['email_address'] = $emailAddress;
    

    if($row){        
        ?>
            <script type="text/javascript">
                document.location.href = "AdminArea.php";
            </script>
        <?php
    }else{        
        ?>
            <script type="text/javascript">
                document.location.href = "AdminLogin.php";
            </script>
        <?php
    }

?>
