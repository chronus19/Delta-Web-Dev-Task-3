<?php

session_start();
$result = null;
if ( $_SESSION['logged_in'] != 1 || empty($_SESSION['username'])) 
	header('Location: index.php');

if ($_SERVER['REQUEST_METHOD']=='GET' and !empty($_GET['user']) ) {
	
		$user = $_GET['user'];
			
		$db_user = "root";
		$db_passwd = "password";
		$database = "delta";
		$server = "127.0.0.1";
		
		$db = mysqli_connect($server,$db_user,$db_passwd,$database);
		
		if(mysqli_connect_errno()) {
			die('Could not connect to database :- ' . mysqli_connect_error());
		}
	
	    $result = mysqli_query($db,"Select username,email,contact,name,propic from user where username='{$user}';") ;
		
		$result = mysqli_fetch_assoc($result);
	
		$imagefile = "<img id='propic' src=data:image/png;base64," . base64_encode($result['propic']).">" ;
}

else {
	header('Location: index.php');
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
<a href='search.php'>Search friends </a>
&nbsp;&nbsp;&nbsp;
<a href='logout.php'>Log Out </a>
</div>

<br>
<center>

<h2> You searched for :- <?php echo $result['name']  ?> </h2>
<?php echo $imagefile ; ?>

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


</div>




</center>

</body>

</html>