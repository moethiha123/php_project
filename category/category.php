<a href="category/create_category.php" class="btn btn-primary">Create Category</a>
<table class="table table-primary table-striped table-hover table-bordered table-sm table-responsive-sm">
    <thead>
        <tr>
            <th scope="col">Name</th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $key => $category) : ?>
            <tr>
                <th scope="row"><?= ++$key ?></th>
                <td><?= $category['name'] ?></td>
                <td>
                    <a href="category/edit-category.php?id=<?= $category['category_id'] ?>" class="btn btn-primary">Edit</a>
                    <a href="delete.php?id=<?= $category['category_id'] ?>&tbname=categories&tbid=category_id" class="btn btn-danger" onclick="alert('are you sure')">Delete</a>
                </td>
            </tr>
        <?php endforeach ?>

    </tbody>
</table>