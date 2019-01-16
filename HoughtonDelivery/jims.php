<!DOCTYPE html>

<?php

	session_start();
	
	if(isset($_SESSION['logout'])){

		header('Location: http://141.219.225.103:8080/');	

	}else if(isset($_SESSION['businessLoginState'])){

		header('Location: http://141.219.225.103:8080/dashboard.php');
	
	}

?>

<html>

<head>

	<link rel="stylesheet" href="style_jims.css">

	<script>

		/* Load Cart items if any */
		var loadCart = new XMLHttpRequest();
		var x;
		var sno = 1;	
		var masterCart = "";

		loadCart.onreadystatechange = function() {

			if(this.status == 200 && this.readyState == 4){

				var itemObj = JSON.parse(this.responseText);
				itemObj = JSON.parse(itemObj);

				if(document.getElementById("cartItems").innerHTML == ""){

					for(x = 0, sno = 1; x < itemObj.length; x++, sno++){
	
						masterCart = masterCart + "<tr><td> " + sno + ". </td><td> " + itemObj[x].ItemName + " </td>\
						<td> " + itemObj[x].ItemQuantity + " </td><td> $" + itemObj[x].ItemCost + " </td></tr><br>";
	
					}
				
					document.getElementById("cartItems").innerHTML = masterCart;

				}else{

					

				}
				
			}
		};

		loadCart.open("GET", "loadCart.php", true);
		loadCart.send();
		

		/* Add to Cart functionality */		
		function addToCart(chooseID){
		
			var addItem = new XMLHttpRequest();
		
			addItem.onreadystatechange = function() {

				if(this.status == 200 && this.readyState == 4){

				        var itemObj = JSON.parse(this.responseText);
        	                        itemObj = JSON.parse(itemObj);
					masterCart = "";
						                                        
					for(x = 0, sno = 1; x < itemObj.length; x++, sno++){

                                                masterCart = masterCart + "<tr><td> " + sno + ". </td><td> " + itemObj[x].ItemName + " </td>\
                                                <td> " + itemObj[x].ItemQuantity + " </td><td> $" + itemObj[x].ItemCost + " </td></tr><br>";

                                        }

                                        document.getElementById("cartItems").innerHTML = masterCart;
					document.getElementById("totalDue").innerHTML = itemObj.Total

				}
	
			};

			addItem.open("GET", "addToCart.php?iid=" + chooseID, true);
			addItem.send();
	
		}

	</script>

</head>

<body>

<div id="dashbar" style="float:left; height:5%; width:100%">

	<?php

		if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editOrder']) && isset($_SESSION['loginState'])){

	                echo "Hello ". $_SESSION['firstName']."!<br>";

       		}else if(isset($_SESSION['loginState'])){

                	echo "Hello ". $_SESSION['firstName']."!<br>";

        	}else{

        	        echo "Hello Guest!<br>";

	        }

	?>

	<form action="hShops.php" style="display:inline" method="post"> <input type="submit" value="Back to Shops" name="contShop"> </form> 

	<?php

		require('logout_button.php');
	
	?>

</div>

<div id="StoreTitle">
	
	<p align="center" style="font-size:59px; margin:0;">Jim's Foodmart</p>

</div>


<div id="shopContainer" style="height:5%; width:100%; overflow:hidden;">

	<div id="controlBar" style="width:19%; float:left;">
	
		control bar

	</div>

	<div id="itemList" style="width:60%; float:left;">

	Item List	

	<?php

		require('showItemList.php');

	?>

	</div>

	<div id="shoppingCart" style="width:20%; float:left;">

		<p>Shopping Cart:</p><br><br>
		<table style="width:100%"><div id="cartItems"></div></table><br>
		<div id="fees"></div><br>
		Total :<div id="totalDue"></div><br>
		<div id="checkoutButton"></div><br>

	</div>

</div>

<div id="footer" style="text-align:right">

	<p id="test">Contact: +1 906 275 9534</p>
	
</div>

</body>

</html>
