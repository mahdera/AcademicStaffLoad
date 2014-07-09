<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Academic Staff Load Managment System</title>
        <link rel="stylesheet" href="style/Underground.css" />
        <script src="../js/js_script.js"></script>
	<script type="text/javascript" src="jQuery/jquery-1.11.1.min.js"></script>
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
					xmlhttp.open("GET","GetInstructorInfoForEdit.php?q="+str,true);
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
				
				function showEditSection(ctr)
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
					xmlhttp.open("GET","GetInstructorLoadInfo.php?courseNumber="+courseNumber+"&instructorId="+instructorId+"&type="+type+"&courseTitle="+courseTitle,true);
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
				
				function assignCourseNumberValue(str)
				{
					if(str != "")
					{
						document.getElementById("txtselectedcoursetype").value=str;
					}
				}			
				
				function changeCourseTypeToSelected(str)
				{
					if(str != "")
					{
						document.getElementById("currentCourseTypeDiv").innerHTML = str;
						document.getElementById("txtselectedcoursetype").value = str;
					}
				}
				
				function assignCourseNumberToHiddenValue(str)
				{
					if(str != "")
					{
						document.getElementById("txtselectedcoursenumber").value = str;
					}
				}
				
				function showLoadEditionDiv(courseNumber,instructorId,divId,type){				    
					if (courseNumber==""){
						  document.getElementById("courseGrid").innerHTML="";
						  return;
					}else{ 					
					    $('#'+divId).load("GetLoadInfoDetail.php?courseNumber="+encodeURIComponent(courseNumber)+"&instructorId="+instructorId+"&divId="+divId+
							      "&type="+encodeURIComponent(type));
					}
				}
				
				function assignNewCourse(val)
				{
					//alert("Inside assignnewcourse and val is : "+val+" and cat is : "+category);
					document.getElementById('txtcoursenumber').value = val;					
				}
				
				function modifyCourseCategory(courseNumber)
				{
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
							    document.getElementById("txtcategory").value=xmlhttp.responseText;
						    }
					  }
					xmlhttp.open("GET","GetCourseCategory.php?courseNumber="+courseNumber,true);
					xmlhttp.send();
					
				}
				
				function assignNewType(val)
				{
					//alert("Inside assignnewtype and val is : "+val);
					document.getElementById('txttype').value = val;
				}
				
				function confirmLoadEdition()
				{
					if(window.confirm('Are you sure you want to update this record?'))
						return true;
					else 
						return false;
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
					
					<div id="editSection">
					</div>
					
					
					<?php
						//include('GetLoadReport.php');
						include_once('classes/DBConnection.php');
						include_once('classes/InstructorLoad.php');
						$academicUnitId = $_SESSION['deptId'];
						$query = "SELECT * FROM tblInstructor WHERE academic_unit_id = $academicUnitId ORDER BY first_name ASC";
						//print($query."<br/>");
						$resultInstructors = DBConnection::readFromDatabase($query);
						
						print("<table width='80%' border='0'>");
						   $divCounter = 1;
							while($resultInstructorsRow = mysql_fetch_object($resultInstructors))
							{
								$instructorId = $resultInstructorsRow->instructor_id;
								//now check if this instructor is available in the tblInstructorLoad
								$ans = InstructorLoad::doesThisInstructorHasALoad($instructorId,$academicUnitId);
								if($ans == "Yes")
								{
									print("<tr>");
										print("<td>");
											$divId = "editdiv".$divCounter;
											$_SESSION['rptId'] = $instructorId;
											include('GetNonRepeatingInstructorLoadInfo.php');
											//print("<hr/>");
											include('GetRepeatingInstructorLoadInfo.php');
											print("<div id='$divId'></div>");
											//print("<hr/>");
											//print("<hr/>");
										print("</td>");
									print("</tr>");
									print("<tr style='background:red'><td><hr/><hr/><hr/><hr/></td></tr>");
									$divCounter++;
								}//end if
								//print("inside main loop<br/>");
							}//end while loop
							print("</table>");
							
							//now do the same for the parttimer
							$query = "SELECT * FROM tblParttimer WHERE academic_unit_id = $academicUnitId ORDER BY first_name ASC";
							//print($query."<br/>");
							$resultParttimers = DBConnection::readFromDatabase($query);
							
							print("<table width='80%' border='0'>");
							   //$divCounter = 1;
								while($resultParttimersRow = mysql_fetch_object($resultParttimers))
								{
									$instructorId = $resultParttimersRow->parttimer_id;
									//now check if this instructor is available in the tblInstructorLoad
									$ans = InstructorLoad::doesThisInstructorHasALoad($instructorId,$academicUnitId);
									if($ans == "Yes")
									{
										print("<tr>");
											print("<td>");
												$divId = "editdiv".$divCounter;
												$_SESSION['rptId'] = $instructorId;
												include('GetNonRepeatingInstructorLoadInfo.php');
												//print("<hr/>");
												include('GetRepeatingInstructorLoadInfo.php');
												print("<div id='$divId'></div>");
												//print("<hr/>");
												//print("<hr/>");
											print("</td>");
										print("</tr>");
										print("<tr style='background:red'><td><hr/><hr/><hr/><hr/></td></tr>");
										$divCounter++;
									}//end if
									//print("inside main loop<br/>");
								}//end while loop
								print("</table>");
						
					?>				
					
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
