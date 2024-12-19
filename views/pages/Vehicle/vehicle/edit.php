<?php

$vehicle_types = VehicleType::get_vehicle_types();
$vehicle_statuses = VehicleStatus::get_all_vehicle_status();
$vehicle_engine_types = VehicleEngineType::get_all_vehicle_engine_type();
$owners = Owner::get_owners();

// print_r(explode(" ", $vehicle->expiry_date)[0]);

?>
<!-- Vehicle Register Form -->
<div class="row">
    <div class="col-12 col-xl-12 mx-auto">
        <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
            <div class="card-body p-4">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="">
                        <h5 class="mb-4 fw-bold">Update Vehicle</h5>
                    </div>
                </div>
                <form action="<?php echo $base_url ?>/vehicle/update" method="POST" enctype="multipart/form-data" class="row g-4">
                    <input type="hidden" name="id" value="<?=$vehicle->id;?>">
                    <div class="col-md-4">
                        <label for="input1" class="form-label">Vehicle Name</label>
                        <input type="text" name="vehicle_name" class="form-control" id="input1" value="<?=$vehicle->vehicle_name?>">
                    </div>
                    <div class="col-md-4">
                        <label for="input2" class="form-label">Model Name</label>
                        <input type="text" name="model_name" class="form-control" id="input2" value="<?=$vehicle->model?>">
                    </div>
                    <div class="col-md-4">
                        <label for="input3" class="form-label">Year</label>
                        <input type="text" name="year" class="form-control" id="input3" value="<?=$vehicle->year?>">
                    </div>
                    <div class="col-md-4">
                        <label for="input5" class="form-label">Seats</label>
                        <input type="text" name="seats" class="form-control" id="input5" value="<?=$vehicle->seats?>">
                    </div>
                    <div class="col-md-4">
                        <label for="input6" class="form-label">Luggage Capacity</label>
                        <input type="text" name="luggage" class="form-control" id="input6" value="<?=$vehicle->luggage_capacity?>">
                    </div>
                    <div class="col-md-4">
                        <label for="input7" class="form-label">Capacity</label>
                        <input type="text" name="capacity" class="form-control" id="input7" value="<?=$vehicle->capacity?>">
                    </div>
                    <div class="col-md-4">
                        <label for="input8" class="form-label">Price Per Hour</label>
                        <input type="text" name="price_per_hour" class="form-control" id="input8" value="<?=$vehicle->price_per_hour?>">
                    </div>
                    <div class="col-md-4">
                        <label for="input9" class="form-label">Price Per Day</label>
                        <input type="text" name="price_per_day" class="form-control" id="input9" value="<?=$vehicle->price_per_day?>">
                    </div>
                    <div class="col-md-4">
                        <label for="input10" class="form-label">Price Per Week</label>
                        <input type="text" name="price_per_week" class="form-control" id="input10" value="<?=$vehicle->price_per_week?>">
                    </div>
                    <div class="col-md-4">
                        <label for="input15" class="form-label">Discount Price</label>
                        <input type="text" name="discount_price" class="form-control" id="input15" value="<?=$vehicle->discount_price?>">
                    </div>
                    <div class="col-md-4">
                        <label for="input11" class="form-label">Owner</label>
                        <select id="input11" name="owner_id" class="form-select">
                            <option selected="">Select Owner</option>
                            <?php foreach ($owners as $owner): ?>
                                <option <?=$vehicle->vehicle_owner_id === $owner['id'] ? "selected" : ""?> value="<?=$owner['id']?>"><?=$owner['first_name'] . " " . $owner['last_name']?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="input13" class="form-label">Vehicle Status</label>
                        <select id="input13" name="vehicle_status_id" class="form-select">
                            <option selected="">Select Vehicle Status</option>
                            <?php foreach ($vehicle_statuses as $status): ?>
                                <option <?=$vehicle->vehicle_status_id === $status['id'] ? "selected" : "";?> value="<?=$status['id'];?>"><?=$status['vehicle_status'];?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="input20" class="form-label">Insurance Provider</label>
                        <input type="text" name="insurance_provider" class="form-control" id="input20" value="<?=$vehicle->insurance_provider?>">
                    </div>
                    <div class="col-md-4">
                        <label for="input19" class="form-label">Insurance Expire Date</label>
                        <input type="date" name="expiry_date" class="form-control" id="input19" value="<?=explode(" ", $vehicle->expiry_date)[0]?>">
                    </div>
                    <div class="col-md-12">
                        <label for="input23" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="input23" placeholder="Description..." rows="3"><?=$vehicle->description?></textarea>
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" name="update" class="btn btn-grd-primary px-4 text-white">Update Vehicle</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>