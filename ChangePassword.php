<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Academic Staff Load Managment System</title>
        <link rel="stylesheet" href="style/Underground.css" />
        <script src="../js/js_script.js"></script>
        <link rel="shortcut icon" href="images/campus.jpeg"/>
        
        <style type="text/css">
			.main {
			/*width:219px;*/
			width:100%;
			/*border:1px solid black;*/
			border:0px solid black;
			}
			
			.month {
			background-color:black;
			font:bold 12px verdana;
			color:white;
			}
			
			.daysofweek {
			background-color:#CCCCCC;
			font:bold 9px verdana;
			color:blue;
			}
			
			.days {
			font-size: 9px;
			font-family:verdana;
			color:black;
			/*background-color:#EAEAFF;*/
			background-color:#FAFAFA;
			padding: 1px;
			}
			
			.days #today{
			font-weight: bold;
			color:red;
			background-color:#CCCCCC;
			}                                               
		 </style>
		 <script type="text/javascript" src="js_files/basiccalendar.js"></script>
		 
		 <script type="text/javascript" language="javascript">
		 	function isUpdateBlank()
		 	{
		 		if(document.getElementById("txtcurrentusername").value=="")
		 		{
		 			alert("Enter the current username!");
		 			document.getElementById("txtcurrentusername").focus();
		 			return false;
		 		}
		 		else if(document.getElementById("txtnewusername").value=="")
		 		{
		 			alert("Enter the new username");
		 			document.getElementById("txtnewusername").focus();
		 			return false;
		 		}
		 		else 
		 			return true;
		 	}
		 </script>
    </head>
    
    <body>
<?php   
    @session_start();
    $sessName = $_SESSION['full_name'];
    //check if the session variable is set
    if(isset($sessName))
    {
?>
 <div id="wrap">
 				<?php
        			require('IndexHeader.inc');
        		?>
        		
            <?php
            	include('UserSidebar.inc');
				?>            
            
            <div id="indexmain">              
					<?php
						include('InnerStatusBar.inc');
						print("<hr/>");
						include('ManageMyAccountInnerMenu.inc');						
					?>					
					<!--now enter the username modification module in here-->
					<form name="changepassword" method="post" action="UpdatePassword.php" onsubmit="return isUpdateBlank();">
						<table border="0" width="80%">
							<tr>
								<td align="right">
									Enter Email
								</td>
								<td>
									<input type="text" name="txtemail"/>
								</td>
							</tr>
							<tr>
								<td align="right">
									Enter current username
								</td>
								<td>
									<input type="text" name="txtusername"/>
								</td>
							</tr>
							<tr>
								<td align="right">
									Enter the current password
								</td>
								<td>
									<input type="password" name="txtcurrentpassword"/>
								</td>
							</tr>
							<tr>
								<td align="right">
									Enter the new password
								</td>
								<td>
									<input type="password" name="txtnewpassword"/>
								</td>
							</tr>
							<tr>
								<td>
								</td>
								<td>
									<input type="submit" value="Update" class="button"/>
									<input type="reset" value="Clear" class="button"/>
								</td>
							</tr>
						</table>
					</form>
            </div><!----all forms in this div-->

                
           
<?php
    require('Footer.inc');
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
