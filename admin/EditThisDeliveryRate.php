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
            		include("ManageDeliveryLookUpInnerMenu.inc");
            		include_once("../classes/DBConnection.php");
            		$category = $_GET['category'];
            		$delivery = $_GET['type'];
            		
            		$query = "SELECT * FROM tblRateLookUp WHERE category = '$category' AND delivery_type = '$delivery'";
            		//print($query);
            		$result = DBConnection::readFromDatabase($query);
            		$resultRow = mysql_fetch_object($result);
            	?>  
            	           
					<form name="frmeditadminposition" method="post" action="UpdateDeliveryRate.php" onsubmit="return isBlank();">
						<br/><br/>
						
						<table width="80%">
						<caption>Update Delivery Rate</caption>
							<tr>
								<td align="right" width="40%">
									Category:
								</td>
								<td align="left">
									<input type="hidden" name="txtcategoryhidden" value="<?php print($resultRow->category);?>"/>
									<?php
										print($resultRow->category);
									?>									
								</td>								
							</tr>
							<tr>
								<td align="right">
									Delivery Type:
								</td>
								<td align="left">
									<input type="hidden" name="txtdeliverytypehidden" value="<?php print($resultRow->delivery_type);?>"/>
									<?php
										print($resultRow->delivery_type);
									?>
								</td>
							</tr>
							<tr>
								<td align="right">
									Rate:
								</td>
								<td align="left">
									<input type="text" name="txtrate" value="<?php print($resultRow->rate);?>"/>
								</td>
							</tr>
							<tr>
							    <td align="right">
								Calculating Mechanism:
							    </td>
							    <td>
								<select name="slctcalculatingmechanism" id="slctcalculatingmechanism" style="width:40%">
								    <option value="" selected="selected">--Select--</option>
								    <?php
									if($resultRow->calculating_mechanism == 'section'){
								    ?>
									    <option value="section" selected="selected">Number of Sections</option>
									    <option value="student">Number of Students</option>
								    <?php
									}else if($resultRow->calculating_mechanism == 'student'){
								    ?>
									    <option value="section">Number of Sections</option>
									    <option value="student" selected="selected">Number of Students</option>
								    <?php
									}else{
								    ?>
									    <option value="section">Number of Sections</option>
									    <option value="student">Number of Students</option>  
								    <?php
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
									<input type="reset" value="Undo" class="button"/>
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

