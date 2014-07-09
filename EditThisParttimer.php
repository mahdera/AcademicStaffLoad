<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Academic Staff Load Managment System</title>
        <link rel="stylesheet" href="style/Underground.css" />
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
    session_start();
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
            		print("<hr style='color: lightblue'/>");
            		include("ManageInstructorInnerMenu.inc");
            		include_once("classes/DBConnection.php");
            		$instructorId = $_GET['id'];
            		
            		$query = "SELECT * FROM tblParttimer WHERE parttimer_id = '$instructorId'";
            		$result = DBConnection::readFromDatabase($query);
            		$resultRow = mysql_fetch_object($result);
            		
            		$query = "SELECT * FROM tblAcademicUnit";
            		$resultAcademicUnit = DBConnection::readFromDatabase($query);            		
            	?>  
            	           
					<form name="frmeditinstructor" method="post" action="UpdateParttimer.php" onsubmit="return isBlank();">
						<br/><br/>						
						<table width="80%">	
							<caption>Edit Parttimer</caption>						
							<tr>
								<td align="right">
									First Name
								</td>
								<td align="left">
									<input type="hidden" name="txtinstructorid" value="<?php print($resultRow->parttimer_id);?>"/>
									<input type="text" name="txtfirstname" value="<?php print($resultRow->first_name);?>"/>
								</td>								
							</tr>
							<tr>
								<td align="right">
									Last Name
								</td>
								<td align="left">									
									<input type="text" name="txtlastname" value="<?php print($resultRow->last_name);?>"/>
								</td>								
							</tr>
							<tr>
								<td align="right">
									Email
								</td>
								<td align="left">									
									<input type="text" name="txtemail" value="<?php print($resultRow->email);?>"/>
								</td>								
							</tr>
							<tr>
								<td align="right">
									Mobile Phone
								</td>
								<td align="left">									
									<input type="text" name="txtmobilephone" value="<?php print($resultRow->mobile_phone);?>"/>
								</td>								
							</tr>
							<tr>
								<td align="right">
									Instructor Level
								</td>
								<td align="left">									
									<select name="slctinstructorlevel">
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
									Specialization
								</td>
								<td align="left">									
									<input type="text" name="txtspecialization" value="<?php print($resultRow->specialization);?>"/>
								</td>								
							</tr>
							<tr>
								<td align="right">
									Organization
								</td>
								<td align="left">									
									<input type="text" name="txtorganization" value="<?php print($resultRow->organization);?>"/>
								</td>
							</tr>
							<tr>
								<td align="right">Select Academic Unit</td>
								<td>	
								  <select name="slctacademicunit">
								  		<option value="" selected="selected">--Select--</option>					
										<?php
											while($resultAcademicUnitRow = mysql_fetch_object($resultAcademicUnit))
											{
												print("<option value='$resultAcademicUnitRow->academic_unit_id'>$resultAcademicUnitRow->academic_unit_name</option>");
											}
										?>
									</select>
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

