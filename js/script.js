function len_between(str,min,max) {
	if (str.length < min || str.length > max) {
		return 0;
	}
	return 1;
}	

function validate_new_user_data() {
	
	var username = document.getElementById('username').value;
	var password = document.getElementById('password').value;
	var name = document.getElementById('name').value;
	var email = document.getElementById('email').value;
	var contact = document.getElementById('contact').value;
	var repassword = document.getElementById('repasswd').value;
	
	if(!len_between(username,4,20)) {
		document.getElementById('msg').innerHTML = 'Username should be 4 to 20 characters long.';
		return;
	}
	if(!len_between(name,4,30)) {
		document.getElementById('msg').innerHTML = 'Name should be 4 to 30 characters long.';
		return;
	}
	if(!len_between(email,5,50)) {
		document.getElementById('msg').innerHTML = 'E-Mail should be 5 to 50 characters long.';
		return;
	}
	
	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (!filter.test(email)) {
		document.getElementById('msg').innerHTML = 'Please provide a valid email address';
		return;
	}
	
	if(!len_between(contact,10,12)) {
		document.getElementById('msg').innerHTML = 'Contact number should be 10 to 12 characters long.';
		return;
	}
	if(!len_between(password,5,30)) {
		document.getElementById('msg').innerHTML = 'Password should be 5 to 30 characters long.';
		return;
	}
	if(repassword != password) {
		alert("Your passwords do not match. Please fill the form properly.");
		document.getElementById('password').value='';
		document.getElementById('repasswd').value='';
		return;
	}
	
	// Using AJAX for form submission
	var ajax = new XMLHttpRequest();
	ajax.open("POST",'register.php',true);
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4 && ajax.status == 200) {
			if ( ajax.responseText === 'SUCCESS' ) {
				//console.log("Registered Successfully !!")
				document.location.href= 'success.php';
			}
			else 
				document.getElementById('msg').innerHTML = "Failed to register. Try again." ;
			}
		}
		
	var new_user = new FormData(document.myform);
	ajax.send(new_user);
	//console.log("Sent new user details !!");

}


function validate_edit_details() {
	
	var name = document.getElementById('name').value;
	var email = document.getElementById('email').value;
	var contact = document.getElementById('contact').value;
	
	if(!len_between(name,4,30)) {
		document.getElementById('msg').innerHTML = 'Name should be 4 to 30 characters long.';
		return;
	}
	if(!len_between(email,5,50)) {
		document.getElementById('msg').innerHTML = 'E-Mail should be 5 to 50 characters long.';
		return;
	}
	if(!len_between(contact,10,12)) {
		document.getElementById('msg').innerHTML = 'Contact number should be 10 to 12 characters long.';
		return;
	}
	
	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (!filter.test(email)) {
		document.getElementById('msg').innerHTML = 'Please provide a valid email address';
		return;
	}

	document.myform.submit();
	
}

function login_user() {
	var ajax = new XMLHttpRequest();
	ajax.open("POST",'login.php',true);
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4 && ajax.status == 200) {
			if ( ajax.responseText === 'SUCCESS' )
				//console.log("Returned Success");
				document.location.href = 'dashboard.php';
			else {
				document.getElementById('msg').innerHTML = 'Invalid credentials.';
				console.log("Auth failed !!");
			}
			}
		}
		
	var login_details = new FormData(document.myform);
	ajax.send(login_details);
	
}

// Function for creating as-you-type suggestions using AJAX
	
function suggest() {
	
	var ajax = new XMLHttpRequest();
	ajax.open("POST","suggest.php",true);
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4 && ajax.status == 200) {
			document.getElementById('suggest').innerHTML = ajax.responseText;
			//console.log(ajax.responseText);
			}
		}
		
	//console.log(document.getElementById('suggest').innerHTML);
	var text = document.getElementById('search').value;
	//console.log('Search str :- ' + text);
	ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajax.send("text="+text);
	//console.log("Sent search details !!");
	
}

