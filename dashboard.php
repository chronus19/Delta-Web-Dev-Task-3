<?php

	session_start();
	if ($_SESSION['logged_in'] != 1)  // Checking if user is logged in 
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
	
	$result = mysqli_query($db,"Select username,email,contact,name,propic from user where username='{$username}';") ;
	
	$result = mysqli_fetch_assoc($result);
	
	// Generating te code for displaying profile picture
    $imagefile = "<img id='propic' src=data:image/png;base64," . base64_encode($result['propic']).">" ;
	
    
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta  name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard</title>
<link href="css/style.css" rel="stylesheet">
</head>
<body style="background-color: Moccasin;">

	<div id='navbar' >
		<a href='search.php'>Search friends </a>
		&nbsp;&nbsp;&nbsp;
		<a href='logout.php'>Log Out </a>
	</div>

<center>
	<h2> Welcome <?php echo $result['name']  ?></h2>
	<?php echo $imagefile; ?>

	<div id='holder'>
	<table>
		<tr>
		<td>Username :- </td>
		<td> <?php echo $result['username']  ?>  </td>
		</tr>

		<tr>
		<td>Name :- </td>
		<td><?php echo $result['name']  ?></td>
		</tr>

		<tr>
		<td> E-Mail :- </td>
		<td> <?php echo $result['email']  ?> </td>
		</tr>

		<tr>
		<td> Contact :- </td>
		<td><?php echo $result['contact']  ?> </td>
		</tr>
	</table>
    <br> 
	
	<center> <a href='edit.php'> Edit Details </a>	</center>

	</div>

</center>

</body>

</html>