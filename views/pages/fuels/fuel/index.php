<?php

    $owner_id = $_SESSION['owner_id'];
    $driver_id = $_SESSION['driver_id'];

    if ($owner_id) {
        $fuel_records = Fuel::get_fuel_records_by_owner_id($owner_id);
    } else if ($driver_id) {
        $fuel_records = Fuel::get_fuel_records_by_driver_id($driver_id);
    } else {
        $fuel_records = Fuel::get_fuel_records();
    }

    $sl = 1;

    // echo "<pre>";
    // print_r($fuel_records);
    // die();

?>

<div class="row">
    <div class="col-xl-12">
            <h6 class="mb-0 text-uppercase">Fuel Tracking</h6>
        <hr>
        <div class="card">
            <div class="card-body">
                <table class="table mb-0 table-hover align-middle">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">SL.</th>
                            <th scope="col">Vehicle Name</th>
                            <th scope="col">Driver Name</th>
                            <th scope="col">Fiiling Station</th>
                            <th scope="col">Location</th>
                            <th scope="col">Fuel Type</th>
                            <th scope="col">Total Amount</th>
                            <th scope="col">Fiiling Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($fuel_records as $record): ?>
                            <tr class="text-center">
                                <td><?=$sl++;?></td>
                                <td><?=$record['vehicle_name']?></td>
                                <td><?=User::get_user_by_driver_id($record['driver_id'])->full_name?></td>
                                <td><?=$record['filling_station_name']?></td>
                                <td><?=$record['location']?></td>
                                <td><?=$record['fuel_type']?></td>
                                <td><?=$record['total_cost']?></td>
                                <td>
                                    <?=date("F j,Y", strtotime(explode(" ", $record['created_at'])[0]))?>
                                </td>
                                <td>
                                    <a class="btn btn-sm text-dark bg-info d-flex justify-content-center align-items-center" href="/fuel/view/<?=$record['id']?>" title="Details">
                                        <i class="material-icons-outlined">visibility</i>
                                </td>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>