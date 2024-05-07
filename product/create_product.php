<?php
include "../Database/db.php";

$now = new DateTime('now');
$now = $now->format('Y-m-d H:i:s');
$errors = [];
$now = new DateTime('now');
$now = $now->format('Y-m-d H:i:s');
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    echo $price;
    $features = $_POST['is_featured'] ?? 0;
    $category_id = $_POST['category_id'];
    $photoName = $_FILES['photo']['name'];
    $photoTmp = $_FILES['photo']['tmp_name'];
    move_uploaded_file($photoTmp, "imgs/$photoName");
    empty($name) ? $errors[] = "name required" : "";
    empty($description) ? $errors[] = "description required" : "";
    empty($category_id) ? $errors[] = "category_id required" : "";
    empty($price) ? $errors[] = "price required" : "";
    empty($features) ? $errors[] = "features required" : "";
    empty($photoName) ? $errors[] = "photo required" : "";
    // die("ok");
    // print_r($errors);
    if (count($errors) === 0) { {
            $sql = "INSERT INTO products (category_id,name,description,price,is_featured,photo,created_date,updated_date) VALUES (:category_id,:name,:description,:price,:features,:photo,:created_date,:updated_date)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':category_id', $category_id, PDO::PARAM_STR);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':price', $price, PDO::PARAM_STR);
            $stmt->bindParam(':features', $features, PDO::PARAM_STR);
            $stmt->bindParam(':photo', $photoName, PDO::PARAM_STR);
            $stmt->bindParam(':created_date', $now, PDO::PARAM_STR);
            $stmt->bindParam(':updated_date', $now, PDO::PARAM_STR);
            if ($stmt->execute()) {
                header("location:http://localhost/php_exercise/blog/admin-dashboard.php");
            } else {
                $errors[] = "error occurred";
            }
        }
    }
}
include "../partials/header.php";
include "../partials/nav.php";
// include "./partials/carousel.php";
?>
<form action="create_product.php" method="post" enctype="multipart/form-data" class="w-50 m-auto my-5 p-5 shadow">
    <h1 class="text-center">Add Products</h1>
    <?php
    foreach ($errors as $key => $err) {
        echo "<div class='alert alert-danger'>$err</div>";
    }
    ?>
    <div class="mb-3">
        <select name="category_id" class="form-control">
            <option value="">Select Category Name</option>
            <?php
            $sql = "SELECT * FROM categories";
            $s = $pdo->prepare($sql);
            $s->execute();
            $res = $s->fetchAll(PDO::FETCH_ASSOC);
            foreach ($res as $key => $value) { ?>
                <option value="<?= $value['category_id'] ?>" class="form-control"><?= $value['name'] ?></option>
            <?php  } ?>
            ?>
        </select>
    </div>
    <div class="mb-3">
        <input type="text" placeholder="Name...." name="name" class="form-control">
    </div>
    <div class="mb-3">
        <textarea name="description" placeholder="Description..." class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <input type="text" placeholder="Price...." name="price" class="form-control">
    </div>
    <div class="mb-3">
        <input type="radio" name="is_featured" value="1">Make Features
    </div>
    <div class="mb-3">
        <input type="file" name="photo">
    </div>
    <div class="text-center">
        <input type="submit" name="add" class="btn btn-primary">
    </div>
</form>
<!-- <?php include "./partials/footer.php" ?> -->