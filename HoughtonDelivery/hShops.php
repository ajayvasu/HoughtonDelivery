<!DOCTYPE html>

<?php

	session_start();

	require('login_database.php');

	/* Check if a new user is signing up */
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addUser'])){

	        $insert = "INSERT INTO customer_signedUp (Username, FirstName, LastName, Password, 
		Address, PhoneNumber, Email, DOB, Ethnicity) VALUES ('".$_POST['c_Username']."', '"
		.$_POST['c_FirstName']."', '".$_POST['c_LastName']."', '".$_POST['c_Passwordcheck']."', '
		". $_POST['c_Address']."', '".$_POST['c_PhoneNumber']."', '".$_POST['c_Email']."', '"
		.$_POST['c_DOB']."', '".$_POST['c_Ethnicity']."')";

        	if(mysqli_query($rat, $insert)){

                	echo "New Record Created Successfully!";

	        }else{

        	        echo mysqli_error($rat);

	        }

		echo "New User created Successfully!";
	
		/* loginState tells if you are signed in, or a guest (the state of being) */
		$_SESSION['loginState'] = $_POST['c_Username'];
		$_SESSION['firstName'] = $_POST['c_FirstName'];
		echo "Logged in as: ". $_SESSION['firstName']."!<br>";

	/* Check if the correct login details were provided if the user tries to login with an existing account */
	}else if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){

		$username = $_POST['username'];
		$password = $_POST['password'];

		$check = "SELECT * FROM customer_signedUp WHERE Username = '".$username."' AND Password = '".$password."'";
		$check = mysqli_query($rat, $check);

		if(mysqli_num_rows($check) == 1){

			$FirstName = "SELECT FirstName FROM customer_signedUp WHERE Username = '".$username."' AND Password = '".$password."'";
			$FirstName = mysqli_query($rat, $FirstName);
			$FirstName = mysqli_fetch_assoc($FirstName);
			echo "Hello, ".$FirstName['FirstName']."!";
			$_SESSION['firstName'] = $FirstName['FirstName'];
			$_SESSION['loginState'] = $username;

		}else{

			$_SESSION['errorMessage'] = "Incorrect username or password";
			header('Location: http://141.219.225.103:8080');

		}

	/* Check if the user selected the continue shopping option. */
	}else if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['contShop'])){
		
		if(isset($_SESSION['loginState'])){
				
			unset($_SESSION['checkedOut']);
			echo "Hello ". $_SESSION['firstName']."!<br>";

		} else {

			unset($_SESSION['checkedOut']);
			echo "Hello Guest!";

		}

	/* This checks if the user is logged in when accessing hShops.php */
	}else if(isset($_SESSION['loginState'])){

		echo "Hello ". $_SESSION['firstName']."!<br>";

	}else if(isset($_SESSION['businessLoginState'])){

		header('Location: http://141.219.225.103:8080/dashboard.php');

	}else{
		
		echo "Hello Guest!";
				
	}

?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="style_hShops.css">
</head>

<body class="store">

<div id="stack">
<div class="card">
<a href="jims.php">
	<div class="cardPic">	
	<img src="img.png" alt="image" style="width:233px; height:144px">
		<div class="desc">
			<p>Jim's Food Mart</p>
			<p>Pasties, Fruits & booze</p>
		</div>
	</div>
</a>
</div>

<div class="card">
<a href="jims.php">
        <div class="cardPic">
        <img src="img.png" alt="image" style="width:233px; height:144px">
                <div class="desc">
                        <p>Subway at Pearl St.</p>
                        <p>Fresh</p>
                </div>
        </div>
</a>
</div>

<div class="card">
<a href="jims.php">
        <div class="cardPic">
        <img src="img.png" alt="image" style="width:233px; height:144px">
                <div class="desc">
                        <p>JJ's Wok and Grill</p>
                        <p>Asian cuisine</p>
                </div>
        </div>
</a>
</div>

<div class="card">
<a href="jims.php">
        <div class="cardPic">
        <img src="img.png" alt="image" style="width:233px; height:144px">
                <div class="desc">
                        <p>Rodeo Mexican Kitchen</p>
                        <p>Mexican foods</p>
                </div>
        </div>
</a>
</div>
</div>

<div id="changeLoc">
<a href="index.php">Change Location</a>
</div>

<?php 

	require('logout_button.php');

?>

</body>

<?php

	require('close_database.php');

?>

</html>
