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
            		include("ManageAdminPositionInnerMenu.inc");
            		include_once("../classes/DBConnection.php");
            		$adminPosId = $_GET['id'];
            		$query = "SELECT * FROM tblAdminPosition WHERE id = $adminPosId";
            		$result = DBConnection::readFromDatabase($query);
            		$resultRow = mysql_fetch_object($result);
            	?>  
            	           
					<form name="frmeditadminposition" method="post" action="UpdateAdminPosition.php" onsubmit="return isBlank();">
						<br/><br/>
						
						<table width="80%">
						<caption>Update Admin Position</caption>
							<tr>
								<td align="right">
									Admin Position
								</td>
								<td align="left">
									<input type="hidden" name="txtadminpositionid" value="<?php print($resultRow->id);?>"/>
									<input type="text" name="txtadminpositionname" value="<?php print($resultRow->admin_position_name);?>"/>
								</td>								
							</tr>
                                                        <tr>
								<td align="right">
									Equivalent Credit
								</td>
								<td align="left">
                                                                    <input type="text" name="txtcreditequivalent" id="txtcreditequivalent" value="<?php print($resultRow->equivalent_credit )?>"/>
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

