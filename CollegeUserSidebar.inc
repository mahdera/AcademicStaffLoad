				<div id="sidebar">                
                <!--the side bar menu for the administrator will be listed below-->
                <h1>Reports</h1>
                <div class="left-box">
                	<ul class="sidemenu">
                		<li><a href="CollegeManageInstructorReport.php"><img src="images/instructorreport.jpeg" border="0" align="absmiddle" /> Instructor Report</a></li>
                		<li><a href="CollegeManageCourseReport.php"><img src="images/coursereport.jpeg" border="0" align="absmiddle" /> Course Report</a></li>
                		<li><a href="CollegeManageLoadReport.php"><img src="images/loadreport.jpeg" border="0" align="absmiddle" /> Load Report</a></li>
                		<li><a href="LogOff.php"><img src="images/logout.gif" border="0" align="absmiddle"/> Logout</a></li>                		
                	</ul>
                </div>  
                <h1>Help</h1>
                <div class="left-box">
                	<ul class="sidemenu">
                		<li><a href="userguide.pdf">User Guide</a></li>
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