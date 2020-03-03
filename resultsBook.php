<?php
// LOG ONTO SERVER
// include a file that has the login information or login function
// mysqli_connect.php

echo "<h1> BOOK RESULTS</h1>";

define('DB_HOST','localhost');
define('DB_USER','ayob');
define('DB_PASSWORD','Whosays1');
define('DB_NAME','bookOrama');

$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR die("Could not connect to database".mysqli_connect_error());

$searchtype = $_POST['searchtype'];
$searchterm = $_POST['searchterm'];
//check searchtype is correct value

$searchterm = trim($_POST['searchterm']);

if(!$searchtype || !$searchterm){
    echo "No proper input";
    exit;
}

switch($searchtype)
{
case 'Title';
case 'Author';
case 'ISBN';
break;
default:
echo "That is not a valid input";
}



// QUERY

$query = "SELECT ISBN, Author, Title, Price FROM Books WHERE $searchtype = ?";
  
$stmt = $dbc-> prepare($query);
$stmt-> bind_param('s',$searchterm);
$stmt-> execute();
$stmt-> store_result();
$stmt-> bind_result($ISBN, $AUTHOR, $TITLE, $PRICE);

echo "<p>Number of Books:".$stmt->num_rows."</p>";

while ($stmt->fetch()){
echo $ISBN . "</br>" . $AUTHOR . "</br>" . $TITLE . "</br>" . number_format($PRICE,2). "</br>";
}

?>