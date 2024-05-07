<?php
session_start();
require "./Database/db.php";
require "./partials/header.php";
require "./backend/nav.php";
$usersQry = "SELECT * FROM users";
$st = $pdo->prepare($usersQry);
$st->execute();
$users = $st->fetchAll(PDO::FETCH_ASSOC);
$CateQry = "SELECT * FROM categories";
$statement1 = $pdo->prepare($CateQry);
$statement1->execute();
$categories = $statement1->fetchAll(PDO::FETCH_ASSOC);
$productQry = "SELECT * fROM products";
$sp = $pdo->prepare($productQry);
$sp->execute();
$products = $sp->fetchAll(PDO::FETCH_ASSOC);

?>


<?php if ($_SESSION['admin']) : ?>

    <div class="row m-0">
        <div class="col-lg-3 col-12">
            <?php include "./backend/sidebar.php" ?>

        </div>
        <div class="col-lg-8 col-12">

            <?php include "./user/users.php" ?>
            <?php include "./category/category.php" ?>
            <?php include "./product/product.php" ?>


        </div>
    </div>

<?php else : ?>
<?php endif ?>