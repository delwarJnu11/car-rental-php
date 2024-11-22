<?php

$vehicleTypes = VehicleType::get_vehicle_types();

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
                            <th scope="col">Vehicle Type Name</th>
                            <th scope="col">Time</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vehicleTypes as $vehicleType): ?>
                            <tr class="text-center">
                                <th scope="row"><?= $vehicleType['id'] ?></th>
                                <td><?= $vehicleType['vehicle_type_name'] ?></td>
                                <td>
                                    <?= date("g:i a", strtotime(explode(" ", $vehicleType['created_at'])[1])) ?>
                                </td>
                                <td>
                                    <?= date("F j,Y", strtotime(explode(" ", $vehicleType['created_at'])[0]))
                                    ?>
                                </td>
                                <td>
                                    <a class="btn btn-sm text-warning" href="/vehicle_type/edit/<?= $vehicleType['id'] ?>" title="Edit">
                                        <i class="material-icons-outlined">edit</i>
                                    </a>
                                    <a class="btn btn-sm text-danger" href="/vehicle_type/delete/<?= $vehicleType['id'] ?>" title="Delete">
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