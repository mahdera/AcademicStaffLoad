<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Academic Staff Load Managment System</title>
        <link rel="stylesheet" href="../style/Underground.css" />
        <script src="../js/js_script.js"></script>
        <link rel="shortcut icon" href="images/campus.jpeg"/>
        <script type="text/javascript" language="javascript" src="../Ajax/ajax.js"></script>
        <script type="text/javascript" language="javascript">
		 	function showLoadReportForThisAcademicUnit(val)
		 	{
		 		//alert("10x to God! val is : "+val);
		 		document.getElementById("loadspan").style.visibility = "visible";
		 		if (val=="")
				  {
					  document.getElementById("loadReportDiv").innerHTML="";
					  return;
				  } 
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
						  document.getElementById("loadReportDiv").innerHTML = xmlhttp.responseText;
						  document.getElementById("loadspan").style.visibility = "hidden";
					  }
				  }
				xmlhttp.open("GET","GetCollegeLoadReport.php?id="+val,true);
				xmlhttp.send();
		 	}//end function 
		 	
		 	function showLoadReportForThisInstructor()
		 	{
		 		var val = document.getElementById("txtinstructorid").value;
		 		//alert(val);
		 		document.getElementById("loadspan").style.visibility = "visible";
		 		if (val=="")
				  {
					  document.getElementById("loadReportDiv").innerHTML="";
					  document.getElementById("loadspan").style.visibility = "hidden";
					  return;
				  } 
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
						  document.getElementById("loadReportDiv").innerHTML = xmlhttp.responseText;
						  document.getElementById("loadspan").style.visibility = "hidden";
					  }
				  }
				xmlhttp.open("GET","GetInstructorDetailLoadReport.php?instId="+val,true);
				xmlhttp.send();
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
        			//require('../IndexHeader.inc');
        			require('LoadReportHeader.inc');
        		?>
        		
            <?php
            	//include('AdminSidebar.inc');
            	include_once('AdminLoadReportInnerMenu.inc');
            	include_once('../classes/DBConnection.php');
				?>            
            
            <div id="indexmain">              
					<?php
						$query = "SELECT * FROM tblAcademicUnit ORDER BY academic_unit_name ASC";
						$result = DBConnection::readFromDatabase($query);
					?>
					<div>
						Enter Instructor Id: <input type="text" name="txtinstructorid" id="txtinstructorid"/>
						<input type="button" value="Search" class="button" onClick="showLoadReportForThisInstructor();"/>
						-- Instructor Load Report <span id="loadspan" style="visibility:hidden;"> <img src="images/loadingfb.gif" width="16" height="16" align="absmiddle" border="0"/></span>
					</div>
					<hr/>
					
					<div id="loadReportDiv">
						Load Report will be listed here
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

