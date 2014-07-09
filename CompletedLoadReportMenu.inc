<div id="completedLoadInfoDiv" style="background:#FfCCCF" align="center">                    
  		<table  width="100%">
  		  <tr>
  			<td align="center">
  					<?php
  					@session_start();
  					$academicUnitId = $_SESSION['deptId'];
  					include_once('classes/Semester.php');
  					include_once('classes/CompletedLoadInformation.php');
  					$currentSemesterObj = Semester::getCurrentSemester(); 					
  					$completed = CompletedLoadInformation::hasThisAcademicUnitCompletedLoadProcessing($academicUnitId,$currentSemesterObj->academic_year,$currentSemesterObj->semester);
  					print("<input type='hidden' name='hiddenacademicunitid' id='hiddenacademicunitid' value='$academicUnitId'/>");
  					print("<input type='hidden' name='hiddenacademicyear' id='hiddenacademicyear' value='$currentSemesterObj->academic_year'/>");
  					print("<input type='hidden' name='hiddensemester' id='hiddensemester' value='$currentSemesterObj->semester'/>"); 					
  					
  					if($completed == "false"){
  					?>
	  					Please click the submit button if you completed all the load information for your academic unit | 
	  					<input type="button" value="Submit Load Information!" class="button" onclick="saveCompletedLoadInformation(document.getElementById('hiddenacademicunitid').value,
	  					document.getElementById('hiddenacademicyear').value,document.getElementById('hiddensemester').value);"/>
	  				<?php
	  				}else{
	  				?>
	  				<strong><font color='red' size='+1'>Your load Information has been submitted!</font></strong>
	  				<?php
	  				}
	  				?>
	  		</td>	  			
	  	  </tr>
  		</table>  		         
</div>