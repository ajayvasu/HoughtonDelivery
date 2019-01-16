<!DOCTYPE html>

<?php

        $rat = mysqli_connect("localhost", "root", "Knicker_Bocker_7", "snowy");


        if(!$rat){
                die("Connection Failed: " . mysqli_connect_error());
        }

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addUser'])){
	$insert = "INSERT INTO myPeople (username, password, FirstName, LastName, Email, PhoneNumber) VALUES ('".$_POST['uname']."', '".$_POST['pwd']."', '".$_POST['fname']."', '".$_POST['lname']."', '". $_POST['email']."', '".$_POST['phoneNo']."')";	

	if(mysqli_query($rat, $insert)){
                echo "New Record Created Successfully!";
        }else{
                echo mysqli_error($rat);
        }

	session_start();
	$_SESSION['loginState'] = $_POST['uname'];
	echo "Logged in as: ". $_SESSION['loginState'];
	}else if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){

		$username = $_POST['username'];
		$password = $_POST['password'];

		$check = "SELECT * FROM myPeople WHERE username = '$username' AND password = '$password'";

		$result = mysqli_query($rat, $check);
		echo mysqli_fetch_assoc($result, MYSQLI_ASSOC);
		echo $username;
		echo $password;

		if(mysqli_num_rows($result) == 1){
			session_start();
			$_SESSION['loginState'] = $username;
			echo "Logged in as: ". $_SESSION['loginState'];
		} else {
			header('Location: http://www.houghtondelivery.com');
		}

	}else if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guestLogin'])){

		session_start();
		$_SESSION['loginState'] = "Guest";
		
		echo "Logged in as: ". $_SESSION['loginState'];

	}else if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['contShop'])){

		session_start();		
		echo "Logged in as: ". $_SESSION['loginState'];

	}else{
		echo "Not logged in";
	}

?>

<html>

<head>
<link rel="stylesheet" type="text/css" href="style_hShops.css">
</head>

<body class="store">

<a href="jims.php">	
	<div class="card">
	
	<img src="img.png" alt="image" style="width:233px; height:144px">	
		<div class="desc">
			<p>Jim's Food Mart</p>
			<p>Pasties, Fruits & booze</p>
		</div>
	</div>
</a>

<a href="index.php">Change Location</a>



</body>
<?php  mysqli_close($rat);  ?>
</html>
