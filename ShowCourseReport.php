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
						$query = "SELECT * FROM tblCourse WHERE academic_unit_id = $academicUnitId ORDER BY course_number ASC";						
						$resultCourses = DBConnection::readFromDatabase($query);
						
						print("<table width='100%' border='0'>");
							print("<tr style='background:lightblue'>");
								print("<th><font size='2'>Course Number</font></th>");
								print("<th><font size='2'>Course Title</font></th>");
								print("<th><font size='2'>Credit Hour</font></th>");
								print("<th><font size='2'>Lecture Hour</font></th>");
								print("<th><font size='2'>Lab Hour</font></th>");
								print("<th><font size='2'>Category</font></th>");
								print("<th><font size='2'>Total Number of students</font></th>");								
							print("</tr>");
							$ctr = 1;
							while($resultCoursesRow = mysql_fetch_object($resultCourses))
							{
								if($ctr % 2 == 0)
							   {
								  print("<tr style='background:#ded7fe'>");
								}
								else
								{
								  print("<tr style='background:#ecfdfe'>");
								}			
									print("<td align='center'><font size='2'>$resultCoursesRow->course_number</font></td>");
									print("<td align='left'><font size='2'>$resultCoursesRow->course_title</font></td>");
									print("<td align='center'><font size='2'>$resultCoursesRow->credit_hour</font></td>");
									print("<td align='center'><font size='2'>$resultCoursesRow->lecture_hour</font></td>");
									print("<td align='center'><font size='2'>$resultCoursesRow->lab_hour</font></td>");
									print("<td align='center'><font size='2'>$resultCoursesRow->category</font></td>");
									print("<td align='center'><font size='2'>$resultCoursesRow->total_number_of_students</font></td>");								
								print("</tr>");
								$ctr++;
							}//end while loop
							print("</table>");
						include('ShowCourseReportInnerExportMenu.inc');
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
