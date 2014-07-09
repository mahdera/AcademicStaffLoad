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
            		include_once("../classes/DBConnection.php");
            		$rankId = $_REQUEST['rankId'];
            		
            		$query = "SELECT * FROM tblAcademicRank WHERE id = $rankId";
            		//print($query);
            		$result = DBConnection::readFromDatabase($query);
            		$resultRow = mysql_fetch_object($result);
            	?>  
            	           
					<form name="frmeditacademicrank" method="post" action="UpdateAcademicRank.php" onsubmit="return isBlank();">
						<br/><br/>
						
						<table width="80%">
						<caption>Update Academic Rank</caption>
							<tr>
								<td align="right">
									Rank Name
								</td>
								<td align="left">
									<input type="text" name="txtrankname" id="txtrankname" value="<?php print($resultRow->rank_name);?>"/>
									<input type="hidden" name="txtrankid" id="txtrankid" value="<?php print($rankId);?>"/>							
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

