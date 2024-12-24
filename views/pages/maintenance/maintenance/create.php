<?php

$vehicles = Vehicle::get_vehicles();

?>

<div class="row">
    <div class="col-12 col-xl-12 mx-auto">
        <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
            <div class="card-body p-4">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="">
                        <h5 class="mb-4 fw-bold">Request For Maintenance</h5>
                    </div>
                </div>
                <form action="<?php echo $base_url ?>/maintenance/save" method="POST" class="row g-4">
                    <div class="col-md-12">
                        <label for="input11" class="form-label">Vehicle</label>
                        <select id="input11" name="vehicle_id" class="form-select">
                            <option selected="">Select Vehicle</option>
                            <?php foreach ($vehicles as $vehicle): ?>
                            <option value="<?=$vehicle['id'];?>"><?=$vehicle['vehicle_name'] . " - " . $vehicle['license_no']?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="input20" class="form-label">Cost</label>
                        <input type="text" name="cost" class="form-control" id="input20" placeholder="Cost...">
                    </div>
                    <div class="col-md-12">
                        <label for="input23" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="input23" placeholder="Description..." rows="2"></textarea>
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" name="create" class="btn btn-grd-primary px-4 text-white">Request Maintenance</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>