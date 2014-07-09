<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Academic Staff Load Managment System</title>
        <link rel="stylesheet" href="../style/Underground.css" />
        <script src="../js/js_script.js"></script>
        <link rel="shortcut icon" href="images/campus.jpeg"/>
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
            	?>             
					<div>
					   <p>
							This section lets you manage course information. Please choose the action from the 
							above menu.<br/>
							
							You can enter one course at a time. If you make a mistak while entering, you can use 
							the edit option. If a course is no logner needed in a department, you can use the delete option to 
							remove the course information from the database.
						</p>
					</div>					
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

