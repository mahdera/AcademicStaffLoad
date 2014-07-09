<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Academic Staff Load Managment System</title>
        <link rel="stylesheet" href="style/Underground.css" />
        <script src="../js/js_script.js"></script>
        <link rel="shortcut icon" href="images/campus.jpeg"/>
        
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
		 <script type="text/javascript" language="javascript">
		 	function showInstructorReportForThisAcademicUnit(val)
		 	{
		 		//alert("10x to God! val is : "+val);
		 		if (val=="")
				  {
					  document.getElementById("instructorReportDiv").innerHTML="";
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
						  document.getElementById("instructorReportDiv").innerHTML = xmlhttp.responseText;
					  }
				  }
				xmlhttp.open("GET","GetCollegeInstructorReport.php?id="+val,true);
				xmlhttp.send();
		 	}//end function 
		 </script>
    </head>
    
    <body>
<?php   
    session_start();
    $sessName = $_SESSION['full_name'];
    //check if the session variable is set
    if(isset($sessName))
    {
?>
 <div id="wrap">
 				<?php
        			require('IndexHeader.inc');
        		?>
        		
            <?php
            	include('CollegeUserSidebar.inc');
				?>            
            
            <div id="indexmain">              
					<?php
						include('CollegeInnerStatusBar.inc');
						//include('classes/DBConnection.php');
						//now get all the academic units in this faculty
						$facultyId = $_SESSION['facultyId'];
						$query = "SELECT * FROM tblAcademicUnit WHERE faculty_id = '$facultyId'";
						$result = DBConnection::readFromDatabase($query);
					?>					
					<div>
						<select name="slctacademicunit" onChange="showInstructorReportForThisAcademicUnit(this.value);">
							<option value="" selected="selected">--Select Academic Unit--</option>
							<?php
								while($resultRow = mysql_fetch_object($result))
								{
									print("<option value='$resultRow->id'>$resultRow->academic_unit_name</option>");
								}//end while
							?>
						</select>
						-- Instructor Report
					</div>
					<hr/>
					<div id="instructorReportDiv">
						Instructor Report will be listed here
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
