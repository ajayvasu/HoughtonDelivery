<!DOCTYPE html>

<?php

	session_start();
	if(isset($_SESSION['logout'])){

                header('Location: http://www.houghtondelivery.com/');

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
<link rel="stylesheet" style="text/css" href="style_checkout.css">

<script>

	function executeTransaction() {

		window.location = "execute_transaction.php";

	}

</script>

</head>

<body class="checkoutPage">

<form action="hShops.php" method="post">
	<input type="submit" class="pressy" name="contShop" value="Back to Shops">
</form>

<form action="jims.php" method="post">
	<input type="submit" class="pressy" name="editOrder" value="Edit Order">
</form>

<p>Payment Gateway under construction.</p>
<a href="execute_transaction.php">Make Payment</a>

<?php

	require('logout_button.php');

?>

</body>

</html>
