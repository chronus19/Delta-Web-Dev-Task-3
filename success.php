<?php
    
	$db_user = "root";
	$db_passwd = "password";
	$database = "delta";
	$server = "127.0.0.1";
	session_start();
	
	if (! isset($_SESSION['reg_user'])) {
		header("Location: index.php");
	}
	
	$user = $_SESSION['reg_user'];
	unset($_SESSION['reg_user']);
	
	$db = mysqli_connect($server, $db_user, $db_passwd, $database );
	
	if (mysqli_connect_errno()) {
    echo "Connect failed: <br/> " . mysqli_connect_error();
    die(1);
	}
    
	$result = mysqli_query($db,"SELECT name,propic from user where username='{$user}'; " );
	$data = mysqli_fetch_assoc($result);
	$imagefile = "<img style='height:180px; width=180px;' src=data:image/png;base64," . base64_encode($data['propic']).">" ;
	mysqli_close($db);

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta  name="viewport" content="width=device-width, initial-scale=1">
<title>Registered Successfuly</title>

</head>
<body style = 'background-color: lightgreen;'>
<br>
<center>
	<h2> Registered Successfully !! </h2><br>
	<?php  echo $data['name'] . "<br/><br/>";
		   echo $imagefile;
	?>
	
	<br>
	<h3> <a href = 'index.php'>Login here</a>
</center>

</body>

</html>