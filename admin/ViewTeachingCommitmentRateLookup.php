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
            		include("ManageTeachingCommitmentRateLookupInnerMenu.inc");
            	?>  
            	           
					<!--now i need to read all the campus saved in the database-->
					<?php
						include_once("../classes/DBConnection.php");
						include_once("../classes/ExpectedTeachingCommitmentRateLookup.php");						
						
						$result = ExpectedTeachingCommitmentRateLookup::getAllExpectedTeachingCommitmentRateLookups();
						$ctr = 1;						
						print("<div align='center'>");
						
						print("<table width='80%' align='center' border='0'>");
						print("<caption>List of Teaching Commitment Rate Lookups</caption>");
						print("<tr style='background: lightblue'>");
							print("<th><font size='2'>Percentage</font></th>");						
							print("<th><font size='2'>Expected Hour</font></th>");
						print("</tr>");
						
							while($resultRow = mysql_fetch_object($result))
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
										print("<font size='2'>$resultRow->percentage</font>");
									print("</td>");									
									print("<td align='center'>");
										print("<font size='2'>$resultRow->expected_hour</font>");
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

