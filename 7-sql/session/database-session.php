<?php

session_start();


if(array_key_exists('email', $_POST) OR array_key_exists('password', $_POST)){
    $link = mysqli_connect("localhost", "root", "", "test");

    if(mysqli_connect_error()){
        die("There was an error connecting to the database.");
    }

    if($_POST['email'] == ''){
        echo "<p>Email address is required.</p>";
    }
    elseif($_POST['password'] == ''){
        echo "<p>Password is required.</p>";
    }
    else{
        $query = "SELECT id FROM users WHERE email = '"
                . mysqli_real_escape_string($link, $_POST['email']) . "'";

        $result = mysqli_query($link, $query);

        if(mysqli_num_rows($result) > 0){
            echo "<p>That email address has already been taken.</p>";
        } 
        else{
            // Sanitize user input
            $email = mysqli_real_escape_string($link, $_POST['email']);
            $password = mysqli_real_escape_string($link, $_POST['password']);

            // Create the query
            $query = "INSERT INTO users (email, password) VALUES ('$email', '$password')";  
            
            if(mysqli_query($link, $query)){
                $_SESSION['email'] = $_POST['email'];
                header('Location: session.php');
            }
            else{
                echo "<p> There was a problem signing you up! Please try again later</p>";
            }
        }
    }  
}

?>