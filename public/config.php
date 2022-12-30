<?php
$host = 'localhost';
$user = 'Webuser';
$password = 'Lab2022';
$database = 'sushi_shop';

$link = mysqli_connect($host, $user, $password) or die("Error: couldnt connect to host");
mysqli_select_db($link, $database) or die("Error: the database could not be opened");