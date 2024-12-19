<?php

$bookingStatus = BookingStatus::get_booking_status("booking_status", "Confirm");
$vehicleStatus = VehicleStatus::get_vehicle_status("vehicle_status", "In Trip");

$available_vehicles = Vehicle::available_vehicles($bookingStatus->id, date('Y-d-m'), $vehicleStatus->id);

?>


<div class="row">
    <?php if (count($available_vehicles)): ?>
    <div class="col-xl-12">
        <h6 class="mb-0 text-uppercase">All Available vehicles</h6>
        <hr>
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th scope="col">Image</th>
                            <th scope="col">Vehicle Name</th>
                            <th scope="col">Model Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($available_vehicles as $vehicle): ?>
                            <tr class="text-center">
                                <td>
                                    <img width="70" height="60" class="bg-grd-warning" src="<?=$base_url?>/img/vehicle/<?=$vehicle['image']?>" alt="">
                                </td>
                                <td><?=$vehicle['vehicle_name']?></td>
                                <td><?=$vehicle['model']?></td>
                                <td><span class="badge bg-success">Avaiable</span></td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center gap-2" style="height: 100%;">
                                        <a
                                            class="btn btn-sm btn-danger text-white d-flex justify-content-center align-items-center gap-2"
                                            href="/vehicle/details/<?=$vehicle['id']?>"
                                            title="Details">
                                            <i class="material-icons-outlined">visibility</i> Details
                                        </a>
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
            <h2 class="fs-4 py-2 text-center text-text-white-50">There are no Available Vehicles.</h2>
        </div>
    <?php endif;?>
</div>