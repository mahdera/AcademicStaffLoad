<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Academic Staff Load Managment System</title>
        <link rel="stylesheet" href="style/Underground.css" />
        <script src="../js/js_script.js"></script>
        <link rel="shortcut icon" href="images/campus.jpeg"/>
        <script type="text/javascript" language="javascript">        		
        			
        		function showInstructor(str)
				{	
					document.getElementById("loadspan").style.visibility = "visible";				
					if (str=="")
					  {
						  document.getElementById("staffProfile").innerHTML="";
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
							    document.getElementById("staffProfile").innerHTML=xmlhttp.responseText;
							    document.getElementById("loadspan").style.visibility = "hidden";
						    }
					  }
					xmlhttp.open("GET","GetInstructorInfoForDelete.php?q="+str,true);
					xmlhttp.send();
				}
				
				
				
				function enableShowGrid()
				{
					document.getElementById("btnShowGrid").disabled=false;
				}
				
				function showGridDiv()
				{
					document.getElementById("courseInfo").style.visibility = "visible";
				}
				
				function isBlank()
				{
					var selectcourse = "slctcourse";
					var textnumberofsections = "txtnumberofsections";
					var selecttype = "slcttype";
					var selectcategory = "slctcategory";
					
					var numberOfCourses = document.getElementById("numberofcourses").value;
					
					var i=1;
					
					while(i<=numberOfCourses)
					{
						//alert("# of course : "+numberOfCourses+" i : "+i);
						selectcourse = selectcourse + i;
						textnumberofsections = textnumberofsections + i;
						selecttype = selecttype + i;
						selectcategory = selectcategory + i;						
						
						if(document.getElementById(selectcourse).value=="")
						{								
							document.getElementById("errorMsg").innerHTML = "Select course number for course : "+1;
							document.getElementById(selectcourse).focus();
							document.getElementById(selectcourse).style.borderColor='red';
							return false;
						}
						if(document.getElementById(textnumberofsections).value=="")
						{							
							document.getElementById("errorMsg").innerHTML = "Enter the number of sections for course : "+1;
							document.getElementById(textnumberofsections).focus();
							document.getElementById(textnumberofsections).style.borderColor='red';							
							return false;
						}
						if(document.getElementById(selecttype).value=="")
						{							
							document.getElementById("errorMsg").innerHTML = "Select the type for course : "+i;
							document.getElementById(selecttype).focus();
							document.getElementById(selecttype).style.borderColor='red';	
							return false;							
						}
						if(document.getElementById(selectcategory).value=="")
						{		
							document.getElementById("errorMsg").innerHTML = "Select the category for course : "+i;
							document.getElementById(selectcategory).focus();
							document.getElementById(selectcategory).style.borderColor='red';
							return false;
						}
						i++;			
					}					
				}
				
				function deleteThisRow(ctr)
				{
					//alert(ctr);
					var courseNumberId = "hidcoursenumber"+ctr;
					var courseTitleId = "hidcoursetitle"+ctr;
					var instructorIdId = "hidinstructorid"+ctr;
					var typeId = "hidtype"+ctr;
					//alert(courseNumberId);
					
					var courseNumber = document.getElementById(courseNumberId).value;
					var courseTitle = document.getElementById(courseTitleId).value;
					var instructorId = document.getElementById(instructorIdId).value;
					var type = document.getElementById(typeId).value;
					
					//alert("course number: "+courseNumber+" inst id: "+instructorId+" type: "+type);
					//it is safe upto this point Mahder
					//now formulate one string parameter which i can send to the php file
					 
					
					if (ctr=="")
					  {
						  document.getElementById("courseGrid").innerHTML="";
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
							    document.getElementById("courseGrid").innerHTML=xmlhttp.responseText;
						    }
					  }
					xmlhttp.open("GET","DeleteThisLoadInfo.php?courseNumber="+courseNumber+"&instructorId="+instructorId+"&type="+type,true);
					xmlhttp.send();
				}
				
				function getCourseTitle(courseNumber)
				{
					//alert(courseNumber);
					if (courseNumber=="")
					  {
						  document.getElementById("courseTitleDiv").innerHTML="";
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
							    document.getElementById("courseTitleDiv").innerHTML=xmlhttp.responseText;
						    }
					  }
					xmlhttp.open("GET","GetCourseTitle.php?courseNumber="+courseNumber,true);
					xmlhttp.send();
				}
				
				function checkAndChangeColor(str,id)
				{
					if(str != "")
					{
						document.getElementById("errorMsg").innerHTML = "";
						document.getElementById(id).style.borderColor='black';
					}
				}	
				
				function changeRowColor(id)
				{
					//var rowId = "tr" + id;
					//alert(rowId);
					document.getElementById(id).style.background = 'green';
				}
				
				function changeRowColorToThisColor(id)
				{
					alert("id : "+id);
					//document.getElementById(id).style.background = color;
				}	
				
				function confirmLoadDeletion(courseNumber)
				{
					if(window.confirm('Are you sure you want to delete load information for course : '+courseNumber+" ?"))
					{
						return true;
					}
					else
					{
						return false;
					}
				}		
				
        </script>
        
        <style type="text/css">
			.main {
			/*width:219px;*/
			width:100%;
			/*border:1px solid black;*/
			border:0px solid black;
			}
			
			.month {
			background-color:black;
			font:bold 12px verdana;
			color:white;
			}
			
			.daysofweek {
			background-color:#CCCCCC;
			font:bold 9px verdana;
			color:blue;
			}
			
			.days {
			font-size: 9px;
			font-family:verdana;
			color:black;
			/*background-color:#EAEAFF;*/
			background-color:#FAFAFA;
			padding: 1px;
			}
			
			.days #today{
			font-weight: bold;
			color:red;
			background-color:#CCCCCC;
			}
		 </style>
		 <script type="text/javascript" src="js_files/basiccalendar.js"></script>
    </head>
    <body>
