<?php

    setcookie("customerId", "1234", time() + 60 * 60 * 24); // Sets the cookie to expire in 24hr.

    echo $_COOKIE['customerId'];

?>