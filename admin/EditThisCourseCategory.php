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
            		include("ManageCourseCategoryInnerMenu.inc");
            		include_once("../classes/DBConnection.php");
            		$courseCategoryId = $_GET['id'];
            		$query = "SELECT * FROM tblCourseCategory WHERE id = $courseCategoryId";
            		$result = DBConnection::readFromDatabase($query);
            		$resultRow = mysql_fetch_object($result);
            	?>  
            	           
					<form name="frmeditadminposition" method="post" action="UpdateCourseCategory.php" onsubmit="return isBlank();">
						<br/><br/>
						
						<table width="80%">
						<caption>Update Course Category</caption>
							<tr>
								<td align="right">
									Course Category
								</td>
								<td align="left">
									<input type="hidden" name="txtcoursecategoryid" value="<?php print($resultRow->id);?>"/>
									<input type="text" name="txtcoursecategoryname" value="<?php print($resultRow->course_category_name);?>"/>
								</td>								
							</tr>
							<tr>
								<td>
								</td>
								<td>
									<input type="submit" value="Update" class="button"/>
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

