<head>
	<script>
		function showDHTMLMenu()
		{			
			document.getElementById("dhtmlmenu").style.visibility = "visible";
		}
		
		function hideDHTMLMenu()
		{
			document.getElementById("dhtmlmenu").style.visibility = "hidden";
		}
		
		function showAAUParttimerEntry()
		{		
			//alert("hello");					
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
					    document.getElementById("courseInfo").innerHTML=xmlhttp.responseText;					    
				    }
			  }			   
			  xmlhttp.open("GET","EnterAAUParttimerStaffInfo.php",true);
			  xmlhttp.send();					
		}//end function
		
		function showExternalParttimerEntry()
		{
			//alert("am here");
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
					    document.getElementById("courseInfo").innerHTML=xmlhttp.responseText;					    
				    }
			  }			   
			  xmlhttp.open("GET","EnterExternalParttimerStaffInfo.php",true);
			  xmlhttp.send();				
		}
	</script>
	<style type="text/css">
		table{
			/*background: #CCCCCC;*/
		}				
		a{
			color:black;
			text-decoration:none;
			font:bold;
		}
		a:hover{
			color:#606060;
			text-decoration:underline;
		}
		td.menu{
			background:lightblue;			
		}
		table.menu{			
			position:absolute;
			visibility:hidden;
		}
	</style>
</head>
<div id="manageDiv" style="background:#CCCCCC"">                    
  		<table  width="100%">
  		  <tr>
  			<td align="center">
	  			<a href="AddInstructor.php"><img src="images/new.png" align="absmiddle"/> <font size="1">Add Instructor</font></a>
	  		</td>
	  		<td align="center" onMouseOver="showDHTMLMenu();" onMouseOut="hideDHTMLMenu();">
	  			<a href="#.php"><img src="images/text.png" align="absmiddle"/> <font size="1">Add Parttimer</font></a>
	  			<table style="position: absolute; visibility:hidden;" id="dhtmlmenu" class="menu">
	  				<tr>
	  					<td class="menu"><a href="#.php" onClick="showAAUParttimerEntry();">AAU Parttimer</a></td>
	  				</tr>
	  				<tr>
	  					<td class="menu"><a href="#.php" onClick="showExternalParttimerEntry();">External Parttimer</a></td>
	  				</tr>
	  			</table>
	  		</td>
	  		<td align="center">
	  			<a href="ViewInstructor.php"><img src="images/view.png" align="absmiddle"/> <font size="1">View Instructor</font></a>
	  		</td>
	  		<td align="center">
	  			<a href="EditInstructor.php"><img src="images/edit.gif" align="absmiddle"/> <font size="1">Edit Instructor</font></a>
	  		</td>
	  		<td align="center">
	  			<a href="DeleteInstructor.php"><img src="images/ImgDelete.gif" align="absmiddle"/> <font size="1">Delete Instructor</font></a>
	  		</td>
	  		<td align="center">  		
	  			<a href="LogOff.php"><img src="images/logout.gif" align="absmiddle"/> <font size="1">Logout</font></a>
	  		</td>
	  	  </tr>
  		</table>         
</div>