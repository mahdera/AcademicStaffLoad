<?php
	//get the passed id	
	include_once("classes/DBConnection.php");
	$numberOfCourses = $_GET['num'];
	$ctr = 1;
	//now show the result using a table
	print("<form name='frmcoursegrid' method='post' action='SaveLoadInfo.php' onsubmit='return isBlank();'>");
	$instId = $_GET['instId'];
	print("<input type='hidden' name='txtinstructorid' value='$instId'/>");
	print("<input type='hidden' name='txtnumberofcourses' value='$numberOfCourses'/>");
	print("<table border='0' width='100%' style='border:1px black'>");
		print("<tr style='background:lightblue'>");
				print("<th>");
					print("<font size='2'>Course</font>");
				print("</th>");
				
				print("<th>");
					print("<font size='2'>Delivery Type.</font>");
				print("</th>");
				
				print("<th>");
					print("<font size='2'>Num of Stud per sec.</font>");
				print("</th>");
				
				print("<th>");
					print("<font size='2'>Total Num of Stud.</font>");
				print("</th>");
				
				print("<th>");
					print("<font size='2'>Num. Sec</font>");
				print("</th>");
				
				print("<th>");
					print("<font size='2'>Category</font>");
				print("</th>");
				
				print("<th>");
					print("<font size='2'>Remark</font>");
				print("</th>");
		print("</tr>");
		//now show only those course in this department
		@session_start();
		$deptId = $_SESSION['deptId'];
		//change the table to ....tblOfferings later...dont forget mahder
		$query = "SELECT * FROM tblCourseDelivery";
		$resultCourseDelivery = DBConnection::readFromDatabase($query);
		
		$query = "SELECT * FROM tblCourseOfferings ORDER BY academic_unit_id, course_number, course_title ASC";
		//print($query);		
		$result = DBConnection::readFromDatabase($query);			
		
		while($ctr <= $numberOfCourses)
		{		
			
			if($ctr % 2 == 0)
		        {
			  print("<tr style='background:#ded7fe'>");
			}
			else
			{
			  print("<tr style='background:#ecfdfe'>");
			}					
				print("<td align='center'>");
					$controlName = trim("slctcourse".$ctr);
					print("<input type='hidden' id='hidcounter' value='$ctr'/>");					
					print("<select name='$controlName' lang='$ctr' id='$controlName' onchange='checkAndChangeColor(this.value,id);changeCategory(this.value,this.lang);' style='width:400px'>");
							print("<option value='' selected='selected'>--Select Course--</option>");
							$courseCtr = 0;					
							while($resultRow = mysql_fetch_object($result))
							{						
							 print("<option value='$resultRow->course_number' title='$resultRow->category'>");
								print("$resultRow->course_number: $resultRow->course_title");
							 print("</option>");							
							}							
					print("</select>");
					
				print("</td>");
				
				print("<td align='center'>");
					$controlName = "slcttype".$ctr;
					print("<select title='$ctr' name='$controlName' id='$controlName'>");
						print("<option value='' selected='selected'>--Select Type--</option>");
						while($resultCourseDeliveryRow = mysql_fetch_object($resultCourseDelivery))
						{
							print("<option value='$resultCourseDeliveryRow->course_delivery_name'>$resultCourseDeliveryRow->course_delivery_name</option>");						
						}						
						print("</select>");					
				print("</td>");
				
				print("<td align='center'>");
					$controlName = "txtnumberofstudentspersection".$ctr;
					$divId = "divnumstudinsection";
					print("<div id='$divId'>");
						print("<input type='text' size='2' name='$controlName' id='$controlName' onblur='checkAndChangeColor(this.value,id);' value='0'/>");
					print("</div>");
				print("</td>");
				
				print("<td align='center'>");
					$controlName = "txtnumberofstudents".$ctr;
					print("<input type='text' size='2' name='$controlName' id='$controlName' onblur='checkAndChangeColor(this.value,id);' value='0'/>");
				print("</td>");		
				
				print("<td align='center'>");					
					$controlName = "txtnumberofsections".$ctr;
					$divId = "divnumsection";
					print("<div id='$divId'>");
						print("<input type='text' size='2' name='$controlName' id='$controlName' onblur='checkAndChangeColor(this.value,id);' value='0'/>");
					print("</div>");
				print("</td>");			
				
				print("<td align='center'>");
					$controlName = "slctcategory".$ctr;
					$divName = "categoryInfo".$ctr;
					print("<input type='hidden' name='$controlName' value=''/>");
					print("<div id='$divName'></div>");				
				print("</td>");		
				
				print("<td align='center'>");
					$controlName = "textarearemark".$ctr;					
					print("<textarea name='$controlName' id='$controlName' style='width:100%' rows='1'>No Remark</textarea>");
				print("</td>");	
				
			print("</tr>");
			$ctr++;	
	 }
	 print("<tr>");
			print("<td colspan='7' align='center'>");
				print("<input type='submit' value='Save' class='button'/>");
			print("</td>");
		print("</tr>");
	print("</table>");
	print("</form>");			
?>
<script type="text/javascript">
       $(document).ready(function(){
	      var ctr = 1;
	      $('#slcttype'+ctr).change(function(){
		     var deliveryType = $('#slcttype'+ctr).val();
		     var category = $('#categoryInfo'+ctr).html();
		     
		     if (deliveryType != "" && category != "") {
			    var dataString = "deliveryType="+deliveryType+"&category="+category;
			    $.ajax({					
				    url: 'GetCalculatingMechanismOfThisDeliveryType.php',		
				    data: dataString,
				    type:'POST',
				    success:function(response){			    		
				    	  if (response.trim() == "student") {
						 $('#txtnumberofstudentspersection1').hide();
						 $('#txtnumberofstudents1').show();
						 $('#txtnumberofsections1').hide();
					  }else if (response.trim() == "section") {
						 $('#txtnumberofsections1').show();
						 $('#txtnumberofstudentspersection1').show();
						 $('#txtnumberofstudents1').show();
					  }
				    },
				    error:function(error){
					  alert(error);
				    }
			    });
		     }
	      });
       });
</script>