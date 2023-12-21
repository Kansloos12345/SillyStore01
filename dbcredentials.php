<?php 

// Database credentials
$dbHost = 'localhost'; 
$dbName = 'sillystore01';
$dbUser = 'root';
$dbPass = '';

$db_connection = null;
$db_statement = null;

try {
    $db_connection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
} catch(PDOException $error) {
    header('location: ../../main.php');
    exit(); // die()
}