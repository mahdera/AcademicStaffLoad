<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Academic Staff Load Managment System</title>
        <link rel="stylesheet" href="../style/Underground.css" />
        <script src="../js/js_script.js"></script>
        <link rel="shortcut icon" href="images/campus.jpeg"/>
        <script type="text/javascript" language="javascript" src="../Ajax/ajax.js"></script>        
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
            
            <div id="adminmain">
            		<font color='red' size='+1'>              
						<?php
								@session_start();				
								$selectedCourseNumber = $_SESSION['courseToBeRemoved'];
								$courseObj = Course::getCourse($selectedCourseNumber);
								print("Course $selectedCourseNumber: $courseObj->course_title can't be deleted as it is currently given in the following academic units:<br/>");
								$currentUseList = CourseOffering::getCurrentOfferingListForCourse($selectedCourseNumber);
								$ctr = 1;
								while($currentUseListRow = mysql_fetch_object($currentUseList)){
									$academicUnitObj = AcademicUnit::getAcademicUnit($currentUseListRow->academic_unit_id);
									print("$ctr. $academicUnitObj->academic_unit_name<br/>");
									$ctr++;
								}//end while loop
						?>
						</font>
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

