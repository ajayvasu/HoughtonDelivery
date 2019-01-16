<?php

	session_start();
	require('login_database.php');


	$repeatFlag = false;
	$choice = mysqli_query($rat, "SELECT * FROM Inventory WHERE IID = ".$_GET['iid']."");
	$choice = mysqli_fetch_assoc($choice);

	$cart = mysqli_query($rat, "SELECT Cart FROM customer_signedUp WHERE Username = \"".$_SESSION['loginState']."\"");
	$cart = mysqli_fetch_assoc($cart);

	if($cart['Cart'] == NULL){
		
		/* Update MySQL with new Cart selection */
		$cartStuff = json_encode(array( "IID" => "".$choice['IID']."", "ItemName" => "".$choice['ItemName']."", "ItemQuantity" => 1, "ItemCost" => $choice['ItemCost'] ), JSON_FORCE_OBJECT);
		$cartStuff = "[".$cartStuff."]";
		$cartStuff = json_encode($cartStuff);
		mysqli_query($rat, "UPDATE customer_signedUp SET Cart = ".$cartStuff." WHERE Username = \"".$_SESSION['loginState']."\"");
		
		/* Send the updated cart to the Javascript */
		$cart = mysqli_query($rat, "SELECT Cart FROM customer_signedUp WHERE Username = \"".$_SESSION['loginState']."\"");
	        $cart = mysqli_fetch_assoc($cart);
		echo json_encode($cart['Cart']);

	}else{
		
		/* Check to see if choice is already in the cart */
		$cart = json_decode($cart['Cart']);
		for($x = 0; $x < sizeof($cart); $x++){
			
			if($cart[$x]->IID == $choice['IID']){
				
				$repeatFlag = true;
				break;
		
			}

		}

		/* Selecting an item that's already in the cart */
		if($repeatFlag == true){
			
	                for($x = 0; $x < sizeof($cart); $x++){
	
        	                if($cart[$x]->IID == $choice['IID']){

					$cart[$x]->ItemQuantity++;
					$unitPrice = floatval($choice['ItemCost']);
					$quantity = intval($cart[$x]->ItemQuantity);
					$cart[$x]->ItemCost = $unitPrice * $quantity;
					$cart = json_encode($cart);
					mysqli_query($rat, "UPDATE customer_signedUp set Cart = '".$cart."' WHERE Username = \"".$_SESSION['loginState']."\"");
	
					/* Send the updated cart to the Javascript */
	                		$cart = mysqli_query($rat, "SELECT Cart FROM customer_signedUp WHERE Username = \"".$_SESSION['loginState']."\"");
        		        	$cart = mysqli_fetch_assoc($cart);
                			echo json_encode($cart['Cart']);
					$repeatFlag = false;
					break;

				}
			}

		/* Selecting an item that isn't in the cart */
		}else{
		
			$cartStuff = json_encode(array( "IID" => "".$choice['IID']."", "ItemName" => "".$choice['ItemName']."", "ItemQuantity" => 1, "ItemCost" => $choice['ItemCost'] ), JSON_FORCE_OBJECT);

			/* Remove the end square bracket from the MySQL JSON string */
			$cart = json_encode($cart);
			$temp = substr($cart, 0, strlen($cart)-1);
			/* Append the rest of the JSON string and insert it into the MySQL database */
			$cartStuff = $temp.", ".$cartStuff."]";
			$cartStuff = json_encode($cartStuff);
			mysqli_query($rat, "UPDATE customer_signedUp SET Cart = ".$cartStuff." WHERE Username = \"".$_SESSION['loginState']."\"");

			/* Send the updated cart to the Javascript */
	                $cart = mysqli_query($rat, "SELECT Cart FROM customer_signedUp WHERE Username = \"".$_SESSION['loginState']."\"");
        	        $cart = mysqli_fetch_assoc($cart);
                	echo json_encode($cart['Cart']);

		}
	
	}

	require('close_database.php'); 

?>
