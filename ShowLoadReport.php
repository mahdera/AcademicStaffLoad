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
            	//include('UserSidebar.inc');
				?>            
            
            <div id="indexmain">              
					<?php
						include('InnerStatusBar.inc');
					?>	
					<hr/>
					<?php
						include('ReportInnerMenu.inc');
						print("<hr/>");						
					?>
					
					<?php
						//include('GetLoadReport.php');
						include_once('classes/DBConnection.php');
						include_once('classes/InstructorLoad.php');
						$academicUnitId = $_SESSION['deptId'];
						$query = "SELECT * FROM tblInstructor WHERE academic_unit_id = $academicUnitId ORDER BY first_name ASC";
						//print($query."<br/>");
						$resultInstructors = DBConnection::readFromDatabase($query);
						
						print("<table width='100%' border='0'>");
						
							while($resultInstructorsRow = mysql_fetch_object($resultInstructors))
							{
								$instructorId = $resultInstructorsRow->instructor_id;
								//now check if this instructor is available in the tblInstructorLoad
								$ans = InstructorLoad::doesThisInstructorHasALoad($instructorId);
								if($ans == "Yes")
								{
									print("<tr>");
										print("<td>");
											//initialize a session object
											$_SESSION['rptId'] = $instructorId;
											include('GetNonRepeatingInstructorLoadInfo.php');
											//print("<hr/>");
											include('GetRepeatingInstructorLoadInfo.php');
											//print("<hr/>");
											//print("<hr/>");
										print("</td>");
									print("</tr>");
									print("<tr style='background:red'><td><hr/><hr/><hr/><hr/><hr/><hr/><hr/></td></tr>");
								}//end if
								//print("inside main loop<br/>");
							}//end while loop
							print("</table>");
						include('ReportInnerExportMenu.inc');
					?>				
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
