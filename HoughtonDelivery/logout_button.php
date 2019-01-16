<?php

/* Show the login button if the user is logged in. */
        if(isset($_SESSION['loginState'])){

               echo '<div id="logout" style="display:inline">
                        <form action="index.php" method="post" style="float:right">
                                <input type="submit" name="logout" value="Logout">
                        </form>
                </div>';

        }
?>
