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
        			else if(document.getElementById("slctinstructorlevel").value=="")
        			{
        				document.getElementById("errorMsg").innerHTML = "Select Instructor level!";
        				document.getElementById("slctinstructorlevel").focus();
        				document.getElementById("slctinstructorlevel").style.borderColor="red";        				
        				return false;
        			}
        			else if(document.getElementById("txtserviceyear").value=="")
        			{
        				document.getElementById("errorMsg").innerHTML = "Enter the service year!";
        				document.getElementById("txtserviceyear").focus();
        				document.getElementById("txtserviceyear").style.borderColor="red";        				
        				return false;
        			}
        			else if(document.getElementById("txtspecialization").value=="")
        			{
        				document.getElementById("errorMsg").innerHTML = "Enter Specialization!";
        				document.getElementById("txtspecialization").focus();
        				document.getElementById("txtspecialization").style.borderColor="red";        				
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
           			document.getElementById(id).style.borderColor="lightblue";
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
            		include("ManageInstructorInnerMenu.inc");
            		include_once("../classes/DBConnection.php");
            		include_once("../classes/AcademicRank.php");
            		$query = "SELECT * FROM tblAcademicUnit ORDER BY academic_unit_name ASC";
            		$result = DBConnection::readFromDatabase($query);            		
            	?>  
            	           
					<form name="frmaddinstructor" method="post" action="SaveInstructor.php" onsubmit="return isBlank();">
						<br/><br/>						
						<div id="errorMsg"></div>
						<table width="80%">
							<caption>Add New Instructor</caption>
							<tr>
								<td align="right">
									Select Academic Unit
								</td>
								<td align="left">
									<select name="slctacademicunit" id="slctacademicunit" onchange="checkAndChangeColor(this.value,id)">
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
									Sex
								</td>
								<td align="left">									
									<select name="slctsex">
										<option value="" selected="selected">--Select Sex--</option>
										<option value="Male">Male</option>
										<option value="Female">Female</option>
									</select>
								</td>								
							</tr>
							<tr>
								<td align="right">
									Qualification
								</td>
								<td align="left">
									<input type="text" name="txtqualification" id="txtqualification" onblur="checkAndChangeColor(this.value,id);"/>
								</td>								
							</tr>
							<tr>
								<td align="right">
									Status
								</td>
								<td align="left">
									<select name="slctstatus">
										<option value="" selected="selected">--Select--</option>
										<option value="FT">Full Timer</option>
										<option value="SL">Study Leave</option>
										<option value="LWP">Leave Without Pay</option>
										<option value="SBT">Sabbatical Leave</option>
										<option value="ML">Maternity Leave</option>
										<option value="SKL">Sick Leave</option>
									</select>
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
									Academic Rank
								</td>
								<td align="left">
									<?php
									   $resultRank = AcademicRank::getAllAcademicRanks();
										print("<select name='slctinstructorlevel' onChange='checkAndChangeColor(this.value,id)'>");
										print("<option value='' selected='selected'>--Select--</option>");
										while($resultRankRow = mysql_fetch_object($resultRank))
										{
											print("<option value='$resultRankRow->rank_name'>$resultRankRow->rank_name</option>");
										}//end while
									print("</select>");
								?>
								</td>								
							</tr>
							<tr>
								<td align="right">
									Service Year
								</td>
								<td align="left">
									<input type="text" name="txtserviceyear" id="txtserviceyear" onblur="checkAndChangeColor(this.value,id);"/>
								</td>								
							</tr>
							<tr>
								<td align="right">
									Specialization
								</td>
								<td align="left">
									<input type="text" name="txtspecialization" id="txtspecialization" onblur="checkAndChangeColor(this.value,id);"/>
								</td>								
							</tr>
							<tr>
								<td align="right">
									Other Responsibilities
								</td>
								<td align="left">
									<?php
										include_once('../classes/AdminPosition.php');
										//read all the admin positions from the database so that the user can select one from
										$allAdminResult = AdminPosition::getAllAdminPositions();
										print("<select name='slctadminposition' id='slctadminposition'>");
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
									Nationality
								</td>
								<td align="left">
									<input type="text" name="txtnationality" id="txtnationality" value="Ethiopian" onblur="checkAndChangeColor(this.value,id);"/>
								</td>								
							</tr>
							<tr>
								<td align="right">
									Teaching Commitment
								</td>
								<td align="left">
									<?php
										include_once("../classes/ExpectedTeachingCommitmentRateLookup.php");
										$rateLookupList = ExpectedTeachingCommitmentRateLookup::getAllExpectedTeachingCommitmentRateLookups();
										print("<select name='slctexpectedteachingcommitmentratelookup' id='slctexpectedteachingcommitmentratelookup'>");
											print("<option value='' selected='selected'>--Select--</option>");
											while($rateLookupListRow = mysql_fetch_object($rateLookupList)){
												print("<option value='$rateLookupListRow->id'>$rateLookupListRow->percentage</option>");
											}
										print("</select>");
									?>									
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

