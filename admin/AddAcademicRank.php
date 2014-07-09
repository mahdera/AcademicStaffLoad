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
        			if(document.getElementById("txtacademicrank").value=="")
        			{        				
        				document.getElementById("errorMsg").innerHTML = "Enter the name of the rank!";
        				document.getElementById("txtacademicrank").focus();
        				document.getElementById("txtacademicrank").style.borderColor="red";        				
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
            		include("ManageAcademicRankInnerMenu.inc");
            		include_once('../classes/AcademicRank.php');
            		
            	?>  
            	           
					<form name="frmaddacademicrank" method="post" action="SaveAcademicRank.php" onsubmit="return isBlank();">
						<br/><br/>
						
						<div id="errorMsg"></div>
						<table width="80%">
							<caption>Add Academic Rank</caption>							
							<tr>
								<td align="right">
									Academic Rank
								</td>														
								<td align="left">
									<input type="text" name="txtacademicrank" id="txtacademicrank"/>									
								</td>								
							</tr>							
							<tr>
								<td>
								</td>
								<td>
									<input type="submit" value="Add" class="button"/>
									<input type="reset" value="Clear" class="button"/>
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

