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
    session_start();
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
            	//include('AdminSidebar.inc');
            	include('AdminLoadReportInnerMenu.inc');
				?>            
            
            <div id="indexmain"> 
            	<?php
            		//include("ManageCampusInnerMenu.inc");decide about this with wondisho if modifying the staff profile is going to be required
            	?>  
            	          
                <!--here goes the details for the staff profile-->
                <?php
                	include('ShowStaffProfileNow.inc');
                ?>
            </div><!----all forms in this div-->

                
           
<?php
    require('../Footer.inc');
?>
		</div>
    </body>
    </html>
    <?php
            }
            else
            {
                echo "ur session has expired";
            }
 ?>

