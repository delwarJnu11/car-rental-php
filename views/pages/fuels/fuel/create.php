<?php

    $vehicles = Vehicle::get_vehicles();
    $fuel_types = FuelType::get_fuel_types();

?>
<!-- Vehicle Register Form -->
<div class="row">
    <div class="col-12 col-xl-12 mx-auto">
        <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
            <div class="card-body p-4">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="">
                        <h5 class="mb-4 fw-bold">ReFuel To a Vehicle</h5>
                    </div>
                </div>
                <form action="<?php echo $base_url ?>/fuel/save" method="POST" class="row g-4">
                    <div class="col-md-6">
                        <label for="input11" class="form-label">Vehicle Name</label>
                        <select id="input11" name="vehicle_id" class="form-select">
                            <option selected="">Select Vehicle</option>
                            <?php foreach ($vehicles as $vehicle): ?>
                            <option value="<?=$vehicle['id'];?>"><?=$vehicle['vehicle_name'];?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="input12" class="form-label">Fuel Type</label>
                        <select id="input12" name="fuel_type_id" class="form-select">
                            <option selected="">Select Fuel Type</option>
                            <?php foreach ($fuel_types as $type): ?>
                            <option value="<?=$type['id'];?>"><?=$type['name'];?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="input1" class="form-label">Quantity</label>
                        <input type="text" name="quantity" class="form-control" id="input1" placeholder="Quantity" required>
                    </div>
                    <div class="col-md-6">
                        <label for="input2" class="form-label">Price per Litre</label>
                        <input type="text" name="price_per_unit" class="form-control" id="input2" placeholder="Price">
                    </div>
                    <div class="col-md-6">
                        <label for="input3" class="form-label">Filling Station Name</label>
                        <input type="text" name="filling_station_name" class="form-control" id="input3" placeholder="Filling Station Name">
                    </div>
                    <div class="col-md-6">
                        <label for="input4" class="form-label">Location</label>
                        <input type="text" name="location" class="form-control" id="input4" placeholder="Location">
                    </div>
                    <div class="col-md-12">
                        <label for="input23" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="input23" placeholder="Description..." rows="3"></textarea>
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" name="create" class="btn btn-grd-primary px-4 text-white">Add Fuel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>