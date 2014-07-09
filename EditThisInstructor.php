<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Academic Staff Load Managment System</title>
        <link rel="stylesheet" href="style/Underground.css" />
        <script type="text/javascript" src="jQuery/jquery-1.11.1.min.js"></script>
        <script src="Ajax/ajax.js" type="text/javascript" language="javascript"></script>
        <link rel="shortcut icon" href="images/campus.jpeg"/>
        <script language="javascript">
        		function isBlank()
        		{
        			if(document.frmaddcampus.txtcampusname.value=="")
        			{
        				alert("Enter the name of the campus");
        				document.frmaddcampus.txtcampusname.focus();
        				return false;
        			}
        			else
        				return true;
        		}

                        function updateInputBox(control,val)
        		{
        			//alert(control);
					document.getElementById(control).value = val;
        		}

        		function updateSelectedAcademicUnit(val)
        		{
	        		//first assign the selected academic unit id to the hidden variable
	        		//alert(val);
	        		document.getElementById('hiddenacademicunitid').value = val;
	        		//now change the text of the the older dept name by the new selected dept using Ajax


					if (window.XMLHttpRequest)
					{// code for IE7+, Firefox, Chrome, Opera, Safari
						  xmlhttp=new XMLHttpRequest();
					}
					else
					{// code for IE6, IE5
						  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp.onreadystatechange=function()
					{
						  if (xmlhttp.readyState==4 && xmlhttp.status==200)
						  {
							    document.getElementById("deptName").innerHTML=xmlhttp.responseText;
						  }
					}
					xmlhttp.open("GET","GetDepartmentName.php?id="+val,true);
					xmlhttp.send();
	        		//alert('got here');
        		}
        </script>
        
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
    </head>
    <body>
<?php   
    @session_start();
    $sessName = $_SESSION['full_name'];
    include_once("classes/ExpectedTeachingCommitment.php");
    include_once("classes/ExpectedTeachingCommitmentRateLookup.php");
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
            		print("<hr style='color: lightblue'/>");
            		include("ManageInstructorInnerMenu.inc");
            		include_once("classes/DBConnection.php");
                        include_once("classes/DBConnection.php");
            		include_once("classes/Instructor.php");
            		include_once("classes/AcademicUnit.php");
            		include_once("classes/AdminPosition.php");
            		include_once("classes/AcademicRank.php");

            		$instructorId = $_GET['id'];
            		$query = "SELECT * FROM tblInstructor WHERE instructor_id = $instructorId";
            		$result = DBConnection::readFromDatabase($query);
            		$resultRow = mysql_fetch_object($result);
            		
            		$query = "SELECT * FROM tblAcademicUnit ORDER BY academic_unit_name ASC";
            		$resultAcademicUnit = DBConnection::readFromDatabase($query);
                        $resultAcademicUnit = DBConnection::readFromDatabase($query);
            		$resultInstructorRow = Instructor::getInstructorDetail($instructorId);   
            	?>  
            	           
					<form name="frmeditinstructor" method="post" action="UpdateInstructor.php" onsubmit="return isBlank();">
						<br/><br/>
						
						<table width="80%" border="0">
                     <caption>Edit Instructor</caption>
							<tr>
								<td align="right">
									Select Academic Unit:
								</td>								
								<td>									
									<select name="slctacademicunit" id="slctacademicunit" style="width:100%">
										<?php
										while($resultAcademicUnitRow = mysql_fetch_object($resultAcademicUnit)){
										    if(trim($resultInstructorRow->academic_unit_id) == trim($resultAcademicUnitRow->id)){
										?>
										    <option value="<?php print($resultAcademicUnitRow->id);?>" selected="selected"><?php print($resultAcademicUnitRow->academic_unit_name);?></option>
										<?php
										    }else{
										?>
										    <option value="<?php print($resultAcademicUnitRow->id);?>"><?php print($resultAcademicUnitRow->academic_unit_name);?></option>
										<?php
										    }
										}//end while loop
										?>
									</select>
								</td>								
							</tr>
							<tr>
								<td align="right">
									First Name:
								</td>
								<td>
								    <input type="text" name="txtfirstname" value="<?php print($resultInstructorRow->first_name);?>" size='30'/>
								    <input type="hidden" name="txtinstructorid" value="<?php print($resultInstructorRow->instructor_id);?>"/>									
								</td>								
							</tr>
							<tr>
								<td align="right">
									Last Name:
								</td>
								<td>
								    <input type="text" name="txtlastname" value="<?php print($resultInstructorRow->last_name);?>" size='30'/>
								</td>								
							</tr>
							<tr>
								<td align="right">
									Sex:
								</td>
								<td>
								    <select name="slctsex" id="slctsex">
									<option value="" selected="selected">--Select--</option>
									<?php
									    if($resultInstructorRow->sex == "Female"){
									?>
										<option value="Female" selected="selected">Female</option>
										<option value="Male"></option>
									<?php
									    }else{
									?>
										<option value="Female">Female</option>
										<option value="Male" selected="selected">Male</option>
									<?php
									    }
									?>
								    </select>								    
								</td>								
							</tr>
							<tr>
								<td align="right">
									Qualification:
								</td>
								<td>
									<input type="text" name="txtqualification" value="<?php print($resultInstructorRow->educational_qualification);?>" size='30'/>
								</td>								
							</tr>
							<tr>
								<td align="right">
									Status:
								</td>
								<td>									
									<select name="slctstatus" id="slctstatus">
									    <option value="" selected="selected">--Select</option>
									    <?php
										if(trim($resultInstructorRow->status) == "FT"){
										    ?>
											<option value="FT" selected="selected">Full Timer</option>
											<option value="SL">Study Leave</option>
											<option value="LWP">Leave Without Pay</option>
											<option value="SBT">Sabbatical Leave</option>
											<option value="ML">Maternity Leave</option>
											<option value="SKL">Sick Leave</option>		
										    <?php
										}else if(trim($resultInstructorRow->status) == "SL"){
										    ?>
											<option value="FT">Full Timer</option>
											<option value="SL" selected="selected">Study Leave</option>
											<option value="LWP">Leave Without Pay</option>
											<option value="SBT">Sabbatical Leave</option>
											<option value="ML">Maternity Leave</option>
											<option value="SKL">Sick Leave</option>		
										    <?php
										}else if(trim($resultInstructorRow->status) == "LWP"){
										    ?>
											<option value="FT">Full Timer</option>
											<option value="SL">Study Leave</option>
											<option value="LWP" selected="selected">Leave Without Pay</option>
											<option value="SBT">Sabbatical Leave</option>
											<option value="ML">Maternity Leave</option>
											<option value="SKL">Sick Leave</option>		
										    <?php
										}else if(trim($resultInstructorRow->status) == "SBT"){
										    ?>
											<option value="FT">Full Timer</option>
											<option value="SL">Study Leave</option>
											<option value="LWP">Leave Without Pay</option>
											<option value="SBT" selected="selected">Sabbatical Leave</option>
											<option value="ML">Maternity Leave</option>
											<option value="SKL">Sick Leave</option>		
										    <?php
										}else if(trim($resultInstructorRow->status) == "ML"){
										    ?>
											<option value="FT">Full Timer</option>
											<option value="SL">Study Leave</option>
											<option value="LWP">Leave Without Pay</option>
											<option value="SBT">Sabbatical Leave</option>
											<option value="ML" selected="selected">Maternity Leave</option>
											<option value="SKL">Sick Leave</option>		
										    <?php
										}else if(trim($resultInstructorRow->status) == "SKL"){
										    ?>
											<option value="FT">Full Timer</option>
											<option value="SL">Study Leave</option>
											<option value="LWP">Leave Without Pay</option>
											<option value="SBT">Sabbatical Leave</option>
											<option value="ML">Maternity Leave</option>
											<option value="SKL" selected="selected">Sick Leave</option>		
										    <?php
										}else{
										    ?>
											<option value="FT">Full Timer</option>
											<option value="SL">Study Leave</option>
											<option value="LWP">Leave Without Pay</option>
											<option value="SBT">Sabbatical Leave</option>
											<option value="ML">Maternity Leave</option>
											<option value="SKL">Sick Leave</option>		
										    <?php
										}
									    ?>									    
									</select>
								</td>								
							</tr>							
							<tr>
								<td align="right">
									Email:
								</td>
								<td>
									<input type="text" name="txtemail" value="<?php print($resultInstructorRow->email);?>" size='30'/>
								</td>								
							</tr>
							<tr>
								<td align="right">
									Mobile Phone:
								</td>
								<td>
									<input type="text" name="txtmobilephone" value="<?php print($resultInstructorRow->mobile_phone);?>" size='30'/>
								</td>								
							</tr>
							<tr>
								<td align="right">
									Instructor Level:
								</td>
								<td>									
									<?php
									    $resultRank = AcademicRank::getAllAcademicRanks();
									?>
									<select name="slctinstructorlevel" id="slctinstructorlevel">
									    <option value="" selected="selected">--Select--</option>
									    <?php										
										while($resultRankRow = mysql_fetch_object($resultRank)){
										    if($resultInstructorRow->instructor_level == $resultRankRow->rank_name){
											print("<option value='$resultRankRow->rank_name' selected='selected'>$resultRankRow->rank_name</option>");
										    }else{
											print("<option value='$resultRankRow->rank_name'>$resultRankRow->rank_name</option>");
										    }
										}//end while
									    ?>
									</select>										
								</td>								
							</tr>
							<tr>
								<td align="right">
									Service Year:
								</td>
								<td>
									<input type="text" name="txtserviceyear" value="<?php print($resultRow->service_year);?>" size='30'/>
								</td>								
							</tr>
							<tr>
								<td align="right">
									Specialization:
								</td>
								<td>
									<input type="text" name="txtspecialization" value="<?php print($resultRow->specialization);?>" size='30'/>
								</td>								
							</tr>
							<tr>
								<td align="right">
									Other Responsibilities:
								</td>
								<td>
									<?php
										//get the value of the current responsibility from the database
										$adminPositionName = AdminPosition::getPositionNameFor($resultRow->other_responsibilities);
										//print($adminPositionName);										
										//print("<input type='hidden' id='hiddenotherrespo' name='hiddenotherrespo' value='$resultRow->other_responsibilities'/>");
									?>
									<select name="slctadminposition" id="slctadminposition" style="width:100%">
									    <option value="" selected="selected">--Select--</option>
									    <?php
										include_once('classes/AdminPosition.php');
										$adminPositionResult = AdminPosition::getAllAdminPositions();
										while($adminPositionResultRow = mysql_fetch_object($adminPositionResult))
										{
										    if($resultRow->other_responsibilities == $adminPositionResultRow->id)
											print("<option value='$adminPositionResultRow->id' selected='selected'>$adminPositionResultRow->admin_position_name</option>");
										    else
											print("<option value='$adminPositionResultRow->id'>$adminPositionResultRow->admin_position_name</option>");
										}//end while
									    ?>
									</select>
								</td>																
							</tr>
							<tr>
								<td align="right">
									Nationality:
								</td>
								<td>
									<input type="text" name="txtnationality" value="<?php print($resultInstructorRow->nationality);?>" size='30'/>
								</td>								
							</tr>
							<tr>
								<td align="right">
									Expected Teaching Commitment:
								</td>
								<td>									
									<select name="slctteachingcommitmentratelookup" id="slctteachingcommitmentratelookup" style="width: 100%">
									    <option value="" selected="selected">--Select--</option>
									    <?php
										$teachingCommitmentRateLookupList = ExpectedTeachingCommitmentRateLookup::getAllExpectedTeachingCommitmentRateLookups();
										$expectedTeachingCommitmentObj = ExpectedTeachingCommitment::getExpectedTeachingCommitmentFor($resultInstructorRow->instructor_id,$resultInstructorRow->academic_unit_id);										
										while($teachingCommitmentRateLookupListRow = mysql_fetch_object($teachingCommitmentRateLookupList)){
										    if($expectedTeachingCommitmentObj != null){
											$expectedRateLookupId = $expectedTeachingCommitmentObj->expected_teaching_commitment_rate_lookup_id;
											if($expectedRateLookupId == $teachingCommitmentRateLookupListRow->id){
											    print("<option value='$teachingCommitmentRateLookupListRow->id' selected='selected'>$teachingCommitmentRateLookupListRow->percentage</option>");
											}else{
											    print("<option value='$teachingCommitmentRateLookupListRow->id'>$teachingCommitmentRateLookupListRow->percentage</option>");
											}
										    }else{
											print("<option value='$teachingCommitmentRateLookupListRow->id'>$teachingCommitmentRateLookupListRow->percentage</option>");
										    }
										}//end while loop
									    ?>
									</select>
								</td>
								
							</tr>
							<tr>
							    <td>
							    </td>
							    <td>
								    <input type="submit" value="Update" class="button"/>
								    <input type="reset" value="Undo" class="button"/>
							    </td>
							</tr>
						</table>
						<br/><br/><br/><br/><br/><br/><br/>
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
<script type="text/javascript">
    $(document).ready(function(){
	//alert('hi');
    });//end document.ready function    
</script>
