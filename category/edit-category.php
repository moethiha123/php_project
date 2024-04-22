<?php
require "../Database/db.php";
require "../partials/header.php";
$errors = [];
$id = $_GET['id'];
$categ_qry = "SELECT * FROM categories WHERE category_id=:id";
$s = $pdo->prepare($categ_qry);
$s->bindParam(":id", $id, PDO::PARAM_INT);
$s->execute();
$category = $s->fetch();
require "../partials/nav.php";
$id = $_GET['id'];
echo "id is", $id;
?>
<div class="main p-5">
    <form action="update-category.php" class="w-50 m-auto p-5 m-5 shadow" method="post">
        <?php ?>
        <h1 class="text-center mb-5">Edit Category</h1>
        <input type="hidden" name="categoryid" value="<?= $category['category_id'] ?>">
        <div class="mb-3">
            <input type="text" placeholder="Name...." name="name" value="<?= $category['name'] ?>">
        </div>

        <input type="submit" value="update" name="update" class="btn btn-primary ">





    </form>