<?php   
    @session_start();
    $sessName = $_SESSION['full_name'];
    //check if the session variable is set
    if(isset($sessName))
    {
    $globalInstId;
?>
 <div id="wrap">
       
 				<?php
        			require('IndexHeader.inc');
        		?>
        		
            <?php
            	include('UserSidebar.inc');
				?>            
            
             <div id="indexmain">             
					<?php
						include('InnerStatusBar.inc');						
					?>
					
					<div id="infoDisplay">
						<b>Delete Load Information</b>
					</div>
					
					<div id="selectInstructor">
						<input type="hidden" id="departmentId" value="<?php print($academicUnitid);?>"/>
						<?php
							//now i need to read all the instructors in this department
							$query = "SELECT * FROM tblInstructor WHERE academic_unit_id = $academicUnitId ORDER BY first_name,last_name ASC";
							$result = DBConnection::readFromDatabase($query);													
						?>
						<table border="0" width="80%">
							<tr>								
								<td>
									Please Select An Instructor:
									<select name="slctinstructor" id="slctinstructor" onchange="showInstructor(this.value);enableShowGrid();" style="width: 50%">
											<option value="" selected="selected">--Select Instructor--</option>
										<?php
											while($resultRow = mysql_fetch_object($result))
											{
										?>
											<option value="<?php print($resultRow->instructor_id);?>">
												<?php print($resultRow->first_name." ".$resultRow->last_name);?>
											</option>
											<?php
											}//end first while loop
											print("<option value=''>==============</option>");
											$query = "SELECT * FROM tblParttimer WHERE academic_unit_id = $academicUnitId";
											$resultParttimer = DBConnection::readFromDatabase($query);
											while($resultParttimerRow = mysql_fetch_object($resultParttimer))
											{
											?>
											<option value="<?php print($resultParttimerRow->parttimer_id);?>">
												<?php print($resultParttimerRow->first_name." ".$resultParttimerRow->last_name." (-PS-)");?>
											</option>
											<?php
											}
											?>
											?>
									</select> <span id="loadspan" style="visibility:hidden;"> <img src="admin/images/loadingfb.gif" width="16" height="16" align="absmiddle" border="0"/></span>									 
								</td>					
							</tr>
						</table>
					</div>
					
					<!--now comes the staff profile section which gets populated by the Ajax response man...LOL-->
					<div id="staffProfile">
						
					</div>					
					
					<div id="errorMsg">
					</div>					
					
					<div id="courseGrid">
						<div class="separater">					 
						</div>
						
					</div>					
					
            </div><!----all forms in this div-->

                
           
<?php
    require('Footer.inc');
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
