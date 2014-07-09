<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">-->
<html>
    <head>        
        <title>Academic Staff Load Managment System</title>
        <link rel="stylesheet" href="style/Underground.css" />
        <script src="js/js_script.js"></script>
			<link rel="shortcut icon" href="images/campus.jpeg"/>
        <script type="text/javascript" language="javascript1.1">
           function isLoginBlank()
           {
           		if(document.getElementById("txtemail").value=="")
           		{           			
           			document.getElementById("errorMsg").innerHTML = "Please, Enter the email address!";
           			document.getElementById("txtemail").focus();
           			document.getElementById("txtemail").style.borderColor="red";
           			return false;
           		}
           		else if(document.getElementById("txtusername").value=="")
           		{
           			document.getElementById("errorMsg").innerHTML = "Please, Enter the username!";
           			document.getElementById("txtusername").focus();
           			document.getElementById("txtusername").style.borderColor="red";
           			return false;
           		}
           		else if(document.getElementById("txtpassword").value=="")
           		{
           			document.getElementById("errorMsg").innerHTML = "Please, Enter the password!";
           			document.getElementById("txtpassword").focus();
           			document.getElementById("txtpassword").style.borderColor="red";
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
           			document.getElementById(id).style.borderColor="lightblue";
           		}
           }
           
           function setFirstFocus()
           {
           		document.getElementById("txtemail").focus();
           }
           
           /*var browserName=navigator.appName; 
				var browserVer=parseInt(navigator.appVersion); 
				if ((browserName=="Netscape" && browserVer>=3) || (browserName=="Microsoft Internet Explorer" && browserVer>=4)) 
				  version="n3"; 
				else 
				  version="n2"; 
				
				if (version=="n3")
				  alert("Your browser passes the test");
				else
				  alert("You need an upgrade, I think.");*/
				  
				  ////now comes the browser detection section
				  var codeName = navigator.appCodeName;
				  var browserName = navigator.appName;
				  var version = navigator.appVersion;
				  var browserInfo = "code name : "+codeName+
				  							"\nbrowser name : "+browserName+
				  							"\nversion : "+version;
				  			
				  							
				  //alert(browserInfo);
				  if(browserName == 'Microsoft Internet Explorer')
				  {
				  		alert("Microsoft Internet Explorer has some known issues! \nPlz try installing Mozilla firefox webbrowser attached at the end of this website!");
				  		document.getElementById('firefoxdiv').style.visibility = "visible";
				  }
				  else if(browserName == 'Netscape' && version < 5.0)
				  {
				  		alert("Your web browser is very old! Plz try installing Mozilla firefox webbrowser attached at the end of this website!");
				  		document.getElementById("firefoxdiv").style.visibility = "visible";
				  }
				  else
				  		document.getElementById('firefoxdiv').style.visibility = "hidden";
				  
				  	/*document.write("Browser CodeName: " + navigator.appCodeName);
					document.write("<br /><br />");
					document.write("Browser Name: " + navigator.appName);
					document.write("<br /><br />");
					document.write("Browser Version: " + navigator.appVersion);
					document.write("<br /><br />");
					document.write("Cookies Enabled: " + navigator.cookieEnabled);
					document.write("<br /><br />");
					document.write("Platform: " + navigator.platform);
					document.write("<br /><br />");
					document.write("User-agent header: " + navigator.userAgent);*/

        </script>
    </head>


    <body onLoad="setFirstFocus();">        
        <div id="wrap">
        	  <?php
        			require('IndexHeader.inc');
        			//$msg = $_GET['msg'];
        		?>       		
        		
        		
            <div id="indexmain">
                <div align="center">  
                		               
                    <form name="frmadminlogin" action="ValidateUser.php" onsubmit="return isLoginBlank()" method="post">
                    		
                    			<div id="errorMsg">
                    				<?php
                    					
                    					//if($msg != "")
                    					//{
                    						//print($msg);
                    					//}	
                    				?>
                    					
        							</div>   
                        <table border="0" width="50%">
                        	<caption>Authorized users only</caption>
                        	 <tr>
                        	 	<td><img src="images/user1.jpg" border="0" width="20" height="20" align="absmiddle"/></td>
                        	 	<td></td>
                        	 </tr>
                            <tr>
                                <td align="right">Email</td>
                                <td align="left"><input type="text" id="txtemail" name="txtemail" size="20" onblur="checkAndChangeColor(this.value,id);"/></td>
                            </tr>
                            <tr>
                                <td align="right">Username</td>
                                <td align="left"><input type="text" id="txtusername" name="txtusername" size="20" onblur="checkAndChangeColor(this.value,id);"/></td>
                            </tr>
                            <tr>
                                <td align="right">Password</td>
                                <td align="left"><input type="password" size="20" id="txtpassword" name="txtpassword" onblur="checkAndChangeColor(this.value,id);"/></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
				    <input class="button" type="submit" value="Login"/>
				    <input class="button" type="reset" value="Clear"/>
				</td>                                
                            </tr>                     
                        </table>
                        <div>
                        	<br/><br/><br/><br/>
                        </div>
                        <div id="firefoxdiv">
                      			Click <a href="Firefox Setup 3.6.12.exe"><img src="images/firefox.jpg" align="absmiddle" border="0"/> Here to install firefox</a>
                    		</div>   
                    </form>      
                    		       
            </div><!--end wrap division-->

        <?php
            require('IndexFooter.inc');
        ?>

    </body>
</html>
