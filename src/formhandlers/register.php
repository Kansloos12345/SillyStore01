<?php

session_start();

@require_once ("../../dbcredentials.php");

$firstname = htmlentities( $_POST['firstname'] );
$lastname = htmlentities( $_POST['lastname'] );
$prefix = htmlentities( $_POST['prefix'] );
$email = htmlentities( $_POST['email'] );
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$street = htmlentities( $_POST['street']);
$postalcode = htmlentities( $_POST['postalcode']);
$country = htmlentities( $_POST['country']);

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $db_connection->query($sql);
$present = $result->rowCount();
if ($present > 0) {
    $_SESSION['email_alert'] = '1';
    
    echo 
    '<script>
    history.back()
    </script>';

} else {

$sql = "INSERT INTO `users`(`firstname`, `lastname`, `prefix`, `email`, `password`, `street`, `postalcode`, `country`)
        VALUES(:firstname, :lastname, :prefix, :email, :password, :street, :postalcode, :country)";

$placeholders = [
    ':firstname' => $firstname,
    ':lastname' => $lastname,
    ':prefix' => $prefix,
    ':email' => $email,
    ':password' => $password,
    ':street' => $street,
    ':postalcode' => $postalcode,
    ':country' => $country,
];

$db_statement = $db_connection->prepare($sql);
$db_statement->execute($placeholders);

header('location: ../../login.php');
exit();

}