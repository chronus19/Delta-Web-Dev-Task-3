<?php

session_start();
// If logged in, redirect to dashboard
if (isset($_SESSION['logged_in']))
    if ($_SESSION['logged_in'] == 1) 	
		header("Location: dashboard.php");


if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{	
	if(empty($_POST['username']) || empty($_POST['password'])) {
		header("Location: index.php");
		die(1);
	}
	
	$username = htmlspecialchars($_POST['username']);
	$password = md5($_POST['password']);
		
	$db_user = "root";
	$db_passwd = "password";
	$database = "delta";
	$server = "127.0.0.1";
	
	$db = mysqli_connect($server,$db_user,$db_passwd,$database);
    if (mysqli_connect_errno()) {
		echo "Connect failed: <br/> " . mysqli_connect_error();
		die(1);
	}
	
	$result = mysqli_query($db,"Select username from user where username='{$username}' and password='{$password}' ;") ;
	
	if($result) 
	{
		if($result->num_rows == 1) 
			{
			// If credentials are correct, login user
			session_regenerate_id(true);
			$_SESSION['logged_in']=1;
			$_SESSION['username']=$username;
			echo "SUCCESS";  // Reply for AJAX script
			die(0);
			}
	}
}

?>
