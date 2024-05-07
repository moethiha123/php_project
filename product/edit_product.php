<?php
require "../Database/db.php";
require "../partials/header.php";
$errors = [];
$id = $_GET['id'];
$pro_qry = "SELECT * FROM products WHERE product_id=:id";
$s = $pdo->prepare($pro_qry);
$s->bindParam(":id", $id, PDO::PARAM_INT);
$s->execute();
$product = $s->fetch();
require "../partials/nav.php";


?>
<div class="main p-5">
    <form action="update_product.php" class="w-50 m-auto p-5 m-5 shadow" method="post" enctype="multipart/form-data">
        <?php ?>
        <h1 class="text-center mb-5">Edit Product</h1>
        <input type="hidden" name="catid" value="<?php echo $product['category_id'] ?>">
        <input type="hidden" name="pid" value="<?php echo $product['product_id'] ?>">



        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Name...." name="name" value="<?= $product['name'] ?>">
        </div>
        <div class="mb-3">

            <textarea name="description" class="form-control" placeholder="description">
                <?= $product['description'] ?>
            </textarea>
        </div>




        <div class="mb-3">
            <label for="">Photo</label>
            <input type="file" name="photo" class="form-control">
            <img src="img/<?= $product['photo'] ?>" width="160" height="200"
                style="object-fit: cover;object-fit:contain;">
        </div>
        <div class=" mb-3">
            <input tpe="text" name="price" placeholder="Price" class="form-control"
                value="<?= $product['price'] ?>"><br>

        </div>
        <div class="mb-3">
            <?php if ($product['is_featured'] == 1) : ?>
            <input type="checkbox" name="is_featured" checked value="1">
            <?php else : ?>
            <input type="checkbox" name="is_featured" value="1">
            <?php endif ?>
            <label for="">Feature</label>
        </div>
        <input type="hidden" name="oldphoto" value="<?= $product['photo'] ?>">

        <input type="submit" value="update" name="update" class="btn btn-primary ">





    </form>
</div>