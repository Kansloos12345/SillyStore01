<?php

session_start();

@require_once ("includes/header.php");

@require_once ("dbconnect.php");

$dbconnect = new dbconnection();

if(!empty($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM product WHERE product_name LIKE '%$search%'";
}

if(isset($_GET['limited_edition'])){
    $sql = "SELECT * FROM product WHERE catagory='limited_edition'";
}

if(isset($_GET['kharua_collection'])){
    $sql = "SELECT * FROM product WHERE catagory='kharua_collection'";
}

if(isset($_GET['rvspijker_collection'])){
    $sql = "SELECT * FROM product WHERE catagory='rvspijker_collection'";
}

if(isset($_GET['special_merch'])){
    $sql = "SELECT * FROM product WHERE catagory='rvspijker_collection' OR catagory='kharua_collection'";
}

if(isset($_GET['other_products'])){
    $sql = "SELECT * FROM product";
}

$query = $dbconnect -> prepare($sql);

$query -> execute();

$recset = $query -> fetchAll(PDO::FETCH_ASSOC);

?>

<link rel="stylesheet" href="css/index.css">

<p id=title><strong>Products↓</strong></p>

<div class="maingrid">

<?php foreach ($recset as $key => $value) { ?>

<div class="product-card">
    <div class="product-price">
        <strong>
            €<?= $value["product_price"]; ?>
        </strong>
    </div>
    <img src="img/products/<?= $value["product_img"]; ?>" class="product-image" alt="" />
    <h1 class="product-title"><?= $value["product_name"]; ?></h1>

    <form action="src/formhandlers/addtocart.php" method="POST">

        <?php if ($_SESSION == true) {?>
            <button class="product-buy-btn" value="<?= $value["product_id"]; ?>" name="product" type="submit" onclick="addedtocart()">
                KOPUH
            </button>
        <?php } else { ?>
            <a href="login.php">
                <p>eerst inloggen lol</p>
            </a>
        <?php } ?>

    </form>
</div>

<script>
    // Check if the cart message exists in session
    <?php if (isset($_SESSION['cart_message'])) { ?>
        // Display the alert with the cart message
        swal({
            title: "ありがとう！",
            text: "Item haz been added to da cart :3",
            icon: "success",
            button: "Yay!",
        });
        // Clear the cart message from session
        <?php unset($_SESSION['cart_message']); ?>
    <?php } ?>
</script>

<?php } ?>

</div>

<?php

    @require_once ("includes/footer.php");

?>