<?php

	session_start();
	
	//unset($_SESSION['logged_in']);
	//unset($_SESSION['username']);
	session_unset();
	session_destroy();
	
	header('Location: index.php');

?>
