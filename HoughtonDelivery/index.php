<?php

	session_start();

	if(isset($_POST['logout'])){
		
		session_destroy();	
		echo "Logout successful";

	}else if(isset($_SESSION['loginState'])){
	
		header('Location: http://141.219.225.103:8080/hShops.php');

	}else if(isset($_SESSION['businessLoginState'])){
	
		header('Location: http://141.219.225.103:8080/dashboard.php');

	}else if(isset($_SESSION['errorMessage'])){

		session_destroy();
		echo $_SESSION['errorMessage'];
	
	}
	

?>

<!DOCTYPE html>

<html>

<head>

<link rel="stylesheet" type="text/css" href="style_index.css">
<title>Houghton Delivery!</title> 

<script>

	function addDetails(){
		
		if(document.getElementById("locations").value == "Houghton"){

			document.getElementById("pedanticLocation").innerHTML = '<form name="address" action="hShops.php" method="post">\
			Building/Apt Number <input type="text" name="aptNo" required><br>\
			Street Address <input type="text" name="street" required><br>\
			<input type="submit" name="guestLogin" value="Submit">\
			</form>';

		}else if(document.getElementById("locations").value == "Other"){

			document.getElementById("pedanticLocation").innerHTML = "Service coming soon in other areas";

		}else{ 
	
			document.getElementById("pedanticLocation").innerHTML = "";
	
		}

	}

	function backHome(){

		document.getElementById("TextZone").innerHTML = '<div id="TextZone">\
		<span class="choose">\
		<br>\
		<br>\
		<p>Choose Location:</p>\
		<form>\
		<select id="locations" onchange="addDetails()">\
		        <option value="invalid" selected>...</option>\
		        <option value="Houghton">Houghton</option>\
		        <option value="Other">Other</option>\
		</select>\
		</form>\
		<div id="pedanticLocation"></div>\
		</span>\
		<p><strong>OR</strong></p>\
		<p>Sign In:</p>\
		<form action="hShops.php" method="post">\
		        <input type="text" name="username" placeholder="username"></input><br>\
		<br>\
		<input type="password" name="password" placeholder="password"></input><br>\
		<br>\
		<input type="submit" name="login" value="Sign In">\
		</form>\
		<br>\
		<div id="signupLink">\
		        <button onclick="CustomerSignup()">Sign up</button>\
			<button onclick="BusinessLogin()">Business SignIn</button>\
		</div>\
		</div>';


	}

	function CustomerSignup(){

		document.getElementById("TextZone").innerHTML = '<button onclick="backHome()">Back</button>\
		<br><br>\
		<form action="hShops.php" method="post">\
		First Name: <input type="text" name="c_FirstName" autocomplete="off" required><br>\
		Last Name: <input type="text" name="c_LastName" autocomplete="false" required><br>\
		Address: <input type="text" name="c_Address" autocomplete="false" required><br><br>\
		Phone Number: <input type="text" name="c_PhoneNumber" required><br>\
		Email ID: <input type="text" name="c_Email" required><br>\
		Date of Birth(YYYY-MM-DD):<input type="text" name="c_DOB" required><br>\
		Ethnicity: <input type="text" name="c_Ethnicity" required><br><br>\
		Create Username: <input type="text" name="c_Username"><br><br>\
		Create Password: <input type="password" name="c_Password" required><br><br>\
		Re-enter Password: <input type="password" name="c_Passwordcheck" required><br><br>\
		Agree to <a href="">Terms and Conditions</a>: <input type="checkbox" name="terms" required><br><br>\
		<div class="g-recaptcha" data-sitekey="6Le4cVkUAAAAABXZBLQ_mqq6KEWAApWm6EvRrUdI"></div>\
		<input type="submit" name="addUser"></form>';

	}

	function BusinessLogin(){

		document.getElementById("TextZone").innerHTML = '<button onclick="backHome()">Back</button>\
		<br><br>\
		<form action="dashboard.php" method="post">\
			Title: <select name="business_title">\
				<option value="invalid">...</option>\
				<option value="R">Root</option>\
				<option value="B">Business</option>\
				<option value="A">Agent</option>\
				<option value="D">Driver</option>\
			</select>\
			<br><br>\
			<input type="text" name="b_username" placeholder="username">\
			<br><br>\
			<input type="password" name="b_password" placeholder="password">\
			<br><br>\
			<input type="submit" name="business_login">\
			<br><br>\
		</form>';
	
	}


</script>

</head>


<div id="backgrnd">
<body class = "addressPage">

<div id="boxy">
<div id="textboxy">
<div id="siteName1">
	Houghton 
<div id="siteName2">
	Delivery!
</div>
</div>
<div id="TextZone">
<span class="choose">
<br>
<br>

<p>Choose Location:</p>
<form>
<select id="locations" onchange="addDetails()">
	<option value="invalid" selected>...</option>
	<option value="Houghton">Houghton</option>
	<option value="Other">Other</option>
</select>
</form>
<div id="pedanticLocation"></div>

</span>
<p><strong>OR</strong></p>
<p>Sign In:</p>
<form action="hShops.php" method="post">
	<input type="text" name="username" placeholder="username"></input><br>
<br>
<input type="password" name="password" placeholder="password"></input><br>

<br>
<input type="submit" name="login" value="Sign In">
</form>
<br>

<div id="signupLink">
	<button onclick="CustomerSignup()">Sign up</button>
	<button onclick="BusinessLogin()">Business SignIn</button>
</div>
</div>

</div>
</div>

</div>

</body>
</div>
</html>
