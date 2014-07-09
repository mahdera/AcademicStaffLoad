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

                        function updateCampusName(campusId)
                        {
                            //alert(campusId);
                            document.getElementById('slctcampus').value=campusId;
                            document.getElementById('txtdisplay').value=campusName;
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
            		$campusId = $_GET['id'];
            		$query = "SELECT * FROM tblFaculty WHERE id = $campusId";
            		$result = DBConnection::readFromDatabase($query);
            		$resultRow = mysql_fetch_object($result);
            		
            		$query = "SELECT * FROM tblCampus";
            		$resultCampus = DBConnection::readFromDatabase($query);            		
            	?>  
            	           
					<form name="frmeditcampus" method="post" action="UpdateFaculty.php" onsubmit="return isBlank();">
						<br/><br/>
						
						<table width="80%" border="0">
						<caption>Edit Faculty</caption>
							<tr>
								<td align="right">
								     Select Campus
								</td>
                                                                <td>
                                                                    <?php
                                                                        //first get the campus id from the faculty class
                                                                        $campusId = $resultRow->campus_id;
                                                                        //now get the campus detail
                                                                        include_once('../classes/Faculty.php');
                                                                        $campusDetail = Faculty::getCampusDetail($campusId);
                                                                        //print($campusDetail->campus_name);
                                                                        print("<input type='hidden' name='slctcampus' id='slctcampus' value='$campusDetail->id'/>");
                                                                        print("<input type='text' name='txtdisplay' id='txtdisplay' value='$campusDetail->campus_name'/>");
                                                                    ?>
                                                                </td>
								<td align="left">
                                                                    <select name="slctcampus1" onchange="updateCampusName(this.value);">
                                                                        <option value="" selected="selected">--Select--</option>
										<?php
											while($resultCampusRow = mysql_fetch_object($resultCampus))
											{
										?>
                                                                                        <option value="<?php print($resultCampusRow->id);?>" lang="<?php print($resultCampusRow->campus_name);?>">
												<?php print($resultCampusRow->campus_name);?>
											</option>
											<?php
											}
											?>
									</select>
								</td>
							</tr>
							<tr>
								<td align="right">
									Name of Faculty
								</td>
								<td align="left">
									<input type="hidden" name="txtfacultyid" value="<?php print($resultRow->id);?>"/>
									<input type="text" name="txtfacultyname" value="<?php print($resultRow->faculty_name);?>"/>
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
						<br/><br/><br/><br/><br/><br/><br
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

