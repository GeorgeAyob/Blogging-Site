<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php

session_start();
$session=[];
session_destroy();


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

redirect_user1('index.php');

?>


</body>
</html>