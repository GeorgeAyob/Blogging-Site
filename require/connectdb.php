<?php
define('DB_HOST','localhost');
define('DB_USER','');
define('DB_PASSWORD','');
define('DB_NAME','');
$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR die("Could not connect to database".mysqli_connect_error());
?>
