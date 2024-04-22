<?php
include "./Database/db.php";
$errors = [];
$now = new DateTime('now');
$now = $now->format('Y-m-d H:i:s');
if (isset($_POST['register'])) {
    // echo "OK";
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_BCRYPT);
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $photoName = $_FILES['photo']['name'];
    $photoTMP = $_FILES['photo']['tmp_name'];
    move_uploaded_file($photoTMP, "img/$photoName");
    empty($name) ? $errors[] = "name require" : "";
    empty($email) ? $errors[] = "email require" : "";
    empty($password) ? $errors[] = "password require" : "";
    empty($phone) ? $errors[] = "phone require" : "";
    empty($gender) ? $errors[] = "gender require" : "";
    empty($photoName) ? $errors[] = "photo require" : "";
    if (count($errors) === 0) {
        $emailCheck = "SELECT * FROM users WHERE email= :email";
        $statement = $pdo->prepare($emailCheck);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $res = $statement->execute();
        $res = $statement->rowCount();
        if ($res === 1) {
            $errors[] = "email already exists";
        } else {
            $sql = "INSERT INTO users (name,email,password,phone,address,gender,photo,created_date,updated_date) VALUES (:name,:email,:password,:phone,:address,:gender,:photo,:created_date,:updated_date)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam('name', $name, PDO::PARAM_STR);
            $stmt->bindParam('email', $email, PDO::PARAM_STR);
            $stmt->bindParam('password', $password, PDO::PARAM_STR);
            $stmt->bindParam('phone', $phone, PDO::PARAM_STR);
            $stmt->bindParam('address', $address, PDO::PARAM_STR);
            $stmt->bindParam('gender', $gender, PDO::PARAM_STR);
            $stmt->bindParam('photo', $photoName, PDO::PARAM_STR);
            $stmt->bindParam('created_date', $now, PDO::PARAM_STR);
            $stmt->bindParam('updated_date', $now, PDO::PARAM_STR);
            $stmt->execute();
            header("location:login.php");
        }
    } else {
        $errors[] = "error occured";
    }
}

include "./partials/header.php";
include "./partials/nav.php";
// include "./partials/carousel.php";

?>
<h1 style="text-align: center;">Register Page</h1>
<form action="register.php" method="post" enctype="multipart/form-data" class="w-50 m-auto my-5 p-5 shadow">
    <?php
    foreach ($errors as $key => $err) {
        echo "<div class='alert alert-danger'>$err</div>";
    }
    ?>
    <div class="mb-3">
        <input type="text" name="name" placeholder="Name" class="form-control"><br>

    </div>
    <div class="mb-3">
        <input type="email" name="email" placeholder="Email" class="form-control"><br>

    </div>
    <div class="mb-3">
        <input type="password" name="password" placeholder="Password" class="form-control"><br>
    </div>
    <div class="mb-3">
        <textarea name="address" placeholder="Address" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <input type="text" name="phone" placeholder="Phone" class="form-control"><br>
    </div>
    <div class="mb-3">
        <input type="file" name="photo"><br>

    </div>
    <div class="mb-3">
        <p for>Select gender</p>
        <input type="radio" name="gender" value="male">Male
        <input type="radio" name="gender" value="female">Female
    </div>
    <div class="text-center">
        <button type="Submit" name="register" class="btn btn-primary">Submit</button><br>
    </div>









</form>

<?php require "./partials/footer.php";
