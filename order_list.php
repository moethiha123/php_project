<?php
require "./database/db.php";
require "./partials/header.php";
if (isset($_POST['deliver'])) {
    $cid = $_POST['cid'];
    $status = $_POST['status'];
    $deliver_qry = "UPDATE customers SET status=:status WHERE customer_id=:customer_id";
    $d = $pdo->prepare($deliver_qry);
    $d->bindParam(":status", $status, PDO::PARAM_INT);
    $d->bindParam(":customer_id", $cid, PDO::PARAM_INT);
    $d->execute();
}
?>
<a href="admin-dashboard.php" class="btn btn-primary">Admin</a>
<table class="table w-75 p-5 m-auto my-5">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">CustomerName</th>
            <th scope="col">CustomerPhonenumber</th>
            <th scope="col">Product_Id</th>
            <th scope="col">Product_Photo</th>
            <th scope="col">Date</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM customers";
        $s = $pdo->prepare($sql);
        $s->execute();
        $res = $s->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res as $key => $value) :
            $customer_id = $value['customer_id'];
        ?>
        <tr>
            <th scope="row"><?= ++$key ?></th>
            <th scope="row"><?= $value['name'] ?></th>
            <td scope="row"><?= $value['phone'] ?></td>
            <?php
                $qry = "SELECT order_items.*, products.name,products.photo FROM order_items LEFT JOIN products ON order_items.product_id = products.product_id WHERE order_items.customer_id = :customer_id";
                $s = $pdo->prepare($qry);
                $s->bindParam(":customer_id", $customer_id, PDO::PARAM_INT);
                $s->execute();
                $rr = $s->fetchAll(PDO::FETCH_ASSOC);
                // print_r($rr);
                foreach ($rr as $key => $vv) :
                ?>
            <td class="bg-success d-flex flex-column">
            <td scope="row"><?= $vv['name'] ?></td>
            <td scope="row"><img src="./Product-Image/<?= $vv['photo'] ?>" width="60" alt=""></td>
            </td>
            <?php endforeach ?>
            <td scope="row"><?= $value['created_date'] ?></td>

            <td scope="row"><?= $value['status'] == 0 ? "Undelivered" : "Delivered"  ?></td>
            <td>
                <form action="order_list.php" method="post">
                    <input type="hidden" name="status" value="1">
                    <input type="hidden" name="cid" value="<?= $value['customer_id'] ?>">
                    <input type="submit" value="Make Delivery" name="deliver">
                </form>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>