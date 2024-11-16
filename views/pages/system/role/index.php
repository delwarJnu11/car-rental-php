<?php
$roles = Role::get_roles();
?>

<div class="row">
    <div class="col-xl-12">
        <h6 class="mb-0 text-uppercase">Roles Table</h6>
        <hr>
        <div class="card">
            <div class="card-body">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Role Name</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($roles as $role): ?>
                            <tr>
                                <th scope="row"><?= $role['id'] ?></th>
                                <td><?= $role['name'] ?></td>
                                <td><?= $role['created_at'] ?></td>
                                <td>
                                    <a class="btn btn-primary" href="/role/edit/<?= $role['id'] ?>">Edit</a>
                                    <a class="btn btn-danger" href="">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>