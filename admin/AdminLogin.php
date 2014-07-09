<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Academic Staff Load Managment System</title>
        <link rel="stylesheet" href="../style/Underground.css" />
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
           		else if(document.getElementById("txtadminname").value=="")
           		{
           			document.getElementById("errorMsg").innerHTML = "Please, Enter the username!";
           			document.getElementById("txtadminname").focus();
           			document.getElementById("txtadminname").style.borderColor="red";
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
        </script>
    </head>


    <body onLoad="advAutomatically();">
        <?php
        ?>
        
        <div id="wrap">
        	  <?php
        			require('../IndexHeader.inc');
        		?>
        		
            <div id="indexmain">
                <div align="center">                    
                    <form name="frmadminlogin" action="ValidateAdmin.php" onsubmit="return isLoginBlank()" method="post">
                    		<caption>Administrator Login</caption>
                    		<div id="errorMsg">             					
        						</div>   
                        <table border="0" width="50%">
                        	 <tr>
                        	 	<td><img src="images/key.jpg" border="0" width="20" height="20" align="absmiddle"/></td>
                        	 	<td></td>
                        	 </tr>
                            <tr>                            	
                                <td align="right">Email</td>
                                <td align="left"><input type="text" id="txtemail" name="txtemail" size="20" onblur="checkAndChangeColor(this.value,id);"/></td>
                            </tr>
                            <tr>
                                <td align="right">Username</td>
                                <td align="left"><input type="text" id="txtadminname" name="txtadminname" size="20" onblur="checkAndChangeColor(this.value,id);"/></td>
                            </tr>
                            <tr>
                                <td align="right">Password</td>
                                <td align="left"><input type="password" id="txtpassword" size="20" name="txtpassword" onblur="checkAndChangeColor(this.value,id);"/></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
				    <input class="button" type="submit" value="Login"/>
				    <input class="button" type="reset" value="Clear"/>
				</td>
                            </tr>
                        </table>
                    </form>                
            </div><!--end wrap division-->

        <?php
            require('../Footer.inc');
        ?>

    </body>
</html>
