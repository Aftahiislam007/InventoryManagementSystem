<?php

$server = "localhost";
$username = "root";
$password = "";
$db = "inventory";

$connect = mysqli_connect($server, $username, $password);

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

$select_db = mysqli_select_db($connect, $db);

if (!$select_db) {
    die("Error selecting database: " . mysqli_error($connect));
}
// else{
//     echo "Database selected successfully";
// }

session_start();

// Register session variables (deprecated)
// session_register('type');
// session_register('user_id');
$_SESSION['type'] = '';
$_SESSION['user_id'] = '';
?>
