<?php
    

	
	if($_SERVER['REQUEST_METHOD'] == 'POST')  {
		
	$db_user = "root";
	$db_passwd = "password";
	$database = "delta";
	$server = "127.0.0.1";
	// Establish connection	
	$db = mysqli_connect($server, $db_user, $db_passwd, $database );
	
	if (mysqli_connect_errno()) {
    echo "Connect failed: <br/> " . mysqli_connect_error();
    die(1);
	}
	
	if (empty($_POST['text'])) { 
		die(1);
	}
	
	$key = $_POST['text'];
	
	// Search for similar names in the database
	$result = mysqli_query($db,"SELECT username,name from user where name LIKE '{$key}%'; " );
	
	$data = '';
	
	if($result) 
		for($i=0;$i<$result->num_rows;$i++) 
		{
			$t = mysqli_fetch_assoc($result);
			// Generating the complete HTML response on the server side ,
			// A better alternative is to send the raw data, and process it on the client side.
			$data .= "<a href=display.php?user=" . $t['username']  . ">" . "{$t['name']} </a> <br>" ;
		}
	echo $data;  // Send the reply back
	mysqli_close($db);
	
	}

?>