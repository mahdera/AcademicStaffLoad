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
            		$instructorId = $_GET['id'];
            		$query = "SELECT * FROM tblUser WHERE instructor_id = $instructorId";
            		$result = DBConnection::readFromDatabase($query);
            		$resultRow = mysql_fetch_object($result);
            		
            		$query = "SELECT * FROM tblAcademicUnit";
            		$resultAcademicUnit = DBConnection::readFromDatabase($query);            		
            	?>  
            	           
					<form name="frmedituser" method="post" action="UpdateUser.php" onsubmit="return isBlank();">
						<br/><br/>
						<caption>Edit Instructor</caption>
						<table width="80%">
							<tr>
								<td align="right">
									Select Academic Unit
								</td>
								<td align="left">
									<select name="slctacademicunit">
										<?php
											while($resultAcademicUnitRow = mysql_fetch_object($resultAcademicUnit))
											{
										?>
											<option value="<?php print($resultAcademicUnitRow->id);?>">
												<?php print($resultAcademicUnitRow->academic_unit_name);?>
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
								<td align="left">
									<input type="hidden" name="txtinstructorid" value="<?php print($resultRow->instructor_id);?>"/>
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
									Administrative Position
								</td>
								<td align="left">									
									<select name="slctadministrativeposition">
										<option value="Dean">Dean</option>
										<option value="Assistant Dean">Assistant Dean</option>
										<option value="Department Head">Department Head</option>										
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

