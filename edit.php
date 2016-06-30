<?php

session_start();

function len_between($str,$min,$max) {
	if (empty($str))
		return 0;
	if (strlen($str) < $min || strlen($str) > $max)
		return 0;
    return 1;
}

    if($_SERVER['REQUEST_METHOD']=='POST') {
	
	    if (empty($_SESSION['logged_in']) || empty($_SESSION['username'])){
			header('Location: index.php');
		}
		
		if ($_SESSION['logged_in'] !=1 )
			header('Location: index.php');
		
		if (!len_between($_POST['name'],4,30)) {
		$errormsg = 'Name should be 4 to 30 characters long.';
		}
		else if (!len_between($_POST['email'],5,50)) {
			$errormsg = 'E-Mail should be 5 to 50 characters long.';
		}
		else if (!len_between($_POST['contact'],9,12)) {
			$errormsg = 'Contact number should be 10 to 12 characters long.';
		}
		
		// If all inputs are validated.
		else {
		$db_user = "root";
		$db_passwd = "password";
		$database = "delta";
		$server = "127.0.0.1";
		
		$db = mysqli_connect($server,$db_user,$db_passwd,$database);
		if (mysqli_connect_errno()) {
			echo "Connect failed: <br/> " . mysqli_connect_error();
			die(1);
		}
		
		$query = "UPDATE user set name='{$_POST['name']}', contact='{$_POST['contact']}', email='{$_POST['email']}' ";
		
		if(!empty($_FILES['propic']['tmp_name'])) {
			if ($_FILES['propic']['size'] > 65500) {
				$errormsg = ' Image size too big !';
				return ;
			    }
				
			else{
				$image = addslashes(file_get_contents($_FILES['propic']['tmp_name']));
				$query .= ", propic='{$image}' ";
				}
		}
		
		$query .= " where username='{$_SESSION['username']}' ; ";
	
	$result = mysqli_query($db,$query);
		
	if(! $result) {
		header('Location: edit.php');
	}
	header("Location: dashboard.php");
		
	}
	}
	
    else {
		
	
	if ($_SESSION['logged_in'] != 1 || empty($_SESSION['username'])) 
		header('Location: index.php');

	$db_user = "root";
	$db_passwd = "password";
	$database = "delta";
	$server = "127.0.0.1";
	
	$username = $_SESSION['username'];
	
	$db = mysqli_connect($server,$db_user,$db_passwd,$database);
    if (mysqli_connect_errno()) {
    echo "Connect failed: <br/> " . mysqli_connect_error();
    die(1);
	}
	
	$result = mysqli_query($db,"Select name,email,contact from user where username='{$username}';") ;
    
	$result = mysqli_fetch_assoc($result);
    }
?>

<!DOCTYPE html>

<html>
<head>
<meta charset="utf-8">
<meta  name="viewport" content="width=device-width, initial-scale=1">
<title>Edit Details</title>

<script src="js/script.js"></script>
<link href="css/style.css" rel="stylesheet">

</head>
<body style="background-color: Moccasin;">

<div id='navbar' >
<a href='dashboard.php'>Dashboard </a>
&nbsp;&nbsp;&nbsp;
<a href='logout.php'>Log Out </a>
</div>

<center>
<h2> Welcome <?php echo $result['name']  ?></h2>

<span id='msg' style='color:red'>

<?php 
if (!empty($errormsg))
	echo $errormsg;
?>

</span> <br/><br/>

<form name='myform' action='edit.php' method='POST' enctype="multipart/form-data" >

<div id='edit-details'>

<table>

<tr>
<td>Name :- </td>
<td><input type='text' id='name' name='name' value='<?php echo $result['name']  ?>' /></td>
</tr>

<tr>
<td> E-Mail :- </td>
<td> <input type='text' id='email' name='email' value='<?php echo $result['email']  ?>' /> </td>
</tr>

<tr>
<td> Contact :- </td>
<td><input type='text' id='contact' name='contact' value='<?php echo $result['contact']  ?>' /> </td>
</tr>

<tr>
<td> Profile Picture :- </td>
<td>
<p style='font-size:12px'> Do not select an image to keep the previous image.</p>
<input type="file" accept='image/*' name="propic" /> <br>
</td>
</tr>

</table>
<br/>
	<center><button type='button' onclick='validate_edit_details()'>UPDATE</button></center>
</div>

</form>

</center>


</body>

</html>