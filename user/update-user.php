<?php
require "../Database/db.php";
$errors = [];
if (isset($_POST['update'])) {
    $id = $_POST['userid'];
    echo "$id <br>";
    $name = $_POST['name'];
    echo "$name <br>";
    $email = $_POST['email'];
    echo "$email <br>";
    $gender = $_POST['gender'];
    echo "$gender <br>";
    $phone = $_POST['phone'];
    echo "$phone <br>";
    $address = $_POST['address'];
    echo "$address <br>";

    $oldphoto = $_POST['oldphoto'];
    echo "$oldphoto <br>";
    $pname = $_FILES['photo']['name'];
    echo "$pname<br>";
    $tmpname = $_FILES['photo']['tmp_name'];

    if ($pname) {
        move_uploaded_file($tmpname, "../img/$pname");
    } else {
        $pname = $oldphoto;
    }
    empty($name) ? $errors[] = "name required..." : "";
    empty($email) ? $errors[] = "email required..." : "";
    empty($phone) ? $errors[] = "phone required..." : "";
    empty($gender) ? $errors[] = "gender required..." : "";
    empty($address) ? $errors[] = "address required..." : "";
    empty($pname) ? $errors[] = "photo required..." : "";
    if (count($errors) === 0) {
        echo "Hello";
        $updateqry = "UPDATE  users SET name=:name ,phone=:phone,gender=:gender, email=:email, address=:address , photo=:photo WHERE user_id=:user_id";
        $statement = $pdo->prepare($updateqry);
        $statement->bindParam(":name", $name, PDO::PARAM_STR);
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->bindParam(":phone", $phone, PDO::PARAM_STR);
        $statement->bindParam(":gender", $gender, PDO::PARAM_STR);
        $statement->bindParam(":address", $address, PDO::PARAM_STR);
        $statement->bindParam(":photo", $pname, PDO::PARAM_STR);
        $statement->bindParam(":user_id", $id, PDO::PARAM_STR);
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
foreach ($errors as $key => $error) {

    echo "$error <br>";
}
