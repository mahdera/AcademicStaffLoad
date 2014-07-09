<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Academic Staff Load Managment System</title>
        <link rel="stylesheet" href="style/Underground.css" />
        <script src="../js/js_script.js"></script>
	<script src="jQuery/jquery-1.11.1.min.js" type="text/javascript"></script>
        <link rel="shortcut icon" href="images/campus.jpeg"/>
        <script type="text/javascript" language="javascript">        		
        			
        		function showInstructor(str)
				{
					//alert(str);					
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
						    }
					  }
					if(str=="PS")//this is for parttimer staffs
					{
						document.getElementById("courseInfo").style.visibility = "hidden";
						xmlhttp.open("GET","SelectParttimerType.php",true);
						xmlhttp.send();
						//////////////////////here is where i have stoped @10:20
					}
					else
					{
						document.getElementById("courseInfo").style.visibility = "visible";
						xmlhttp.open("GET","GetInstructorInfo.php?q="+str,true);
						xmlhttp.send();
					}
				}
				
				function showSpecificParttimerDataEntry(str)
				{
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
						    }
					  }
					if(str=="AAU Parttimer")//this is for parttimer staffs
					{
						document.getElementById("courseInfo").style.visibility = "hidden";
						xmlhttp.open("GET","EnterAAUParttimerStaffInfo.php",true);
						xmlhttp.send();
						//////////////////////here is where i have stoped @10:20
					}
					else
					{
						document.getElementById("courseInfo").style.visibility = "hidden";
						xmlhttp.open("GET","EnterExternalParttimerStaffInfo.php?q="+str,true);
						xmlhttp.send();
					}
				}
				
				function showCourseGrid(){				    
				    var str = $("#numberofcourses").val();
				    var instId = $("#slctinstructor").val();
				    $('#courseGrid').load("CreateCourseGrid.php?num="+str+"&instId="+instId);
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
						/*if(document.getElementById(selectcategory).value=="")
						{		
							document.getElementById("errorMsg").innerHTML = "Select the category for course : "+i;
							document.getElementById(selectcategory).focus();
							document.getElementById(selectcategory).style.borderColor='red';
							return false;
						}*/
						i++;			
					}					
				}
				
				function changeCategory(str,ctrValue)
				{
					//alert(ctrValue);
					var divName = "categoryInfo"+ctrValue;
					if (str=="")
					  {
						  document.getElementById(divName).innerHTML="";
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
							    document.getElementById(divName).innerHTML=xmlhttp.responseText;
						    }
					  }
					xmlhttp.open("GET","GetCourseCategory.php?courseNumber="+str+"&ctrValue="+ctrValue,true);
					xmlhttp.send();
				}			
				
				function checkAndChangeColor(str,id)
				{
					if(str != "")
					{
						document.getElementById("errorMsg").innerHTML = "";
						document.getElementById(id).style.borderColor='lightblue';
					}
				}
				
				function changeVisibility()
				{
					//if(document.getElementById('').style.visibility == "hidden")
						//document.getElementById().style.visibility = "visible";
				}	
				
				function disableEnableNumberofSection(deliveryType,ctr)
				{
					//alert(deliveryType+" : "+ctr);
					//i need to hide the numberOfSection field iff deliverytype is
					//Thesis, PG Advising and Project Advising
					//var nubmerOfSections = "divnumsection";
					//alert("the control : "+nubmerOfSections);
					if(deliveryType == "Thesis" || deliveryType == "Advising" || deliveryType == "Project Advising")
					{
						//alert(deliveryType);
						document.getElementById("divnumsection").style.visibility = "hidden";
						document.getElementById("divnumstudinsection").style.visibility = "hidden";
					}
					else
					{
						document.getElementById("divnumsection").style.visibility = "visible";
						document.getElementById("divnumstudinsection").style.visiblity = "visible";
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
						<b>Enter Load Information</b>
					</div>
					
					<div id="selectInstructor">
						<input type="hidden" id="departmentId" value="<?php print($academicUnitid);?>"/>
						<?php
							//now i need to read all the instructors in this department
							$query = "SELECT * FROM tblInstructor WHERE academic_unit_id = '$academicUnitId' ORDER BY first_name, last_name ASC";
							$result = DBConnection::readFromDatabase($query);													
						?>
						<table border="0" width="100%">
							<tr style="background: lightyellow">								
								<td>
									Please Select An Instructor:&nbsp;
									<select name="slctinstructor" id="slctinstructor" onchange="showInstructor(this.value);enableShowGrid();changeVisibility();" style="width: 50%">
											<option value="" selected="selected">--Select Instructor--</option>
										<?php
											while($resultRow = mysql_fetch_object($result))
											{
										?>
											<option value="<?php print($resultRow->instructor_id);?>">
												<?php print($resultRow->first_name." ".$resultRow->last_name);?>
											</option>
											<?php
											}//end while loop
											print("<option value=''>==============</option>");
											$query = "SELECT * FROM tblParttimer WHERE academic_unit_id = '$academicUnitId' ORDER BY first_name, last_name ASC";											
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
											<!--now do the same for all the parttimers-->
											<option value="PS">--Add New Part Timer--</option>
									</select>									 
								</td>					
							</tr>
						</table>
					</div>
					
					<!--now comes the staff profile section which gets populated by the Ajax response man...LOL-->
					<div id="staffProfile">
						
					</div>				
					
					<!--According to Wondisho...this should be hidden at the begining-->
					<div id="courseInfo" style="visibility: hidden">											
							<table width="100%" border="0">
								<tr>
									<td>
										<!--<font size="2">Number of course/s</font>-->
									</td>
									<td>
										<input type="hidden" size="3" name="txtnumberofcourse" id="numberofcourses" value="1"/>
									</td>
									<td align="center">
										<input type="submit"  id="btnShowGrid" value="Add Course" class="button" disabled="disabled" onClick="showCourseGrid();"/>
									</td>
								<tr>
							</table>						
					</div>
					
					<div class="separater">					 
					</div>
					
					<div id="errorMsg">
					</div>					
					
					<div id="courseGrid">
						<div class="separater">					 
						</div>						
					</div>
					
					<div id="allInstructorsLoad">
						<?php
							include("ShowInstructorLoad.php");
						?>
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
