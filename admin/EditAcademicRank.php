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
            		include("ManageAcademicRankInnerMenu.inc");
            	?>  
            	           
					<!--now i need to read all the campus saved in the database-->
					<?php
						include_once("../classes/DBConnection.php");
						include_once("../classes/AcademicRank.php");						
						
						$result = AcademicRank::getAllAcademicRanks();
						$ctr = 1;						
						print("<div align='center'>");
						
						print("<table width='80%' align='center' border='0'>");
						print("<caption>Edit Academic Rank</caption>");
						print("<tr style='background: lightblue'>");
							print("<th><font size='2'>Rank Name</font></th>");							
							print("<th><font size='2'>E</font>");
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
										print("<font size='2'>$resultRow->rank_name</font>");
									print("</td>");									
									print("<td align='center'>");
										print("<a href='EditThisAcademicRank.php?rankId=$resultRow->id'><img src='images/edit.gif' align='absmiddle' border='0'/></a>");
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

