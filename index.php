<?php

session_start();
if (isset($_SESSION['logged_in']))
    if ($_SESSION['logged_in'] == 1) 	
		header("Location: dashboard.php");

// Below code is for using without using AJAX for form subimssion
/*
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$invalid = '';
	
	if(empty($_POST['username']) || empty($_POST['password'])) {
		$invalid = 'Invalid credentials !!';
		return ;
	}
	
	$username = htmlspecialchars($_POST['username']);
	$password = md5($_POST['password']);
	
		
	$db_user = "root";
	$db_passwd = "password";
	$database = "delta";
	$server = "127.0.0.1";
	
	$db = mysqli_connect($server,$db_user,$db_passwd,$database);
    if (! $db) { 
	    die('Could not connect to the database. Retry later.'); 
		}
	
	$result = mysqli_query($db,"Select username from user where username='{$username}' and password='{$password}' ;") ;
	
	if($result) {
		if($result->num_rows == 1) {
			echo "Logged IN !!";
			session_start();
			$_SESSION['logged_in']=1;
			$_SESSION['username']=$username;
			session_regenerate_id(true);
			header('Location: dashboard.php');
			
	}
	}
	$invalid = 'Invalid credentials !!';
}

*/

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta  name="viewport" content="width=device-width, initial-scale=1">
<title>Login</title>
<link href="css/style.css" rel="stylesheet">
<script src="js/script.js"></script>
</head>

<body style='background-color:Navy'>

<center>
<br> 
	
<div id='login'>
	<h1> Login </h1>
	<br>

	<span id='msg' style='color:red'>
	<!-- For displaying error message, if invalid credentials. -->
	</span> <br/><br/>

	<form name='myform' method='POST' action='login.php'>
		<label for='username'>Username :- </label>
		<input type='text' name="username" id='username' r> <br> <br>

		<label for='passwd'>Password :- </label>
		<input type="password" name="password" id='password' required /> <br><br>

		<button type="button" onclick='login_user()'>LOGIN</button> 
		<!-- <input type='submit' value='SUBMIT' />  -->

	</form>
	<br>
	<h3><a href='register.php'>New user? Register Here</a></h3>


</div>

</center>

</body>

</html>