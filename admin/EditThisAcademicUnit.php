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

                        function updateCampusName(facultyId)
                        {
                            //alert(facultyId);
                            document.getElementById('slctfaculty').value=facultyId;
                            //document.getElementById('txtdisplay').value=campusName;
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
            		$academicUnitId = $_GET['id'];
            		$query = "SELECT * FROM tblAcademicUnit WHERE id = $academicUnitId";
            		$result = DBConnection::readFromDatabase($query);
            		$resultRow = mysql_fetch_object($result);
            		
            		$query = "SELECT * FROM tblFaculty";
            		$resultFaculty = DBConnection::readFromDatabase($query);
              ?>
            	           
					<form name="frmeditacademicunit" method="post" action="UpdateAcademicUnit.php" onsubmit="return isBlank();">
						<br/><br/>
						
                                                <table width="80%" border="0">
                                                    <caption>Edit Academic Unit</caption>
							<tr>
								<td align="right">
									Select Faculty
								</td>
                                                                <td>
                                                                    <?php
                                                                        //first get the campus id from the faculty class
                                                                        $facultyId = $resultRow->faculty_id;
                                                                        //now get the campus detail
                                                                        include_once('../classes/AcademicUnit.php');
                                                                        $facultyDetail = AcademicUnit::getFacultyDetail($facultyId);
                                                                        //print($campusDetail->campus_name);
                                                                        print("<input type='hidden' name='slctfaculty' id='slctfaculty' value='$facultyDetail->id'/>");
                                                                        print("<input type='text' name='txtdisplay' id='txtdisplay' value='$facultyDetail->faculty_name'/>");
                                                                    ?>
                                                                </td>
								<td align="left">
                                                                    <select name="slctfaculty1" onchange="updateCampusName(this.value);">
                                                                        <option value="" selected="selected">--Select--</option>
                                                                        <?php
                                                                                while($resultFacultyRow = mysql_fetch_object($resultFaculty))
                                                                                {
                                                                        ?>
                                                                                <option value="<?php print($resultFacultyRow->id);?>">
                                                                                        <?php print($resultFacultyRow->faculty_name);?>
                                                                                </option>
                                                                                <?php
                                                                                }//end while
                                                                                ?>
									</select>
								</td>
							</tr>
							<tr>
								<td align="right">
									Name of Academic Unit
								</td>
								<td align="left">
									<input type="hidden" name="txtacademicunitid" value="<?php print($resultRow->id);?>"/>
									<input type="text" name="txtacademicunitname" value="<?php print($resultRow->academic_unit_name);?>"/>
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

