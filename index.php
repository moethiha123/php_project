<?php
session_start();
include "./Database/db.php";
include "./partials/header.php";
include "./partials/nav.php";
include "./partials/carousel.php";
$qry = "SELECT * FROM products";
$s = $pdo->prepare($qry);
$s->execute();
$res = $s->fetchAll(PDO::FETCH_ASSOC);
if (isset($_POST['submit'])) {
    $keyword = $_POST['search'];
    $keyword = "%$keyword%";
    $user_qry = "SELECT * FROM products WHERE name LIKE :keyword ";
    $s = $pdo->prepare($user_qry);
    $s->bindParam(":keyword", $keyword, PDO::PARAM_STR);
    $s->execute();
    $res = $s->fetchAll(PDO::FETCH_ASSOC);
} else {
    $qry = "SELECT * FROM products";
    $s = $pdo->prepare($qry);
    $s->execute();
    $res = $s->fetchAll(PDO::FETCH_ASSOC);
}





?>

<div class="main p-5 text-center">
    <div class="row g-4">
        <h3 class="text-danger">Products</h3>
        <?php foreach ($res as $key => $value) : ?>
        <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="card">
                <div class="bg-image hover-overlay ripple overflow-hidden shadow" data-mdb=ripple-color="light">
                    <img src="./img/<?= $value['photo'] ?>" class="img-fluid"
                        style="width:100%;height:300px;object-fit:cover;">
                    <a href="#!">
                        <div class="mask" style="background-color: rgba(251,251,251,0.15);"></div>
                    </a>
                </div>
                <div class="card-body shadow">
                    <h5 class="card-title mb-3"> <?= $value['name'] ?></h5>
                    <a href="product/product_detail.php?id=<?= $value['product_id'] ?>"
                        class="btn btn-primary">Detail</a>
                </div>
            </div>
        </div>
        <?php endforeach ?>
    </div>
</div>

<h1>Home Page</h1>
<p><?php echo $_SESSION['name'] ?? '' ?></p>


<?php require "./partials/footer.php";