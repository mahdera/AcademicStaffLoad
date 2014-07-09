<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Academic Staff Load Managment System</title>
        <link rel="stylesheet" href="../style/Underground.css" />
        <script src="../js/js_script.js"></script>
        <link rel="shortcut icon" href="images/campus.jpeg"/>
        
        <script type="text/javascript" language="javascript">
        		function showCoursesOfThisAcademicUnit(deptId)
        		{
        			if (window.XMLHttpRequest)
					  {// code for IE7+, Firefox, Chrome, Opera, Safari
						  xmlhttp=new XMLHttpRequest();
					  }
					else
					  {// code for IE6, IE5
						  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					  }
					xmlhttp.onreadystatechange=function()
					  {
						  if (xmlhttp.readyState==4 && xmlhttp.status==200)
						  {
							  document.getElementById("innerContent").innerHTML = xmlhttp.responseText;							  
						  }
					  }
					xmlhttp.open("GET","GetAllCoursesOfThisAcademicUnit.php?academicUnitId="+deptId,true);
					xmlhttp.send();
        		}
        		
        		function checkAllCheckBoxes(howMany)
        		{
        			//alert(howMany);
        			for(i=1;i<=howMany;i++)
        			{
        				idVal = "chk"+i;
        				document.getElementById(idVal).checked = true;
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
        			require_once('../classes/DBConnection.php');
        			$academicUnitId = $_REQUEST['academicUnitId'];
        		?>
        		
            <?php
            	include('AdminSidebar.inc');
            	$query = "SELECT * FROM tblAcademicUnit ORDER BY academic_unit_name ASC";
					$result = DBConnection::readFromDatabase($query);
				?>            
            
            <div id="indexmain">              
					<select name="slctacademicunit" id="slctacademicunit" onchange="showCoursesOfThisAcademicUnit(this.value);">
							<option value="" selected="selected">--Select Academic Unit--</option>
							<?php
								while($resultRow = mysql_fetch_object($result))
								{
									print("<option value='$resultRow->id'>$resultRow->academic_unit_name</option>");
								}//end while
							?>
					</select>
					<hr/>
					<div id="innerContent">
						<?php
							include('GetOfferedCoursesForThisAcademicUnit.php?academicUnitId=$academicUnitId');
						?>
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

