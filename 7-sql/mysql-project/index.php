<?php

    if(array_key_exists("submit", $_POST)){

        $link = mysqli_connect("localhost", "root", "", "secret_diary");

        if(mysqli_connect_error()){
            die("Data connection error!");
        }

        $error = "";

        if(!$_POST['email']){
            $error .= "An email address is required. <br>";
        }

        if(!$_POST['password']){
            $error .= "A password is required. <br>";
        }

        if($error != ""){
            $error = "<p> There were errors in your form!</p>" . $error;
        }
        else{
            $emailAddress = mysqli_real_escape_string($link, $_POST['email']);
            $query = "SELECT id FROM users WHERE email = '" . $emailAddress . "' LIMIT 1";

            $result = mysqli_query($link, $query);

            if(mysqli_num_rows($result) > 0){
                $error = "that email address is taken.";
            }
            else{
                $password = mysqli_real_escape_string($link, $_POST['password']);
                $password = password_hash($password, PASSWORD_DEFAULT);

                $query = "INSERT INTO users (email, password) VALUES ('" . $emailAddress . "', '" . $password . "')";

                if(!mysqli_query($link, $query)){
                    $error .= "<p>Could not sign you up - please try again later.</p>";
                    $error .= "<p>" . mysqli_error($link) . "</p>";
                }
                else{
                    echo "sign up seccessful!";
                }// end if for successful/failed sign up.
            }// End mysqli_num_rows test.
        }// End of error existing check.

    }// End if the submit exists.

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secret Diary</title>
</head>
<body>

    <div id="error"><?php echo $error; ?></div>
    
    <form method="POST">

        <input type="email" name="email" placeholder="Your email">
        <input type="password" name="password" placeholder="password">
        <input type="checkbox" name="stayLoggedIn" value="1">

        <input type="submit" name="submit" value="sign up!">

    </form>

</body>
</html>