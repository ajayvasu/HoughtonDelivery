<?php

	require('login_database.php');

	$i = 1;

	if($items = mysqli_query($rat, 'SELECT * FROM Inventory WHERE RID = 100')){

		while($row = mysqli_fetch_assoc($items)){

			echo "<div class=\"itemBox\" onclick=\"addToCart(".$row['IID'].")\" style=\"border-style:solid; 
			     margin: 2px; border-radius:5px; border-width: 2px; 
			     align:center; width: 90%;\"><p style=\"padding:5px\">
			     ".$i.". ".$row['ItemName']."<span style=\"align:right\">
			      - $".$row['ItemCost']."</span></p></div>";
			$i++;

		}

	}

	require('close_database.php');		

?>
