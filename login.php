<?php

session_start();

@require_once 'includes/header.php';

?>

<link rel="stylesheet" href="css/index.css">

<div id="title">
    <?php if ($_SESSION == true) {?>
        <h1>Log In or Out</h1>
    <?php } else {?>
        <h1>Log In</h1>
    <?php }?>
    </div>

<form id="login" action="src/formhandlers/login.php" method="POST">

    <div>
        <input type="email" id="email" name="email" placeholder="example@example.com" class="inputs"/>
    </div>

    <div>
        <input type="password" id="wachtwoord" name="password" placeholder="Password" class="inputs"/>
    </div>

    <a href="#">
        <img src="img/main/googol.png" class="smallinputs"></button>
    </a>

    <a href="https://youtu.be/dQw4w9WgXcQ">
        <img src="img/main/TOKTOK.png" class="smallinputs"></button>
    </a>
    
    <button id="submit" type="submit" onclick="loggedin()">Les go</button>

    <a href="register.php">
        <h4>Don't have an account? Sign Up!</h4>
    </a>

    <?php if ($_SESSION == true) {?>
        <a id="logout" href="src/auth/logout.php" onclick="logout(event)">
            <h4>>>> LOG OUT! <<<</h4>
        </a>
    <?php } ?>

</form>

<?php

    @require_once ("includes/footer.php");

?>