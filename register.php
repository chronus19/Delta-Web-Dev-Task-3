<?php

session_start();
if (isset($_SESSION['logged_in']))
    if ($_SESSION['logged_in'] == 1) 	
		header("Location: dashboard.php");
	
function len_between($str,$min,$max) {
	if (empty($str))
		return 0;
	if (strlen($str) < $min || strlen($str) > $max)
		return 0;
    return 1;
}
	
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$errormsg = '';
	
	if (!len_between($_POST['username'],4,20)) {
		echo 'Username should be 4 to 20 characters long.';
	}
	else if (!len_between($_POST['name'],4,30)) {
		echo 'Name should be 4 to 30 characters long.';
	}
	else if (!len_between($_POST['email'],5,50)) {
		echo 'E-Mail should be 5 to 50 characters long.';
	}
	else if (!len_between($_POST['contact'],9,12)) {
		echo 'Contact number should be 10 to 12 characters long.';
	}
	else if (!len_between($_POST['password'],5,30)) {
		echo 'Password should be 5 to 30 characters long.';
	}
	else if (empty($_FILES['propic']['tmp_name'])) {
		echo 'Select a profile picture.';
	}
	else if ($_FILES['propic']['size'] > 65500) {
		echo ' Image size too big !';
    }
	
	else {
	$username = htmlspecialchars($_POST['username']);
	$password = md5($_POST['password']);
	$name = htmlspecialchars($_POST['name']);
	$email = htmlspecialchars($_POST['email']);
	$contact = htmlspecialchars($_POST['contact']);

	$image = addslashes(file_get_contents($_FILES['propic']['tmp_name']));
	
	$db_user = "root";
	$db_passwd = "password";
	$database = "delta";
	$server = "127.0.0.1";
	
	$db = mysqli_connect($server,$db_user,$db_passwd,$database);
    if (mysqli_connect_errno()) {
    echo "Connect failed: <br/> " . mysqli_connect_error();
    die(1);
	}
    
	//$result = 1;
	$result = mysqli_query($db,"INSERT INTO user set "
					.  " username='{$username}' , password='{$password}' , name='{$name}' ,email='{$email}' ,"
					.  " contact='{$contact}' , propic='{$image}'  ; " );
	
	if ($result == null)
		die("Registration Failed !!" );
    
	$_SESSION['reg_user'] = $username;
	echo "SUCCESS";
	die(0);
	}
    	
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta  name="viewport" content="width=device-width, initial-scale=1">
<title>Register</title>

<script src="js/script.js"></script>

</head>
<body style="background-color:lightyellow;">
<br><br>

<center>
<h2>Register</h2>
<br>
<br>
<div>

<span id='msg' style='color:red'>
<!-- For displaying error messages, if any. -->
</span> <br/><br/>

<form name='myform' action='register.php' method='POST' enctype="multipart/form-data" >

<table>
<tr>
<td>
<label for='username'>Username :- </label>
</td>
<td>
<input type='text' id='username' name='username' maxlength=20 /> 
</td>
</tr>

<tr>
<td>
<label for='name'>Name :- </label>
</td>
<td>
<input type='text' id='name' name='name' maxlength=30 /> 
</td>
</tr>

<tr>
<td>
<label for='email'>E-Mail :- </label>
</td>
<td>
<input type='text' id='email' name='email' maxlength=50 /> 
</td>
</tr>

<tr>
<td>
<label for='contact'>Contact No. :- </label>
</td>
<td>
<input type='text' id='contact' name='contact' maxlength=12 /> <br>
</td>
</tr>

<tr>
<td>
<label for='password'>Password :- </label>
</td>
<td>
<input type='password' id='password' name='password' maxlength=30 />
</td>
</tr>

<tr>
<td>
<label for='repasswd'>Re-enter password :- </label>
</td>
<td>
<input type='password' id='repasswd' maxlength=30 /> 
</td>
</tr>

<tr>
<td>
<label for='propic'>Select profile picture :- </label>
</td>
<td>
<input type="file" accept='image/*' name="propic" /> 
</td>
</tr>

</table>
<br> <br>

<button type='button' onclick='validate_new_user_data()'>SUBMIT</button>

</form>

<h3>
<br>
<a href='index.php'>Already registered? Login Here</a>
</h3>

</div>
</center>


</body>

</html>
