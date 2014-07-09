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
        		
        		function confirmDeliveryRateDeletion()
        		{
        			if(window.confirm('Are you sure you want to delete this delivery rate?'))
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
            		include("ManageDeliveryLookUpInnerMenu.inc");
            	?>  
            	           
					<!--now i need to read all the campus saved in the database-->
					<?php
						include_once("../classes/DBConnection.php");
						include_once("../classes/RateLookUp.php");						
						
						$result = RateLookUp::getAllRateLookUp();
						$ctr = 1;						
						print("<div align='center'>");
						
						print("<table width='80%' align='center' border='0'>");
						print("<caption>Edit Delivery Rates</caption>");
						print("<tr style='background: lightblue'>");
							print("<th><font size='2'>Category</font></th>");							
							print("<th><font size='2'>Delivery Type</font></th>");
							print("<th><font size='2'>Rate</font></th>");
							print("<th><font size='2'>Calculating Mechanism</font></th>");
							print("<th><font size='2'>D</font>");
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
									print("<td align='left'>");
										print("<font size='2'>$resultRow->category</font>");
									print("</td>");
									print("<td align='left'>");
										print("<font size='2'>$resultRow->delivery_type</font>");
									print("</td>");
									print("<td align='left'>");
										print("<font size='2'>$resultRow->rate</font>");
									print("</td>");
									print("<td align='left'>");
										print("<font size='2'>$resultRow->calculating_mechanism</font>");
									print("</td>");
									print("<td align='center'>");
										print("<a href='DeleteThisDeliveryRate.php?category=$resultRow->category&type=$resultRow->delivery_type' onclick='return confirmDeliveryRateDeletion();'><img src='images/ImgDelete.gif' align='absmiddle' border='0'/></a>");
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

