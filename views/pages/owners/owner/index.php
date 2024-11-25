<?php

$owners = Owner::get_owners();

?>

<div class="row">
    <div class="col-xl-12">
        <h6 class="mb-4 text-uppercase">Our All Owners</h6>
        <hr>
        <div class="card">
            <div class="card-body">
                <table class="table mb-0 table-hover align-middle">
                    <thead>
                        <tr>
                            <th scope="col">Owner Image</th>
                            <th scope="col">Owner Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Commission Rate</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($owners as $owner): ?>
                            <tr>
                                <th scope="row">
                                    <img width="60" height="60" src="<?= $base_url ?>/img/users/<?= $owner['image'] ?>" class="rounded-circle bg-grd-info p-1" alt="Owner">
                                </th>
                                <td><?= $owner['first_name'] . " " . $owner['last_name'] ?></td>
                                <td><?= $owner['phone'] ?></td>
                                <td><?= $owner['email'] ?></td>
                                <td><?= $owner['commission_rate'] ?>%</td>
                                <td>
                                    <a class="btn btn-sm text-warning" href="/owner/edit/<?= $owner['id'] ?>" title="Edit">
                                        <i class="material-icons-outlined">edit</i>
                                    </a>
                                    <a class="btn btn-sm text-danger" href="/owner/delete/<?= $owner['id'] ?>" title="Delete">
                                        <i class="material-icons-outlined">delete</i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>