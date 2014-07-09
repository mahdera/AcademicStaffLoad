<?php
	// open this directory 
		$myDirectory = opendir("../backups");
		
		// get each entry
		while($entryName = readdir($myDirectory)) {
			$dirArray[] = $entryName;
		}
		
		// close directory
		closedir($myDirectory);
		
		//	count elements in array
		$indexCount	= count($dirArray);
		//print ("$indexCount files<br>\n");
		
		// sort 'em
		sort($dirArray);
		
		// print 'em
		print("<TABLE border='1' cellpadding='5' cellspacing='0' width='80%'>\n");
		print("<TR style='background:lightblue'><TH>Filename (click on filename to open)</TH></TR>\n");
		// loop through the array of files and print them all
		for($index=0; $index < $indexCount; $index++) {
		        if (substr("$dirArray[$index]", 0, 1) != "."){ // don't list hidden files
		        		if($index % 2 == 0)
				   		print("<tr style='background:#ded7fe'>");				
						else				
							print("<tr style='background:#ecfdfe'>");			
						print("<TD><a href=\"../backups/$dirArray[$index]\">$dirArray[$index]</a></td>");								
						print("</TR>\n");
   			}			
		}
		print("</TABLE>\n");
?>