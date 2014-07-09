<?php
    @session_start();
    include_once('classes/DBConnection.php');//one step up in the directory
    //get the sent data from the form
    $email = $_POST['txtemail'];
    $username=$_POST['txtusername'];
    $password=$_POST['txtpassword'];
    ////now compare the passed values with the result stored in the database
    $query = "SELECT * FROM tblUser WHERE email='".$email."' AND pass_word='".MD5($password)."' AND userName='".$username."'";
    
    $result = DBConnection::readFromDatabase($query);
    $row = mysql_fetch_object($result);
    if($row != null){
        $fullName = $row->first_name." ".$row->last_name;
        $emailAddress = $row->email;
        $deptId = $row->academic_unit_id;    
    
        $_SESSION['full_name'] = $fullName;
        $_SESSION['email_address'] = $emailAddress; 
        $_SESSION['deptId'] = $deptId;   
    
        if($row){            
            ?>
                <script type="text/javascript">
                    document.location.href = "UserArea.php";
                </script>
            <?php
        }else{            
            ?>
                <script type="text/javascript">
                    document.location.href = "index.php";
                </script>
            <?php
        }
    }else{
        ?>
            <script type="text/javascript">
                document.location.href = "index.php";
            </script>
        <?php
    }

?>
