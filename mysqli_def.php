<?php
$host = 'localhost';
$user_DB = 'test';
$pass = 'test';
$DB = 'test';

$mysqli = mysqli_connect($host, $user_DB, $pass, $DB);

if ($mysqli->connect_errno) exit("Соединение не удалось");