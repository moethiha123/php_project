<?php
require "../Database/db.php";
$errors = [];
if (isset($_POST['update'])) {
    $id = $_POST['categoryid'];
    echo "$id <br>";
    $name = $_POST['name'];
    echo "$name <br>";
    empty($name) ? $errors[] = "name required..." : "";
    if (count($errors) === 0) {

        $updatequery = "UPDATE categories SET name=:name WHERE category_id=:id";
        $sta = $pdo->prepare($updatequery);
        $sta->bindParam(":name", $name, PDO::PARAM_STR);
        $sta->bindParam(":id", $id, PDO::PARAM_INT);
        $result = $sta->execute();
        if ($result) {
            header("location:http://localhost/php_exercise/blog/admin-dashboard.php");
        } else {
            die('error');
        }
    } else {
        $errors = ['incorrect'];
    }
}
foreach ($errors as $key => $error) {

    echo "$error <br>";
}
