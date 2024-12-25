<?php

    $all_types = FuelType::get_fuel_types();

?>

<div class="row">
    <div class="col-xl-12">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="mb-0 text-uppercase">All Fuel Types</h6>
            <a class="btn btn-grd-primary px-4 text-white d-flex align-items-center gap-2" href="<?=$base_url?>/fuel_type/create">
                <i class="material-icons-outlined">add_circle</i>
                Add Fuel Type</a>
        </div>
        <hr>
        <div class="card">
            <div class="card-body">
                <table class="table mb-0 table-hover align-middle">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">ID</th>
                            <th scope="col">Maintenance Status</th>
                            <th scope="col">Time</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($all_types as $type): ?>
                            <tr class="text-center">
                                <th scope="row"><?=$type['id']?></th>
                                <td><?=$type['name']?></td>
                                <td>
                                    <?=date("g:i a", strtotime(explode(" ", $type['created_at'])[1]))?>
                                </td>
                                <td>
                                    <?=date("F j,Y", strtotime(explode(" ", $type['created_at'])[0]))?>
                                </td>
                                <td>
                                    <a class="btn btn-sm text-warning" href="/fuel_type/edit/<?=$type['id']?>" title="Edit">
                                        <i class="material-icons-outlined">edit</i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>