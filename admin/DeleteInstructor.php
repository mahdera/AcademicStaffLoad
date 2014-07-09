<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Academic Staff Load Managment System</title>
        <link rel="stylesheet" href="../style/Underground.css" />
        <script src="../js/js_script.js"></script>
        <link rel="shortcut icon" href="images/campus.jpeg"/>
        <script language="javascript">
        		function showInstructors(str)
				{	
					document.getElementById("loadspan").style.visibility = "visible";				
					if (str=="")
					  {
						  document.getElementById("instructorProfile").innerHTML="";
						  return;
					  } 
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
							    document.getElementById("instructorProfile").innerHTML=xmlhttp.responseText;
							    document.getElementById("loadspan").style.visibility = "hidden";
						    }
					  }
					xmlhttp.open("GET","GetInstructorsInThisAcademicUnitForDelete.php?q="+str,true);
					xmlhttp.send();
				}
				
				function confirmInstructorDeletion(instId)
				{
					if(window.confirm('Are you sure you want to delete instructor with id : '+instId+' ?'))
						return true;
					else
						return false;
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
            	?>  
            	 
            	<div>
						<input type="hidden" id="departmentId" value="<?php print($academicUnitid);?>"/>
						<?php
							//now i need to read all the instructors in this department
							include_once("../classes/DBConnection.php");
							$query = "SELECT * FROM tblAcademicUnit ORDER BY academic_unit_name";
							$result = DBConnection::readFromDatabase($query);													
						?>
						<table border="0" width="80%">
							<tr>								
								<td>
									<select name="slctacademicunit" id="slctacademicunit" onchange="showInstructors(this.value);">
											<option value="" selected="selected">--Select Academic Unit--</option>
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
									-- Delete Instrucotr <span id="loadspan" style="visibility:hidden;"> <img src="images/loadingfb.gif" width="16" height="16" align="absmiddle" border="0"/></span>								 
								</td>					
							</tr>
						</table>
					</div>
					
					<div id="instructorProfile">
						<b>Course Profile will be listed here</b><br/>
					</div>  
					          
					
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

