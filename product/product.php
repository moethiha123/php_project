<a href="product/create_product.php" class="btn btn-primary">Create Product</a>
<table class="table table-primary table-striped table-hover table-bordered table-sm table-responsive-sm">
    <thead>
        <tr>

            <th scope="col">name</th>
            <th scope="col">description</th>
            <th scope="col">Photo</th>
            <th scope="col">Price</th>
            <th scope="col">is_featured</th>
            <th scope="col">Action</th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $key => $product) : ?>
            <tr>
                <!-- <th scope="row"><?= ++$key ?></th> -->

                <td>
                    <?= $product['name'] ?>
                </td>
                <td><?= $product['description'] ?></td>
                <td><img src="./img/<?= $product['photo'] ?>" width="100"></td>


                <td><?= $product['price'] ?></td>
                <td><?= $product['is_featured'] ?></td>
                <td>
                    <a href="product/edit_product.php?id=<?= $product['product_id'] ?>" class="btn btn-primary">Edit</a>
                    <a href="delete.php?id=<?= $product['category_id'] ?>&tbname=products&tbid=category_id" class="btn btn-danger" onclick="alert('are you sure')">Delete</a>
                </td>
            </tr>
        <?php endforeach ?>

    </tbody>
</table>