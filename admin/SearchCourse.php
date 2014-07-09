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
        			if(document.getElementById("slctacademicunit").value=="")
        			{        				
        				document.getElementById("errorMsg").innerHTML = "Select the academic unit!";
        				document.getElementById("slctacademicunit").focus();
        				document.getElementById("slctacademicunit").style.borderColor="red";        				
        				return false;
        			}
        			else if(document.getElementById("txtinstructorid").value=="")
        			{
        				document.getElementById("errorMsg").innerHTML = "Enter the instructor id!";
        				document.getElementById("txtinstructorid").focus();
        				document.getElementById("txtinstructorid").style.borderColor="red";        				
        				return false;
        			}
        			else if(document.getElementById("txtfirstname").value=="")
        			{
        				document.getElementById("errorMsg").innerHTML = "Enter the first name of the instructor!";
        				document.getElementById("txtfirstname").focus();
        				document.getElementById("txtfirstname").style.borderColor="red";        				
        				return false;
        			}
        			else if(document.getElementById("txtlastname").value=="")
        			{
        				document.getElementById("errorMsg").innerHTML = "Enter the last name of the instructor!";
        				document.getElementById("txtlastname").focus();
        				document.getElementById("txtlastname").style.borderColor="red";        				
        				return false;
        			}
        			else if(document.getElementById("txtemail").value=="")
        			{
	        			document.getElementById("errorMsg").innerHTML = "Enter the email of the instructor!";
        				document.getElementById("txtemail").focus();
        				document.getElementById("txtemail").style.borderColor="red";        				
        				return false;
        			}
        			else if(document.getElementById("txtmobilephone").value=="")
        			{
	        			document.getElementById("errorMsg").innerHTML = "Enter the mobile phone of the instructor!";
        				document.getElementById("txtmobilephone").focus();
        				document.getElementById("txtmobilephone").style.borderColor="red";        				
        				return false;
        			}
        			else if(document.getElementById("slctinstructorlevel").value=="")
        			{
        				document.getElementById("errorMsg").innerHTML = "Select Instructor level!";
        				document.getElementById("slctinstructorlevel").focus();
        				document.getElementById("slctinstructorlevel").style.borderColor="red";        				
        				return false;
        			}
        			else if(document.getElementById("txtserviceyear").value=="")
        			{
        				document.getElementById("errorMsg").innerHTML = "Enter the service year!";
        				document.getElementById("txtserviceyear").focus();
        				document.getElementById("txtserviceyear").style.borderColor="red";        				
        				return false;
        			}
        			else if(document.getElementById("txtspecialization").value=="")
        			{
        				document.getElementById("errorMsg").innerHTML = "Enter Specialization!";
        				document.getElementById("txtspecialization").focus();
        				document.getElementById("txtspecialization").style.borderColor="red";        				
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
           			document.getElementById(id).style.borderColor="lightblue";
           		}
           }
        </script>
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
            
            <div id="indexmain"> 
            	<?php
            		include("ManageCourseInnerMenu.inc");
            		include_once("../classes/DBConnection.php");            		
            		//$query = "SELECT * FROM tblAcademicUnit ORDER BY academic_unit_name ASC";
            		//$result = DBConnection::readFromDatabase($query);            		
            	?>  
            	
            	<div>
            			<form>
            				<table border="0" width="80%">
            					<tr>
            						<td width="20%">Search Course by:</td>
            						<td>
            							<select name="slctbyfield" id="slctbyfield" onchange="showSearchCourseBy(this.value);">
            								<option value="" selected="selected">--Select--</option>
            								<option value="Course Number">Course Number</option>
            								<option value="Course Title">Course Title</option>
            							</select>
            						</td>
            					</tr>
            				</table>
            			</form>
            	</div>
            	      
            	<div id="searchParameterDiv"></div>     
					<div id="searchResultDiv"></div>
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

