<?php

	   session_start();
	   $_SESSION['checkedOut'] = "true";
           header('Location: http://141.219.225.103:8080/success.php');

?>
