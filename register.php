<?php

    session_start();

    @require_once ("includes/header.php");

    $message = '';

    if (isset($_SESSION['email_alert'])) {
        $message = 'Email already exists sowwy :3 :(';
    }

    session_destroy();

?>

<link rel="stylesheet" href="css/index.css">

<h1 id="title">Register pls</h1>

<h2 id="title"><?php echo $message ?></h2>

<form action="src/formhandlers/register.php" method="POST" id="login">
        <div>
            <input type="text" id="voornaam" name="firstname" placeholder="First Name" class="inputs"/>
        </div>
        <div>
            <input type="text" id="achternaam" name="lastname" placeholder="Last Name" class="inputs"/>
        </div>
        <div>
            <input type="text" id="tussenvoegsels" name="prefix" placeholder="Prefixes (Optional)" class="inputs"/>
        </div>
        <div>
            <input type="email" id="email" name="email" placeholder="example@example.com" class="inputs"/>
        </div>
        <div>
            <input type="password" id="wachtwoord" name="password" placeholder="Password" class="inputs"/>
        </div>
        <div>
            <input type="street" id="street" name="street" placeholder="streetname 1" class="inputs"/>
        </div>
        <div>
            <input type="postalcode" id="postalcode" name="postalcode" placeholder="1234 AB" class="inputs"/>
        </div>
        <div>
            <input type="country" id="country" name="country" placeholder="Country" class="inputs"/>
        </div>
    <button id="submit" type="submit">Wahoo</button>
</form>

<?php

    @require_once ("includes/footer.php");

?>