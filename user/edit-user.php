<?php
require "../Database/db.php";
require "../partials/header.php";
$errors = [];
$id = $_GET['id'];
$user_qry = "SELECT * FROM users WHERE user_id=:id";
$s = $pdo->prepare($user_qry);
$s->bindParam(":id", $id, PDO::PARAM_INT);
$s->execute();
$user = $s->fetch();
require "../partials/nav.php";
$id = $_GET['id'];
echo "id is", $id;
?>
<div class="main p-5">
    <form action="update_product.php" class="w-50 m-auto p-5 m-5 shadow" method="post" enctype="multipart/form-data">
        <?php ?>
        <h1 class="text-center mb-5">Edit User</h1>

        <div class="mb-3">
            <input type="text" placeholder="Name...." name="name" value="<?= $user['name'] ?>">
        </div>
        <div class="mb-3">
            <input type="email" placeholder="Email...." name="email" value="<?= $user['email'] ?>">
        </div>
        <div class="mb-3">
            <input type="phone" placeholder="Phone...." name="phone" value="<?= $user['phone'] ?>">
        </div>
        <div class="mb-3">

            <input type="radio" name="gender" value="male" <?= $user['gender'] === "male" ? "checked" : "" ?>> Male
            <input type="radio" name="gender" value="female" <?= $user['gender'] === "female" ? "checked" : "" ?>>Female
        </div>

        <img src="../img/<?= $user['photo'] ?>" alt="user" width="100">
        <input type="hidden" name="oldphoto" value="<?= $user['photo'] ?>">
        <div class="mb-3">
            <label for="">Photo</label>
            <input type="file" name="photo" class="form-control">
        </div>
        <div class="mb-3">
            <textarea name="address" id="" cols="30" rows="10" class="form-control" placeholder="Address">
<?= $user['address'] ?>
            </textarea>
        </div>
        <input type="submit" value="update" name="update" class="btn btn-primary ">





    </form>
</div>