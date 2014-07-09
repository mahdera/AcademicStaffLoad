<?php
	include_once('classes/DBConnection.php');
	
	//first get the parameteres
	$courseNumber = $_GET['courseNumber'];
	$instructorId = $_GET['instructorId'];
	$divId = $_GET['divId'];
	$oldType = $_GET['type'];
	//now define the control names in here...
	$courseSelectControlName = "slctcourse" . $instructorId;
	$oldCourseNumberControlName = "txtoldcoursenumber" . $instructorId;
	$numberOfSectionsControlName = "txtnumberofsections" . $instructorId;
	$numberOfStudentsPerSectionControlName = "txtnumberofstudentspersection" . $instructorId;
	$numberOfStudentsControlName = "txtnumberofstudents" . $instructorId;
	$categoryControlName = "txtcategory" . $instructorId;	
	$deliveryTypeControlName = "slctdeliverytype" . $instructorId;
	$oldDeliveryTypeControlName = "txtolddeliverytype" . $instructorId;
	$remarkControlName = "textarearemark" . $instructorId;
	$buttonId = "btnupdate" . $instructorId;
	
	//design the query
	$query = "SELECT * FROM tblInstructorLoad WHERE instructor_id = '$instructorId' AND course_number = '$courseNumber' AND type = '$oldType'";
	$loadResult = DBConnection::readFromDatabase($query);
	$loadResultRow = mysql_fetch_object($loadResult);
	//time do design a small table
	print("<form name='frmupdateloadinfo' method='post'>");
		print("<table width='100%' border='0'>");
			print("<tr style='background: #ffeda0'>");
				print("<th><font size='2'>Fields</font></th>");
				print("<th><font size='2'>Current Value</font></th>");				
			print("</tr>");
			print("<tr style='background: #ffeda0'>");
				print("<td align='right'>");
					print("<font size='2'>Instructor Id:</font>");
				print("</td>");
				print("<td>");
					print("$loadResultRow->instructor_id");
					print("<input type='hidden' name='txtinstructorid' value='$loadResultRow->instructor_id'/>");
				print("</td>");				
			print("</tr>");
			print("<tr style='background: #ffeda0'>");
				print("<td align='right'>");
					print("<font size='2'>Course:</font>");
				print("</td>");
				print("<td>");
					$query = "SELECT * FROM tblCourseOfferings";
					$result = DBConnection::readFromDatabase($query);					
					print("<select name='$courseSelectControlName' id='$courseSelectControlName' style='width:500px'>");
						print("<option value='' selected='selected'>--Select Course--</option>");							
						while($resultRow = mysql_fetch_object($result)){
							if($resultRow->course_number == $courseNumber){	
								print("<option value='$resultRow->course_number' title='$resultRow->category' selected='selected'>");
								       print("$resultRow->course_number: $resultRow->course_title");
								print("</option>");
							}else{
								print("<option value='$resultRow->course_number' title='$resultRow->category'>");
								       print("$resultRow->course_number: $resultRow->course_title");
								print("</option>");
							}
						}//end while loop							
					print("</select>");
					print("<input type='hidden' name='$oldCourseNumberControlName' id='$oldCourseNumberControlName' value='$courseNumber'/>");
				print("</td>");				
			print("</tr>");
			//this row should be visible iff delivery type is diff from Advising or Project Advising or Thesis
			//display this row iff the selectd course requires the notion of number of secitons
			//if($loadResultRow->type != "Advising" && $loadResultRow->type != "Thesis" && $loadResultRow->type != "Project Advising")
			{						
				print("<tr style='background: #ffeda0'>");
					print("<td align='right'>");
						print("<font size='2'>Number of sections:</font>");
					print("</td>");
					print("<td>");
						if($loadResultRow->type == "Advising" || $loadResultRow->type == "Thesis" || $loadResultRow->type == "Project Advising")
							print("<input type='text' name='$numberOfSectionsControlName' id='$numberOfSectionsControlName' value='$loadResultRow->number_of_sections' readonly='readonly'/>");//am here
						else
							print("<input type='text' name='$numberOfSectionsControlName' id='$numberOfSectionsControlName' value='$loadResultRow->number_of_sections'/>");//am here
					print("</td>");					
				print("</tr>");			
			
				print("<tr style='background: #ffeda0'>");
					print("<td align='right'>");
						print("<font size='2'>Number of students per section:</font>");
					print("</td>");
					print("<td>");
						if($loadResultRow->type == "Advising" || $loadResultRow->type == "Thesis" || $loadResultRow->type == "Project Advising")
							print("<input type='text' name='$numberOfStudentsPerSectionControlName' id='$numberOfStudentsPerSectionControlName' value='$loadResultRow->number_of_students_per_section' readonly='readonly'/>");
						else
							print("<input type='text' name='$numberOfStudentsPerSectionControlName' id='$numberOfStudentsPerSectionControlName' value='$loadResultRow->number_of_students_per_section'/>");
					print("</td>");					
				print("</tr>");
			}//end course or advising checking if...condition
			
			print("<tr style='background: #ffeda0'>");
				print("<td align='right'>");
					print("<font size='2'>Number of Students:</font>");
				print("</td>");
				print("<td>");
					print("<input type='text' name='$numberOfStudentsControlName' id='$numberOfStudentsControlName' value='$loadResultRow->number_of_students' />");
				print("</td>");				
			print("</tr>");
			
			print("<tr style='background: #ffeda0'>");
				print("<td align='right'>");
					print("<font size='2'>Category:</font>");
				print("</td>");
				print("<td>");
					print("<input type='text' id='$categoryControlName' name='$categoryControlName' value='$loadResultRow->category' readonly='readonly'/>");
				print("</td>");				
			print("</tr>");
			
			print("<tr style='background: #ffeda0'>");
				print("<td align='right'>");
					print("<font size='2'>Delivery Type:</font>");
				print("</td>");
				print("<td>");
					$query = "SELECT * FROM tblCourseDelivery";
					$deliveryResult = DBConnection::readFromDatabase($query);
					print("<select name='$deliveryTypeControlName' id='$deliveryTypeControlName'>");
						print("<option value='' selected='selected'>--Select Delivery Type--</option>");							
						while($deliveryResultRow = mysql_fetch_object($deliveryResult)){
							if($oldType == $deliveryResultRow->course_delivery_name){	
								print("<option value='$deliveryResultRow->course_delivery_name' selected='selected'>");
								       print("$deliveryResultRow->course_delivery_name");
								print("</option>");
							}else{
								print("<option value='$deliveryResultRow->course_delivery_name'>");
								       print("$deliveryResultRow->course_delivery_name");
								print("</option>");
							}
						}//end while loop							
					print("</select>");
					print("<input type='hidden' name='$oldDeliveryTypeControlName' id='$oldDeliveryTypeControlName' value='$oldType'/>");
				print("</td>");				
			print("</tr>");
			
			print("<tr style='background: #ffeda0'>");
				print("<td align='right'>");
					print("<font size='2'>Remark:</font>");
				print("</td>");
				print("<td>");
					print("<textarea id='$remarkControlName' name='$remarkControlName' style='width:100%'>$loadResultRow->remark</textarea>");
				print("</td>");				
			print("</tr>");
			
			print("<tr style='background: #ffeda0'>");
				print("<td colspan='2' align='right'>");
					print("<input type='button' value='Update' class='button' id='$buttonId'/>");
					print("<input type='reset' value='Undo' class='button'/>");
				print("</td>");
			print("</tr>");
		print("</table>");
	print("</form>");
