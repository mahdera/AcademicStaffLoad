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
        			else if(document.getElementById("txtcoursenumber").value=="")
        			{
        				document.getElementById("errorMsg").innerHTML = "Enter the course number!";
        				document.getElementById("txtcoursenumber").focus();
        				document.getElementById("txtcoursenumber").style.borderColor="red";        				
        				return false;
        			}
        			else if(document.getElementById("txtcoursetitle").value=="")
        			{
        				document.getElementById("errorMsg").innerHTML = "Enter the course title!";
        				document.getElementById("txtcoursetitle").focus();
        				document.getElementById("txtcoursetitle").style.borderColor="red";        				
        				return false;
        			}
        			else if(document.getElementById("txtcredithour").value=="")
        			{
        				document.getElementById("errorMsg").innerHTML = "Enter the credit hour!";
        				document.getElementById("txtcredithour").focus();
        				document.getElementById("txtcredithour").style.borderColor="red";        				
        				return false;
        			}   
        			else if(document.getElementById("txtlecturehour").value=="")
        			{
        				document.getElementById("errorMsg").innerHTML = "Enter the lecture hour!";
        				document.getElementById("txtlecturehour").focus();
        				document.getElementById("txtlecturehour").style.borderColor="red";        				
        				return false;
        			}        
        			else if(document.getElementById("txtlabhour").value=="")
        			{
        				document.getElementById("errorMsg").innerHTML = "Enter the lab hour!";
        				document.getElementById("txtlabhour").focus();
        				document.getElementById("txtlabhour").style.borderColor="red";        				
        				return false;
        			}        
        			else if(document.getElementById("txttutorialhour").value=="")
        			{
        				document.getElementById("errorMsg").innerHTML = "Enter the tutorial hour!";
        				document.getElementById("txttutorialhour").focus();
        				document.getElementById("txttutorialhour").style.borderColor="red";        				
        				return false;
        			}        
        			else if(document.getElementById("slctcategory").value=="")
        			{
        				document.getElementById("errorMsg").innerHTML = "Enter the category!";
        				document.getElementById("slctcategory").focus();
        				document.getElementById("slctcategory").style.borderColor="red";        				
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
            		include("ManageCourseInnerMenu.inc");
            		include_once("../classes/DBConnection.php");
            		$query = "SELECT * FROM tblAcademicUnit ORDER BY academic_unit_name ASC";
            		$result = DBConnection::readFromDatabase($query);            		
            	?>  
            	           
					<form name="frmaddcourse" method="post" action="SaveCourse.php" onsubmit="return isBlank();">
						<br/><br/>						
						<div id="errorMsg"></div>
						<table width="80%">
							<caption>Add New Course</caption>
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
									Course Number
								</td>
								<td align="left">
									<input type="text" name="txtcoursenumber" id="txtcoursenumber" onblur="checkAndChangeColor(this.value,id);"/>
								</td>								
							</tr>
							<tr>
								<td align="right">
									Course Title
								</td>
								<td align="left">
									<input type="text" name="txtcoursetitle" id="txtcoursetitle" onblur="checkAndChangeColor(this.value,id);"/>
								</td>								
							</tr>
							<tr>
								<td align="right">
									Credit Hour
								</td>
								<td align="left">
									<input type="text" name="txtcredithour" id="txtcredithour" onblur="checkAndChangeColor(this.value,id);"/>
								</td>								
							</tr>	
							<tr>
								<td align="right">
									Lecture Hour
								</td>
								<td align="left">
									<input type="text" name="txtlecturehour" id="txtlecturehour" onblur="checkAndChangeColor(this.value,id);"/>
								</td>								
							</tr>			
							<tr>
								<td align="right">
									Lab Hour
								</td>
								<td align="left">
									<input type="text" name="txtlabhour" id="txtlabhour" onblur="checkAndChangeColor(this.value,id);"/>
								</td>								
							</tr>			
							<tr>
								<td align="right">
									Tutorial Hour
								</td>
								<td align="left">
									<input type="text" name="txttutorialhour" id="txttutorialhour" onblur="checkAndChangeColor(this.value,id);"/>
								</td>								
							</tr>			
							<tr>
								<td align="right">
									Category
								</td>
								<td align="left">
									<select name="slctcategory" id="slctcategory" onchange="checkAndChangeColor(this.value,id);">
										<option value="" selected="selected">--Select--</option>
										<option value="PG">Post Graduate</option>
										<option value="UG">Undergraduate</option>
										<option value="PhD">PhD</option>
									</select>
								</td>								
							</tr>
							<tr>
								<td align="right">
									Total Number of Students
								</td>
								<td align="left">
									<input type="text" name="txttotalnumberofstudents" id="txttotalnumberofstudents" onblur="checkAndChangeColor(this.value,id);"/>
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

