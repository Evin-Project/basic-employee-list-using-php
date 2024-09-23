<?php
$databaseHost = 'localhost';
$databaseName = 'test';
$databaseUsername = 'root';
$databasePassword = ''; // Leave this empty if there's no password

// Open a new connection to the MySQL server
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

// Check connection
if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}
?>