<?php
        
        $error = "";

        $successMessage = "";

        if($_POST){
            if(!$_POST["email"]){
                $error .= "An email address is required.<br>";
            }
            if(!$_POST["content"]){
                $error .= "The content field is required.<br>";
            }
            if(!$_POST["subject"]){
                $error .= "The subject field is required.<br>";
            }

            if($_POST["email"] && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false){
                $error .= "The email address is invalid.<br>";
            }

            if($error != ""){
                $error = '<div class="alert alert-danger" role="alert"><p>There were errors in your form:</p>' . $error . '</div>';
            }
            else{
                $emailTo = "brayden3410@gmail.com";
                $subject = $_POST["subject"];
                $content = $_POST["content"];
                $headers = "From: " . $_POST["email"];

                if(mail($emailTo, $subject, $content, $headers)){
                    $successMessage = '<div class="alert alert-success" role="alert">Your message was sent, ' .
                                      'we\'ll get back to you ASAP!</div>';
                }
                else{
                    $error = '<div class="alert alert-danger" role="alert" Your message couldn\'t be sent - try again later</div>';
                }
            }
            
        }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
          crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <h1>Get in touch!</h1>
        <div id="error"><?php echo $error.$successMessage; ?></div>

        <form method="post">
            <fieldset class="form-group">
                <label for="email"> Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                <small class="text-muted">We'll never share your email with anyone else.</small>
            </fieldset>

            <fieldset class="form-group">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter email">
            </fieldset>

            <fieldset class="form-group">
                <label for="content"> What would you like to ask us?</label>
                <textarea class="form-control" id="content" name="content" rows="3"></textarea>
            </fieldset>

            <button type="submit" id="submit" class="btn btn-primary">Submit</button>

        </form> <!-- End form -->
    </div> <!-- End container -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
            crossorigin="anonymous">
    </script>

<script type="text/javascript">
    $("form").submit(function(e){
        let error = "";
        
        // Check if email field is empty
        if($("#email").val() == ""){
            error += "The email field is required.<br>";
        }

        // Check if subject field is empty
        if($("#subject").val() == ""){
            error += "The subject field is required.<br>";
        }

        // Check if content field is empty
        if($("#content").val() == ""){
            error += "The content field is required.<br>";
        }

        // If there are errors, display them and prevent form submission
        if(error != ""){
            $("#error").html('<div class="alert alert-danger" role="alert"><p><strong>There were errors in your form:</strong></p>' + error + '</div>');
            return false;  // Prevent form submission
        } else {
            return true;  // Allow form submission
        }
    });
</script>


</body>
</html>