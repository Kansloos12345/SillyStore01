<?php

session_start();

include_once 'includes/header.php';
@require_once "dbconnect.php";
@require_once "src/helpers/auth-helpers.php";

if ($_SESSION == true) {
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
}
?>

<link rel="stylesheet" href="css/index.css">
<link rel="stylesheet" href="css/responsive.css">

<a href="https://capy.kanslooos.nl">
    <img id="capybanner" src="img/products/capybanner1.png">
</a>

<a href="https://capy.kanslooos.nl">
    <img id="capybanner2" src="img/products/capybanner2.png">
</a>

<h1 id="echoname">
    <?php if ($_SESSION == true) {
        echo "HAIIII $firstname :3 !";
    } else {echo "HAIIII :3 !";} ?>
</h1>

<div class="maingrid">

    <form  action="main" method="get">
        <input type="submit" name="limited_edition" class="stuff" id="limited_edition" value="" style="background-image: url('img/products/limited_edition.gif'); border:none; background-repeat:no-repeat;background-size:100% 100%;">
    </form>

    <form  action="main" method="get">
        <input type="submit" name="kharua_collection" class="stuff" value="" style="background-image: url('img/products/sillywillylol.gif'); border:none; background-repeat:no-repeat;background-size:100% 100%;">
    </form>

    <form  action="main" method="get">
        <input type="submit" name="rvspijker_collection" class="stuff" value="" style="background-image: url('img/products/rvspijkerspecial.png'); border:none; background-repeat:no-repeat;background-size:100% 100%;">
    </form>

</div>

<?php

    @require_once ("includes/footer.php");

?>