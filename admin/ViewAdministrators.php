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
						$query = "SELECT * FROM tblAdmin ORDER BY firstName,lastName ASC";
						$result = DBConnection::readFromDatabase($query);
						$ctr = 1;			
						print("<form>");			
						print("<div align='center'>");
						
						print("<table width='80%' align='center'>");
						print("<caption>List of Administrators</caption>");
						print("<tr style='background: lightblue'>");							
							print("<th>");
								print("<font size='2'>First Name</font>");
							print("</th>");
							print("<th>");
								print("<font size='2'>Last Name</font>");
							print("</th>");
							print("<th>");
								print("<font size='2'>Email</font>");
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
									print("<font size='2'>$resultRow->firstName</font>");
								print("</td>");								
								print("<td align='center'>");
									print("<font size='2'>$resultRow->lastName</font>");
								print("</td>");
								print("<td align='center'>");
									print("<font size='2'>$resultRow->email</font>");
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

