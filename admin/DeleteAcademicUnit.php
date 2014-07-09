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
        		
        		function confirmAcademicUnitDeletion()
        		{
        			if(window.confirm('Are you sure you want to delete this academic unit?'))
        				return true;
        			else
        				return false;
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
            		include("ManageAcademicUnitInnerMenu.inc");
            	?>  
            	           
					<!--now i need to read all the campus saved in the database-->
					<?php
						include_once("../classes/DBConnection.php");
						$query = "SELECT * FROM tblAcademicUnit, tblFaculty WHERE tblFaculty.id = tblAcademicUnit.faculty_id ORDER BY faculty_name, academic_unit_name ASC";
						$result = DBConnection::readFromDatabase($query);
						$ctr = 1;						
						print("<div align='center'>");
						
						print("<table width='80%' align='center'>");
						print("<caption>Delete Academic Unit</caption>");
						print("<tr style='background: lightblue'>");
							print("<th><font size='2'>Id</font></th>");
							print("<th><font size='2'>Faculty/Institute</font></th>");
							print("<th><font size='2'>Department/Academic Unit</font></th>");
							print("<th><font size='2'>D</font></th>");
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
									print("<font size='2'>$resultRow->id</font>");
								print("</td>");								
								print("<td align='center'>");
									print("<font size='2'>$resultFacultyRow->faculty_name</font>");
								print("</td>");
								
								print("<td align='center'>");
									print("<font size='2'>$resultRow->academic_unit_name</font>");
								print("</td>");
								
								print("<td align='center'>");
									print("<a href='DeleteThisAcademicUnit.php?id=$resultRow->id' onclick='return confirmAcademicUnitDeletion();'><img src='images/ImgDelete.gif' align='absmiddle' border='0'/></a>");
								print("</td>");
							print("</tr>");
							$ctr++;
						}//end while loop
						print("</table>");
						print("</div>");
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

