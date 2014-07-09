				<div id="sidebar">                
                <!--the side bar menu for the administrator will be listed below-->
                <h1>Sidebar menu</h1>
                <div class="left-box">
                    <ul class="sidemenu">
                            <li>Welcome <?php echo "<font color='green'>$sessName</font>"?>!</li>
                            <li><a href="UserArea.php"><img src="images/home.gif" border="0" align="absmiddle"/> User Area</a></li>
                            <li><a href="ManageInstructor.php"><img src="images/instructor.gif" border="0" align="absmiddle"/> Manage Instructor</a></li>
                            <?php
	                              @session_start();
	  										$academicUnitId = $_SESSION['deptId'];
						  					include_once('classes/Semester.php');
						  					include_once('classes/CompletedLoadInformation.php');
						  					$currentSemesterObj = Semester::getCurrentSemester(); 					
						  					$completed = CompletedLoadInformation::hasThisAcademicUnitCompletedLoadProcessing($academicUnitId,$currentSemesterObj->academic_year,$currentSemesterObj->semester);
						  					if($completed == "false"){
						  			 ?>
                            <li><a href="EnterLoadInfo.php"><img src="images/enterload.png" border="0" align="absmiddle"/> Enter Load Information</a></li>									 
									 <li><a href="EditLoadInfoListAll.php"><img src="images/update.gif" border="0" align="absmiddle"/> Edit Load Information</a></li>
									 <li><a href="DeleteLoadInfo.php"><img src="images/delete.png" border="0" align="absmiddle"/> Delete Load Information</a></li>									 
 									 <?php
 									 }else{
 									 ?>
 									 <li><strong><font color='red'>Your load Information has been submitted!</font></strong></li>
 									 <?php
 									 }
 									 ?> 
 									 <li><a href="ManageMyAccount.php"><img src="images/admin.gif" border="0" align="absmiddle"/> Manage My Account</a></li>
 									 <li><a href="LogOff.php"><img src="images/logout.gif" border="0" align="absmiddle"/> Logout</a></li>									 									                             
                    </ul>
                </div>  
                <h1>Reports</h1>
                <div class="left-box">
                	<ul class="sidemenu">
                		<li><a href="ManageInstructorReport.php"><img src="images/instructorreport.jpeg" border="0" align="absmiddle" /> Instructor Report</a></li>
                		<li><a href="ManageCourseReport.php"><img src="images/coursereport.jpeg" border="0" align="absmiddle" /> Course Report</a></li>
                		<li onMouseOver="hideReportFormatForBoth();"><a href="ManageLoadReport.php"><img src="images/loadreport.jpeg" border="0" align="absmiddle" /> Load Report</a></li>
                		<!--<li><a href="FPDF/pdf_report/tuto1.php">Mini Pdf</a></li>-->                		
                	</ul>
                </div>  
                <h1>Help</h1>
                <div class="left-box">
                	<ul class="sidemenu">
                		<li><a href="userguide.pdf"><img src="images/staff.gif" border="0" align="absmiddle"/>User Guide</a></li>
                	</ul>
                </div>       
                <h1>calendar</h1>
                <div class="left-box">
                    <script type="text/javascript">
								var todaydate=new Date();
								var curmonth=todaydate.getMonth()+1; //get current month (1-12);
								var curyear=todaydate.getFullYear(); //get current year				
								document.write(buildCal(curmonth ,curyear, "main", "month", "daysofweek", "days", 0));
						  </script>
                </div>                
            </div>