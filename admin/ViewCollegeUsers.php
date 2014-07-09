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
        			if(document.frmaddcampus.txtcampusname.value=="")
        			{
        				alert("Enter the name of the campus");
        				document.frmaddcampus.txtcampusname.focus();
        				return false;
        			}
        			else
        				return true;
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
            		
            	?>  
            	           
					<!--now i need to read all the campus saved in the database-->
					<?php
						include_once("../classes/DBConnection.php");
						include_once("../classes/AdminPosition.php");
						$query = "SELECT * FROM tblCollegeUser ORDER BY first_name,last_name ASC";
						$result = DBConnection::readFromDatabase($query);
						$ctr = 1;			
						print("<form>");			
						print("<div align='center'>");
						
						print("<table width='80%' align='center'>");
						print("<caption>List of College Users</caption>");
						print("<tr style='background: lightblue'>");
							print("<th>");
								print("<font size='2'>Faculty</font>");
							print("</th>");
							print("<th>");
								print("<font size='2'>Id</font>");
							print("</th>");
							print("<th>");
								print("<font size='2'>First Name</font>");
							print("</th>");
							print("<th>");
								print("<font size='2'>Father's Name</font>");
							print("</th>");
							print("<th>");
								print("<font size='2'>Email</font>");
							print("</th>");
							print("<th>");
								print("<font size='2'>Mobile Phone</font>");
							print("</th>");
							print("<th>");
								print("<font size='2'>Admin Position</font>");
							print("</th>");							
						print("</tr>");
						while($resultRow = mysql_fetch_object($result))
						{
							$query = "SELECT * FROM tblFaculty WHERE id = '$resultRow->faculty_id'";														
							$resultFaculty = DBConnection::readFromDatabase($query);
							$resultFacultyRow = mysql_fetch_object($resultFaculty);
								
						   if($ctr % 2 == 0)
						   {
							  print("<tr style='background:#ded7fe'>");
							}
							else
							{
							  print("<tr style='background:#ecfdfe'>");
							}
								print("<td align='center'>");
									print("<font size='2'>$resultFacultyRow->faculty_name</font>");
								print("</td>");
								print("<td align='center'>");
									print("<font size='2'>$resultRow->instructor_id</font>");
								print("</td>");								
								print("<td align='center'>");
									print("<font size='2'>$resultRow->first_name</font>");
								print("</td>");								
								print("<td align='center'>");
									print("<font size='2'>$resultRow->last_name</font>");
								print("</td>");
								print("<td align='center'>");
									print("<font size='2'>$resultRow->email</font>");
								print("</td>");
								print("<td align='center'>");
									print("<font size='2'>$resultRow->mobile_phone</font>");
								print("</td>");
								$positionName = AdminPosition::getPositionNameFor($resultRow->administrative_position);								
								print("<td align='center'>");
									print("<font size='2'>$positionName</font>");
								print("</td>");
							print("</tr>");
							$ctr++;
						}//end while loop
						print("</table>");
						print("</div>");
						print("</form>");
					?>
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

