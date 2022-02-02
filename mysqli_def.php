<?php
$host = 'localhost';
$user_DB = 'test';
$pass = 'test';
$DB = 'test';

$mysqli = mysqli_connect($host, $user_DB, $pass, $DB);

$mysqli->connect_errno ? print('Connection error!') : print('Connection to DB success!');