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
            		include_once("../classes/Instructor.php");
            		include_once("../classes/AcademicUnit.php");
            		include_once("../classes/AdminPosition.php");
            		
            		$instructorId = $_GET['id'];
            		$query = "SELECT * FROM tblInstructor WHERE instructor_id = $instructorId";
            		$result = DBConnection::readFromDatabase($query);
            		$resultRow = mysql_fetch_object($result);
            		
            		$query = "SELECT * FROM tblAcademicUnit";
            		$resultAcademicUnit = DBConnection::readFromDatabase($query);  
            		$resultInstructorRow = Instructor::getInstructorDetail($instructorId);            		          		
            	?>  
            	           
					<form name="frmeditinstructor" method="post" action="UpdateInstructor.php" onsubmit="return isBlank();">
						<br/><br/>
						
						<table width="80%" border="0">
                     <caption>Edit Instructor</caption>
							<tr>
								<td align="right">
									Select Academic Unit
								</td>
								<td>
									<input type="hidden" id="hiddenacademicunitid" name="hiddenacademicunitid" value="<?php print($resultInstructorRow->academic_unit_id);?>" onChange="updateSelectedAcademicUnit(this.value);"/>
									<?php
										$academicUnitResult = AcademicUnit::getAcademicUnitNameFor($resultInstructorRow->academic_unit_id);
										$academicUnitResultRow = mysql_fetch_object($academicUnitResult);
										print($academicUnitResultRow->academic_unit_name);
									?>
								</td>
								<td align="left">
									<select name="slctacademicunit" onChange="updateSelectedAcademicUnit(this.value)">
										<?php
											while($resultAcademicUnitRow = mysql_fetch_object($resultAcademicUnit))
											{
										?>
											<option value="<?php print($resultAcademicUnitRow->id);?>">
												<div id='deptName'><?php print($resultAcademicUnitRow->academic_unit_name);?></div>
											</option>
											<?php
											}
											?>
									</select>
								</td>
							</tr>
							<tr>
								<td align="right">
									First Name
								</td>
								<td>
									<input type="text" name="txtfirstname" value="<?php print($resultInstructorRow->first_name);?>"/>
								</td>
								<td align="left">
									<input type="hidden" name="txtinstructorid" value="<?php print($resultInstructorRow->instructor_id);?>"/>									
								</td>								
							</tr>
							<tr>
								<td align="right">
									Last Name
								</td>
								<td>
									<input type="text" name="txtlastname" value="<?php print($resultInstructorRow->last_name);?>"/>
								</td>
								<td align="left">								
								</td>								
							</tr>
							<tr>
								<td align="right">
									Sex
								</td>
								<td>
									<input type="text" name="txtsex" value="<?php print($resultInstructorRow->sex);?>"/>
								</td>
								<td align="left">								
								</td>								
							</tr>
							<tr>
								<td align="right">
									Qualification
								</td>
								<td>
									<input type="text" name="txtqualification" value="<?php print($resultInstructorRow->educational_qualification);?>"/>
								</td>
								<td align="left">								
								</td>								
							</tr>
							<tr>
								<td align="right">
									Status
								</td>
								<td>
									<input type="text" name="txtstatus" value="<?php print($resultInstructorRow->status);?>"/>
								</td>
								<td align="left">								
								</td>								
							</tr>							
							<tr>
								<td align="right">
									Email
								</td>
								<td>
									<input type="text" name="txtemail" value="<?php print($resultInstructorRow->email);?>"/>
								</td>
								<td align="left">								
								</td>								
							</tr>
							<tr>
								<td align="right">
									Mobile Phone
								</td>
								<td>
									<input type="text" name="txtmobilephone" value="<?php print($resultInstructorRow->mobile_phone);?>"/>
								</td>
								<td align="left">								
								</td>								
							</tr>
							<tr>
								<td align="right">
									Instructor Level
								</td>
								<td>
									<input type="text" name="txtacademicrank" id="txtacademicrank" value="<?php print($resultInstructorRow->instructor_level);?>"/>
								</td>
								<td align="left">									
									<select name="slctinstructorlevel" onChange="updateInputBox('txtacademicrank',this.value);">
										<option value="" selected="selected">--Select--</option>
										<option value="Doctor">Doctor (Phd)</option>
										<option value="Lecturer">Lecturer (MSc/MA)</option>
										<option value="Assistant Lecturer">Assistant Lecturer</option>
										<option value="Graduate Assistant">Graduate Assistant</option>
									</select>
								</td>								
							</tr>
							<tr>
								<td align="right">
									Service Year
								</td>
								<td>
									<input type="text" name="txtserviceyear" value="<?php print($resultRow->service_year);?>"/>
								</td>
								<td align="left">									
									
								</td>								
							</tr>
							<tr>
								<td align="right">
									Specialization
								</td>
								<td>
									<input type="text" name="txtspecialization" value="<?php print($resultRow->specialization);?>"/>
								</td>
								<td align="left">									
								</td>								
							</tr>
							<tr>
								<td align="right">
									Other Responsibilities
								</td>
								<td>
									<?php
										//get the value of the current responsibility from the database
										$adminPositionName = AdminPosition::getPositionNameFor($resultRow->other_responsibilities);
										print($adminPositionName);
										//print("<input type='text' id='txtacademicposition' name='txtacademicposition' value='$resultRow->other_responsibilities'/>");
                              print("<input type='hidden' id='hiddenotherrespo' name='hiddenotherrespo' value='$resultRow->other_responsibilities'/>");
									?>
								</td>
								<td align="left">
                             <?php
                                 //here you need to get the different types of responsibilities from the database
                                 include_once('../classes/AdminPosition.php');
                                 $adminPositionResult = AdminPosition::getAllAdminPositions();
                                 print("<select name='slctadminposition' onChange=updateInputBox('hiddenotherrespo',this.value);>");
                                     print("<option value='' selected='selected'>--Select--</option>");
                                     while($adminPositionResultRow = mysql_fetch_object($adminPositionResult))
                                     {
                                         print("<option value='$adminPositionResultRow->id'>$adminPositionResultRow->admin_position_name</option>");
                                     }//end while
                                 print("</select>")
                             ?>
								</td>								
							</tr>
							<tr>
								<td align="right">
									Nationality
								</td>
								<td>
									<input type="text" name="txtnationality" value="<?php print($resultInstructorRow->nationality);?>"/>
								</td>
								<td align="left">								
								</td>								
							</tr>
							<tr>
								<td>
								</td>
								<td>
									<input type="submit" value="Update" class="button"/>
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

