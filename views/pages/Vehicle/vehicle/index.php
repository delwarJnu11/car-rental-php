<?php

$vehicles = Vehicle::get_vehicles();

?>

<div class="row">
    <div class="col-xl-12">
        <h6 class="mb-0 text-uppercase">All vehicles</h6>
        <hr>
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th scope="col">Image</th>
                            <th scope="col">Vehicle Name</th>
                            <th scope="col">Model Name</th>
                            <th scope="col">Owner</th>
                            <th scope="col">Vehicle Type</th>
                            <th scope="col">Vehicle Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vehicles as $vehicle): ?>
                            <tr class="text-center">
                                <td>
                                    <img width="70" height="70" src="<?= $base_url ?>/img/<?= $vehicle['image'] ?>" alt="">
                                </td>
                                <td><?= $vehicle['vehicle_name'] ?></td>
                                <td><?= $vehicle['model'] ?></td>
                                <td><?= $vehicle['vehicle_owner_id'] ?></td>
                                <td><?= $vehicle['vehicle_type_id'] ?></td>
                                <td><?= $vehicle['vehicle_status_id'] ?></td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center gap-2" style="height: 100%;">
                                        <a
                                            class="btn btn-sm btn-warning text-white d-flex justify-content-center align-items-center gap-2"
                                            href="/vehicle/edit/<?= $vehicle['id'] ?>"
                                            title="Edit">
                                            <i class="material-icons-outlined">edit</i> Edit
                                        </a>
                                        <a
                                            class="btn btn-sm btn-danger text-white d-flex justify-content-center align-items-center gap-2"
                                            href="/vehicle/details/<?= $vehicle['id'] ?>"
                                            title="Details">
                                            <i class="material-icons-outlined">visibility</i> Details
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>