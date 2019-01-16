<?php

	session_start();
	require('login_database.php');

	$check = mysqli_query($rat, "SELECT Cart from customer_signedUp WHERE Username =\"".$_SESSION['loginState']."\"");
	$check = mysqli_fetch_assoc($check);
	
	if($check['Cart'] != NULL){

		$check = json_encode($check['Cart']);
		echo $check;

	}

	require('close_database.php');	

?>
