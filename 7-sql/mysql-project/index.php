<?php

    session_start();
    $error = "";

    if(array_key_exists("logout", $_GET)){
        session_unset();
        setcookie("id", "", time() - 60 * 60);
        $_COOKIE['id'] = "";
    }
    else if(array_key_exists("id", $_SESSION) OR array_key_exists("id", $_COOKIE)){
        header("Location: loggedinpage.php");
    }// End test for logout query string

    
    if(array_key_exists("submit", $_POST)){

        $link = mysqli_connect("localhost", "root", "", "secret_diary");

        if(mysqli_connect_error()){
            die("Data connection error!");
        }

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


            if($_POST['signUp'] == 1){
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
                        $id = mysqli_insert_id($link);
    
                        $_SESSION['id'] = $id;
    
                        if(isset($_POST['stayLoggedIn'])){
                            setcookie("id", $id, time() + 60 * 60 * 24 * 365);
                        }
    
                        header("Location: loggedinpage.php");
    
                    }// end if for successful/failed sign up.
                }// End mysqli_num_rows test.
            }
            
            else{
                $query = "SELECT * FROM users WHERE email = '" . $emailAddress . "'";
                $result = mysqli_query($link, $query);
                $row = mysqli_fetch_array($result);

                $password = mysqli_real_escape_string($link, $_POST['password']);

                if(isset($row) AND array_key_exists("password", $row)){
                    $passwordMatch = password_verify($password, $row['password']);

                    if($passwordMatch){
                        $_SESSION['id'] = $row['id'];

                        if(isset($_POST['stayLoggedIn'])){
                            setcookie("id", $row['id'], time() + 60 * 60 * 24 * 365);
                        }

                        header("Location: loggedinpage.php");
                    }
                    else{
                        $error = "that email/password combination could not be found.";
                    }
                }
                else{
                    $error = "that email/password combination could not be found.";
                }

            }// end if-else for signup == 1 or 0



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
    
    <div class="container">

        <!-- sign up form -->
        <form method="POST">

                <input type="email" name="email" placeholder="Your email">
                <input type="password" name="password" placeholder="password">
                <input type="checkbox" name="stayLoggedIn" value="1">
                <input type="hidden" name="signUp" value="1">
                <input type="submit" name="submit" value="sign up!">

        </form>

        <!-- log in form -->
        <form method="POST">

            <input type="email" name="email" placeholder="Your email">
            <input type="password" name="password" placeholder="password">
            <input type="checkbox" name="stayLoggedIn" value="1">
            <input type="hidden" name="signUp" value="0">
            <input type="submit" name="submit" value="Log In!">

        </form>

    </div>

</body>
</html>