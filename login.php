<?php
session_start();
include "./partials/header.php";
include "./partials/nav.php";
include "./Database/db.php";
$errors = [];
// include "./partials/carousel.php";
if (isset($_POST['login'])) {
    $email = ($_POST['email']);
    $password = $_POST['password'];
    empty($email) ? $errors[] = "email required..." : "";
    empty($password) ? $errors[] = "password required..." : "";
    if (count($errors) === 0) {
        $email_check_qry = "SELECT * FROM users WHERE email=:email";
        $statement = $pdo->prepare($email_check_qry);
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->execute();
        $res = $statement->fetch();
        print_r($res);
        if ($email === "admin@gmail.com" && $password === "admin") {
            $_SESSION['admin'] = "admin";
            $_SESSION['name'] = "admin";
            header("location:index.php");
        }
        if ($res) {
            if (password_verify($password, $res['password']) && $email === $res['email']) {
                $_SESSION['name'] = $res['name'];
                $_SESSION['photo'] = $res['photo'];
                header("location:index.php");
            } else {
                $errors[] = "email and password do not match";
            }
        } else {
            $errors[] = "Email not exist";
        }
    }
}


?>
<h1 class="hh">Login Page</h1>
<form action="login.php" method="post" enctype="multipart/form-data" class="w-50 m-auto my-5 p-5 shadow">
    <?php
    foreach ($errors as $key => $err) {
        echo "<div class='alert alert-danger'>$err</div>";
    }
    ?>

    <div class="mb-3">
        <input type="email" name="email" placeholder="Email" class="form-control"><br>

    </div>
    <div class="mb-3">
        <input type="password" name="password" placeholder="Password" class="form-control"><br>
    </div>
    <div class="text-center">
        <button type="Submit" name="login" class="btn btn-primary">Submit</button><br>
    </div>
</form>

<?php require "./partials/footer.php";
