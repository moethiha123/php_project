<?php
session_start();

$date = new DateTime('now');
$date = $date->format("Y-m-d H:i:s");

require "./Database/db.php";

if (isset($_POST['order'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $status = 0;
    $sql = "INSERT INTO customers (customer_id,name,email,phone,address,status,created_date,updated_date) VALUES (null,:name,:email,:phone,:address,:status,:created_date,:updated_date)";
    $s = $pdo->prepare($sql);
    $s->bindParam(":name", $name, PDO::PARAM_STR);
    $s->bindParam(":email", $email, PDO::PARAM_STR);
    $s->bindParam(":phone", $phone, PDO::PARAM_STR);
    $s->bindParam(":address", $address, PDO::PARAM_STR);
    $s->bindParam(":status", $status, PDO::PARAM_STR);
    $s->bindParam(":created_date", $date, PDO::PARAM_STR);
    $s->bindParam(":updated_date", $date, PDO::PARAM_STR);
    $s->execute();
    // die("here");
    $customerid = $pdo->lastInsertId();
    foreach ($_SESSION['cart'] as $product_id => $qty) {
        $order_item_qry = "INSERT INTO order_items (customer_id,product_id,qty) VALUES (:customer_id,:product_id,:qty)";
        $s = $pdo->prepare($order_item_qry);
        $s->bindParam(":customer_id", $customerid, PDO::PARAM_INT);
        $s->bindParam(":product_id", $product_id, PDO::PARAM_INT);
        $s->bindParam(":qty", $qty, PDO::PARAM_STR);
        $s->execute();
        if ($s) {
            header('location:index.php?message=success');
        } else {
            echo "hello";
        }
    }
}
require "./partials/header.php";
require "./partials/nav.php";

?>

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!isset($_SESSION['cart'])) {
                        echo "Item Not Found";
                        return;
                    }

                    $total = 0;
                    foreach ($_SESSION['cart'] as $id => $qty) :
                        $qry = "SELECT * FROM products WHERE product_id = :id ";
                        $s = $pdo->prepare($qry);
                        $s->bindParam(":id", $id, PDO::PARAM_INT);
                        $s->execute();
                        $res = $s->fetch();
                        // echo "<pre>";
                        // echo $qty;
                        // print_r($res['price']);
                        // echo "</pre>";

                        // die();
                        $total = $res['price'] * $qty;

                    ?>

                        <tr>
                            <td class="cart_product">
                                <a href=""><img width="200" src="./Product-Image/<?php echo $res['photo'] ?>" alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href=""><?php echo $res['name'] ?? "" ?></a></h4>
                                <p>Product ID: <?php echo $res['product_id'] ?></p>
                            </td>
                            <td class="cart_price  ">
                                <p class=""><?php echo $res['price'] ?>
                                </p>
                            </td>
                            <td class="cart_quantity ">
                                <div class="cart_quantity_button ">
                                    <a class="cart_quantity_up   fs-4" href="add-to-cart.php?id=<?php echo $res['product_id'] ?>">
                                        + </a>
                                    <input class="cart_quantity_input text-center mx-2" type="text" name="quantity" value="<?php echo $qty ?>" autocomplete="off" size="2">
                                    <a class="cart_quantity_down fs-3" href="drop-to-cart.php?id=<?php echo $res['product_id'] ?>"> -
                                    </a>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price"><?php echo $total; ?></p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete fw-bold fs-5 text-danger" href="clear-cart.php?id=<?php echo $res['product_id'] ?>"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    <?php
                    endforeach
                    ?>


                </tbody>
            </table>
        </div>
    </div>
</section>

<form class="w-50 m-auto p-5" action="card.php" method="post">
    <!-- Name input -->
    <h3 class="text-center w-100 mb-3">Order Here</h3>
    <div class="form-outline mb-4">
        <input type="text" name="name" class="form-control" />
        <label class="form-label">Name</label>
    </div>

    <!-- Email input -->
    <div class="form-outline mb-4">
        <input type="email" name="email" class="form-control" />
        <label class="form-label" ">Email</label>
    </div>

    <div class=" form-outline mb-4">
            <input type="text" name="phone" class="form-control" />
            <label class="form-label">Phone</label>
    </div>

    <div class="form-outline  mb-4">
        <textarea name="address" class="form-control">Address</textarea>
    </div>
    <!-- Submit button -->
    <button type="submit" name="order" class="btn btn-primary btn-block mb-4">Order</button>
</form>
<?php require "./partials/footer.php" ?>