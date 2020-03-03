<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

</head>
<body>
<?php  include('includes/header.html'); ?>

<br/><br/>
<br/><br/>

<div class="container text-center">

<form method="post" action="Loginform.php">
<p> <b> Login</b></p>
Email Address: <br/>
<input type="text" name="email" value=
"<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" size="50"/> <br/><br/>
Password: <br/>
<input type="password" name="pass" value=
"<?php if (isset($_POST['pass'])) echo $_POST['pass']; ?>" size="50" /> <br/><br/>
<br/>
<input type="submit" name="Submit" />
</form>

</div>
<?php
    require('require/connectdb.php');

    function redirect_user1($page = 'index.php') {
        // Start defining the URL...
        // URL is http:// plus the host name plus the current directory:
        $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
        // Remove any trailing slashes:
        $url = rtrim($url, '/\\');
        // Add the page:
        $url .= '/' . $page;
        // Redirect the user:
        header("Location: $url");
        exit(); // Quit the script.
    } // End of redirect_user() function.
    

	if (isset($_POST['Submit'])) {
		$errors = "";
 
        if ($_POST['email'] != "") {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors .= "$email is <strong>NOT</strong> a valid email address.<br/><br/>";
            }
        } else {
            $errors .= 'Please enter your email address.<br/>';
        }
 
        if ($_POST['pass'] != "") {
            $pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
            if (!filter_var($pass, FILTER_SANITIZE_STRING)) {
                $errors .= "$pass is <strong>NOT</strong> a valid Password.<br/><br/>";
            }
        } else {
            $errors .= 'Please enter your Password.<br/>';
        }
 
        if (!$errors) {
          
            $pass = SHA1($pass);
            $query = "SELECT user_id, first_name FROM users WHERE email=? AND pass=?";
            $stmt = $dbc-> prepare($query);
     $stmt->bind_param('ss',$email,$pass);
     $stmt->execute();
     $stmt->store_result();
     $stmt->bind_result($user_id, $first_name);
     
       if ($stmt->num_rows >0)
       {
           $stmt->fetch();
           $data = array('user_id'=>$user_id,'first_name'=>$first_name);

        session_start();
		$_SESSION['user_id'] = $data['user_id'];
        $_SESSION['first_name'] = $data['first_name'];

        redirect_user1('index.php');

        
       }
    else { // Not a match!
               echo ' The email address and password entered do not match those on file.';
               return 0;
           }

            echo "Login Successful!<br/><br/>";

        } else {
            
            echo '<div class="text-center" style="color: red">' . $errors . '<br/></div>';
        }
    }

    mysqli_close($dbc); // Close the database connection.



?>
 
 </body>
</html>