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

            function showCourseCategory(val)
            {
                document.getElementById('slctcategory').value=val;
            }
            
            function renewAcademicUnit(val)
            {
            	document.getElementById("txtacademicunit").value = val;
            }
            
            function changeTheAcademicUnitId(academicUnitId){
            	document.getElementById('hiddenacademicunitid').value = academicUnitId;
            	//now comes the ajax method to replace the value of the the current selected academic unit name
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
							    document.getElementById("academicUnitNameDiv").innerHTML = xmlhttp.responseText;							    
						    }
					  }
					xmlhttp.open("GET","ChangeTheAcademicUnitId.php?academicUnitId="+academicUnitId,true);
					xmlhttp.send();
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
                  include_once("../classes/CourseCategory.php");
                  include_once("../classes/AcademicUnit.php");
                        
            		$courseNumber = $_REQUEST['id'];
            		$academicUnitId = $_REQUEST['academicUnitId'];
            		//print("the academic unit id is : $academicUnitId");
            		$query = "SELECT * FROM tblCourse WHERE course_number = '$courseNumber'";
            		$result = DBConnection::readFromDatabase($query);
            		$resultRow = mysql_fetch_object($result);
            		//now get the academic unit
            		$academicUnitObj = AcademicUnit::getAcademicUnit($academicUnitId);
            		$query = "SELECT * FROM tblAcademicUnit ORDER BY academic_unit_name ASC";
            		$resultAcademicUnit = DBConnection::readFromDatabase($query);            		
            	?>  
            	           
					<form name="frmeditcourse" method="post" action="UpdateCourse.php" onsubmit="return isBlank();">
						<br/><br/>
						
                 <table width="70%" border="0">
                  <caption>Edit Course</caption>
							<tr>
								<td align="right">
									Select Academic Unit:
								</td>								
                                                                
                      <td width="20%">
                      	  <?php
                      	  		print("<input type='hidden' name='hiddenacademicunitid' id='hiddenacademicunitid' value='$academicUnitId'/>");
                      	  		print("<div id='academicUnitNameDiv'>");
                      	  			print($academicUnitObj->academic_unit_name);
                      	  		print("</div>");
                      	  ?>
                      </td>
								<td align="left">									
                          		<select name="slctacademicunit" id="slctacademicunit" onChange="changeTheAcademicUnitId(this.value);" style="width:50%">
										<?php
											print("<option value='' selected='selected'>--Select--</option>");
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
									Course Number:
								</td>
                                    <td>
                            				<input type="hidden" name="txtcoursenumber" value="<?php print($resultRow->course_number);?>"/>
								    				<?php print($resultRow->course_number);?>
                                    </td>
								<td align="left">									
								</td>								
							</tr>
							<tr>
								<td align="right">
									Course Title:
								</td>
                                                                <td>
                                                                    <input type="hidden" name="txtcoursenumber" value="<?php print($resultRow->course_number);?>"/>
								    <input type="text" name="txtcoursetitle" value="<?php print($resultRow->course_title);?>"/>
                                                                </td>
								<td align="left">									
								</td>								
							</tr>
							<tr>
								<td align="right">
									Credit Hour:
								</td>
                                                                <td>
                                                                    <input type="text" name="txtcredithour" value="<?php print($resultRow->credit_hour);?>"/>
                                                                </td>
								<td align="left">									
									
								</td>								
							</tr>	
							<tr>
								<td align="right">
									Lecture Hour:
								</td>
                                                                <td>
                                                                    <input type="text" name="txtlecturehour" value="<?php print($resultRow->lecture_hour);?>"/>
                                                                </td>
								<td align="left">									
									
								</td>								
							</tr>
							<tr>
								<td align="right">
									Lab Hour:
								</td>
                                                                <td>
                                                                    <input type="text" name="txtlabhour" value="<?php print($resultRow->lab_hour);?>"/>
                                                                </td>
								<td align="left">									
									
								</td>								
							</tr>
							<tr>
								<td align="right">
									Tutorial Hour:
								</td>
                                                                <td>
                                                                    <input type="text" name="txttutorialhour" value="<?php print($resultRow->tutorial_hour);?>"/>
                                                                </td>
								<td align="left">									
									
								</td>								
							</tr>
							<tr>
								<td align="right">
									Category:
								</td>
                                                                <td>
                                                                    <?php
                                                                        print("<input type='text' id='slctcategory' name='slctcategory' value='$resultRow->category'/>");
                                                                    ?>
                                                                </td>
                                                                <?php
                                                                    //now show the list of course category saved from the database
                                                                    include_once('../classes/CourseCategory.php');
                                                                    $resultCourse = CourseCategory::getAllCourseCategory();
                                                                ?>
								<td align="left">
                                                                    <select name="slctcategory1" id="slctcategory1" onchange="showCourseCategory(this.value);">
                                                                        <option value="" selected="selected">--Select--</option>
                                                                        <?php
                                                                            while($resultCourseRow = mysql_fetch_object($resultCourse))
                                                                            {
                                                                                print("<option value='$resultCourseRow->course_category_name'>$resultCourseRow->course_category_name</option>");
                                                                            }//end while
                                                                        ?>
                                                                    </select>
								</td>								
							</tr>
                                                        <tr>
                                                            <td align="right">
                                                                Total Number of students:
                                                            </td>
                                                            <td>
                                                                <input type="text" name="txttotalnumberofstudents" value="<?php print($resultRow->total_number_of_students);?>"/>
                                                            </td>
                                                            <td>

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

