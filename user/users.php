<table class="table table-primary table-striped table-hover table-bordered table-sm table-responsive-sm">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Photo</th>

            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Gender</th>

            <th scope="col">Phone</th>

            <th scope="col">Action</th>



        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $key => $user) : ?>

        <tr>
            <th scope="row"><?= ++$key ?></th>
            <td><img src="./img/<?= $user['photo'] ?> " width="100" alt="photo"></td>
            <td><?= $user['name'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['gender'] ?></td>
            <td><?= $user['phone'] ?></td>


            <td>
                <a href="user/edit-user.php?id=<?= $user['user_id'] ?>" class="btn btn-primary">Edit</a>
                <a href="delete.php?id=<?= $user['user_id'] ?>&tbname=users&tbid=user_id" class="btn btn-danger"
                    onclick="alert('are you sure')">Delete</a>
            </td>

        </tr>
        <?php endforeach ?>
    </tbody>
</table>