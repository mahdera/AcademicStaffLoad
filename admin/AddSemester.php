<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Academic Staff Load Managment System</title>
        <link rel="stylesheet" href="../style/Underground.css" />
        <script src="../js/js_script.js"></script>
        <link rel="shortcut icon" href="images/campus.jpeg"/>
        <script language="javascript">
        		function isBlank()
        		{
        			if(document.getElementById("txtcampusname").value=="")
        			{        				
        				document.getElementById("errorMsg").innerHTML = "Enter the name of the campus!";
        				document.getElementById("txtcampusname").focus();
        				document.getElementById("txtcampusname").style.borderColor="red";        				
        				return false;
        			}
        			else
        				return true;
        		}
        		
        	  function checkAndChangeColor(str,id)
           {
           		if(str != "")
           		{
           			document.getElementById("errorMsg").innerHTML = "";
           			document.getElementById(id).style.borderColor="black";
           		}
           }
        </script>
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
            
            <div id="indexmain"> 
            	<?php
            		include("ManageSemesterInnerMenu.inc");
            	?>  
            	           
					<form name="frmaddcoursedelivery" method="post" action="SaveSemester.php" onsubmit="return isBlank();">
						<br/><br/>
						
						<div id="errorMsg"></div>
						<table width="80%" border="0">
						<caption>Add Semester</caption>
							<tr>
								<td align="right">
									Current Semester
								</td>
								<td align="left">
									<select name="slctsemester">
										<option value="" selected="selected">--Select--</option>
										<option value="I">I</option>
										<option value="II">II</option>
										<option value="Summer">Summer</option>
									</select>
								</td>								
							</tr>
							
							<tr>
								<td align="right">
									Current Academic year
								</td>
								<td align="left">
									<input type="text" name="txtacademicyear"/> e.g 2010/11
								</td>
							</tr>
							
							<tr>
								<td></td>
								<td align="left">
									<input type="submit" value="Add" class="button"/>
								</td>
							</tr>
							
						</table>
						<br/><br/><br/><br/><br/><br/><br/>
					</form>			
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

