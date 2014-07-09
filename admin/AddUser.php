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
        			if(document.getElementById("slctacademicunit").value=="")
        			{        				
        				document.getElementById("errorMsg").innerHTML = "Select the academic unit!";
        				document.getElementById("slctacademicunit").focus();
        				document.getElementById("slctacademicunit").style.borderColor="red";        				
        				return false;
        			}
        			else if(document.getElementById("txtinstructorid").value=="")
        			{
        				document.getElementById("errorMsg").innerHTML = "Enter the instructor id!";
        				document.getElementById("txtinstructorid").focus();
        				document.getElementById("txtinstructorid").style.borderColor="red";        				
        				return false;
        			}
        			else if(document.getElementById("txtfirstname").value=="")
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
        			else if(document.getElementById("txtmobilephone").value=="")
        			{
	        			document.getElementById("errorMsg").innerHTML = "Enter the mobile phone of the instructor!";
        				document.getElementById("txtmobilephone").focus();
        				document.getElementById("txtmobilephone").style.borderColor="red";        				
        				return false;
        			}
        			else if(document.getElementById("slctadministrativeposition").value=="")
        			{
        				document.getElementById("errorMsg").innerHTML = "Select administrative position!";
        				document.getElementById("slctadministrativeposition").focus();
        				document.getElementById("slctadministrativeposition").style.borderColor="red";        				
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
            		$query = "SELECT * FROM tblAcademicUnit ORDER BY academic_unit_name ASC";
            		$result = DBConnection::readFromDatabase($query);            		
            	?>  
            	           
					<form name="frmadduser" method="post" action="SaveUser.php" onsubmit="return isBlank();">
						<br/><br/>
						
						<div id="errorMsg"></div>
						<table width="80%">
						<caption>Add New User</caption>
							<tr>
								<td align="right">
									Select Academic Unit
								</td>
								<td align="left">
									<select name="slctacademicunit" id="slctacademicunit" onchange="checkAndChangeColor(this.value,id);">
										<option value="" selected="selected">--Select--</option>
										<?php
											while($resultRow = mysql_fetch_object($result))
											{
										?>
											<option value="<?php print($resultRow->id);?>">
												<?php print($resultRow->academic_unit_name);?>
											</option>
											<?php
											}
											?>
									</select>
								</td>
							</tr>
							<tr>
								<td align="right">
									Instructor Id
								</td>
								<td align="left">
									<input type="text" name="txtinstructorid" id="txtinstructorid" onblur="checkAndChangeColor(this.value,id);"/>
								</td>								
							</tr>
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
									Mobile Phone
								</td>
								<td align="left">
									<input type="text" name="txtmobilephone" id="txtmobilephone" onblur="checkAndChangeColor(this.value,id);"/>
								</td>								
							</tr>
							<tr>
								<td align="right">
									Select Administrative Position
								</td>
								<!--the admin position is supposed to be flexible which is read from the database table-->
								<td align="left">
								<?php
									//read all the admin positions from the database so that the user can select one from
									$allAdminResult = AdminPosition::getAllAdminPositions();
									print("<select name='slctadministrativeposition' id='slctadministrativeposition'>");
										print("<option value='' selected='selected'>--Select--</option>");
										while($allAdminResultRow = mysql_fetch_object($allAdminResult))
										{
											print("<option value='$allAdminResultRow->id'>$allAdminResultRow->admin_position_name</option>");
										}
									print("</select>");
								?>
									
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
									<input type="password" name="txtpassword" id="txtpassword" onblur="checkAndChangeColor(this.value,id);"/>
								</td>								
							</tr>
							<tr>
								<td align="right">
									Re-type password
								</td>
								<td align="left">
									<input type="password" name="txtpassword" id="txtpassword" onblur="checkAndChangeColor(this.value,id);"/>
								</td>								
							</tr>
							<tr>
								<td>
								</td>
								<td>
									<input type="submit" value="Add" class="button"/>
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

