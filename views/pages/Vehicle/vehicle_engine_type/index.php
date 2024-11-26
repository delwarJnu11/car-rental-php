<?php

$vehicle_engine_types = VehicleEngineType::get_all_vehicle_engine_type();

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
                        <?php foreach ($vehicle_engine_types as $vehicle_engine_type): ?>
                            <tr class="text-center">
                                <th scope="row"><?= $vehicle_engine_type['id'] ?></th>
                                <td><?= $vehicle_engine_type['vehicle_engine_type'] ?></td>
                                <td>
                                    <?= date("g:i a", strtotime(explode(" ", $vehicle_engine_type['created_at'])[1])) ?>
                                </td>
                                <td>
                                    <?= date("F j,Y", strtotime(explode(" ", $vehicle_engine_type['created_at'])[0]))
                                    ?>
                                </td>
                                <td>
                                    <a class="btn btn-sm text-warning" href="/vehicle_engine_type/edit/<?= $vehicle_engine_type['id'] ?>" title="Edit">
                                        <i class="material-icons-outlined">edit</i>
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