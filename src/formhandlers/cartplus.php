<?php 

session_start();

@require_once ("../helpers/auth-helpers.php");
@require_once ("../../dbconnect.php");
@require_once ("../../dbcredentials.php");

getLoggedInUserID();

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product'];

$dbconnect = new dbconnection();

$sql = "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";

$query = $dbconnect -> prepare($sql);

$query -> execute();

$recset = $query -> fetchAll(PDO::FETCH_ASSOC);

if ($recset == false) {
    $amount = 1;
} else {
    $amount = $recset [0]['amount'];
    $amount ++; 
}

//data toevoegen aan cart of aantal verhogen als het al bestaat
if ($amount == 1) {
    $sql = "INSERT INTO `cart`(`user_id`, `product_id`, `amount`)
            VALUES(:user_id, :product_id, :amount)";
    $placeholders = [
        ':user_id' => $user_id,
        ':product_id' => $product_id,
        ':amount' => $amount,
    ];

    $db_statement = $db_connection->prepare($sql);
    $db_statement->execute($placeholders);
} else {
    $sql = "UPDATE cart SET amount='$amount' WHERE user_id = '$user_id' AND product_id = '$product_id'";
    $query = $dbconnect -> prepare($sql);
    $query -> execute();
}
echo 
'<script>
history.back()
</script>';