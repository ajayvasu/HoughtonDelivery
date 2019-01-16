<?php

        /* Connect to the database */
        $rat = mysqli_connect("localhost", "root", "", "snowy");


        if(!$rat){

                die("Connection Failed: " . mysqli_connect_error());

        }

?>
