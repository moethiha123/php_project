<?php
include "../Database/db.php";
include "../partials/header.php";
include "../partials/nav.php";

$errors = [];

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    echo $name;
    empty($name) ? $errors[] = "name require" : "";
    if (count($errors) === 0) {
        $sq = "Insert into categories(name) VALUES (:name)";
        $stat = $pdo->prepare($sq);
        $stat->bindParam('name', $name, PDO::PARAM_STR);
        $stat->execute();
        header("location:http://localhost/php_exercise/blog/admin-dashboard.php");
    } else {
        echo "error occured";
    }
}
?>




<h1 style="text-align: center;">Create Category Page</h1>
<form action="create_category.php" method="post" class="w-50 m-auto my-5 p-5 shadow">
    <?php
    foreach ($errors as $key => $err) {
        echo "<div class='alert alert-danger'>$err</div>";
    }
    ?>
    <div class="mb-3">
        <input tpe="text" name="name" placeholder="Name" class="form-control"><br>

    </div>
    <div class="text-center">
        <button type="submit" name="submit" class="btn btn-primary">Submit</button><br>
    </div>
</form>
<?php require "../partials/footer.php";