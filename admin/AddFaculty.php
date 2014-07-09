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
        			if(document.getElementById("txtfacultyname").value=="")
        			{        				
        				document.getElementById("errorMsg").innerHTML = "Enter the name of the faculty!";
        				document.getElementById("txtfacultyname").focus();
        				document.getElementById("txtfacultyname").style.borderColor="red";        				
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
            		include("ManageFacultyInnerMenu.inc");
            		include_once("../classes/DBConnection.php");
            		$query = "SELECT * FROM tblCampus";
            		$result = DBConnection::readFromDatabase($query);            		
            	?>  
            	           
					<form name="frmaddfaculty" method="post" action="SaveFaculty.php" onsubmit="return isBlank();">
						<br/><br/>
						
						<div id="errorMsg"></div>
						<table width="80%">
                     <caption>Add New Faculty</caption>
							<tr>
								<td align="right">
									Select Campus
								</td>
								<td align="left">
									<select name="slctcampus">
										<?php
											while($resultRow = mysql_fetch_object($result))
											{
										?>
											<option value="<?php print($resultRow->id);?>">
												<?php print($resultRow->campus_name);?>
											</option>
											<?php
											}
											?>
									</select>
								</td>
							</tr>
                     <tr>
								<td align="right">
									Faculty Id
								</td>
								<td align="left">
									<input type="text" name="txtfacultyid" id="txtfacultyid" onblur="checkAndChangeColor(this.value,id);"/>
								</td>
							</tr>
							<tr>
								<td align="right">
									Name of Faculty
								</td>
								<td align="left">
									<input type="text" name="txtfacultyname" id="txtfacultyname" onblur="checkAndChangeColor(this.value,id);"/>
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

