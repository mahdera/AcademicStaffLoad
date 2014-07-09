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
        			if(document.getElementById("txtcampusname").value=="")
        			{        				
        				document.getElementById("errorMsg").innerHTML = "Enter the name of the campus!";
        				document.getElementById("txtcampusname").focus();
        				document.getElementById("txtcampusname").style.borderColor="red";        				
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
            		include("ManageDeliveryLookUpInnerMenu.inc");
            		include_once('../classes/CourseDelivery.php');
            		include_once('../classes/CourseCategory.php');
            	?>  
            	           
					<form name="frmadddeliverytrate" method="post" action="SaveDeliveryRate.php" onsubmit="return isBlank();">
						<br/><br/>
						
						<div id="errorMsg"></div>
						<table width="80%" border="0">
						<caption>Add Delivery Rate</caption>
							<tr>
								<td align="right" width="40%">
									Category:
								</td>
								<?php
									//now read from the tblCourseCategory
									$resultCategory = CourseCategory::getAllCourseCategory();									
								?>
								<td align="left">
									<select name="slctcategory" style="width:40%">
										<option value="">--Select--</option>
										<?php	
										while($resultCategoryRow = mysql_fetch_object($resultCategory))
										{
											print("<option value='$resultCategoryRow->course_category_name'>$resultCategoryRow->course_category_name</option>");
										}
										?>
									</select>
								</td>								
							</tr>
							<tr>
								<td align="right">
									Delivery:
								</td>
								<?php									
									//now read from the tblCourseDelivery
									$resultDelivery = CourseDelivery::getDeliveryTypes();
								?>								
								<td align="left">
									<select name="slctdelivery" style="width:40%">
										<option value="">--Select--</option>
										<?php	
										while($resultDeliveryRow = mysql_fetch_object($resultDelivery))
										{
											print("<option value='$resultDeliveryRow->course_delivery_name'>$resultDeliveryRow->course_delivery_name</option>");
										}
										?>
									</select>
								</td>								
							</tr>
							<tr>
								<td align="right">
									Rate:
								</td>
								<td align="left">
									<input type="text" name="txtrate" id="txtrate"/>
								</td>								
							</tr>
							<tr>
								<td align="right">
								    Calculating Mechanism:
								</td>
								<td align="left">
								    <select name="slctcalculatingmechanism" id="slctcalculatingmechanism" style="width:40%">
									<option value="" selected="selected">--Select--</option>
									<option value="section">Number of Sections</option>
									<option value="student">Number of Students</option>
								    </select>
								</td>
							</tr>
							<tr>
								<td>
								</td>
								<td>
									<input type="submit" value="Add" class="button"/>
									<input type="reset" value="Clear" class="button"/>
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

