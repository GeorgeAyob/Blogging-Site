<?php
define('DB_HOST','localhost');
define('DB_USER','ayob');
define('DB_PASSWORD','Whosays1');
define('DB_NAME','ayob_SocialMedia');
$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR die("Could not connect to database".mysqli_connect_error());
?>