<?php
require "../Database/db.php";
$errors = [];
if (isset($_POST['update'])) {
    // print_r($_FILES);
    // die;
    $id = $_POST['pid'];
    $catid = $_POST['catid'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $is_featured = $_POST['is_featured'];
    $oldphoto = $_POST['oldphoto'];
    $pname = $_FILES['photo']['name'];
    $tmpname = $_FILES['photo']['tmp_name'];
    if ($pname) {
        move_uploaded_file($tmpname, "../img/$pname");
    } else {
        $pname = $oldphoto;
    }
    empty($name) ? $errors[] = "name required..." : "";
    empty($description) ? $errors[] = "description required..." : "";
    empty($price) ? $errors[] = "price required..." : "";
    empty($is_featured) ? $errors[] = "is_featured required..." : "";
    if (count($errors) === 0) {
        $updateqry = "UPDATE products SET category_id=:catid,name=:name ,description=:description,price=:price, is_featured=:is_featured,photo=:photo WHERE product_id=:product_id";
        $statement = $pdo->prepare($updateqry);
        $statement->bindParam(":catid", $catid, PDO::PARAM_STR);
        $statement->bindParam(":name", $name, PDO::PARAM_STR);
        $statement->bindParam(":description", $description, PDO::PARAM_STR);
        $statement->bindParam(":price", $price, PDO::PARAM_STR);
        $statement->bindParam(":is_featured", $is_featured, PDO::PARAM_STR);
        $statement->bindParam(":photo", $pname, PDO::PARAM_STR);
        $statement->bindParam(":product_id", $id, PDO::PARAM_STR);
        $res = $statement->execute();
        if ($res) {
            header("location:http://localhost/php_exercise/blog/admin-dashboard.php");
        } else {
            die('error');
        }
    } else {
        $errors = ['incorrect'];
    }
}
// require "./partials/error.php";
foreach ($errors as $key => $err) {
    echo $err . "<br>";
}
