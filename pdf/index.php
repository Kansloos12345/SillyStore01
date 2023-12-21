<?php

session_start();

@require_once "../dbconnect.php";
@require_once "../src/helpers/auth-helpers.php";

getLoggedInUserID();
if ($_SESSION != false){
    $user_id = $_SESSION['user_id'];
}

$dbconnect = new dbconnection();
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$query = $dbconnect -> prepare($sql);
$query -> execute();
$recset = $query -> fetchAll(PDO::FETCH_ASSOC);

$user = $recset[0];
$firstname = $user['firstname'];
$prefix = $user['prefix'];
$lastname = $user['lastname'];
if ($prefix == null) {
    $fullname = $firstname . ' ' . $lastname;
} else {
    $fullname = $firstname . ' ' . $prefix . ' ' . $lastname;
}
$street = $user['street'];
$postalcode = $user['postalcode'];
$country = $user['country'];

require('FPDF/fpdf.php');

$pdf = new FPDF ();

$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 20);

$pdf->Cell(290, 30, 'Pakbon', 0, 1, '');

$pdf->SetFont('Arial', '', 12);

$pdf->Cell(0, 5, "$fullname", 0, 1, '');
$pdf->Cell(150);
$pdf->Cell(0, 0, 'SillyStore01', 0, 1, '');

$pdf->Cell(0, 5, "$street", 0, 1, '');
$pdf->Cell(150);
$pdf->Cell(0, 0, 'Beukenlaan 69', 0, 1, '');

$pdf->Cell(0, 5, "$postalcode", 0, 1, '');
$pdf->Cell(150);
$pdf->Cell(0, 0, '6969 GB     B-City', 0, 1, '');

$pdf->Cell(0, 5, "$country", 0, 1, '');
$pdf->Cell(150);
$pdf->Cell(0, 0, 'Nederland', 0, 1, '');

$pdf->SetFont('Arial', '', 9);
$pdf->ln(8);
$pdf->Cell(0, 0, 'Verkooporder: 629', 0, 1, '');
$pdf->ln(3);
$pdf->Cell(0, 0, 'Ordernummer: 391', 0, 1, '');

$pdf->SetFont('Arial', '', 12);

$pdf->ln(10);
$pdf->Cell(0, 1, date("d-m-20y"), 0, 1, '');
$pdf->Cell(0, 0, '_________________________________________________________________________________', 0, 1, '');

// Fetch cart products from the database
$sql = "SELECT product.product_name, product.product_price, cart.amount
        FROM cart
        INNER JOIN product ON cart.product_id = product.product_id
        WHERE cart.user_id = '$user_id'";
$query = $dbconnect -> prepare($sql);
$query -> execute();
$cartProducts = $query -> fetchAll(PDO::FETCH_ASSOC);

define('EURO',chr(128));

$totalPrice = 0;

foreach ($cartProducts as $product) {
    $productName = $product['product_name'];
    $productPrice = $product['product_price'];
    $productAmount = $product['amount'];

    $line = "$productAmount pc - $productName - " . EURO . "$productPrice";
    $pdf->ln(5);
    $pdf->cell(10);
    $pdf->Cell(0, 10, $line, 0, 1, '');
    $pdf->Cell(0, 0, '_________________________________________________________________________________', 0, 1, '');

    $totalPrice += ($productPrice * $productAmount); // Add the product's total price to the overall total
}

$pdf->ln(5);
$pdf->cell(10);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Total: ' . EURO . $totalPrice, 0, 1, ''); // Display the total price

$pdf->Output();
?>