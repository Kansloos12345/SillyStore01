<?php
session_start();

if($_SERVER['REQUEST_METHOD'] != 'POST') {
    die('Geen toegang');
}

@require_once ("../../dbcredentials.php");

$email = htmlentities( $_POST['email'] );
$password = $_POST['password'];

$sql = "SELECT * FROM `users` WHERE `users`.`email` = :email";
$placeholders = [
    ':email' => $email
];

$db_statement = $db_connection->prepare($sql);
$db_statement->execute($placeholders);
$user = $db_statement->fetch(PDO::FETCH_ASSOC);

echo '<pre>';
print_r($user);
echo '</pre>';

if(password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['fullname'] = "{$user['firstname']} {$user['prefix']} {$user['lastname'] }";
    header('location: ../../index.php');
    exit();
}

header('location: ../../login.php');
exit();