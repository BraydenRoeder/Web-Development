<?php

$link = mysqli_connect("localhost", "root", "", "test");

if(mysqli_connect_error()){
    die("There was an error connecting to the database.");
}

//$queryInsert = "INSERT INTO users (email, password) VALUES ('someone@gmail.com' , 'fungus123')";

//mysqli_query($link, $queryInsert);

$queryUpdate = "UPDATE users SET email = 'dog67@gmail.com' WHERE id = '2' LIMIT 1";

mysqli_query($link, $queryUpdate);

?>