<!DOCTYPE html>

<html>

<?php

	session_start();
	
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['business_login'])){

		require('login_database.php');
		$username = $_POST['b_username'];
		$password = $_POST['b_password'];

		if($_POST['business_title'] == "B"){

			$check = "SELECT * FROM retail_Businesses WHERE Username = '".$username."' AND Password = '".$password."'";
			$check = mysqli_query($rat, $check);

			if(mysqli_num_rows($check) == 1){
			
				$check = "SELECT Access FROM retail_Businesses WHERE Username = '".$username."' AND Password = '".$password."'";
				$check = mysqli($rat, $check);
				$check = mysqli_fetch_assoc($check);
	
				if($check['Access'] == $_POST['business_title']){

					$FirstName = "SELECT FirstName from retail_Businesses WHERE Username = '".$username."' AND Password = '".$password."'";
					$FirstName = mysqli_query($rat, $FirstName);
					$FirstName = mysqli_fetch_assoc($FirstName);
					$_SESSION['businessLoginState'] = $FirstName['FirstName'];
					$_SESSION['businessTitle'] = $_POST['business_title'];

				}else{
			
					$_SESSION['errorMessage'] = "Invalid login credentials";
	                                header("Location: http://141.219.225.103:8080/");

				}
			
			}else{
			
				$_SESSION['errorMessage'] = "Invalid login credentials";
				header("Location: http://141.219.225.103:8080/");
		
			}

		}else if($_POST['business_title'] == "A" || $_POST['business_title'] == "D" || $_POST['business_title'] == "R"){

			$check = "SELECT * FROM employees WHERE Username = '".$username."' AND Password = '".$password."'";
                        $check = mysqli_query($rat, $check);

                        if(mysqli_num_rows($check) == 1){

                                $check = "SELECT Access FROM employees WHERE Username = '".$username."' AND Password = '".$password."'";
				$check = mysqli_query($rat, $check);
				$check = mysqli_fetch_assoc($check);

                                if($check['Access'] == $_POST['business_title']){

					$FirstName = "SELECT FirstName FROM employees WHERE Username = '".$username."' AND Password = '".$password."'";
					$FirstName = mysqli_query($rat, $FirstName);
					$FirstName = mysqli_fetch_assoc($FirstName);
                                        $_SESSION['businessLoginState'] = $FirstName['FirstName'];
					$_SESSION['businessTitle'] = $_POST['business_title'];

                                }else{

                                        $_SESSION['errorMessage'] = "Invalid login credentials";
                                        header("Location: http://141.219.225.103:8080/");

                                }

                        }else{

                                $_SESSION['errorMessage'] = "Invalid login credentials";
                                header("Location: http://141.219.225.103:8080/");

                        }

		}else if($_POST['business_title'] == "invalid"){

			$_SESSION['errorMessage'] = "Invalid login credentials";
                        header("Location: http://141.219.225.103:8080/");
		
		}

	require('close_database.php');

	}else if(isset($_SESSION['loginState'])){

                header("Location: http://141.219.225.103:8080/hShops.php");

        }else if(isset($_SESSION['businessLoginState'])){

	}else{

                $_SESSION['errorMessage'] = "Invalid";
                header("Location: http://141.219.225.103:8080/");

        }
	
?>

<head>

</head>

<body>

	<form action="index.php" method="post">
		<input style="float:right" type="submit" name="logout" value="Logout">
	</form>

<?php
        if($_SESSION['businessTitle'] == "R"){

                echo 'Hello, Root! Root is God.

		<br><br>
		<a href="oms.php">OMS</a>
		<a href="allaccess.php">DATA</a>';

        }else if($_SESSION['businessTitle'] == "A" || $_SESSION['businessTitle'] == "D"){

                echo 'Hello '.$_SESSION['businessLoginState'].',

		<br><br>
                <a href="oms.php">OMS</a>
		<a href="timesheet.php">Timesheet</a>';

        }else if($_SESSION['businessTitle'] == "B"){

                echo 'Hello '.$_SESSION['businessLoginState'].',

		<br><br>
		<a href="oms.php">OMS</a>';

       } 


?>


</body>


</html>
