<?php

$link = mysqli_connect("localhost", "root", "", "test");

if(mysqli_connect_error()){
    die("There was an error connecting to the database.");
}

//$query = "SELECT * FROM users";
//$query = "SELECT * FROM users WHERE id = 1";
//$query = "SELECT * FROM users WHERE email LIKE  '%gmail.com'";
//$query = "SELECT email FROM users WHERE id >= 2 AND email like '%a%'";

$name = "John O'Connor";

$query = "SELECT email FROM users WHERE name = '" . mysqli_real_escape_string($link, $name) . "'";



if($result = mysqli_query($link, $query)){
    while($row = mysqli_fetch_array($result)){
        print_r($row);
    }

    print_r($row);
}

?>

