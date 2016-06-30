<?php
    
	$db_user = "root";
	$db_passwd = "password";
	$database = "delta";
	$server = "127.0.0.1";
	
	if($_SERVER['REQUEST_METHOD'] == 'POST')  {
	$db = mysqli_connect($server, $db_user, $db_passwd, $database );
	
	if (mysqli_connect_errno()) {
    echo "Connect failed: <br/> " . mysqli_connect_error();
    die(1);
	}
	
	if (empty($_POST['text'])) { 
		die(1);
	}
	
	$key = $_POST['text'];
	
	$result = mysqli_query($db,"SELECT username,name from user where name LIKE '{$key}%'; " );
	
	$data = '';
	
	if($result) 
		for($i=0;$i<$result->num_rows;$i++) {
			$t = mysqli_fetch_assoc($result);
			$data .= "<a href=display.php?user=" . $t['username']  . ">" . "{$t['name']} </a> <br>" ;
		}
	echo $data;
	mysqli_close($db);
	
	}

?>