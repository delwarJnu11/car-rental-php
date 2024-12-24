<?php

$maintenance_request = Maintenance::get_maintenance_records();

?>

<div class="row">
    <div class="col-xl-12">
            <h6 class="mb-0 text-uppercase">All Maintenance Requests</h6>
        <hr>
        <div class="card">
            <div class="card-body">
                <table class="table mb-0 table-hover align-middle">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">ID</th>
                            <th scope="col">Maintenance Vehicle</th>
                            <th scope="col">Description</th>
                            <th scope="col">Cost</th>
                            <th scope="col">Request Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($maintenance_request as $request): ?>
                            <tr class="text-center">
                                <th scope="row"><?=$request['id']?></th>
                                <td><?=$request['vehicle_name']?></td>
                                <td><?=$request['description']?></td>
                                <td><?=$request['cost']?></td>
                                <td>
                                    <?=date("F j,Y", strtotime(explode(" ", $request['created_at'])[0]))?>
                                </td>
                                <td>
                                    <span class="badge bg-warning text-dark"><?=$request['status']?></span>
                                </td>
                                <td>
                                    <a class="btn btn-sm text-warning" href="/maintenance/edit/<?=$request['id']?>" title="Edit">
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