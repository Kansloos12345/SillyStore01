<?php

session_start();

@require_once ("src/helpers/auth-helpers.php");
@require_once ("includes/header.php");
@require_once ("dbconnect.php");

getLoggedInUserID();

if ($_SESSION == true) {
    $user_id = $_SESSION['user_id'];
    $nologin = '';
} else {
    $user_id = '';
    $nologin = 'Log in pls or else no cart 4 u';
}

$dbconnect = new dbconnection();

$sql = "SELECT * FROM cart WHERE user_id = '$user_id'";

$query = $dbconnect -> prepare($sql);

$query -> execute();

$recset = $query -> fetchAll(PDO::FETCH_ASSOC);

$totalprice = 0;

?>

<link rel="stylesheet" href="css/index.css">
<link rel="stylesheet" href="css/responsive.css">

<h1 id="titlecart">Cart :3</h1>

<h1 id="titlecart"><?php echo $nologin; ?></h1>

<?php foreach ($recset as $key => $value) { 
    $product_id = $value["product_id"];

    $sql = "SELECT * FROM product WHERE product_id = '$product_id'";

    $query = $dbconnect -> prepare($sql);
    
    $query -> execute();
    
    $info = $query -> fetchAll(PDO::FETCH_ASSOC);

    $fullprice = $info[0]["product_price"] * $recset[$key]["amount"];

    $totalprice = $fullprice + $totalprice;
?>

    <div class="cartproduct">
        <img class="image" src="img/products/<?= $info[0]["product_img"]; ?>">
        <p class="productinfo" id="productname"><?= $info[0]["product_name"]; ?></p>
        <p class="productinfo" id="productprice"><strong>€<?php echo $fullprice; ?></strong></p>

        <form action="src/formhandlers/cartmin.php" method="POST">
            <button type="submit" name="product" class="plusses" id="minus" value="<?= $value["product_id"]; ?>" style="background-color: #E8A0BF; background-image: url('img/main/minus.png'); border:none; background-repeat:no-repeat;background-size:100% 100%;"></button>
        </form>

        <p class="productinfo" id="productamount"><?= $recset[$key]["amount"]; ?></p>

        <form action="src/formhandlers/cartplus.php" method="POST">
            <button type="submit" name="product" class="plusses" id="plus" value="<?= $value["product_id"]; ?>" style="background-color: #E8A0BF; background-image: url('img/main/plus.png'); border:none; background-repeat:no-repeat;background-size:100% 100%;"></button>
        </form>

        <form  action="src/formhandlers/cartdel.php" method="POST">
            <button type="submit" name="delete" class="plusses" id="trash" value="<?= $value["product_id"]; ?>" style="background-color: #E8A0BF; background-image: url('img/main/trashcan.png'); border:none; background-repeat:no-repeat;background-size:100% 100%;">
        </form>
    </div>

<?php } ?>

<div class="totalprice">
    <p><strong>Total: €<?php echo $totalprice; ?></strong></p>
</div>

<?php if ($_SESSION == true) { ?>
    <a href="pdf/index.php" class="finaldecision"></a>
<?php } else { ?>
    <a href="login.php" class="finaldecision"></a>
<?php } ?>

<a target="_blank" href="https://youtu.be/dfZgkWlb_hw" id="thankyoudiv">
    <img id="thankyou" src="img/main/saythewords.gif">
</a>

<?php

    @require_once ("includes/footer.php");

?>