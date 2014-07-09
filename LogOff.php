<?php
	 @session_start();
	 unset($_SESSION['full_name']);    
	 @session_destroy();
	 header("Location: index.php");
?>
