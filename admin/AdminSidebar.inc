				<head>
					<script type="text/javascript" language="javascript">
						function confirmDataTruncation()
				        		{
				        			if(window.confirm('Make sure you did not create a new semester before performing this operation! After performing the house keeping operation, you need to delete the old semester and create the new semester!'))
				        			{
				        				if(window.confirm('Are you sure you want to truncate all the Instructor load and Load summary tables?'))
				        					return true;
				        				else
				        					return false;
				        			}
				        			else
				        				return false;
				        		}
					</script>
				</head>				
				<div id="sidebar">                
                <!--the side bar menu for the administrator will be listed below-->
                <h1>Sidebar menu</h1>
                <div class="left-box">
                    <ul class="sidemenu">
                            <li>Welcome <?php echo "<font color='green'>$sessName</font>"?>!</li>
                            <li><a href="AdminArea.php"><img src="images/home.gif" border="0" align="absmiddle"/> Admin Area</a></li>
									 <li><a href="ManageCampus.php"><img src="images/campus.jpeg" border="0" align="absmiddle"/> Manage Campus</a></li>                            
									 <li><a href="ManageFaculty.php"><img src="images/faculty.png" border="0" align="absmiddle"/> Manage Faculty</a></li>
									 <li><a href="ManageAcademicUnit.php"><img src="images/dept.gif" border="0" align="absmiddle"/> Manage Academic Unit</a></li>	                            
                            <li><a href="ManageCourse.php"><img src="images/course.jpeg" border="0" align="absmiddle"/> Manage Course</a></li>								 
									 <li><a href="ManageInstructor.php"><img src="images/instructor.gif" border="0" align="absmiddle"/> Manage Instructor</a></li>
									 <li><a href="ManageSemester.php"><img src="images/semester.jpeg" border="0" align="absmiddle"/> Manage Semester</a></li>
									 <li><a href="AdminManageLoadReport.php"><img src="images/loadreport.jpeg" border="0" align="absmiddle"/> Load Report</a></li>
									 <li><a href="AdminManageTotalLoadReport.php"><img src="images/text.png" border="0" align="absmiddle"/> Total Load Report</a></li>
									 <li><a href="TotalHTMLConverter.exe"><img src="images/excel.jpeg" border="0" align="absmiddle"/> Install Excel Converter</a></li>
									 <li><a href="AdminManageHouseKeeping.php" onclick="return confirmDataTruncation();"><img src="images/housekeeping.gif" border="0" align="absmiddle"/> House Keeping</a></li>
									 <li><a href="AdminViewCompletedLoadInformation.php"><img src="images/view.png" border="0" align="absmiddle"/> Completed Load Information</a></li>
									 <li><a href="AdminTakeBackup.php"><img src="images/backup.png" border="0" align="absmiddle"/> Take Backup</a></li>
									 <li><a href="LogOff.php"><img src="images/logout.gif" border="0" align="absmiddle"/> Logout</a></li>									                             
                    </ul>
                </div>
                
                <h1>Manage Fields</h1>
                <div class="left-box">
                	<ul class="sidemenu">
                		<li><a href="ManageAdminPosition.php"><img src="images/adminposition.gif" border="0" align="absmiddle"/> Manage Admin Positions</a></li>
                		<li><a href="ManageCourseCategory.php"><img src="images/coursecategory.gif" border="0" align="absmiddle"/> Manage Course Category</a></li>
                		<li><a href="ManageCourseDelivery.php"><img src="images/deliverytype.gif" border="0" align="absmiddle"/> Manage Type of Delivery</a></li>
                		<li><a href="ManageDeliveryLookUp.php"><img src="images/settings.png" border="0" align="absmiddle"/> Manage Delivery Look up</a></li>
                		<li><a href="ManageAcademicRank.php"><img src="images/degree.jpeg" border="0" align="absmiddle"/> Manage Academic Rank</a></li>
                		<!--<li><a href="ManageTeachingCommitment.php"><img src="images/teaching.jpeg" border="0" align="absmiddle"/> Manage Teaching Commitment</a></li>-->
                		<li><a href="ManageTeachingCommitmentRateLookup.php"><img src="images/ratelookup.jpeg" border="0" align="absmiddle"/> Commitment Rate Lookup</a></li>
                	</ul>
                </div>
                
                <h1>Manage Administrator</h1>
                <div class="left-box">
                		<ul class="sidemenu">
                			<li><a href="AddAdministrator.php"><img src="images/key.jpeg" border="0" align="absmiddle"/> Add Administrator</a></li>                			
                			<li><a href="ViewAdministrators.php"><img src="images/viewadmin.jpeg" border="0" align="absmiddle"/> View Administrator</a></li>
                			<li><a href="EditAdministrator.php"><img src="images/editadmin.jpeg" border="0" align="absmiddle"/> Edit Administrator</a></li>
                			<li><a href="DeleteAdministrator.php"><img src="images/deleteadmin.jpeg" border="0" align="absmiddle"/> Delete Administrator</a></li>
                			<!--<li><a href="ViewCollegeUsers.php"><img src="images/home.jpeg" border="0" align="absmiddle"/> View College Users</a></li>-->                			                			                			
                		</ul>
                </div>
                
                <h1>Manage College Users</h1>
                <div class="left-box">
                <ul class="sidemenu">
                			<li><a href="AddCollegeUser.php"><img src="images/career.jpeg" border="0" align="absmiddle"/> Add College Users</a></li>
                			<li><a href="ViewCollegeUsers.php"><img src="images/view_college_users.jpeg" border="0" align="absmiddle"/> View College Users</a></li>
                			<li><a href="EditCollegeUser.php"><img src="images/edit_college_user.jpeg" border="0" align="absmiddle"/> Edit College User</a></li>
                			<li><a href="DeleteCollegeUser.php"><img src="images/delete_college_user.jpeg" border="0" align="absmiddle"/> Delete College User</a></li>
                			</ul>                			
                </div>
                
                <h1>Manage Users</h1>
                <div class="left-box">
                <ul class="sidemenu">
                			<li><a href="AddUser.php"><img src="images/adduser.gif" border="0" align="absmiddle"/> Add User</a></li>
                			<li><a href="EditUser.php"><img src="images/edituser.jpeg" border="0" align="absmiddle"/> Edit User</a></li>
                			<li><a href="DeleteUser.php"><img src="images/delete.png" border="0" align="absmiddle"/> Delete User</a></li>
                			<li><a href="ViewUsers.php"><img src="images/viewusers.png" border="0" align="absmiddle"/> View Users</a></li>
                			</ul>
                </div>
                
                <h1>Reset Accounts</h1>
                <div class="left-box">
                <ul class="sidemenu">
                			<li><a href="ResetAccount.php"><img src="images/resetaccount.jpeg" border="0" align="absmiddle"/> Reset Account</a></li>
                			</ul>
                </div>
                
                <h1>Staff Profile</h1>
                <div class="left-box">
                	 <ul class="sidemenu">
                	 	<li><a href="ShowStaffProfile.php"><img src="images/staffprofile.jpeg" border="0" align="absmiddle"/> Generate Staff Profile</a></li>                	 	
                	 </ul>
                </div>
                
            </div>