<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Academic Staff Load Managment System</title>
        <link rel="stylesheet" href="../style/Underground.css" />
        <script src="../js/js_script.js"></script>
        <link rel="shortcut icon" href="images/campus.jpeg"/>
        <script language="javascript">
        		function isBlank()
        		{        			
        			if(document.getElementById("txtfirstname").value=="")
        			{
        				document.getElementById("errorMsg").innerHTML = "Enter the first name of the instructor!";
        				document.getElementById("txtfirstname").focus();
        				document.getElementById("txtfirstname").style.borderColor="red";        				
        				return false;
        			}
        			else if(document.getElementById("txtlastname").value=="")
        			{
        				document.getElementById("errorMsg").innerHTML = "Enter the last name of the instructor!";
        				document.getElementById("txtlastname").focus();
        				document.getElementById("txtlastname").style.borderColor="red";        				
        				return false;
        			}
        			else if(document.getElementById("txtemail").value=="")
        			{
	        			document.getElementById("errorMsg").innerHTML = "Enter the email of the instructor!";
        				document.getElementById("txtemail").focus();
        				document.getElementById("txtemail").style.borderColor="red";        				
        				return false;
        			}        			
        			else if(document.getElementById("txtusername").value=="")
        			{
        				document.getElementById("errorMsg").innerHTML = "Enter the username!";
        				document.getElementById("txtusername").focus();
        				document.getElementById("txtusername").style.borderColor="red";        				
        				return false;
        			}
        			else if(document.getElementById("txtpassword").value=="")
        			{
        				document.getElementById("errorMsg").innerHTML = "Enter the password!";
        				document.getElementById("txtpassword").focus();
        				document.getElementById("txtpassword").style.borderColor="red";        				
        				return false;
        			}
        			else if(document.getElementById("txtrepassword").value=="")
        			{
        				document.getElementById("errorMsg").innerHTML = "Retype the password!";
        				document.getElementById("txtrepassword").focus();
        				document.getElementById("txtrepassword").style.borderColor = "red";
        				return false;
        			}
        			else
        				return true;
        		}
        		
        	  function checkAndChangeColor(str,id)
           {
           		if(str != "")
           		{
           			document.getElementById("errorMsg").innerHTML = "";
           			document.getElementById(id).style.borderColor="black";
           		}
           }
        </script>
    </head>
    <body>
<?php   
    @session_start();
    $sessName = $_SESSION['admin_name'];
    //check if the session variable is set
    if(isset($sessName))
    {
?>
 <div id="wrap">
 				<?php
        			require('../IndexHeader.inc');
        		?>
        		
            <?php
            	include('AdminSidebar.inc');
				?>            
            
            <div id="indexmain"> 
            	<?php            		
            		include_once("../classes/DBConnection.php");
            		include_once("../classes/AdminPosition.php");
            		$query = "SELECT * FROM tblFaculty";
            		$result = DBConnection::readFromDatabase($query);            		
            	?>  
            	           
					<form name="frmadduser" method="post" action="SaveAdministrator.php" onsubmit="return isBlank();">
						<br/><br/>
						
						<div id="errorMsg"></div>
						<table width="80%">
						<caption>Add Administrator</caption>						
							<tr>
								<td align="right">
									First Name
								</td>
								<td align="left">
									<input type="text" name="txtfirstname" id="txtfirstname" onblur="checkAndChangeColor(this.value,id);"/>
								</td>								
							</tr>
							<tr>
								<td align="right">
									Last Name
								</td>
								<td align="left">
									<input type="text" name="txtlastname" id="txtlastname" onblur="checkAndChangeColor(this.value,id);"/>
								</td>								
							</tr>
							<tr>
								<td align="right">
									email
								</td>
								<td align="left">
									<input type="text" name="txtemail" id="txtemail" onblur="checkAndChangeColor(this.value,id);"/>
								</td>								
							</tr>						
							<tr>
								<td align="right">
									Username
								</td>
								<td align="left">
									<input type="text" name="txtusername" id="txtusername" onblur="checkAndChangeColor(this.value,id);"/>
								</td>								
							</tr>
							<tr>
								<td align="right">
									Password
								</td>
								<td align="left">
									<input type="password" name="txtpassword" id="txtrepassword" onblur="checkAndChangeColor(this.value,id);"/>
								</td>								
							</tr>
							<tr>
								<td align="right">
									Re-type password
								</td>
								<td align="left">
									<input type="password" name="txtrepassword" id="txtpassword" onblur="checkAndChangeColor(this.value,id);"/>
								</td>								
							</tr>
							<tr>
								<td>
								</td>
								<td>
									<input type="submit" value="Add" class="button"/>
									<input type="reset" value="Clear" class="button"/>
								</td>
							</tr>
						</table>
						<br/><br/><br/><br/><br/><br/><br/>
					</form>			
            </div><!----all forms in this div-->

                
           
<?php
    require('../Footer.inc');
?>
    </body>
    </html>
    <?php
            }
            else
            {
                echo "ur session has expired";
            }
 ?>