?>
<script type="text/javascript">
	$(document).ready(function(){
		var instructorId = "<?php echo $instructorId;?>";
		var divId = "<?php echo $divId;?>";
		//now define all the control names in here...
		var courseSelectControlName = "slctcourse" + instructorId;
		var numberOfSectionsControlName = "txtnumberofsections" + instructorId;
		var numberOfStudentsPerSectionControlName = "txtnumberofstudentspersection" + instructorId;
		var numberOfStudentsControlName = "txtnumberofstudents" + instructorId;
		var categoryControlName = "txtcategory" + instructorId;
		var deliveryTypeControlName = "slctdeliverytype" + instructorId;
		var remarkControlName = "textarearemark" + instructorId;
		var buttonId = "btnupdate" + instructorId;
		var oldCourseNumberControlName = "txtoldcoursenumber" + instructorId;
		var oldDeliveryTypeControlName = "txtolddeliverytype" + instructorId;
		
		$('#'+courseSelectControlName).change(function(){
			//get the course type and put the value in the categoryControlName...
			var courseNumber = $('#'+courseSelectControlName).val();
			var dataString = "courseNumber="+encodeURIComponent(courseNumber);
			
			$.ajax({					
				url: 'GetCourseCategory.php',		
				data: dataString,
				type:'POST',
				success:function(response){			    		
					$('#'+categoryControlName).val(response);				    		
				},
				error:function(error){
					alert(error);
				}
			});
		});
		
		$('#'+buttonId).click(function(){
			//now get all the values you want to update to the database...
			var courseNumber = encodeURIComponent($('#'+courseSelectControlName).val());
			var numberOfSections = $('#'+numberOfSectionsControlName).val();
			var numberOfStudentsPerSection = $('#'+numberOfStudentsPerSectionControlName).val();
			var numberOfStudents = $('#'+numberOfStudentsControlName).val();
			var category = $('#'+categoryControlName).val();
			var deliveryType = $('#'+deliveryTypeControlName).val();
			var remark = $('#'+remarkControlName).val();
			var oldCourseNumber = encodeURIComponent($('#'+oldCourseNumberControlName).val());
			var oldDeliveryType = encodeURIComponent($('#'+oldDeliveryTypeControlName).val());
			
			if (instructorId != "" && courseNumber != "" && numberOfSections != "" && numberOfStudentsPerSection != "" &&
			    numberOfStudents != "" && category != "" && deliveryType != "") {
				var dataString = "instructorId="+instructorId+"&courseNumber="+courseNumber+
				"&numberOfSections="+numberOfSections+"&numberOfStudentsPerSection="+
				numberOfStudentsPerSection+"&numberOfStudents="+numberOfStudents+
				"&category="+category+"&deliveryType="+deliveryType+"&remark="+remark+
				"&oldCourseNumber="+oldCourseNumber+"&oldDeliveryType="+oldDeliveryType;
				
				$.ajax({					
					url: 'UpdateLoadInfoDetail.php',		
					data: dataString,
					type:'POST',
					success:function(response){			    		
						$('#'+divId).html(response);				    		
					},
					error:function(error){
						alert(error);
					}
				});
			}else{
				alert("Please enter the necessary input data to edit the insturctor load record!");
			}
		});
	});//end document.ready function
</script>