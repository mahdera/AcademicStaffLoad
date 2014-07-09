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
    @session_start();
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
						include_once('classes/AdminPosition.php');
						
						$academicUnitId = $_SESSION['deptId'];
						$query = "SELECT * FROM tblInstructor WHERE academic_unit_id = $academicUnitId ORDER BY first_name ASC";						
						$resultInstructors = DBConnection::readFromDatabase($query);
						
						print("<table width='100%' border='0'>");
							print("<caption>Fulltimer instructors</caption>");
							print("<tr style='background:lightblue'>");
								print("<th><font size='2'>Instructor Id</font></th>");
								print("<th><font size='2'>Full Name</font></th>");
								print("<th><font size='2'>Email</font></th>");
								print("<th><font size='2'>Mobile Phone</font></th>");
								print("<th><font size='2'>Instructor Level</font></th>");
								print("<th><font size='2'>Service Year</font></th>");
								print("<th><font size='2'>Specialization</font></th>");
								print("<th><font size='2'>Other Responsibilities</font></th>");
							print("</tr>");
							$ctr = 1;
							while($resultInstructorsRow = mysql_fetch_object($resultInstructors))
							{
								if($ctr % 2 == 0)
							   {
								  print("<tr style='background:#ded7fe'>");
								}
								else
								{
								  print("<tr style='background:#ecfdfe'>");
								}			
									print("<td align='center'><font size='2'>$resultInstructorsRow->instructor_id</font></td>");
									print("<td><font size='2'>$resultInstructorsRow->first_name $resultInstructorsRow->last_name</font></td>");
									print("<td><font size='2'>$resultInstructorsRow->email</font></td>");
									print("<td><font size='2'>$resultInstructorsRow->mobile_phone</font></td>");
									print("<td><font size='2'>$resultInstructorsRow->instructor_level</font></td>");
									print("<td align='center'><font size='2'>$resultInstructorsRow->service_year</font></td>");
									print("<td><font size='2'>$resultInstructorsRow->specialization</font></td>");
									//now i need to get the additional responsibility name
									$adminPositionId = $resultInstructorsRow->other_responsibilities;
									$adminPositionNameResult = AdminPosition::getPositionName($adminPositionId);
									$adminPositionNameRow = mysql_fetch_object($adminPositionNameResult);
									$adminPositionName = $adminPositionNameRow->admin_position_name;
									print("<td><font size='2'>$adminPositionName</font></td>");
								print("</tr>");
								$ctr++;
							}//end while loop
							//print("</table>");
							print("<tr>");
								print("<td colspan='8' align='center'><strong>Parttimer Instructors</strong></td>");
							print("</tr>");
							$query = "SELECT * FROM tblParttimer WHERE academic_unit_id = $academicUnitId ORDER BY first_name ASC";
							//print($query);
							$parttimerResult = DBConnection::readFromDatabase($query);
							//print("<table width='80%' border='1'>");
							print("<tr style='background:lightblue'>");
								print("<th><font size='2'>Instructor Id</font></th>");
								print("<th><font size='2'>Full Name</font></th>");
								print("<th><font size='2'>Email</font></th>");
								print("<th><font size='2'>Mobile Phone</font></th>");
								print("<th><font size='2'>Instructor Level</font></th>");
								print("<th><font size='2'>Service Year</font></th>");
								print("<th><font size='2'>Specialization</font></th>");
								print("<th><font size='2'>Other Responsibilities</font></th>");
							print("</tr>");
							$ctr = 1;
							while($resultParttimersRow = mysql_fetch_object($parttimerResult))
							{
								if($ctr % 2 == 0)
							   {
								  print("<tr style='background:#ded7fe'>");
								}
								else
								{
								  print("<tr style='background:#ecfdfe'>");
								}	
									print("<td><font size='2'>$resultParttimersRow->parttimer_id</font></td>");
									print("<td><font size='2'>$resultParttimersRow->first_name $resultParttimersRow->last_name</font></td>");
									print("<td><font size='2'>$resultParttimersRow->email</font></td>");
									print("<td><font size='2'>$resultParttimersRow->mobile_phone</font></td>");
									print("<td><font size='2'>$resultParttimersRow->instructor_level</font></td>");
									print("<td align='center'><font size='2'>NA</font></td>");
									print("<td><font size='2'>$resultParttimersRow->specialization</font></td>");
									print("<td align='center'><font size='2'>NA</font></td>");
								print("</tr>");
								$ctr++;
							}//end while loop
							print("</table>");
						include('ReportInstructorInnerExportMenu.inc');
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
