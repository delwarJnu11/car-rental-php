<?php

    $trips = Booking::get_trips_by_driver($_SESSION['driver_id']);

    echo "<pre/>";
    print_r($_SESSION);
    print_r($trips);
?>

<div class="row">
    <?php if (count($trips)): ?>
        <div class="col-xl-12">
        <h6 class="mb-0 text-uppercase">All Trips For Mr. <?=$_SESSION['fname'] . " " . $_SESSION['lname'];?></h6>
        <hr>
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th scope="col">Vehicle Name</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Pick Up</th>
                            <th scope="col">Drop Off</th>
                            <th scope="col">Due Amount</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($trips as $vehicle): ?>
                            <tr class="text-center">
                                <td><?=$vehicle['vehicle_name']?></td>
                                <td><?=$vehicle['first_name'] . " " . $vehicle['last_name']?></td>
                                <td><?=$vehicle['pick_up_location']?></td>
                                <td><?=$vehicle['drop_off_location']?></td>
                                <td class="<?=$vehicle['due_amount'] === 0 ? "badge bg-badge-success" : "";?>"><?=$vehicle['due_amount'] === 0 ? "Paid" : $vehicle['due_amount']?></td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center gap-2" style="height: 100%;">
                                        <button
                                            class="btn btn-sm btn-danger text-white d-flex justify-content-center align-items-center gap-2"
                                            title="Details">
                                            <i class="material-icons-outlined">visibility</i> Details
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php else: ?>
        <div class="mt-5 w-50 d-flex justify-content-center align-items-center text-bg-danger mx-auto p-2 rounded-2">
            <h2 class="fs-4 py-2 text-center text-text-white-50">There are no Trip Found!.</h2>
        </div>
    <?php endif;?>
</div>