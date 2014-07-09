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
        			if(document.getElementById("txtacademicunitname").value=="")
        			{        				
        				document.getElementById("errorMsg").innerHTML = "Enter the name of the academic unit!";
        				document.getElementById("txtacademicunitname").focus();
        				document.getElementById("txtacademicunitname").style.borderColor="red";        				
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
            		include("ManageAcademicUnitInnerMenu.inc");
            		include_once("../classes/DBConnection.php");
            		$query = "SELECT * FROM tblFaculty";
            		$result = DBConnection::readFromDatabase($query);            		
            	?>  
            	           
					<form name="frmaddacademicunit" method="post" action="SaveAcademicUnit.php" onsubmit="return isBlank();">
						<br/><br/>
						<caption>Add New Academic Unit</caption>
						<div id="errorMsg"></div>
						<table width="80%">
							<tr>
								<td align="right">
									Select Faculty
								</td>
								<td align="left">
									<select name="slctfaculty">
										<?php
											while($resultRow = mysql_fetch_object($result))
											{
										?>
											<option value="<?php print($resultRow->id);?>">
												<?php print($resultRow->faculty_name);?>
											</option>
											<?php
											}
											?>
									</select>
								</td>
							</tr>
                     <tr>
								<td align="right">
									Academic Unit Id
								</td>
								<td align="left">
									<?php
										//here let the system suggest the max academic unit id to Chilo so that his life would be very easy
										include_once('../classes/AcademicUnit.php');
										$maxAcademicUnitId = AcademicUnit::getTheMaxAcademicUnitId();
										print(strlen($maxAcademicUnitId));
										$maxAcademicUnitIdStr = "value";
										if(strlen($maxAcademicUnitId) == 1){
										   $prefix = "00";
											$maxAcademicUnitIdStr = $prefix . $maxAcademicUnitId;
										}else if(strlen($maxAcademicUnitId )== 2){
											$prefix = "0";											
											$maxAcademicUnitIdStr = $prefix . $maxAcademicUnitId;											
										}else{
											$maxAcademicUnitIdStr = $maxAcademicUnitId;
										}										
									?>
									<input type="text" id="txtacademicunitid" name="txtacademicunitid" onblur="checkAndChangeColor(this.value,id);" value="<?php print($maxAcademicUnitIdStr);?>"/>
								</td>
							</tr>
							<tr>
								<td align="right">
									Name of Academic Unit
								</td>
								<td align="left">
									<input type="text" id="txtacademicunitname" name="txtacademicunitname" onblur="checkAndChangeColor(this.value,id);"/>
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

