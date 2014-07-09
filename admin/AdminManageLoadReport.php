<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Academic Staff Load Managment System</title>
        <link rel="stylesheet" href="../style/Underground.css" />
        <script src="../js/js_script.js"></script>
        <link rel="shortcut icon" href="images/campus.jpeg"/>
        <script type="text/javascript" language="javascript">
		 	function showLoadReportForThisAcademicUnit(academicUnitId,academicYear,semester)
		 	{
		 		//alert(academicUnitId+":"+academicYear+":"+semester);
		 		if(academicUnitId == "")
		 		{
		 			document.getElementById('errorMsg').innerHTML = "<font color='red'>Select the academic unit!</font>";
		 			document.getElementById('slctacademicunit').style.borderColor = "red";
		 			document.getElementById('slctacademicunit').focus();
		 			return false;
		 		}
		 		else if(academicYear == "")
		 		{
		 			document.getElementById('slctacademicunit').style.borderColor = "green";
		 			document.getElementById('slctacademicyear').style.borderColor = "red";
		 			document.getElementById('errorMsg').innerHTML = "<font color='red'>Select the academic year!</font>";
		 			document.getElementById('slctacademicyear').focus();
		 			return false;
		 		}
		 		else if(semester == "")
		 		{
		 			document.getElementById('slctacademicyear').style.borderColor = "green";
		 			document.getElementById('errorMsg').innerHTML = "<font color='red'>Select the semester!</font>";
		 			document.getElementById('slctsemester').style.borderColor = "red";
		 			document.getElementById('slctsemester').focus();
		 			return false;
		 		}
		 		else
		 		{
			 		//alert(academicUnitId+" : "+academicYear+" : "+semester);
			 		document.getElementById("loadspan").style.visibility = "visible";			 		 
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
							  document.getElementById("loadReportDiv").innerHTML = xmlhttp.responseText;
							  document.getElementById("loadspan").style.visibility = "hidden";
						  }
					  }
					xmlhttp.open("GET","GetCollegeLoadReport.php?academicUnitId="+academicUnitId+"&academicYear="+academicYear+"&semester="+semester,true);
					xmlhttp.send();
				}//end else
		 	}//end function 
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
        			//require('../IndexHeader.inc');
        			require('LoadReportHeader.inc');
        		?>
        		
            <?php
            	//include('AdminSidebar.inc');
            	include_once('AdminLoadReportInnerMenu.inc');
            	include_once('../classes/DBConnection.php');
				?>            
            
            <div id="indexmain">              
					<?php
						$currentYear = date("Y");						
						//print("last dig : $lastTwoDigit<br/>");
						//print($currentYear."<br/>");
						$query = "SELECT * FROM tblAcademicUnit ORDER BY academic_unit_name ASC";
						$result = DBConnection::readFromDatabase($query);
					?>
					<div>
						<select name="slctacademicunit" id="slctacademicunit">
							<option value="" selected="selected">--Select Academic Unit--</option>
							<?php
								while($resultRow = mysql_fetch_object($result))
								{
									print("<option value='$resultRow->id'>$resultRow->academic_unit_name</option>");
								}//end while
							?>
						</select>|									
						<select name="slctacademicyear" id="slctacademicyear">
							<option value="" selected="selected">--Select Academic Year--</option>							
							<?php
								$lastYear = $currentYear - 1;
								$currentYearLastTwoDigit = $currentYear % 100;
								while($currentYear >= 2005)//come and adjust this later
								{								
									$mixedYear = $lastYear--."/".$currentYearLastTwoDigit--;
									print("<option value='$mixedYear'>$mixedYear</option>");
									if($currentYearLastTwoDigit < 10)
										$currentYearLastTwoDigit = "0".$currentYearLastTwoDigit;
								   $currentYear--;
								}//end while loop
							?>
						</select>
						|
						<select name="slctsemester" id="slctsemester">
							<option value="" selected="selected">--Select Semester--</option>
							<option value="I">I</option>
							<option value="II">II</option>
							<option value="Summer">Summer</option>
						</select>	
						|
						<input type="button" value="Generate Report" class="button" onclick="showLoadReportForThisAcademicUnit(document.getElementById('slctacademicunit').value,document.getElementById('slctacademicyear').value,document.getElementById('slctsemester').value);"/>
						-- Load Report <span id="loadspan" style="visibility:hidden;"> <img src="images/loadingfb.gif" width="16" height="16" align="absmiddle" border="0"/></span>
						<span id="errorMsg"></span>
					</div>
					<hr/>
					<div id="loadReportDiv">
						Load Report will be listed here
					</div>
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

