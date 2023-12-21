<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DaSillyStore :3</title>
    <link rel="icon" type="image/x-icon" href="favi.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/includes.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>

<header>
    <div id="message">
        <p>Products will NEVER ship :3</p>
    </div>

    <nav>
        <a href="index">
            <img id="logo" class="navsleft" src="./img/main/dasillystore.png">
        </a>

        <a href="index">
            <img id="logosmall" class="navsleft" src="./img/main/logosmall.png">
        </a>

        <form action="main" method="get">
            <button type="submit" name="special_merch" id="clothinglist" class="navsleft"><strong><i>Special </i>Merch↓</strong></button>
        </form>

        <form  action="main" method="get">
            <button type="submit" name="other_products" id="productlist" class="navsleft"><strong>All Products↓</strong></button>
        </form>

        <form action="main" method="get">
            <button type="submit" name="other_products" id="productsmall" class="navsleft"></button>
        </from>

        <a href="cart">
            <img id="cart" class="navsright" src="./img/main/cartempty.png">
        </a>

        <?php if ($_SESSION == true) {?>
            <a href="login">
                <p id="loginbutton" class="navsright"><strong>Log out</strong></p>
            </a>
        <?php } else { ?>
        <a href="login">
            <p id="loginbutton" class="navsright"><strong>Log in</strong></p>
        </a>
        <?php } ?>
        
        <div id="search" class="navsright">
            <form action="main.php" method="get">
                <input type="text" placeholder="Search for products..." name="search">
                <button>
                    <i class="fa fa-search" style="font-size: 2vh;"></i>
                </button>
            </form>
        </div>
        
    </nav>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="./js/script.js"></script>

</header>