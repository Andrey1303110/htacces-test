<?php
$host = 'localhost';
$user_DB = 'devcot';
$pass = 'Kxdi3gwgq2kBWJ9i';
$DB = 'devcot_db1';

$mysqli = mysqli_connect($host, $user_DB, $pass, $DB);
$mysqli->connect_errno ? print('Connection error!') : false;
$_SESSION['connect'] = $mysqli;