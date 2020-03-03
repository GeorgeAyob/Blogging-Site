<?php  session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add a Post</title>
</head>
<body>
<?php
include('includes/header.html');
include('includes/functions.php');
require('require/connectdb.php');

function printform()
{
    echo '
    <form method="POST" action="addPost.php">
    <fieldset >
                <legend>Write a New Post Here:</legend>
                <p>Title</p>
                <p><input type="text"  name="title" ></input></p>
                <p> <textarea  name="post" id="post" placeholder="I was born..." ></textarea></p>
                <input type="submit" name="submit" value="Post!">
    </fieldset>
    </form>';
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') 
{
    if(isset($_SESSION['user_id']) && isset($_SESSION['first_name']))
    {
        echo "Welcome " . $_SESSION['first_name'];
        printform();
    }
 
    else 
    { redirect_user1('Loginform.php'); }
}


if (isset($_POST['submit']))
{

    $title = htmlspecialchars(($_POST['title']));
    $post = htmlspecialchars($_POST['post']);
    $userid= $_SESSION['user_id'];

    $query = "INSERT INTO `post` (`post_id`, `title`, `body`, `registration_date`, `user_id`) VALUES (NULL, ?, ?, CURRENT_DATE(), ?);";

    $stmt = $dbc-> prepare($query);
    $stmt-> bind_param('ssi',$title,$post,$userid);
    $stmt-> execute();

    echo "<h1>POST SUCCESSFUL!</h1>";
    printform();

}


?>

    
</body>
</html>