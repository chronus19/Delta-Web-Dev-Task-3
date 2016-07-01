<?php

session_start();
$result = null;
// If not logged in, redirect to login page
if ( $_SESSION['logged_in'] != 1 || empty($_SESSION['username'])) 
	header('Location: index.php');

if ($_SERVER['REQUEST_METHOD']=='POST') {
	if(!empty($_POST['search'])) {
	
	$name = htmlspecialchars($_POST['search']);
	
	$db_user = "root";
	$db_passwd = "password";
	$database = "delta";
	$server = "127.0.0.1";
	
	$db = mysqli_connect($server,$db_user,$db_passwd,$database);
	
	if(mysqli_connect_errno()) {
		die('Could not connect to database :- ' . mysqli_connect_error());
	}
	
	$query = "select username,name from user where name LIKE '{$name}%' ;";
	$result = mysqli_query($db,$query);
	$search_result = '';
	
	// Generate the search results
	for($i=0;$i<$result->num_rows;$i++) {
		$t = mysqli_fetch_assoc($result);
		$search_result .= "<a href='display.php?user={$t['username']}' >" . $t['name'] ."</a><br>"; 
	}
	
}

}

?>

<!DOCTYPE html>

<html>
<head>
<meta charset="utf-8">
<meta  name="viewport" content="width=device-width, initial-scale=1">
<title>Search Friends</title>

<script src="js/script.js"></script>
<link href="css/style.css" rel="stylesheet">

</head>
<body style="background-color: Moccasin;">

	<div id='navbar' >
		<a href='dashboard.php'>Dashboard </a>
		&nbsp;&nbsp;&nbsp;
		<a href='logout.php'>Log Out </a>
	</div>

<br>
<center>

	<form method='POST' name='myform' action='search.php' >

		<label for='search'>Enter name to search for :- </label> <br>
		<input id='search' type='text' name='search' style='width:250px' onkeyup='suggest()' maxlength=30 />
		<input type='submit' value='SUBMIT' /> <br>

	</form>

		<div id='suggest'>
		<!-- As-you-type suggestions -->
		</div>


	<div id='search_result' style='margin-top:50px;' >
		<!-- Displaying search results -->
	<?php
	if (!empty($search_result)) {
		echo "<h2>Search Results :- </h2><br>";
		echo $search_result;
	}
	?>

	</div>

</center>

</body>

</html>