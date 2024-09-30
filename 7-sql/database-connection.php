<?php

    $link = mysqli_connect("localhost", "root", "", "test");

    if(mysqli_connect_error()){
        die("There was an error connecting to the database.");
    }

    $query = "SELECT * FROM users";

    if($result = mysqli_query($link, $query)){
        $row = mysqli_fetch_array($result);

        print_r($row);
    }

?>