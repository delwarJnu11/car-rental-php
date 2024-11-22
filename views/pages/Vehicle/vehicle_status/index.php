<?php

$vehicle_statuses = VehicleStatus::get_all_vehicle_status();

?>

<div class="row">
    <div class="col-xl-12">
        <h6 class="mb-0 text-uppercase">All Vehicle Types</h6>
        <hr>
        <div class="card">
            <div class="card-body">
                <table class="table mb-0 table-hover align-middle">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">ID</th>
                            <th scope="col">Vehicle Status</th>
                            <th scope="col">Time</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vehicle_statuses as $vehicle_status): ?>
                            <tr class="text-center">
                                <th scope="row"><?= $vehicle_status['id'] ?></th>
                                <td><?= $vehicle_status['vehicle_status'] ?></td>
                                <td>
                                    <?= date("g:i a", strtotime(explode(" ", $vehicle_status['created_at'])[1])) ?>
                                </td>
                                <td>
                                    <?= date("F j,Y", strtotime(explode(" ", $vehicle_status['created_at'])[0]))
                                    ?>
                                </td>
                                <td>
                                    <a class="btn btn-sm text-warning" href="/vehicle_status/edit/<?= $vehicle_status['id'] ?>" title="Edit">
                                        <i class="material-icons-outlined">edit</i>
                                    </a>
                                    <a class="btn btn-sm text-danger" href="/vehicle_status/delete/<?= $vehicle_status['id'] ?>" title="Delete">
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