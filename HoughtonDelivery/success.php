<!DOCTYPE html>

<?php

	session_start();
	if(isset($_SESSION['logout'])){

                header('Location: http://141.219.225.103:8080/');

        }else if(isset($_SESSION['businessLoginState'])){

                header('Location: http://141.219.225.103:8080/dashboard.php');

	}else if(isset($_SESSION['checkedOut'])){

		if(isset($_SESSION['loginState'])){

                	echo "Hello ". $_SESSION['firstName']."!<br>";

        	}else{

			echo "Hello Guest";		
			
		}

	}else{

		header('Location: http://141.219.225.103:8080/');
	
	}

?>

<html>

<head>
<link rel="stylesheet" type="text/css" href="style_success.css">

<script>

</script>
</head>

<body class="successPage">
	<p>Order Successful!</p>

	<form action = "hShops.php" method="post">
		<input type="submit" class="pressy" name="contShop" value="Back to shops">
	</form>

<?php

	require('logout_button.php');

?>

</body>

</html>
