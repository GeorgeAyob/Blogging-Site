<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Page</title>
</head>
<body>
    

<?php 
session_start();
include('includes/header.html');


 if(  isset($_SESSION['user_id']) && isset($_SESSION['first_name']) )
 {
 
    echo " <p>Hello ". $_SESSION['first_name'].", you are logged in</p>";
  
 }

 else
 echo "You are not lgged in";

function recentposts() {
require('require/connectdb.php');

$query = "SELECT post.title, post.body, post.registration_date, users.first_name From post INNER JOIN users ON post.user_id = users.user_id ORDER BY registration_date DESC LIMIT 5;";
  
$stmt = $dbc-> prepare($query);
$stmt-> execute();
$stmt-> store_result();
$stmt-> bind_result($title, $body,$registration_date,$firstname);

echo "<p>Posts:".$stmt->num_rows."</p>";

while ($stmt->fetch()){
echo  "<h3>".$title."</h3>".$firstname."</br>" .$registration_date. "</br>" . $body. "</br>";
}

echo"</br>";
echo "<a href='#'> 1 </a>";
echo "<a href='#'> 2 </a>";
echo "<a href='#'> 3 </a>";


}


recentposts();
?>

<?php
include('includes/footer.html');
?>

</body>
</html>